<div class="row">
  <h5 class="pull-left">Results:
    <?php echo ' ' . $questionCount . " questions"; ?>
    <?php //echo $pages->currentPage . ' to ' . $pages->pageCount . ' of ' . $questionCount; ?>
  </h5>
  <div class="span8 pull-right">

    <?php
    // $this->widget('CLinkPager', array(
    //'pages' => $pages,
    //))
    ?>
  </div>
</div>

<?php
$count = 1;

foreach ($questions as $question):
  $actionText = "";
  $actionValue = "";
  $questionAddedClass = "";
  $notificationHideClass = "";
  $isAdded = UserQuestion::isAdded($question->id, $questionnaireId);
  if ($isAdded) {
    $questionAddedClass = "question-added-row";
    $actionValue = "added";
    $actionText = "<i class='icon-minus-sign'></i> Added";
  } else {
    $notificationHideClass = "hidden";
    $actionValue = "add";
    $actionText = "<i class='icon-plus-sign'></i> Add";
  }
  ?>
  <div id="<?php echo 'question-result-row-' . $question->id ?>"
       class="panel panel-default question-result-row <?php echo $questionAddedClass ?>" 
       question-id="<?php echo $question->id ?>" 
       question-status="<?php echo UserQuestion::$FROM_QUESTION; ?>">

    <div class="added-notification <?php echo $notificationHideClass; ?> row">
      <div class="label label-info">
        You have added this question in this questionnaire
      </div>
      <br>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-lg-1 col-sm-1 col-xs-1">
          <?php echo ($pages->currentPage * $pages->pageSize) + $count++; ?>
        </div>
        <div class="col-lg-9 col-sm-9 col-xs-12">
          <blockquote>
            <p><?php
              $analyzedQuestion = QuestionBank::analyzeQuestion($question->content);
              if ($analyzedQuestion === null) :
                echo $question->content;
              else:
                ?>
                <?php echo $analyzedQuestion[0]; ?>
                <input type="text" class="que-question-fill span3" placeholder="<?php echo $analyzedQuestion[2]; ?>">
                <?php echo $analyzedQuestion[1]; ?>
              <?php endif;
              ?>
            </p>
            <small><?php echo $question->author . ", " . $question->year; ?> <br>
              <cite title="Source Title"><?php echo $question->concept ?></cite></small>
          </blockquote>
          <!-- <a class="que-view-answer-options-toggle">
            <strong>View Answer Options</strong> 
            <i class="glyphicon glyphicon-chevron-down"></i>
          </a>
          <div class="question-answer-options row hide">
            <ol class="nav nav-list">
              <li>Strongly Agree</li>
              <li>Agree</li>
              <li>Neither Agree nor Disagree</li>
              <li>Disagree</li>
              <li>Strongly Disagree</li>
            </ol>
          </div>-->
        </div> 
        <div class="col-lg-2 col-sm-2 col-xs-2">
          <?php //if ($analyzedQuestion === null) : ?>
          <button class="add-question-btn pull-right btn btn-default" que-action="<?php echo $actionValue; ?>"><?php echo $actionText; ?></button>
        </div>
      </div>
      <br>
      <div class="row que-more-info-question-row que-hide">
        <div class="col-lg-12 col-sm-12 col-xs-12">
          <dl class="dl-horizontal">
            <dt>
            Modifications:
            </dt>
            <dd>
              <div class="que-more-info-question-modification">

              </div>
            </dd>
          </dl>
        </div>
      </div>
    </div>
    <div class="panel-footer que-question-footer row">
      <p class="btn btn-link question-added-btn que-stats" question-id="<?php echo $question->id ?>" >
        Used: <strong><?php echo $question->times_added; ?></strong>
      </p>
      <p class="btn btn-link que-more-question-info-btn question-modified-btn que-stats" question-id="<?php echo $question->id ?>" >
        Modified: <strong><?php echo $question->times_modified; ?></strong> 
      </p>
    </div>
  </div>
<?php endforeach; ?>
         