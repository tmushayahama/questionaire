<?php $this->beginContent('//home_layouts/navbar'); ?>
<?php
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/que_questionnaire.js', CClientScript::POS_END
);
?>
<script id="record-task-url" type="text/javascript">
  var questionnaireSearchFromCYUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionnairesearchfromcy/questionnaireId/" . $questionnaireId); ?>";
  var questionnaireSearchFromQUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionnairesearchfromq/questionnaireId/" . $questionnaireId); ?>";
  var questionSearchUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionsearch/questionnaireId/" . $questionnaireId); ?>";
  var questionKeywordSearchUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionkeywordsearch/questionnaireId/" . $questionnaireId); ?>";
  var questionnaireKeywordSearchUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionnaireKeywordSearch/questionnaireId/" . $questionnaireId); ?>";

  var addQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/addquestion/questionnaireId/" . $questionnaireId); ?>";
  var createQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/createquestion/questionnaireId/" . $questionnaireId); ?>";
  var editQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/editquestion"); ?>";
  var moreInfoQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/viewModifiedQuestions"); ?>";
  var getUserQuestionToDeleteUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/getUserQuestionToDelete/questionnaireId/" . $questionnaireId); ?>";
  var removeQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/removequestion/questionnaireId/" . $questionnaireId); ?>"
  var duplicateQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/duplicatequestion/questionnaireId/" . $questionnaireId); ?>"

</script>

