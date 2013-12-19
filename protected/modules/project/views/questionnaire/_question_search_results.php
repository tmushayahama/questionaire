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
         