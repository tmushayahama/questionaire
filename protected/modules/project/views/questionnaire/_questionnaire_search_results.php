<div class="accordion" id="questionnaire-search-result-1">
  <?php
  $count = 1;
  $color = "transparent";

  foreach ($questionnaires as $questionnaire):
    $questionnaireQuestions = QuestionnaireQuestionBank::getQuestionnaireQuestions($questionnaire->id);
    ?>
    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#questionnaire-search-result-1" href="<?php echo '#collapse-question-search-1-' . $questionnaire->id; ?>">
          <?php echo $questionnaire->name ?> 
          <i class="pull-right icon-chevron-down"></i>
        </a>
      </div>
      <div id="<?php echo 'collapse-question-search-1-' . $questionnaire->id; ?>" class="accordion-body collapse">
        <div class="accordion-inner">
          <div class="row">
            <a class="btn btn-small btn-inverse pull-left">Add All</a>
            <div class="span3">
              <?php echo count($questionnaireQuestions); ?> Questions
            </div>
          </div>
          <?php
          foreach ($questionnaireQuestions as $questionnaireQuestion):


            if (!UserQuestion::isAdded($questionnaireQuestion->question->id, $questionnaireId)) {
              $color = "transparent";
            } else {
              $color = "question-added-row";
            }
            ?>
            <div class="row-fluid question-result-row <?php echo $color ?>" 
                 question-id="<?php echo $questionnaireQuestion->question->id ?>" 
                 question-status="<?php echo UserQuestion::$FROM_QUESTIONNAIRE; ?>">
              <div class="span1">
                <?php echo $count++; ?>
              </div>
              <div class="span8">
                <p>
                  <?php echo $questionnaireQuestion->question->content ?> </p>
                <p><small>-<?php echo $questionnaireQuestion->question->author ?> <i><?php echo $questionnaireQuestion->question->year ?></i></small><br>

                </p>
              </div>
              <div class="pull-right span3">
                <div class="pull-right span12 row-fluid">
                  <a class="question-added-btn pull-right span5 que-stats" question-id="<?php echo $questionnaireQuestion->question->id ?>" >
                    <h5><?php echo $questionnaireQuestion->question->times_added ?></h5>
                    <h6>Times Added</h6>
                  </a>
                  <a class="question-modified-btn pull-right span5 que-stats" question-id="<?php echo $questionnaireQuestion->question->id ?>" >
                    <h5><?php echo $questionnaireQuestion->question->times_modified ?></h5>
                    <h6>Times Modified</h6>
                  </a>
                </div>

              </div>
              <div class="row-fluid">
                <div class="span7 offset1">
                  <a id="que-more-question-info-btn" question-id="<?php echo $questionnaireQuestion->question->id ?>" >More Question Details</a>
                 <!--  <a question-id="<?php //echo $question->id                                                ?>" href="#" class="edit-add-question-btn pull-right btn-link">Edit Add</a>
                  <a question-id="<?php //echo $question->id                                                ?>" href="#" class="qRemove-question-btn pull-right btn-link">Remove</a>-->
                </div>
                <div class="pull-right btn-group ">
                  <button class="btn dropdown-toggle" data-toggle="dropdown">
                    More Actions
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a question-id="<?php echo $questionnaireQuestion->question->id ?>" href="#" class="edit-add-question-btn pull-right btn-link">Edit Before Add</a></li>
                    <li><a question-id="<?php //echo $question->id                                         ?>" href="#" class="edit-add-question-btn pull-right btn-link">Add Position</a></li>
                  </ul>
                </div>
                <a href="#" class="add-question-btn pull-right btn que-btn-red-border-1">Add</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>