<div class="row-fluid">
  <ul class="breadcrumb que-breadcrumb">
    <li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-link')); ?><span class="divider">/</span></li>
    <li><?php echo CHtml::link("Project: " . Project::model()->findByPk($projectId)->name, Yii::app()->createUrl("project/project/view", array("id" => $projectId)), array('class' => 'btn btn-link')) ?><span class="divider">/</span></li>
    <li class="active">Questionnaire</li>

    <!--<li class="offset7"><a href="#new-project-modal" role="button" class="gb-btn" data-toggle="modal">Manage Questionnaire</a></li>-->
  </ul>
  <div class="que-topbar-nav container">
    <div class="row">
      <h4 class="pull-left"><?php echo $model->name ?></h4>
      <ul id="que-topbar-nav-list" class="que-nav-1 pull-right">
        <li class="active"><a href="#questionnaire-design-pane" data-toggle="tab">Design Questionnaire</a></li>
        <li class=""><a href="#questionnaire-summary-pane" data-toggle="tab">Summary</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="container">
  <div class="row-fluid que-white-background">
    <div class="tab-content">
      <div class="tab-pane active " id="questionnaire-design-pane">
        <div class="que-sidebar row-fluid">
          <h3 class="sub-heading-1">Design Questionnaire</h3>
          <ul id="que-questionnaire-activity-nav" class="que-sidebar-nav-1">
            <li class="active"><a href="#que-questionnaire-edit-pane" data-toggle="tab">Edit Questionnaire<i class="icon-chevron-right pull-right"></i></a></li>
            <br>
            <h4 class="sub-heading-2">Add Question</h4>
            <li class=""><a href="#que-questionnaire-bank-pane" data-toggle="tab">From Questionnaire Bank <i class="icon-chevron-right pull-right"></i></a></li>
            <li class=""><a href="#que-question-bank-pane" data-toggle="tab">From Question Bank<i class="icon-chevron-right pull-right"></i></a></li>
            <li class=""><a href="#que-create-new-question-bank-pane" data-toggle="tab">Create Your Own<i class="icon-chevron-right pull-right"></i></a></li>
          </ul>
        </div><!--/span-->
        <div class="que-middle-container row-fluid">
          <div class="tab-content row">
            <div class="tab-pane active"id="que-questionnaire-edit-pane">
              <div class="tab-heading">
                <div class="pull-left">Edit Questionnaire</div>
                <div class="pull-right">
                  <?php echo UserQuestion::getUserQuestionsCount($questionnaireId) ?><small> questions</small>
                </div>
              </div>
              <div id="que-questionnaire-questions" class="span11">
                <?php
                $count = 1;
                foreach ($userQuestions as $userQuestion):
                  echo $this->renderPartial('_question_row', array(
                   'count' => $count++,
                   'userQuestion' => $userQuestion));
                endforeach;
                ?>
              </div>
            </div>
            <div class="tab-pane"id="que-questionnaire-bank-pane">
              <div class="tab-heading">
                Add from Questionnaire Bank
              </div>
              <div class="row-fluid">
                <?php
                echo $this->renderPartial('_search_questionnaires_form', array(
                 'questionnaireSearchFromCYModel' => $questionnaireSearchFromCYModel,
                 'questionnaireSearchFromQModel' => $questionnaireSearchFromQModel,
                 'toolList' => $toolList,
                 "yearList" => $yearList,
                 'conceptList' => $conceptList));
                ?>
              </div>
              <div id="que-questionnaire-result" class="row-fluid">

              </div>
            </div>
            <div class="tab-pane"id="que-question-bank-pane">
              <div class="tab-heading">
                Add from Question Bank
              </div>
              <div class="row-fluid">
                <?php
                echo $this->renderPartial('_search_questions_form', array('model' => $questionSearchModel,
                 "yearList" => $yearList,
                 'conceptList' => $conceptList));
                ?>
              </div>
              <div id="que-question-result" class="row-fluid">

              </div>
            </div>
            <div class="tab-pane"id="que-create-new-question-bank-pane">
              <div class="tab-heading">
                Create your Own Question
              </div>
              <div class="row-fluid">
                <textarea id="que-create-question-input" class="input-block-level" rows="4"></textarea>
                <div class="row-fluid gb-footer">
                  <button id="que-save-create-question-btn" class="que-btn que-btn-blue-2" >Save</button>
                  <button id="que-cancel-create-question-btn" class="que-btn  que-btn-grey-1">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="questionnaire-summary-pane">
        <div class="tab-heading">
          <div class="pull-left">Total Questions</div>
          <div class="pull-right">
            <?php echo UserQuestion::getUserQuestionsCount($questionnaireId) ?>
          </div>
        </div>

        <div class="que-stats-row-1 row-fluid">
          <div class=" que-stats offset1 span3">
            <h1><?php echo UserQuestion::getUserQuestionsOriginalCount($questionnaireId) ?></h1>
            <h3>Original Questions</h3>
          </div>
          <div class="que-stats span4">
            <h1><?php echo UserQuestion::getUserQuestionsModifiedCount($questionnaireId) ?></h1>
            <h3>Questions Modified</h3>
          </div>
          <div class="que-stats span3">
            <h1><?php echo UserQuestion::getUserQuestionsCreatedCount($questionnaireId) ?></h1>
            <h3>Questions New</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<div id="que-search-summary-modal" class="modal hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <span><h3>Search Criteria Summary</h3>
  </span>
  <div class="modal-body">
    <div class="span6">
      Selected Tool(s)
    </div>
    <div class="span6">
      Selected Concept(s)
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
<div id="user-question-to-delete-modal" class="modal modal-thick hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <span><h3>Remove Referenced Question</h3><p>
    You can remove directly from here. 
    </p>
  </span>
  <div class="modal-body">

  </div>
  <div class="modal-footer">
    <button id="que-delete-all" class="que-btn que-btn-red-1" data-dismiss="modal" aria-hidden="true">Delete All</button>
    <button type="button" class="que-btn que-btn-grey-1" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
<div id="question-modified-modal" class="modal modal-thick hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <span><h3>View Modified</h3>
  </span>
  <div class="modal-body">
    <div class="span12">

    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
<div id="edit-add-question-modal" class="modal hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <span><h3>Edit and Add</h3>
  </span>
  <div class="modal-body">
    <div class="span12">
      <dl class="dl-horizontal">
        <dt>
        Content
        </dt>
        <dd>
          <textarea class="span12" id="edit-add-question-input" rows=3> </textarea>
        </dd>
        <dt>
        Scale
        </dt>
        <dd>
          <textarea class="span12" id="edit-scale-input" rows=3> 
          </textarea>
        </dd>
      </dl>
    </div>
  </div>
  <div class="modal-footer">
    <button id="add-question" class="btn btn-success" data-dismiss="modal" aria-hidden="true">Add</button>
    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
<?php $this->endContent(); ?>