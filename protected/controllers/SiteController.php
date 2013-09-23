<?php

class SiteController extends Controller {

	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha' => array(
						'class' => 'CCaptchaAction',
						'backColor' => 0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page' => array(
						'class' => 'CViewAction',
				),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		$this->projectCount = UserProject::Model()->count("user_id=" . Yii::app()->user->id);
		$projectModel = new Project;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Project'])) {
			$projectModel->attributes = $_POST['Project'];
			$projectModel->create_at = date("Y-m-d H:i:s");
			if ($projectModel->save()) {
				$userProject = new UserProject;
				$userProject->project_id = $projectModel->id;
				$userProject->user_id = Yii::app()->user->id;
				$userProject->save();
				$this->refresh();
				$this->redirect(array('/site'));
			}
		}
		$this->render('home', array(
				'projects' => UserProject::model()->findAll("user_id = " . Yii::app()->user->id),
				'projectModel' => $projectModel,));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact() {
		$controller_model = new ContactForm;
		if (isset($_POST['ContactForm'])) {
			$controller_model->attributes = $_POST['ContactForm'];
			if ($controller_model->validate()) {
				$name = '=?UTF-8?B?' . base64_encode($controller_model->name) . '?=';
				$subject = '=?UTF-8?B?' . base64_encode($controller_model->subject) . '?=';
				$headers = "From: $name <{$controller_model->email}>\r\n" .
								"Reply-To: {$controller_model->email}\r\n" .
								"MIME-Version: 1.0\r\n" .
								"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'], $subject, $controller_model->body, $headers);
				Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$controller_model->names = 15;
		$this->render('contact', array('view_model' => $controller_model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$model = new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

}