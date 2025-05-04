<?php

/**
 * This is the model class for table "tbl_task".
 *
 * The followings are the available columns in table 'tbl_task':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property string $due_date
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property TblUser $user
 */
class Task extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, status, created_at', 'required'),

			array('user_id', 'numerical', 'integerOnly' => true),
			array('title', 'length', 'max' => 255),
			array('status', 'length', 'max' => 11),
			array('description, due_date, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, status, due_date, user_id, created_at, updated_at', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'TblUser', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Titolo',
			'description' => 'Descrizione',
			'status' => 'Stato',
			'due_date' => 'Data Scadenza',
			'user_id' => 'User',
			'created_at' => 'Creato il',
			'updated_at' => 'Aggiornato il',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new CDbCriteria;

		// ...altri confronti...
		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('due_date', $this->due_date, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);
		
		// Filtro per utente loggato
		$user = TblUser::model()->findByAttributes(['username' => Yii::app()->user->id]);
		if ($user) {
			$criteria->compare('user_id', $user->id);
		} else {
			$criteria->compare('user_id', 0); // Nessun risultato se non loggato
		}
				// Filtro per utente loggato
		$criteria->compare('status', $this->status, true);
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
