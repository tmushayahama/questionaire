<?php $this->beginContent('//home_layouts/navbar'); ?>
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
<ul class="breadcrumb que-breadcrumb">
  <li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-link')); ?><span class="divider">/</span></li>
  <li>Project:<?php echo CHtml::link(Project::model()->findByPk($projectId)->name, Yii::app()->createUrl("project/project/view", array("id" => $projectId)), array('class' => 'btn btn-link')); ?><span class="divider">/</span></li>
  <li>Questionnaire: <?php echo CHtml::link($model->name, Yii::app()->createUrl("project/questionnaire/view", array("questionnaireId" => $questionnaireId, "projectId" => $projectId), array('class' => 'btn btn-link'))); ?><span class="divider">/</span></li>

  <!--<li class="offset7"><a href="#new-project-modal" role="button" class="gb-btn" data-toggle="modal">Manage Questionnaire</a></li>-->
</ul>
<div id="que-topbar-question" class="row-fluid ">
  <div class="span3">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bmi_logo.png" alt=""><br>
  </div>
  <div class="span8">
    <br>
    <div class="row-fluid input-prepend input-append">
      <div class="btn-group">
        <button class="btn dropdown-toggle" data-toggle="dropdown">
          All
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a>All</a></li>
          <li><a>Content</a></li>
          <li><a>Tool</a></li>
          <li><a>Year</a></li>
        </ul>
      </div>
      <input class="span9" id="appendedPrependedDropdownButton" class="que-input-large" placeholder="Keyword Search."type="text">

      <div class="btn-group">
        <button class="que-btn que-btn-blue-2" >
          Search
        </button> 
      </div>
    </div>
    <a href="#questionnaire-preview-modal" class="que-btn btn-link" role="button" data-toggle="modal"><h4>Browse by Sort Code</h4></a>

  </div>
</div>
<div class="row-fluid">
  <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bmi_bar.png" alt=""><br>
</div>
<div class="row-fluid que-container">
  <div class="span3">
    <div class="sidebar-nav que-questionnaire-sidebar">
      <h4>Additional Filters</h4>
      <?php
      echo $this->renderPartial('_search_questions_form', array('model' => $questionSearchModel,
       'toolList' => $toolList,
       "yearList" => $yearList,
       'conceptList' => $conceptList));
      ?>
    </div>
  </div>
  <div id="que-questions-container"class="span7">
    <div class="span12 row-fluid">
      <a href="#questionnaire-preview-modal" class="que-btn btn-link" role="button" data-toggle="modal"><h4>Preview Questionnaire</h4></a>
      <a href="<?php echo Yii::app()->createUrl("project/questionnaire/view", array("questionnaireId" => $questionnaireId, "projectId" => $projectId)); ?>" class="que-btn btn-link pull-right"><h4>Go To Questionnaire</h4>
      </a> 
    </div>
    <br>
    <div id="que-questionnaire-topbar" class="row-fluid">
      <div class="row-fluid">
        <div class="span3">
          <h5 class="pull-left">Results
            <?php echo $pages->currentPage . ' to ' . $pages->pageCount . ' of ' . $questionCount; ?>
          </h5>
        </div>
      </div>
      <div class="row-fluid">
        <div class="span8">
          <br>
          <?php
          $this->widget('CLinkPager', array(
           'pages' => $pages,
          ))
          ?>
        </div>
        <a href="#que-search-summary-modal" class="que-btn btn-link" role="button" data-toggle="modal"><h5>View Search Criteria</h5></a>
      </div>
      <?php
      $count = 1;
      $color = "transparent";
      foreach ($questions as $question):
        if (!UserQuestion::isAdded($question->id, $questionnaireId)) {//number of times added
          $color = "transparent";
        } else {
          $color = "question-added-row";
        }
        ?>
        <div class="row-fluid question-result-row <?php echo $color ?>" id="<?php echo 'display-question-' . $question->id ?>">
          <div class="span1">
            <?php echo ($pages->currentPage * $pages->pageSize) + $count++; ?>
          </div>
          <div class="span8">
            <p id="<?php echo 'add-question-' . $question->id ?>"><?php echo $question->content ?> </p>
            <p><small>-<?php echo $question->author ?> <i><?php echo $question->year ?></i></small><br>

            </p>
          </div>
          <div class="pull-right span3">
            <div class="pull-right span12 row-fluid">
              <a id="question-added-btn" class=" pull-right span5 que-stats" question-id="<?php echo $question->id ?>" >
                <h6>Added</h6>
                <h5><?php echo UserQuestion::getModified($question->id); ?></h5>
              </a>
              <a id="question-modified-btn" class="pull-right span5 que-stats" question-id="<?php echo $question->id ?>" >
                <h6>Modified</h6>
                <h5><?php echo UserQuestion::getModified($question->id); ?></h5>
              </a>
            </div>

          </div>
          <div class="row-fluid">
            <div class="span7 offset1">
              <a id="que-more-question-info-btn" question-id="<?php echo $question->id ?>" >More Question Details</a>
             <!--  <a question-id="<?php //echo $question->id                                ?>" href="#" class="edit-add-question-btn pull-right btn-link">Edit Add</a>
              <a question-id="<?php //echo $question->id                                ?>" href="#" class="qRemove-question-btn pull-right btn-link">Remove</a>-->
            </div>
            <div class="pull-right btn-group ">
              <button class="btn dropdown-toggle" data-toggle="dropdown">
                More Actions
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a question-id="<?php echo $question->id ?>" href="#" class="edit-add-question-btn pull-right btn-link">Edit Before Add</a></li>
                <li><a question-id="<?php //echo $question->id                         ?>" href="#" class="edit-add-question-btn pull-right btn-link">Add Position</a></li>
              </ul>
            </div>
            <a question-id="<?php echo $question->id ?>" href="#" class="add-question-btn pull-right btn btn-primary">Add</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
  <div id="questionnaire-preview-modal" class="modal modal-thick hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <span><h3><?php echo $model->name; ?></h3>
    </span>

    <div class="modal-body">
      <div class="">
        <table class="table table-condensed table-hover">
          <thead>
          <th>
            Content
          </th>
          <th>
            Scale
          </th>
          </thead>
          <tbody id="question-row">
            <?php
            $count = 1;
            foreach ($question_contents as $question_content):
              echo $this->renderPartial('_question_row', array(
               'count' => $count++,
               'question_content' => $question_content));
            endforeach;
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
  </div>
  <div id="que-search-summary-modal" class="modal hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <span><h3>Search Criteria Summary</h3>
    </span>
    <div class="modal-body">
      <div class="span6">
        Selected Questionnaire(s)
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
          Questionnaire
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