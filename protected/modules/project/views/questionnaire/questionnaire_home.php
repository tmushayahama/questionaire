<?php $this->beginContent('//home_layouts/home_nav_questionnaire'); ?>
<?php
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/que_questionnaire.js', CClientScript::POS_END
);
?>
<script id="record-task-url" type="text/javascript">
  var addQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/addquestion/questionnaireId/" . $questionnaireId); ?>";
  var editQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/editquestion/questionnaireId/" . $questionnaireId); ?>";
  var moreInfoQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/moreinfoquestion"); ?>";
  var removeQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/removequestion/questionnaireId/" . $questionnaireId); ?>"
  var qRemoveQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/qremovequestion/questionnaireId/" . $questionnaireId); ?>"
</script>

<div class="row-fluid">
  <ul class="breadcrumb que-breadcrumb">
    <li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-link')); ?> <span class="divider">/</span></li>
    <li class="active"><?php //echo $projectModel->name     ?></li>

    <li class="offset7"><a href="#new-project-modal" role="button" class="gb-btn" data-toggle="modal">Manage Questionnaire</a></li>
  </ul>
</div>

<div class="row-fluid que-container">
  <div class="span3">
    <a href="<?php echo Yii::app()->createUrl("project/questionnaire/viewquestions", array("questionnaireId" => $questionnaireId, "projectId" => $projectId)); ?>" class="que-btn que-btn-blue-2 btn-block btn-large">Add More Questions
    </a>
  </div><!--/span-->
  <div class="span7">
    <div class="heading">
      <?php echo $model->name ?>
    </div>
    <br>
    <div id="sortable">
      <?php
      $count = 1;
      foreach ($question_contents as $question_content):
        echo $this->renderPartial('_question_row', array(
         'count'=>$count++,
         'question_content' => $question_content));
      endforeach;
      ?>
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