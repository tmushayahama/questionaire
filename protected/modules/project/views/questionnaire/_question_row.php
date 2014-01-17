<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>
<div id="<?php echo "que-user-question-row-" . $userQuestion->id ?>" class="ui-state-default question-row" user-question-id="<?php echo $userQuestion->id ?>">
  <div class="row">
    <div class="span1">
      <h2 class="text-center text-info count"><?php echo $count; ?></h2>
    </div>
    <div class="span9">
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
        <!-- <a class="que-view-answer-options-toggle">
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
        </div> -->
      </div>
    </div> 
    <div class="span2">
      <small class="badge badge-info">
        <?php
        switch ($userQuestion->status) {
          case UserQuestion::$FROM_QUESTION:
            case UserQuestion::$FROM_QUESTIONNAIRE:
            echo "certified";
            break;
          case UserQuestion::$FROM_QUESTION_MODIFIED:
          case UserQuestion::$FROM_QUESTIONNAIRE_MODIFIED:
            echo "modified";
            break;
          case UserQuestion::$NEW_QUESTION:
            echo "new";
            break;
        }
        ?>
      </small>
    </div>
  </div>
  <div class="row que-footer que-question-action-links">
    <div class="span11">
      <a class="que-btn btn-link pull-right que-duplicate-question-btn" ><h4>Duplicate</h4></a>
      <a class="que-btn btn-link pull-right que-edit-question-btn"><h4>Edit</h4></a>
      <a class="que-btn btn-link pull-right que-remove-question-btn"><h4>Remove</h4></a>
    </div>
  </div>
  <div class="row que-footer que-edit-question-submit-btn-row hide">
    <div class="span11">
      <a class="que-save-edit-question-btn btn btn-small btn-success que-btn-color-white" >Save</a>
      <a class="que-cancel-edit-question-btn btn btn-small">Cancel</a>
    </div>
  </div>
</div>