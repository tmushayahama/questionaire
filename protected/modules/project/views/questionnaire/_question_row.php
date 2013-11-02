<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>
<div class="row-fluid question-row">
  <div class="span1">
    1
  </div>
  <div class="span8">
    <p><?php echo $question_content->question->content; ?></p><br>
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
  <div class="span2 ">
  </div>
  <br>
  <div class="span11">
    <a class="que-btn btn-link">Add Question Above</a>
    <a class="que-btn btn-link pull-right"> Copy </a>
    <a href="#edit-question-modal" question-content="<?php echo $question_content->question->content ?>" question_id="<?php echo $question_content->question->id ?>"role="button" data-toggle="modal" class="que-btn btn-link pull-right edit-question-btn">Edit</a>
    <a href="#" userQuestion_id="<?php echo $question_content->question->id ?>"role="button" class="que-btn btn-link pull-right remove-question-btn">Remove</a>
  </div>
</div>