<?php

class ProjectModule extends CWebModule {

	public $createProjectUrl = 'project/project/create';
	public $viewProjectUrl = 'project/project/view/id/';
	public $createQuestionnaireUrl = '/project/questionnaire/dashboard/projectId/';
	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		// import the module-level models and components
		$this->setImport(array(
				'project.models.*',
				'project.components.*',
		));
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

}
