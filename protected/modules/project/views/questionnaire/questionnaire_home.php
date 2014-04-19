<?php $this->beginContent('//layouts/que_main1'); ?>

<?php
$questionCount = UserQuestion::getUserQuestionsCount($questionnaireId);
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
</div>
<br>
<br>
<h2 class="container">
  <div class="col-lg-8 col-sm-8 col-xs-12">
    <?php echo $model->name; ?>
  </div>
  <div class="col-lg-4 col-sm-4 col-xs-12">
    <?php echo $questionCount; ?><small> questions</small>
  </div>
</h2>
<div class="que-topbar-nav container">
  <ul id="que-topbar-nav-list" class="que-nav-1 row que-no-padding">
    <li class="active col-lg-6 col-sm-6 col-xs-12"><a class="" href="#questionnaire-design-pane" data-toggle="tab">Preview Questionnaire</a></li>
    <li class="col-lg-6 col-sm-6 col-xs-12"><a href="#que-search-question-pane" data-toggle="tab">Question Search</a></li>
    <!--   <li class=""><a href="#que-browse-question-pane" data-toggle="tab">Browse Question</a></li> -->
  </ul>
</div>
<div class="container">
  <div class="row">
    <div class="tab-content">
      <div class="tab-pane active" id="questionnaire-design-pane">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4><div class="">Preview</div></h4>
          </div>
          <div class="panel-body">
            <div class="que-questionnaire-stats">
              <div class="panel">
                <div class="row">
                  <a class="col-lg-4 col-sm-4 col-xs-4 que-stats">
                    <h1 id="que-question-original-number"><?php echo UserQuestion::getUserQuestionsOriginalCount($questionnaireId) ?></h1>
                    <h5 class="text-center">Original Questions</h5>
                  </a>
                  <a class="col-lg-4 col-sm-4 col-xs-4 que-stats">
                    <h1 id="que-question-modified-number"><?php echo UserQuestion::getUserQuestionsModifiedCount($questionnaireId); ?></h1>
                    <h5 class="text-center">Questions Modified</h5>
                  </a>
                  <a class="col-lg-4 col-sm-4 col-xs-4 que-stats">
                    <h1 id="que-question-created-number"><?php echo UserQuestion::getUserQuestionsCreatedCount($questionnaireId); ?></h1>
                    <h5 class="text-center">New Created Questions</h5>
                  </a>
                </div>
              </div>
            </div>
            <?php
            $hideResult = "";
            $hideAlert = "";
            if ($questionCount == 0) {
              $hideResult = "que-hide";
            } else {
              $hideAlert = "que-hide";
            }
            ?>
            <div id="que-no-questionnaire-alert" class="alert alert-info <?php echo $hideAlert; ?>">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>You haven't added any question(s)</strong><br>
              You can add questions from our Question and Questionnaire Bank.
            </div>

            <div id="que-questionnaire-questions" class="row <?php echo $hideResult; ?>">
              <div class="row">
                <div class="pull-right">
                  <a id="que-reorder-questions-btn" class="btn btn-primary" que-action="reorder">Reorder</a>
                  <a id="que-reorder-questions-cancel-btn" class="que-hide btn btn-default">Cancel</a>
                </div>
              </div>             
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
      </div>
      <div class="tab-pane"id="que-create-new-question-bank-pane">
        <div class="panel panel-default">
          <div class="panel-heading">
            Create your Own Question
          </div>
          <div class="panel-body">
            <textarea id="que-create-question-input" class="col-lg-12 col-sm-12 col-xs-12" rows="4"></textarea>
            <div class="row-fluid gb-footer">
              <button id="que-save-create-question-btn" class="que-btn que-btn-blue-2" >Save</button>
              <button id="que-cancel-create-question-btn" class="que-btn  que-btn-grey-1">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="que-search-question-pane">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4><div class="">Question Search</div></h4>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php
              echo $this->renderPartial('_search_questions_form', array('model' => $questionSearchModel,
               "toolList" => $toolList,
               "yearList" => $yearList,
               'conceptList' => $conceptList));
              ?>
            </div>
            <div id="que-result-analytics-bar" class="que-hide">
              <ul id="que-result-as-container" class="nav nav-tabs">
                <li><a id="que-result-as-questionnaires" class="que-result-as btn btn-default" result-output="1"><h4>Results As Questions</h4></a></li>
                <li><a id="que-result-as-questions" class="que-result-as" result-output="2"><h4>Results As Questionnaires</h4></a></li>
              </ul>
              Sort By
              <div class="form-group row">
                <select id="que-sort-question-result-selector" class="input-lg">
                  <option value="<?php echo QuestionBank::$SORT_BY_TIMES_ADDED; ?>">Most Added</option>
                  <option value="<?php echo QuestionBank::$SORT_BY_TIMES_MODIFIED; ?>">Most Modified</option>
                  <option value="<?php echo QuestionBank::$SORT_BY_CONTENT; ?>">Content</option>
                  <option value="<?php echo QuestionBank::$SORT_BY_YEAR; ?>">Year</option>
                  <option value="<?php echo QuestionBank::$SORT_BY_CONCEPT; ?>">Concept</option>
                  <option value="<?php echo QuestionBank::$SORT_BY_TOOL; ?>">Questionnaire</option>
                  <option value="<?php echo QuestionBank::$SORT_BY_AUTHOR; ?>">Author</option>
                </select>
                <select id="que-sort-order-selector" class="input-lg"> 
                  <option value="<?php echo QuestionBank::$ORDER_DESC; ?>">Descending</option>
                  <option value="<?php echo QuestionBank::$ORDER_ASC; ?>">Ascending</option>
                </select>
              </div>
            </div>
            <div id="que-question-result" class="row">
            </div>
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
<?php $this->endContent(); ?>