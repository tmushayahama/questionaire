<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>
<?php foreach ($userQuestions as $userQuestion): ?>
  <div id="<?php echo "from-results-remove-user-question-row-" . $userQuestion->id ?>" class="from-results-question-row" user-question-id="<?php echo $userQuestion->id ?>">
    <div class="row-fluid">
      <div class="span10">
        <div class="row-fluid que-question-text">
          <p class="que-question-content"><?php echo $userQuestion->content; ?></p>
        </div>
      </div>
      <div class="span2">
        <a class="from-results-remove-question-btn btn btn-danger">Remove</a>
      </div>
    </div>
  </div>
<?php endforeach; ?>