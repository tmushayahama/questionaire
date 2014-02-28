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
      'actions' => array('create', 'update', 'dashboard', 'addquestion', 'createquestion', 'viewquestions',
       'questionbrowse', 'questionnairesearchfromcy', 'GetUserQuestionToDelete', 'questionKeywordSearch',
       'questionnaireKeywordSearch'),
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
    $questionSearchModel = new QuestionBank();
    $questionnaireSearchFromCYModel = new QuestionBank;
    $questionnaireSearchFromQModel = new Questionnaire;

    $this->render('questionnaire_home', array(
     'projectId' => $projectId,
     'questionnaireId' => $questionnaireId,
     'model' => $this->loadModel($questionnaireId),
     //'sortcodes' => QuestionSort::getChildCode("Root"),
     'toolList' => QuestionBank::getUniqueTools(),
     'yearList' => QuestionBank::getUniqueYear(),
     'conceptList' => QuestionBank::getUniqueConcepts(),
     'questionnaireList' => Questionnaire::getQuestionnaires(),
     'questionSearchModel' => $questionSearchModel,
     'questionnaireSearchFromCYModel' => $questionnaireSearchFromCYModel,
     'questionnaireSearchFromQModel' => $questionnaireSearchFromQModel,
     'userQuestions' => UserQuestion::getUserQuestions($questionnaireId)
    ));
  }

  public function actionQuestionBrowse() {
    if (Yii::app()->request->isAjaxRequest) {
      $parentCode = Yii::app()->request->getParam('parent_code');
      $sortcodeChild = $this->renderPartial('sortcode/_sortcode_child', array(
       'sortcodes' => QuestionSort::getChildCode($parentCode),
       'childCode' => $parentCode,)
        , true
        , true);
      echo CJSON::encode(array(
       'sortcode_child' => $sortcodeChild,
       'question_search_results' => $this->renderPartial('_question_search_results', array(
        'questions' => QuestionBank::Model()->findAll("sort_code='" . $parentCode . "'"),
        'questionCount' => QuestionBank::Model()->count("sort_code='" . $parentCode . "'"),
        'questionnaireId' => null,
        'pages' => null)
         , true
         , true)));
    }
    Yii::app()->end();
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

  public function actionPopulateFilters() {
    if (Yii::app()->request->isAjaxRequest) {

      echo CJSON::encode(array(
       'question_search_results' => $this->renderPartial('_question_search_results', array(
        'questions' => QuestionBank::Model()->findAll($searchCriteria),
        'questionCount' => QuestionBank::Model()->count($searchCriteria),
        'questionnaireId' => $questionnaireId,
        'pages' => $pages)
         , true
         , true)));
    }
    Yii::app()->end();
  }

  /* public function actionQuestionSearch($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
    $questionSearchModel = new QuestionBank();
    $questionnaireSearchModel = new QuestionBank;
    //$searchQuestionnaireCriteria = new CDbCriteria;
    $searchCriteria = new CDbCriteria;
    //$searchToolCriteria = new CDbCriteria;
    $searchConceptCriteria = new CDbCriteria;
    $searchYearCriteria = new CDbCriteria;
    //$questionSearchModel->unsetAttributes();	// clear any default values

    /* if (isset($_POST['QuestionnaireQeustion']['questionnaireList'])) {
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
    } *
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
    //  $searchCriteria->mergeWith($searchToolCriteria, 'AND');
    $searchCriteria->mergeWith($searchConceptCriteria, 'AND');
    $searchCriteria->mergeWith($searchYearCriteria, 'AND');

    $count = QuestionBank::Model()->count($searchCriteria);
    $pages = new CPagination($count);
    $pages->pageSize = 50;
    $pages->applyLimit($searchCriteria);
    echo CJSON::encode(array(
    'no_results'=> $count,
    'question_search_results' => $this->renderPartial('_question_search_results', array(
    'questions' => QuestionBank::Model()->findAll($searchCriteria),
    'questionCount' => $count,
    'questionnaireId' => $questionnaireId,
    'pages' => $pages)
    , true
    , true)));
    }
    Yii::app()->end();
    } */

  public function actionQuestionKeywordSearch($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $keyword = Yii::app()->request->getParam('keyword');
      // $tool = Yii::app()->request->getParam('tool');
      $concept = Yii::app()->request->getParam('concept');
      $sortId = Yii::app()->request->getParam('sort_id');
      $year = Yii::app()->request->getParam('year');
      $selectedDropdowns = Yii::app()->request->getParam('selected_dropdown');
      $selectedFilterType = Yii::app()->request->getParam('selected_filter_type');
      $selectedFilter = Yii::app()->request->getParam('selected_filter');
      $resultOutput = Yii::app()->request->getParam('result_output');
      if ($sortId != null) {
        //combine the 2
        $sortId.=" ".Yii::app()->request->getParam('order');
      }
      $model = new QuestionBank();
      // $toolList = QuestionBank::getUniqueColumn($keyword, $tool, $concept, $year, "tool");
      $conceptList = QuestionBank::getUniqueColumn($keyword, null, $concept, $year, "concept");
      $yearList = QuestionBank::getUniqueColumn($keyword, null, $concept, $year, "year");
      //$count = QuestionBank::Model()->count($searchCriteria);
      $questionCount = QuestionBank::keywordSearchCount($keyword, null, $concept, $year);
      $pages = new CPagination(100);
      $pages->pageSize = 100;
      $resultRow = "";

      $selectedFilterView = null;
      //$toolDropdown = null;
      $conceptDropdown = null;
      $yearDropdown = null;

      if ($resultOutput == 1) {
        $resultRow = $this->renderPartial('_question_search_results', array(
         'questions' => QuestionBank::keywordSearch($keyword, null, $concept, $year, $sortId, 50),
         'questionCount' => $questionCount,
         'questionnaireId' => $questionnaireId,
         'pages' => $pages)
          , true
          , true);
      } else {
        $resultRow = $this->renderPartial('_questionnaire_search_results', array(
         'questionnaires' => QuestionnaireQuestionBank::keywordSearch($keyword, null, $concept, $year, 10),
         'questionnaireId' => $questionnaireId)
          , true);
      }
      /*  if (in_array("que-question-tool-dropdown", $selectedDropdowns)) {
        $toolDropdown = CHtml::activeDropDownList(
        $model, 'year', CHtml::listData($toolList, 'tool', 'tool'), array(
        'id' => 'que-question-tool-dropdown',
        'filter-type' => QuestionBank::$FILTER_TOOL,
        //'empty' => 'Select a Questionnaire',
        // 'options' => array('2' => array('selected' => true)),
        'class' => 'input-block-level'));
        } else {
        $toolDropdown = CHtml::activeDropDownList(
        $model, 'year', CHtml::listData($toolList, 'tool', 'tool'), array(
        'id' => 'que-question-tool-dropdown',
        'filter-type' => QuestionBank::$FILTER_TOOL,
        'empty' => 'Select a Questionnaire',
        'class' => 'input-block-level'));
        } */
      if (in_array("que-question-concept-dropdown", $selectedDropdowns)) {
        $conceptDropdown = CHtml::activeDropDownList(
            $model, 'concept', CHtml::listData($conceptList, 'concept', 'concept'), array(
           'id' => 'que-question-concept-dropdown',
           'filter-type' => QuestionBank::$FILTER_CONCEPT,
           //'empty' => 'Select a Concept',
           'class' => 'input-block-level'
        ));
      } else {
        $conceptDropdown = CHtml::activeDropDownList(
            $model, 'concept', CHtml::listData($conceptList, 'concept', 'concept'), array(
           'id' => 'que-question-concept-dropdown',
           'filter-type' => QuestionBank::$FILTER_CONCEPT,
           'empty' => 'Select a Concept',
           //'options' => array('1' => array('selected' => true)),
           'class' => 'input-block-level'
        ));
      }
      if (in_array("que-question-year-dropdown", $selectedDropdowns)) {
        $yearDropdown = CHtml::activeDropDownList(
            $model, 'year', CHtml::listData($yearList, 'year', 'year'), array(
           'id' => 'que-question-year-dropdown',
           'filter-type' => QuestionBank::$FILTER_YEAR,
           //'empty' => 'Select a Year',
           'class' => 'input-block-level'
        ));
      } else {
        $yearDropdown = CHtml::activeDropDownList(
            $model, 'year', CHtml::listData($yearList, 'year', 'year'), array(
           'id' => 'que-question-year-dropdown',
           'filter-type' => QuestionBank::$FILTER_YEAR,
           'empty' => 'Select a Year',
           // 'options' => array('1' => array('selected' => true)),
           'class' => 'input-block-level'
        ));
      }
      if ($selectedFilter != null) {
        $selectedFilterView = $this->renderPartial('_selected_filter_row', array(
         'filterTypeId' => $selectedFilterType,
         'filterType' => $this->questionFilterType($selectedFilterType),
         'filterSelected' => $selectedFilter)
          , true);
      }

      echo CJSON::encode(array(
       'no_results' => $questionCount == 0,
       'selected_dropdown' => $selectedDropdowns,
       'filter_selected' => $selectedFilterView,
       //'tool_dropdown' => $toolDropdown,
       'concept_dropdown' => $conceptDropdown,
       'year_dropdown' => $yearDropdown,
       'question_search_results' => $resultRow,));
    }
    Yii::app()->end();
  }

  public function actionQuestionnaireKeywordSearch($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $keyword = Yii::app()->request->getParam('keyword');


      echo CJSON::encode(array(
       'questionnaire_search_results' => $this->renderPartial('_questionnaire_search_results', array(
        'questionnaires' => QuestionnaireQuestionBank::keywordSearch($keyword, 10),
        'questionnaireId' => $questionnaireId)
         , true)));
    }
    Yii::app()->end();
  }

  public function actionQuestionnaireSearchFromCY($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $searchQuestionnaireCriteria = new CDbCriteria;
      $searchCriteria = new CDbCriteria;
      $searchConceptCriteria = new CDbCriteria;
      $searchYearCriteria = new CDbCriteria;
      //$questionSearchModel->unsetAttributes();	// clear any default values
      $searchConceptCriteria->with = array
       ("question" => array("alias" => "t2"));
      $searchYearCriteria->with = array
       ("question" => array("alias" => "t2"));
      $searchCriteria->with = array
       ("question" => array("alias" => "t2"),
       "bankQuestionnaire" => array("alias" => "t3"));
      if (isset($_POST['QuestionBank'][3]['questionConceptList'])) {
        if (is_array($_POST['QuestionBank'][3]['questionConceptList'])) {
          foreach ($_POST['QuestionBank'][3]['questionConceptList'] as $concept) {
            $searchConceptCriteria->addCondition("t2.concept='" . $concept . "'", 'OR');
          }
        }
      }
      if (isset($_POST['QuestionBank'][3]['questionYearList'])) {
        if (is_array($_POST['QuestionBank'][3]['questionYearList'])) {
          foreach ($_POST['QuestionBank'][3]['questionYearList'] as $year) {
            $searchYearCriteria->addCondition("t2.year='" . $year . "'", 'OR');
          }
        }
      }
      $searchCriteria->mergeWith($searchConceptCriteria, 'AND');
      $searchCriteria->mergeWith($searchYearCriteria, 'AND');
      $searchCriteria->group = "bank_questionnaire_id";
      $searchCriteria->distinct = true;

      echo CJSON::encode(array(
       'questionnaire_search_results' => $this->renderPartial('_questionnaire_search_results', array(
        'questionnaires' => QuestionnaireQuestionBank::Model()->findAll($searchCriteria),
        'questionnaireId' => $questionnaireId)
         , true)));
    }
    Yii::app()->end();
  }

  public function actionQuestionnaireSearchFromQ($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      //$searchQuestionnaireCriteria = new CDbCriteria;
      //$searchCriteria = new CDbCriteria;
      //$searchConceptCriteria = new CDbCriteria;
      $searchToolCriteria = new CDbCriteria;
      $searchToolCriteria->with = array(
       "bankQuestionnaire" => array("alias" => "t3"));
      $searchToolCriteria->group = "bank_questionnaire_id";
      $searchToolCriteria->distinct = true;
      //$questionSearchModel->unsetAttributes();	// clear any default values
      ///$searchToolCriteria->with = array
      // ("question" => array("alias" => "t2"));
      if (isset($_POST['Questionnaire'][2]['questionnaireSelected'])) {
        if (is_array($_POST['Questionnaire'][2]['questionnaireSelected'])) {
          foreach ($_POST['Questionnaire'][2]['questionnaireSelected'] as $name) {
            $searchToolCriteria->addCondition("t3.name='" . $name . "'", 'OR');
          }
        }
      }
      //$searchCriteria->mergeWith($searchConceptCriteria, 'AND');
      // $searchCriteria->mergeWith($searchYearCriteria, 'AND');
      // $searchCriteria->group = "bank_questionnaire_id";
      // $searchCriteria->distinct = true;

      echo CJSON::encode(array(
       'questionnaire_search_results' => $this->renderPartial('_questionnaire_search_results', array(
        'questionnaires' => QuestionnaireQuestionBank::Model()->findAll($searchToolCriteria),
        'questionnaireId' => $questionnaireId)
         , true)));
    }
    Yii::app()->end();
  }

  public function actionAddQuestion($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $userQuestion = new UserQuestion;
      $questionId = Yii::app()->request->getParam('question_id');
      $questionStatus = Yii::app()->request->getParam('question_status');
      $questionBankModel = QuestionBank::Model()->findByPk($questionId);
      $content = $questionBankModel->content;


      $userQuestion->parent_id = $questionId;
      $userQuestion->questionnaire_id = $questionnaireId;
      $userQuestion->content = $content;
      $userQuestion->status = $questionStatus;
      $userQuestion->order = UserQuestion::getUserQuestionsCount($questionnaireId);
      if ($userQuestion->save(false)) {
        QuestionBank::modifyTimesAdded($questionBankModel, true);
      }

      echo CJSON::encode(array(
       'orginal_questions_count' => UserQuestion::getUserQuestionsOriginalCount($questionnaireId),
       'modified_questions_count' => UserQuestion::getUserQuestionsModifiedCount($questionnaireId),
       'created_questions_count' => UserQuestion::getUserQuestionsCreatedCount($questionnaireId),
       'question_row' => $this->renderPartial('_question_row', array(
        'count' => 1,
        'userQuestion' => $userQuestion)
         , true)));
    }
    Yii::app()->end();
  }

  public function actionDuplicateQuestion($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {

      $duplicatedUserQuestion = new UserQuestion;
      $originalUserQuestionId = Yii::app()->request->getParam('user_question_id');
      $originalUserQuestion = UserQuestion::Model()->findByPk($originalUserQuestionId);
      $duplicatedUserQuestion->attributes = $originalUserQuestion->attributes;
      if ($duplicatedUserQuestion->save(false)) {
        
      }

      echo CJSON::encode(array(
       'orginal_questions_count' => UserQuestion::getUserQuestionsOriginalCount($questionnaireId),
       'modified_questions_count' => UserQuestion::getUserQuestionsModifiedCount($questionnaireId),
       'created_questions_count' => UserQuestion::getUserQuestionsCreatedCount($questionnaireId),
       'original_user_question_id' => $originalUserQuestion->id,
       'question_row' => $this->renderPartial('_question_row', array(
        'count' => 1,
        'userQuestion' => $duplicatedUserQuestion)
         , true)));
    }
    Yii::app()->end();
  }

  public function actionCreateQuestion($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $userQuestion = new UserQuestion;
      $questionContent = Yii::app()->request->getParam('content');


      $userQuestion->questionnaire_id = $questionnaireId;
      $userQuestion->content = $questionContent;
      $userQuestion->status = UserQuestion::$NEW_QUESTION;
      if ($userQuestion->save(false)) {
        
      }

      echo CJSON::encode(array(
       'orginal_questions_count' => UserQuestion::getUserQuestionsOriginalCount($questionnaireId),
       'modified_questions_count' => UserQuestion::getUserQuestionsModifiedCount($questionnaireId),
       'created_questions_count' => UserQuestion::getUserQuestionsCreatedCount($questionnaireId),
       'question_row' => $this->renderPartial('_question_row', array(
        'count' => 1,
        'userQuestion' => $userQuestion)
         , true)));
    }
    Yii::app()->end();
  }

  public function actionEditQuestion($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $userQuestionId = Yii::app()->request->getParam('user_question_id');
      $content = Yii::app()->request->getParam('content');
      $userQuestion = UserQuestion::Model()->findByPk($userQuestionId);

      $userQuestion->content = $content;
      if ($userQuestion->status == UserQuestion::$FROM_QUESTIONNAIRE) {
        $userQuestion->status = UserQuestion::$FROM_QUESTIONNAIRE_MODIFIED;
      }
      if ($userQuestion->status == UserQuestion::$FROM_QUESTION) {
        $userQuestion->status = UserQuestion::$FROM_QUESTION_MODIFIED;
      }
      if ($userQuestion->save()) {
        if ($userQuestion->status != UserQuestion::$NEW_QUESTION) {
          $question = QuestionBank::Model()->findByPk($userQuestion->parent_id);
          $question->times_modified++;
          $question->save();
        }
      }
      echo CJSON::encode(array(
       'orginal_questions_count' => UserQuestion::getUserQuestionsOriginalCount($questionnaireId),
       'modified_questions_count' => UserQuestion::getUserQuestionsModifiedCount($questionnaireId),
       'created_questions_count' => UserQuestion::getUserQuestionsCreatedCount($questionnaireId),
       "content" => $userQuestion->content,
       "user_question_id" => $userQuestion->id));
    }
    Yii::app()->end();
  }

  public function actionReorderQuestion($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $questionIds = Yii::app()->request->getParam("question_ids");
      $idCount = count($questionIds);
      for ($i = 0; $i < $idCount; $i++) {
        $userQuestion = UserQuestion::Model()->findByPk($questionIds[$i]);
        $userQuestion->order = $idCount + 1 - $i;
        if ($userQuestion->save(false)) {
          
        }
      }

      echo CJSON::encode(array(
       'done' => count($questionIds)));
    }
    Yii::app()->end();
  }

  public function actionRemoveQuestion($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $userQuestionId = Yii::app()->request->getParam('userQuestion_id');
      $model = UserQuestion::model()->findByPk($userQuestionId);
      $model->delete();
      echo CJSON::encode(array(
       'orginal_questions_count' => UserQuestion::getUserQuestionsOriginalCount($questionnaireId),
       'modified_questions_count' => UserQuestion::getUserQuestionsModifiedCount($questionnaireId),
       'created_questions_count' => UserQuestion::getUserQuestionsCreatedCount($questionnaireId),
       "user_question_id" => $userQuestionId));
    }
    Yii::app()->end();
  }

  public function actionGetUserQuestionToDelete($questionnaireId) {
    if (Yii::app()->request->isAjaxRequest) {
      $parentId = Yii::app()->request->getParam('question_id');
      $questionStatus = Yii::app()->request->getParam('question_status');


      echo CJSON::encode(array(
       'user_questions_to_delete' => $this->renderPartial('_user_questions_to_delete', array(
        'count' => 1,
        'userQuestions' => UserQuestion::getUserQuestionsByParentId($questionnaireId, $parentId))
         , true)));
    }
    Yii::app()->end();
  }

  public function actionViewModifiedQuestions() {
    if (Yii::app()->request->isAjaxRequest) {
      $questionId = Yii::app()->request->getParam('question_id');


      echo CJSON::encode(array(
       'question_id' => $questionId,
       'questions_modified_container' => $this->renderPartial('_questions_modified_container', array(
        'userQuestions' => UserQuestion::getModified($questionId),
         )
         , true
         , true)));
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
      $question = QuestionBank::Model()->findByPk($questionId);

      echo CJSON::encode(array(
       'question_id' => $question->id,
       'concept' => $question->concept,
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

  public function questionFilterType($filterType) {
    switch ($filterType) {
      case QuestionBank::$FILTER_CONCEPT:
        return "Concept:";
      case QuestionBank::$FILTER_TOOL:
        return "Questionnaire:";
      case QuestionBank::$FILTER_YEAR:
        return "Year:";
    }
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
