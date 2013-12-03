<?php
$count = 1;
$color = "transparent";
foreach ($questionnaires as $questionnaire):
  ?>
  <div class="accordion" id="questionnaire-search-result-1">
    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#questionnaire-search-result-1" href="<?php echo '#collapse-question-search-1-' . $questionnaire->id; ?>">
          <?php echo $questionnaire->name ?> <i class="pull-right icon-chevron-down"></i>
        </a>
      </div>
      <div id="<?php echo 'collapse-question-search-1-' . $questionnaire->id; ?>" class="accordion-body collapse">
        <div class="accordion-inner">
          <?php
          foreach (QuestionnaireQuestionBank::getQuestionnaireQuestions($questionnaire->id) as $questionnaireQuestion):


            //if (!UserQuestion::isAdded($question->id, $questionnaireId)) {//number of times added
            $color = "transparent";
            // } else {
            //$color = "question-added-row";
            // }
            ?>
            <div class="row-fluid question-result-row <?php echo $color ?>" id="<?php echo 'display-question-' . $questionnaireQuestion->question->id ?>">
              <div class="span1">
                <?php echo $count++; ?>
              </div>
              <div class="span8">
                <p id="<?php echo 'add-question-' . $questionnaireQuestion->question->id ?>"><?php echo $questionnaireQuestion->question->content ?> </p>
                <p><small>-<?php echo $questionnaireQuestion->question->author ?> <i><?php echo $questionnaireQuestion->question->year ?></i></small><br>

                </p>
              </div>
              <div class="pull-right span3">
                <div class="pull-right span12 row-fluid">
                  <a id="question-added-btn" class=" pull-right span5 que-stats" question-id="<?php echo $questionnaireQuestion->question->id ?>" >
                    <h6>Added</h6>
                    <h5><?php //echo UserQuestion::getModified($question->id);           ?></h5>
                  </a>
                  <a id="question-modified-btn" class="pull-right span5 que-stats" question-id="<?php echo $questionnaireQuestion->question->id ?>" >
                    <h6>Modified</h6>
                    <h5><?php //echo UserQuestion::getModified($question->id);           ?></h5>
                  </a>
                </div>

              </div>
              <div class="row-fluid">
                <div class="span7 offset1">
                  <a id="que-more-question-info-btn" question-id="<?php echo $questionnaireQuestion->question->id ?>" >More Question Details</a>
                 <!--  <a question-id="<?php //echo $question->id                                           ?>" href="#" class="edit-add-question-btn pull-right btn-link">Edit Add</a>
                  <a question-id="<?php //echo $question->id                                           ?>" href="#" class="qRemove-question-btn pull-right btn-link">Remove</a>-->
                </div>
                <div class="pull-right btn-group ">
                  <button class="btn dropdown-toggle" data-toggle="dropdown">
                    More Actions
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a question-id="<?php echo $questionnaireQuestion->question->id ?>" href="#" class="edit-add-question-btn pull-right btn-link">Edit Before Add</a></li>
                    <li><a question-id="<?php //echo $question->id                                    ?>" href="#" class="edit-add-question-btn pull-right btn-link">Add Position</a></li>
                  </ul>
                </div>
                <a question-id="<?php echo $questionnaireQuestion->question->id ?>" href="#" class="add-question-btn pull-right btn que-btn-red-border-1">Add</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>