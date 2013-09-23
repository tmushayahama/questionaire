<?php

class QuestionnaireController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters() {
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
	public function accessRules() {
		return array(
				array('allow', // allow all users to perform 'index' and 'view' actions
						'actions' => array(),
						'users' => array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions' => array('create', 'update', 'dashboard'),
						'users' => array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions' => array('admin', 'delete'),
						'users' => array('admin'),
				),
				array('deny', // deny all users
						'users' => array('*'),
				),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionDashboard($projectId) {
		$this->render('dashboard', array(
						//'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($projectId, $questionnaireId) {
		$questionModel = new Question;
		$questionSearchModel = new Question();
		$searchCriteria = new CDbCriteria;
		//$questionSearchModel->unsetAttributes();	// clear any default values
		if (isset($_POST['Question']['questionToolList'])) {
			if (is_array($_POST['Question']['questionToolList'])) {
				foreach ($_POST['Question']['questionToolList'] as $tool) {
					$searchCriteria->addCondition("tool='" . $tool . "'", 'OR');
				}
			}
		}
		if (isset($_POST['Question']['questionConceptList'])) {
			if (is_array($_POST['Question']['questionConceptList'])) {
				foreach ($_POST['Question']['questionConceptList'] as $concept) {
					$searchCriteria->addCondition("concept='" . $concept . "'", 'OR');
				}
			}
		}


		$this->render('view', array(
				'questions' => Question::Model()->findAll($searchCriteria),
				'questionCount' => Question::Model()->count($searchCriteria),
				'model' => $this->loadModel($questionnaireId),
				'toolList' => Question::getUniqueTools(),
				'conceptList' => Question::getUniqueConcepts(),
				'questionSearchModel' => $questionSearchModel
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Questionnaire;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Questionnaire'])) {
			$model->attributes = $_POST['Questionnaire'];
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
	public function actionUpdate($id) {
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Questionnaire'])) {
			$model->attributes = $_POST['Questionnaire'];
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
	public function actionDelete($id) {
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Questionnaire');
		$this->render('index', array(
				'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Questionnaire('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['Questionnaire']))
			$model->attributes = $_GET['Questionnaire'];

		$this->render('admin', array(
				'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Questionnaire the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = Questionnaire::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Questionnaire $model the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionnaire-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}

