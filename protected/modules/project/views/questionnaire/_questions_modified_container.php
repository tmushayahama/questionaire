<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>
<?php
$modifiedCount = 1;
foreach ($userQuestions as $userQuestion):
  ?>
  <div class="que-modified-question-row" user-question-id="<?php echo $userQuestion->id ?>">
    <div class="row-fluid">
      <div class="span1">
        <?php $modifiedCount++; ?>
      </div>
      <div class="span9">
        <div class="row-fluid que-question-text">
          <p class="que-question-content"><?php echo $userQuestion->content; ?></p>
        </div>
      </div>
      <div class="span2">
        <button class="add-question-from-modified-btn que-btn que-btn-grey-1 ">Add</button>
      </div>
    </div>
  </div>
  <br>
<?php endforeach; ?>