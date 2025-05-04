<?php 
/**
 * SignupForm class.
 * SignupForm register degli utenti
 */

class SignupForm extends CFormModel
{
	public $username;
	public $email;
	public $password;
	public $password_repeat;

	public function rules()
	{
		return array(
			array('username, password, password_repeat', 'required'),
			array('email', 'email'),
			array('username, email', 'length', 'max'=>128),
			array('password', 'compare', 'compareAttribute'=>'password_repeat', 'message' => 'Le password non coincidono.'),
			array('username, email', 'unique', 'className'=>'TblUser', 'message'=>'{attribute} è già in uso.'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'password_repeat' => 'Conferma password',
		);
	}

	public function register()
	{
		$user = new TblUser;
		$user->username = $this->username;
		$user->email = $this->email;
		$user->password = $this->password;

		if ($user->save()) {
			return true;
		} else {
			// trasferisco gli errori da TblUser a SignupForm
			foreach ($user->getErrors() as $attribute => $errors) {
				foreach ($errors as $error) {
					$this->addError($attribute, $error);
				}
			}
			return false;
		}
	}
}
