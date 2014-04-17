<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>
<div id="<?php echo "que-user-question-row-" . $userQuestion->id ?>" class="ui-state-default question-row" user-question-id="<?php echo $userQuestion->id ?>">
  <div class="que-grab-me hide">
    <h2>Grab Me</h2>
  </div>
  <div class="row">
    <div class="span1">
      <h2 class="text-center text-info count"><?php echo $count; ?></h2>
    </div>
    <div class="span9">
      <div class="row-fluid edit-question-input hide">
        <textarea class="que-edit-question-content input-block-level" rows="3">
      
        </textarea>
        <!-- <a class="que-view-answer-options-toggle">
           <h5> <strong>Edit Answer Options</strong> 
             <i class="glyphicon glyphicon-chevron-down"></i>
           </h5>
         </a>
         <div class="question-answer-options row hide">
           <textarea class="input-block-level" rows="5">     
           </textarea>
         </div> -->
      </div>
      <div class="row-fluid que-question-text">
        <p class="que-question-content"><?php echo $userQuestion->content; ?></p>
        <!-- <a class="que-view-answer-options-toggle">
          <h5> <strong>View Answer Options</strong> 
            <i class="glyphicon glyphicon-chevron-down"></i>
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
      <small class=""><i>
          <?php
          switch ($userQuestion->status) {
            case UserQuestion::$FROM_QUESTION_MODIFIED:
            case UserQuestion::$FROM_QUESTIONNAIRE_MODIFIED:
              echo "modified";
              break;
            case UserQuestion::$NEW_QUESTION:
              echo "new";
              break;
          }
          ?>
        </i></small>
    </div>
  </div>
  <div class="row que-footer que-question-action-links">
    <div class="span12">
      <div class="btn-group pull-right">
        <button class="que-btn que-btn-grey-1 btn-mini que-duplicate-question-btn" >Duplicate</button>
        <button class="que-btn que-btn-grey-1 btn-mini que-edit-question-btn">Edit</button>
        <button class="que-btn que-btn-grey-1 btn-mini que-remove-question-btn">Remove</button>
      </div>
    </div>
  </div>
  <div class="row que-footer que-edit-question-submit-btn-row hide">
    <div class="span11">
      <button class="que-save-edit-question-btn que-btn que-btn-blue-2" >Save</button>
      <button class="que-cancel-edit-question-btn que-btn que-btn-grey-1">Cancel</button>
    </div>
  </div>
</div>