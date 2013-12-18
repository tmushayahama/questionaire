<div class="accordion" id="questionnaire-search-result-1">
  <?php
  $count = 1;
  $color = "transparent";

  foreach ($questionnaires as $questionnaire):
    $questionnaireQuestions = QuestionnaireQuestionBank::getQuestionnaireQuestions($questionnaire->id);
    ?>
    <div class="accordion-group">
      <div class="accordion-heading row">
        <h4>
          <?php echo $questionnaire->name ?> 
        </h4>
        <div class="row">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#questionnaire-search-result-1" href="<?php echo '#collapse-question-search-1-' . $questionnaire->id; ?>">
            View Questions <?php echo count($questionnaireQuestions); ?> 
            <i class="icon-chevron-down"></i>
          </a>
        </div>
        <div class="que-question-footer row">
          <a class="btn btn-link question-added-btn que-stats" >
            Used: <strong><?php echo 0 ?></strong>
          </a>
          <a class="btn btn-link question-modified-btn que-stats">
            Modified: <strong><?php echo 0 ?></strong> 
          </a>
          <a class="pull-right btn btn-link que-more-question-info-btn"><strong>More Questionnaire Details</strong></a>
        </div>
      </div>
      <div id="<?php echo 'collapse-question-search-1-' . $questionnaire->id; ?>" class="accordion-body collapse">
        <div class="accordion-inner">
          <div class="row">
            <a class="que-add-all-questionnaire-questions btn btn-small btn-inverse pull-left">Add All</a>
            <div class="span3">
              <?php echo count($questionnaireQuestions); ?> Questions
            </div>
          </div>
          <?php
          $count = 1;
          foreach ($questionnaireQuestions as $questionnaireQuestion):
            $questionAddedClass = "";
            $notificationHideClass = "";
            $isAdded = UserQuestion::isAdded($questionnaireQuestion->question->id, $questionnaireId);
            if ($isAdded) {
              $questionAddedClass = "question-added-row";
            } else {
              $notificationHideClass = "hidden";
            }
            ?>
            <div class="question-result-row <?php echo $questionAddedClass ?>" 
                 question-id="<?php echo $questionnaireQuestion->question->id ?>" 
                 question-status="<?php echo UserQuestion::$FROM_QUESTION; ?>">

              <div class="added-notification <?php echo $notificationHideClass; ?> row">
                <div class="label label-info">
                  You have added this question in this questionnaire
                </div>
                <br>
              </div>
              <div class="row">
                <div class="span1">
                  <?php echo $count++; ?>
                </div>
                <div class="span9">
                  <blockquote>
                    <p><?php echo $questionnaireQuestion->question->content; ?></p>
                    <small><?php echo $questionnaireQuestion->question->author ?> <cite title="Source Title"><?php echo $questionnaireQuestion->question->concept ?></cite></small>
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
                <a class="btn btn-link question-added-btn que-stats" >
                  Used: <strong><?php echo $questionnaireQuestion->question->times_added; ?></strong>
                </a>
                <a class="btn btn-link question-modified-btn que-stats">
                  Modified: <strong><?php echo $questionnaireQuestion->question->times_modified; ?></strong> 
                </a>
                <a class="pull-right btn btn-link que-more-question-info-btn"><strong>More Question Details</strong></a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>