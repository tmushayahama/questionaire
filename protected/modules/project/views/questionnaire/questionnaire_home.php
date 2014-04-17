<?php $this->beginContent('//home_layouts/navbar'); ?>

<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/que_questionnaire.js', CClientScript::POS_END
);
?>
<script id="record-task-url" type="text/javascript">
  var questionBrowseUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionbrowse"); ?>";

  var questionnaireSearchFromCYUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionnairesearchfromcy/questionnaireId/" . $questionnaireId); ?>";
  var questionnaireSearchFromQUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionnairesearchfromq/questionnaireId/" . $questionnaireId); ?>";
  var questionSearchUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionsearch/questionnaireId/" . $questionnaireId); ?>";
  var questionKeywordSearchUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionkeywordsearch/questionnaireId/" . $questionnaireId); ?>";
  var questionnaireKeywordSearchUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/questionnaireKeywordSearch/questionnaireId/" . $questionnaireId); ?>";

  var addQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/addquestion/questionnaireId/" . $questionnaireId); ?>";
  var createQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/createquestion/questionnaireId/" . $questionnaireId); ?>";
  var editQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/editquestion", array("questionnaireId" => $questionnaireId)); ?>";
  var reorderQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/reorderquestion", array("questionnaireId" => $questionnaireId)); ?>";
  var moreInfoQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/viewModifiedQuestions"); ?>";
  var getUserQuestionToDeleteUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/getUserQuestionToDelete/questionnaireId/" . $questionnaireId); ?>";
  var removeQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/removequestion/questionnaireId/" . $questionnaireId); ?>"
  var duplicateQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/duplicatequestion/questionnaireId/" . $questionnaireId); ?>"

</script>

<div class="row-fluid">
  <ul class="breadcrumb que-breadcrumb">
    <li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-link')); ?><span class="divider">/</span></li>
    <li><?php echo CHtml::link(Project::model()->findByPk($projectId)->name, Yii::app()->createUrl("project/project/view", array("id" => $projectId)), array('class' => 'btn btn-link')) ?><span class="divider">/</span></li>
    <li class="active">Questionnaire</li>

    <!--<li class="offset7"><a href="#new-project-modal" role="button" class="gb-btn" data-toggle="modal">Manage Questionnaire</a></li>-->
  </ul>
  <br>
  <br>
  <h2 class="container">
    <div class="span8">
      <?php echo $model->name; ?>
    </div>
    <div class="pull-right">
      <?php echo UserQuestion::getUserQuestionsCount($questionnaireId) ?><small> questions</small>
    </div>
  </h2>
  <div class="que-topbar-nav container">
    <div class="row">
      <ul id="que-topbar-nav-list" class="que-nav-1">
        <li class="active"><a href="#questionnaire-design-pane" data-toggle="tab">Preview Questionnaire</a></li>
        <li class=""><a href="#que-search-question-pane" data-toggle="tab">Question Search</a></li>
        <!--   <li class=""><a href="#que-browse-question-pane" data-toggle="tab">Browse Question</a></li> -->
      </ul>
    </div>
  </div>
</div>
<div class="container">
  <div class="row-fluid que-white-background">
    <div class="tab-content">
      <div class="tab-pane active" id="questionnaire-design-pane">
        <div class="que-white-background row-fluid span12">
          <div class="tab-heading">
            <div class="pull-left">Preview</div>
          </div>
          <div class="que-questionnaire-stats">
            <ul class="thumbnails">
              <li class="span4">
                <a class="thumbnail que-stats">
                  <h1 id="que-question-original-number"><?php echo UserQuestion::getUserQuestionsOriginalCount($questionnaireId) ?></h1>
                  <h5 class="text-center">Original Questions</h5>
                </a>
              </li>
              <li class="span4">
                <a class="thumbnail que-stats">
                  <h1 id="que-question-modified-number"><?php echo UserQuestion::getUserQuestionsModifiedCount($questionnaireId); ?></h1>
                  <h5 class="text-center">Questions Modified</h5>
                </a>
              </li>
              <li class="span4">
                <a class="thumbnail que-stats">
                  <h1 id="que-question-created-number"><?php echo UserQuestion::getUserQuestionsCreatedCount($questionnaireId); ?></h1>
                  <h5 class="text-center">New Created Questions</h5>
                </a>
              </li>
            </ul>
          </div>
          <div class="row-fluid">
            <button id="que-reorder-questions-btn" class="que-btn que-btn-blue-2 pull-right" que-action="reorder">
              Reorder
            </button>
            <button id="que-reorder-questions-cancel-btn" class="hide que-btn que-btn-grey-1 pull-right">
              Cancel
            </button>
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
      </div>
      <div class="tab-pane"id="que-create-new-question-bank-pane">
        <div class="tab-heading">
          Create your Own Question
        </div>
        <div class="que-margined">
          <div class="row-fluid">
            <textarea id="que-create-question-input" class="input-block-level" rows="4"></textarea>
            <div class="row-fluid gb-footer">
              <button id="que-save-create-question-btn" class="que-btn que-btn-blue-2" >Save</button>
              <button id="que-cancel-create-question-btn" class="que-btn  que-btn-grey-1">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane" id="que-search-question-pane">
        <div class="tab-heading">
          Question Search
        </div>
        <div class="que-margined">
          <div class="row-fluid">
            <?php
            echo $this->renderPartial('_search_questions_form', array('model' => $questionSearchModel,
             "toolList" => $toolList,
             "yearList" => $yearList,
             'conceptList' => $conceptList));
            ?>
          </div>
          <div id="que-result-analytics-bar" class="hide">
            <ul id="que-result-as-container" class="nav nav-tabs">
              <li><a id="que-result-as-questionnaires" class="que-result-as que-btn-grey-1" result-output="1"><h4>Results As Questions</h4></a></li>
              <li><a id="que-result-as-questions" class="que-result-as" result-output="2"><h4>Results As Questionnaires</h4></a></li>
            </ul>
            Sort By
            <select id="que-sort-question-result-selector">
              <option value="<?php echo QuestionBank::$SORT_BY_TIMES_ADDED; ?>">Most Added</option>
              <option value="<?php echo QuestionBank::$SORT_BY_TIMES_MODIFIED; ?>">Most Modified</option>
              <option value="<?php echo QuestionBank::$SORT_BY_CONTENT; ?>">Content</option>
              <option value="<?php echo QuestionBank::$SORT_BY_YEAR; ?>">Year</option>
              <option value="<?php echo QuestionBank::$SORT_BY_CONCEPT; ?>">Concept</option>
              <option value="<?php echo QuestionBank::$SORT_BY_TOOL; ?>">Questionnaire</option>
              <option value="<?php echo QuestionBank::$SORT_BY_AUTHOR; ?>">Author</option>
            </select>
            <select id="que-sort-order-selector">
              <option value="<?php echo QuestionBank::$ORDER_ASC; ?>">Ascending</option>
              <option value="<?php echo QuestionBank::$ORDER_DESC; ?>">Descending</option>
            </select>
          </div>

          <div id="que-question-result" class="row-fluid">

          </div>
        </div>
      </div>
      <!--<div class="tab-pane"id="que-browse-question-pane">
      <?php
      //echo $this->renderPartial('sortcode/_sortcode_child', array(
      // 'sortcodes'=> $sortcodes,
      // 'childCode'=>"Root"));
      ?>
      </div> -->
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
<?php $this->endContent();?>