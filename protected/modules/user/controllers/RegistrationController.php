<?php

class RegistrationController extends Controller {

	public $defaultAction = 'registration';

	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
				'captcha' => array(
						'class' => 'CCaptchaAction',
						'backColor' => 0xFFFFFF,
				),
		);
	}

	/**
	 * Registration user
	 */
	public function actionRegistration() {
		$registerModel = new RegistrationForm;
		$profile = new Profile;
		$profile->regMode = true;
		$loginModel = new UserLogin;
		if (Yii::app()->user->isGuest) {
			// collect user input data
			if (isset($_POST['UserLogin'])) {
				$loginModel->attributes = $_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if ($loginModel->validate()) {
					$this->lastViset();
					if (Yii::app()->user->returnUrl == '/index.php')
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			// display the login form
			//$this->render('/user/authenticate',
			//				array('model'=>$model));
		} //else
		//$this->redirect(Yii::app()->controller->module->returnUrl);
		// ajax validator
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
			echo UActiveForm::validate(array($registerModel, $profile));
			Yii::app()->end();
		}

		if (Yii::app()->user->id) {
			$this->redirect(Yii::app()->controller->module->profileUrl);
		} else {
			if (isset($_POST['RegistrationForm'])) {
				$registerModel->attributes = $_POST['RegistrationForm'];
				$profile->attributes = ((isset($_POST['Profile']) ? $_POST['Profile'] : array()));
				if ($registerModel->validate() && $profile->validate()) {
					$registerModel->username = $registerModel->email;
					$soucePassword = $registerModel->password;
					$registerModel->activkey = UserModule::encrypting(microtime() . $registerModel->password);
					$registerModel->password = UserModule::encrypting($registerModel->password);
					$registerModel->verifyPassword = UserModule::encrypting($registerModel->verifyPassword);
					$registerModel->superuser = 0;
					//$registerModel->status = ((Yii::app()->controller->module->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);

					if ($registerModel->save()) {
						$profile->user_id = $registerModel->id;
						$profile->save();
						if (Yii::app()->controller->module->sendActivationMail) {
							$activation_url = $this->createAbsoluteUrl('/user/activation/activation', array("activkey" => $registerModel->activkey, "email" => $registerModel->email));
							UserModule::sendMail($registerModel->email, UserModule::t("You registered from {site_name}", array('{site_name}' => Yii::app()->name)), UserModule::t("Please activate you account go to {activation_url}", array('{activation_url}' => $activation_url)));
						}

						if ((Yii::app()->controller->module->loginNotActiv || (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false)) && Yii::app()->controller->module->autoLogin) {
							$identity = new UserIdentity($registerModel->username, $soucePassword);
							$identity->authenticate();
							Yii::app()->user->login($identity, 0);
							$this->redirect(Yii::app()->controller->module->returnUrl);
						} else {
							if (!Yii::app()->controller->module->activeAfterRegister && !Yii::app()->controller->module->sendActivationMail) {
								Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
							} elseif (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false) {
								Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please {{login}}.", array('{{login}}' => CHtml::link(UserModule::t('Login'), Yii::app()->controller->module->loginUrl))));
							} elseif (Yii::app()->controller->module->loginNotActiv) {
								Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email or login."));
							} else {
								Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email."));
							}
							$this->refresh();
						}
					}
				}
				else
					$profile->validate();
			}
			$this->render('/user/authenticate',
							array('loginLodel' => $loginModel,
									'registerModel' => $registerModel,
									'profile' => $profile));
		}
	}

}