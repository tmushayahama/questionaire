<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>
<div class="ui-state-default question-row">
  <div class="row">
    <div class="span1">
      <h3><?php echo $count; ?></h3>
    </div>
    <div class="span11">
      <p><?php echo $userQuestion->content; ?></p><br>
      <div class="row-fluid ">
        <label class="span4 radio">
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" unchecked>
          Strongly Disagree
        </label>
        <label class="span4 radio">
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" unchecked>
          Agree
        </label>
        <label class="span4 radio">
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" unchecked>
          Strongly Agree
        </label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="span11">
      <a class="que-btn btn-link"><h5>Add Question Above</h5></a>
      <a class="que-btn btn-link pull-right"><h5>Copy</h5></a>
      <a href="#edit-question-modal" question-content="<?php echo $userQuestion->content ?>" question_id="<?php echo $userQuestion->id ?>"role="button" data-toggle="modal" class="que-btn btn-link pull-right edit-question-btn"><h5>Edit</h5></a>
      <a href="#" userQuestion_id="<?php echo $userQuestion->id ?>"role="button" class="que-btn btn-link pull-right remove-question-btn"><h5>Remove</h5></a>
    </div>
  </div>
</div>