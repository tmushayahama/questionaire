<?php $this->beginContent('//home_layouts/navbar'); ?>
<?php
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/que_questionnaire.js', CClientScript::POS_END
);
?>
<script id="record-task-url" type="text/javascript">
  var questionnaireSearchUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionnairesearch/questionnaireId/" . $questionnaireId); ?>";
  var addQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/addquestion/questionnaireId/" . $questionnaireId); ?>";
  var editQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/editquestion"); ?>";
  var moreInfoQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/moreinfoquestion"); ?>";
  var removeQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/removequestion/questionnaireId/" . $questionnaireId); ?>"
  var qRemoveQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/qremovequestion/questionnaireId/" . $questionnaireId); ?>"
</script>

<div class="row-fluid">
  <ul class="breadcrumb que-breadcrumb">
    <li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-link')); ?><span class="divider">/</span></li>
    <li><?php echo CHtml::link("Project: " . Project::model()->findByPk($projectId)->name, Yii::app()->createUrl("project/project/view", array("id" => $projectId)), array('class' => 'btn btn-link')) ?><span class="divider">/</span></li>
    <li class="active">Questionnaire</li>

    <!--<li class="offset7"><a href="#new-project-modal" role="button" class="gb-btn" data-toggle="modal">Manage Questionnaire</a></li>-->
  </ul>
</div>
<div class="container">
  <div class="row que-topbar">
    <h2><?php echo $model->name ?></h2>
  </div>
  <div class="row-fluid que-border-top-red-1 que-white-background">
    <div id="que-questionnaire-sidebar" class="span3">
      <div class="">
        <ul id="que-questionnaire-activity-nav" class="">
          <li class="active"><a href="#que-questionnaire-edit-pane" data-toggle="tab">Edit Questionnaire<i class="icon-chevron-right pull-right"></i></a></li>

          <h5>Add Question</h5>
          <li class=""><a href="#que-questionnaire-bank-pane" data-toggle="tab">From Questionnaire Bank <i class="icon-chevron-right pull-right"></i></a></li>
          <li class=""><a href="#que-question-bank-pane" data-toggle="tab">From Question Bank<i class="icon-chevron-right pull-right"></i></a></li>
          <li class=""><a href="#que-create-new-question-bank-pane" data-toggle="tab">Create Your Own<i class="icon-chevron-right pull-right"></i></a></li>

        </ul>

      </div>
    </div><!--/span-->
    <div class="span9 que-questionnaire-content">
      <div class="tab-content row">
        <div class="tab-pane active"id="que-questionnaire-edit-pane">

          <div class="tab-heading">
            Edit Questionnaire
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
             'model' => $questionnaireSearchModel,
             'questionnaireList' => $questionnaireList));
            ?>
          </div>
          <div id="questionnaire-result" class="row-fluid">

          </div>
        </div>
        <div class="tab-pane"id="que-question-bank-pane">
          <div class="tab-heading">
            Add from Question Bank
          </div>
          <div class="row-fluid">
            <?php
            echo $this->renderPartial('_search_questions_form', array('model' => $questionSearchModel,
             'pages' => $pages,
             'questionCount' => $questionCount,
             'toolList' => $toolList,
             "yearList" => $yearList,
             'conceptList' => $conceptList));
            ?>
          </div>
          <div id="que-questionnaire-question-result" class="row-fluid">
            <div class="row-fluid">
              <h5 class="pull-left">Results
                <?php echo $pages->currentPage . ' to ' . $pages->pageCount . ' of ' . $questionCount; ?>
              </h5>
              <div class="span8 pull-right">
                <?php
                $this->widget('CLinkPager', array(
                 'pages' => $pages,
                ))
                ?>
              </div>
            </div>

            <?php
            $count = 1;

            foreach ($questions as $question):
              $questionAddedClass = "";
              $notificationHideClass = "";
              $isAdded = UserQuestion::isAdded($question->id, $questionnaireId);
              if ($isAdded) {
                $questionAddedClass = "question-added-row";
              } else {
                $notificationHideClass = "hidden";
              }
              ?>
              <div class="question-result-row <?php echo $questionAddedClass ?>" 
                   question-id="<?php echo $question->id ?>" 
                   question-status="<?php echo UserQuestion::$FROM_QUESTION; ?>">

                <div class="added-notification <?php echo $notificationHideClass; ?> row">
                  <div class="label label-info">
                    You have added this question in this questionnaire
                  </div>
                  <br>
                </div>
                <div class="row">
                  <div class="span1">
                    <?php echo ($pages->currentPage * $pages->pageSize) + $count++; ?>
                  </div>
                  <div class="span9">
                    <blockquote>
                      <p><?php echo $question->content; ?></p>
                      <small><?php echo $question->author ?> <cite title="Source Title"><?php echo $question->concept ?></cite></small>
                    </blockquote>
                    <a class="que-view-answer-options-toggle">
                      <strong>View Answer Options</strong> 
                      <i class="icon-chevron-down"></i>
                    </a>
                    <div class="question-answer-options row hide">
                      <ol class="nav nav-list">
                        <li>Strongly Agree</li>
                        <li>Agree</li>
                        <li>Neither Agree nor Disagree</li>
                        <li>Disagree</li>
                        <li>Strongly Disagree</li>
                      </ol>
                    </div>
                  </div>
                  <div class="span2">
                    <a href="#" class="add-question-btn pull-right btn que-btn-red-border-1"><i class=icon-plus-sign></i> Add</a>
                  </div>
                </div>
                <br>
                <div class="que-question-footer row">
                  <a class="btn btn-link question-added-btn que-stats" question-id="<?php echo $question->id ?>" >
                    Used: <strong><?php echo $question->times_added; ?></strong>
                  </a>
                  <a class="btn btn-link question-modified-btn que-stats" question-id="<?php echo $question->id ?>" >
                    Modified: <strong><?php echo $question->times_modified; ?></strong> 
                  </a>
                  <a class="pull-right btn btn-link que-more-question-info-btn"><strong>More Question Details</strong></a>
                </div>
              </div>
            <?php endforeach; ?>
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
<div id="edit-question-modal" class="modal hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <span><h3>Edit Question</h3>
  </span>
  <div class="modal-body">
    <div class="span12">
      <textarea class="span12" id="edit-question-input" rows=3> </textarea>
    </div>
  </div>
  <div class="modal-footer">
    <button id="que-save-edited-btn" class="btn btn-success" data-dismiss="modal" aria-hidden="true">Save</button>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
<div id="question-more-info-modal" class="modal hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <span><h3>Question Info</h3>
  </span>
  <div class="modal-body">
    <div class="span12">
      <dl class="dl-horizontal">
        <dt>
        Content
        </dt>
        <dd>
          <p id="que-more-info-question-content">
          </p>
        </dd>
        <dt>
        Concept
        </dt>
        <dd>
          <p id="que-more-info-question-concept">
          </p>
        </dd>
        <dt>
        Tool
        </dt>
        <dd>
          <p id="que-more-info-question-tool">
          </p>
        </dd>
        <dt>
        Author
        </dt>
        <dd>
          <p id="que-more-info-question-author">
          </p>
        </dd>
        <dt>
        Year
        </dt>
        <dd>
          <p id="que-more-info-question-year">
          </p>
        </dd>
      </dl>
    </div>
  </div>
  <div class="modal-footer">
    <button id="add-question" class="btn btn-success" data-dismiss="modal" aria-hidden="true">Add</button>
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
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
<?php $this->endContent(); ?>