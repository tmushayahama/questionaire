<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>
<div id="<?php echo "que-user-question-row-".$userQuestion->id ?>" class="ui-state-default question-row" user-question-id="<?php echo $userQuestion->id ?>">

  <div class="row">
    <div class="span1">
      <h3 class="count"><?php echo $count; ?></h3>
    </div>
    <div class="span11">
      <div class="row-fluid edit-question-input hide">
        <textarea class="que-edit-question-content input-block-level" rows="3">
      
        </textarea>
        <a class="que-view-answer-options-toggle">
          <h5> <strong>Edit Answer Options</strong> 
            <i class="icon-chevron-down"></i>
          </h5>
        </a>
        <div class="question-answer-options row hide">
          <textarea class="input-block-level" rows="5">     
          </textarea>
        </div>
      </div>
      <div class="row-fluid que-question-text">
        <p class="que-question-content"><?php echo $userQuestion->content; ?></p>
        <a class="que-view-answer-options-toggle">
          <h5> <strong>View Answer Options</strong> 
            <i class="icon-chevron-down"></i>
          </h5>
        </a>
        <div class="question-answer-options row hide">
          <label class="radio">
            <input type="radio" name="<?php echo "radio-" . $count; ?>" id="<?php echo "radio-" . $count; ?>" value="option1" unchecked>
            Strongly Agree
          </label>
          <label class="radio">
            <input type="radio" name="<?php echo "radio-" . $count; ?>" id="<?php echo "radio-" . $count; ?>" value="option1" unchecked>
            Agree
          </label>
          <label class="radio">
            <input type="radio" name="<?php echo "radio-" . $count; ?>" id="<?php echo "radio-" . $count; ?>" value="option1" unchecked>
            Neither Agree nor Disagree
          </label>
          <label class="radio">
            <input type="radio" name="<?php echo "radio-" . $count; ?>" id="<?php echo "radio-" . $count; ?>" value="option1" unchecked>
            Disagree
          </label>
          <label class="radio">
            <input type="radio" name="<?php echo "radio-" . $count; ?>" id="<?php echo "radio-" . $count; ?>" value="option1" unchecked>
            Strongly Disagree
          </label>
        </div>
      </div>
    </div>
  </div>
  <div class="row que-question-action-links">
    <div class="span11">
      <a class="que-btn btn-link pull-right disabled" ><h4>Copy</h4></a>
      <a class="que-btn btn-link pull-right que-edit-question-btn"><h4>Edit</h4></a>
      <a href="#" userQuestion_id="<?php echo $userQuestion->id ?>"role="button" class="que-btn btn-link pull-right remove-question-btn"><h4>Remove</h4></a>
    </div>
  </div>
  <div class="row que-edit-question-submit-btn-row hide">
    <div class="span11">
      <a class="que-save-edit-question-btn que-btn btn-small que-btn-green-1 que-btn-color-white" >Save</a>
      <a class="que-cancel-edit-question-btn btn btn-small">Cancel</a>
   </div>
  </div>
</div>