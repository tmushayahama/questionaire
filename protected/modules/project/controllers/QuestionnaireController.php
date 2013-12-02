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
      'actions' => array('create', 'update', 'dashboard', 'addquestion', 'viewquestions', 'questionnairesearch'),
      'users' => array('@'),
     ),
     array('allow', // allow admin user to perform 'admin' and 'delete' actions
      'actions' => array('admin', 'delete', 'initquestionnaire'),
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
    $questionModel = new QuestionBank;
    $questionSearchModel = new QuestionBank();
    $questionnaireSearchModel = new Questionnaire;
    $searchQuestionnaireCriteria = new CDbCriteria;
    $searchCriteria = new CDbCriteria;
    $searchToolCriteria = new CDbCriteria;
    $searchConceptCriteria = new CDbCriteria;
    $searchYearCriteria = new CDbCriteria;
    //$questionSearchModel->unsetAttributes();	// clear any default values

    if (isset($_POST['QuestionnaireQeustion']['questionnaireList'])) {
      if (is_array($_POST['QuestionnaireQeustion']['questionnaireList'])) {
        foreach ($_POST['QuestionnaireQeustion']['questionnaireList'] as $questionnaire) {
          $searchQuestionnaireCriteria->addCondition('name="' . $questionnaire . '"', 'OR');
        }
      }
    }
    if (isset($_POST['QuestionBank']['questionToolList'])) {
      if (is_array($_POST['QuestionBank']['questionToolList'])) {
        foreach ($_POST['QuestionBank']['questionToolList'] as $tool) {
          $searchToolCriteria->addCondition('tool="' . $tool . '"', 'OR');
        }
      }
    }
    if (isset($_POST['QuestionBank']['questionConceptList'])) {
      if (is_array($_POST['QuestionBank']['questionConceptList'])) {
        foreach ($_POST['QuestionBank']['questionConceptList'] as $concept) {
          $searchConceptCriteria->addCondition("concept='" . $concept . "'", 'OR');
        }
      }
    }
    if (isset($_POST['QuestionBank']['questionYearList'])) {
      if (is_array($_POST['QuestionBank']['questionYearList'])) {
        foreach ($_POST['QuestionBank']['questionYearList'] as $year) {
          $searchYearCriteria->addCondition("year='" . $year . "'", 'OR');
        }
      }
    }
    $searchCriteria->mergeWith($searchToolCriteria, 'AND');
    $searchCriteria->mergeWith($searchConceptCriteria, 'AND');
    $searchCriteria->mergeWith($searchYearCriteria, 'AND');

    $count = QuestionBank::Model()->count($searchCriteria);
    $pages = new CPagination($count);
    $pages->pageSize = 50;
    $pages->applyLimit($searchCriteria);

    $this->render('questionnaire_home', array(
     'projectId' => $projectId,
     'questionnaireId' => $questionnaireId,
     'questions' => QuestionBank::Model()->findAll($searchCriteria),
     'questionCount' => QuestionBank::Model()->count($searchCriteria),
     'pages' => $pages,
     'model' => $this->loadModel($questionnaireId),
     'toolList' => QuestionBank::getUniqueTools(),
     'yearList' => QuestionBank::getUniqueYear(),
     'conceptList' => QuestionBank::getUniqueConcepts(),
     'questionnaireList' => Questionnaire::getQuestionnaires(),
     'questionSearchModel' => $questionSearchModel,
     'questionnaireSearchModel' => $questionnaireSearchModel,
     'question_contents' => UserQuestion::getUserQuestions($questionnaireId)
    ));
  }

  public function actionViewQuestions($projectId, $questionnaireId) {
    $questionModel = new QuestionBank;
    $questionSearchModel = new QuestionBank;
    $questionnaireSearchModel = new Questionnaire;
    $searchCriteria = new CDbCriteria;
    $searchToolCriteria = new CDbCriteria;
    $searchConceptCriteria = new CDbCriteria;
    $searchYearCriteria = new CDbCriteria;

    //$questionSearchModel->unsetAttributes();	// clear any default values
    if (isset($_POST['QuestionBank']['questionToolList'])) {
      if (is_array($_POST['QuestionBank']['questionToolList'])) {
        foreach ($_POST['QuestionBank']['questionToolList'] as $tool) {
          $searchToolCriteria->addCondition('tool="' . $tool . '"', 'OR');
        }
      }
    }
    if (isset($_POST['QuestionBank']['questionConceptList'])) {
      if (is_array($_POST['QuestioBankn']['questionConceptList'])) {
        foreach ($_POST['QuestionBank']['questionConceptList'] as $concept) {
          $searchConceptCriteria->addCondition("concept='" . $concept . "'", 'OR');
        }
      }
    }
    if (isset($_POST['QuestionBank']['questionYearList'])) {
      if (is_array($_POST['QuestionBank']['questionYearList'])) {
        foreach ($_POST['QuestionBank']['questionYearList'] as $year) {
          $searchYearCriteria->addCondition("year='" . $year . "'", 'OR');
        }
      }
    }
    $searchCriteria->mergeWith($searchToolCriteria, 'AND');
    $searchCriteria->mergeWith($searchConceptCriteria, 'AND');
    $searchCriteria->mergeWith($searchYearCriteria, 'AND');

    $count = QuestionBank::Model()->count($searchCriteria);
    $pages = new CPagination($count);
    $pages->pageSize = 50;
    $pages->applyLimit($searchCriteria);

    /* For searching using questionnaire */

    $this->render('questions_home', array(
     'projectId' => $projectId,
     'questionnaireId' => $questionnaireId,
     'questions' => QuestionBank::Model()->findAll($searchCriteria),
     'questionCount' => QuestionBank::Model()->count($searchCriteria),
     'pages' => $pages,
     'model' => $this->loadModel($questionnaireId),
     'toolList' => QuestionBank::getUniqueTools(),
     'yearList' => QuestionBank::getUniqueYear(),
     'conceptList' => QuestionBank::getUniqueConcepts(),
     'questionSearchModel' => $questionSearchModel,
     'question_contents' => UserQuestion::getUserQuestions($questionnaireId)
    ));
  }

  public function actionQuestionnaireSearch($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $searchQuestionnaireCriteria = new CDbCriteria;
      //$questionSearchModel->unsetAttributes();	// clear any default values

      if (isset($_POST['Questionnaire']['questionnaireSelected'])) {
        if (is_array($_POST['Questionnaire']['questionnaireSelected'])) {
          foreach ($_POST['Questionnaire']['questionnaireSelected'] as $questionnaire) {
            $searchQuestionnaireCriteria->addCondition('name="' . $questionnaire . '"', 'OR');
          }
        }
      }
      echo CJSON::encode(array(
       'questionnaire_search_results' => $this->renderPartial('_questionnaire_search_results', array(
        'questionnaires' => Questionnaire::Model()->findAll($searchQuestionnaireCriteria))
         , true)));
    }
    Yii::app()->end();
  }

  public function actionAddQuestion($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $userQuestion = new UserQuestion;
      $questionnaireQuestion = new QuestionnaireQuestion;
      $questionId = Yii::app()->request->getParam('question_id');
      $content = Question::Model()->findByPk($questionId)->content;

      $userQuestion->question_id = $questionId;
      $userQuestion->user_id = Yii::app()->user->id;
      $userQuestion->content = $content;
      $userQuestion->save(false);
      $questionnaireQuestion->question_id = $userQuestion->id;
      $questionnaireQuestion->questionnaire_id = $questionnaireId;
      $questionnaireQuestion->save(false);

      echo CJSON::encode(array(
       'question_row' => $this->renderPartial('_question_row', array(
        'question_content' => $questionnaireQuestion)
         , true)));
    }
    Yii::app()->end();
  }

  public function actionEditQuestion($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $userQuestion = new UserQuestion;
      $questionnaireQuestion = new QuestionnaireQuestion;
      $questionId = Yii::app()->request->getParam('question_id');
      $content = Question::Model()->findByPk($questionId)->content;

      $userQuestion->question_id = $questionId;
      $userQuestion->user_id = Yii::app()->user->id;
      $userQuestion->content = $content;
      $userQuestion->save(false);
      $questionnaireQuestion->question_id = $userQuestion->id;
      $questionnaireQuestion->questionnaire_id = $questionnaireId;
      $questionnaireQuestion->save(false);

      echo CJSON::encode(array(
       'question_row' => $this->renderPartial('_question_row', array(
        'question_content' => $questionnaireQuestion)
         , true)));
    }
    Yii::app()->end();
  }

  public function actionRemoveQuestion($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $userQuestionId = Yii::app()->request->getParam('userQuestion_id');
      $model = UserQuestion::model()->findByPk($userQuestionId);
      $model->delete();
    }
    Yii::app()->end();
  }

  //problem!!!: will delete questions with same question->id in other questionnaire
  public function actionQRemoveQuestion($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $questionId = Yii::app()->request->getParam('question_id');
      $model = UserQuestion::model()->findByAttributes(array('question_id' => $questionId));
      $model->delete();
    }
    Yii::app()->end();
  }

  public function actionMoreInfoQuestion() {
    if (Yii::app()->request->isAjaxRequest) {
      $questionId = Yii::app()->request->getParam('question_id');
      $question = Question::Model()->findByPk($questionId);

      echo CJSON::encode(array(
       'content' => $question->content,
       'concept' => $question->concept,
       'tool' => $question->tool,
       'author' => $question->author,
       'year' => $question->year
      ));
    }
    Yii::app()->end();
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

  public function actionInitQuestionnaire() {
    Questionnaire::initQuestionnaire();
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
