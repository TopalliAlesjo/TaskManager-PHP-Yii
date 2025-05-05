<?php

use function PHPSTORM_META\type;

class TaskController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('view', 'create', 'update', 'manageTask', 'delete', 'changeStatus'), // tolto 'index' per evitare bypass url
				'users' => array('@'),
			),
			array(
				'deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$labels = array(
			'To_Do' => 'Da fare',
			'In_Progress' => 'In elaborazione',
			'Done' => 'Conclusa'
		);

		if (isset($labels[$model->status])) {
			$statuslabel = $labels[$model->status];
		} else {
			$statuslabel = $model->status;
		}

		$this->render('view', array(
			'model' => $model,
			'statuslabel' => $statuslabel,
		));
	}
	/**
	 * Aggiorna lo stato delle task.
	 */
	public function actionChangeStatus($id, $status)
	{
	    $model = $this->loadModel($id);
	    
	    // Verifica che lo stato sia valido
	    $validStatuses = array('To_Do', 'In_Progress', 'Done');
	    if(!in_array($status, $validStatuses)) {
	        throw new CHttpException(400, 'Stato non valido.');
	    }
	    
	    $model->status = $status;
	    $model->updated_at = new CDbExpression('NOW()'); // Aggiorna il timestamp
	    
	    if($model->save()) {
	        // Redirect alla stessa pagina con lo stesso filtro di stato
	        $currentStatus = isset($_GET['Task']['status']) ? $_GET['Task']['status'] : $status;
	        $this->redirect(array('manageTask', 'Task[status]' => $currentStatus));
	    } else {
	        throw new CHttpException(500, 'Errore nel cambiare lo stato della task.');
	    }
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Task;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		// Recupera l'ID numerico dell'utente loggato
		$user = TblUser::model()->findByAttributes(['username' => Yii::app()->user->id]);
		$userId = $user->id;
		$model->user_id = $userId;
		// prepara redirect appena salvato la task
		if (isset($_POST['Task'])) {
			$model->attributes = $_POST['Task'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Task'])) {
			$model->attributes = $_POST['Task'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manageTask', 'Task[status]' => 'To_Do'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// Recupera l'ID numerico dell'utente loggato
		$user = TblUser::model()->findByAttributes(['username' => Yii::app()->user->id]);
		if ($user) {
			$userId = $user->id;
		} else {
			$userId = 0;
		}

		$criteria = new CDbCriteria();
		$criteria->compare('user_id', $userId);

		$dataProvider = new CActiveDataProvider('Task', array(
			'criteria' => $criteria,
		));

		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionManageTask()
	{
		$model = new Task('search');

		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Task']))
			$model->attributes = $_GET['Task'];
		/* FILTRO DA LINGUAGGIO DB A PREDEFINITO */
		$labels = array(
			'To_Do' => 'Da fare',
			'In_Progress' => 'In elaborazione',
			'Done' => 'Conclusa'
		);

		if (isset($labels[$model->status])) {
			$statuslabel = $labels[$model->status];
		} else {
			$statuslabel = $model->status;
		}
		$this->render('manageTask', array(
			'model' => $model,
			'statuslabel' => $statuslabel,
		));
	}

/* TYPE: {
0= task(singolare)
1= titolo(plurale)
}*/
	public static function getStatusLabel($status,$type) { 
		if ($status == "To_Do") {
			return "Da fare";
		}
		if ($status == "In_Progress") {
			return "In elaborazione";
		} else {

		}
		if ($status == "Done" && $type = 0) {
			return "Conclusa";
		} elseif ($status == "Done" && $type = 1) {
			return "Concluse";
		} else {
			return $status;
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Task the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Task::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Task $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'task-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
