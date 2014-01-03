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
  <div id="<?php echo 'question-result-row-'.$question->id ?>"
       class="question-result-row <?php echo $questionAddedClass ?>" 
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
    <div class="row-fluid que-more-info-question-row hide">
      <div class="span12">
        <dl class="dl-horizontal">
          <dt>
          Concept:
          </dt>
          <dd>
            <p class="que-more-info-question-concept">
            </p>
          </dd>
          <dt>
          Author:
          </dt>
          <dd>
            <p class="que-more-info-question-author">
            </p>
          </dd>
          <dt>
          Year:
          </dt>
          <dd>
            <p class="que-more-info-question-year">
            </p>
          </dd>
        </dl>
      </div>
    </div>
    <div class="que-question-footer row">
      <a class="btn btn-link question-added-btn que-stats" question-id="<?php echo $question->id ?>" >
        Used: <strong><?php echo $question->times_added; ?></strong>
      </a>
      <a class="btn btn-link question-modified-btn que-stats" question-id="<?php echo $question->id ?>" >
        Modified: <strong><?php echo $question->times_modified; ?></strong> 
      </a>
      <h5><a class="pull-right btn btn-link que-more-question-info-btn">More Question Details</a></h5>
    </div>
  </div>
<?php endforeach; ?>
         