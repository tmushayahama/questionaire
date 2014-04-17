<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>
<div id="<?php echo "que-user-question-row-" . $userQuestion->id ?>" class="ui-state-default question-row panel panel-default" user-question-id="<?php echo $userQuestion->id ?>">
  <div class="que-grab-me que-hide panel-heading">
    <h5>Grab Me</h5>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-1 col-sm-1 col-xs-1">
        <h2 class="text-center text-info count"><?php echo $count; ?></h2>
      </div>
      <div class="col-lg-9 col-sm-9 col-xs-9">
        <div class="row edit-question-input que-hide">
          <textarea class="que-edit-question-content col-lg-12 col-sm-12 col-xs-12" rows="3"></textarea>
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
        <div class="row que-question-text">
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
      <div class="col-lg-2 col-sm-2 col-xs-2">
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
  </div>
  <div class="panel-footer que-question-action-links">
    <div class="row">
      <div class="btn-group pull-right">
        <button class="btn btn-default btn-xs que-duplicate-question-btn" >Duplicate</button>
        <button class="btn btn-default btn-xs que-edit-question-btn">Edit</button>
        <button class="btn btn-default btn-xs que-remove-question-btn">Remove</button>
      </div>
    </div>
  </div>
  <div class="panel-footer que-edit-question-submit-btn-row que-hide">
    <div class="col-lg-offset-1">
      <button class="que-save-edit-question-btn btn btn-success btn-xs" >Save</button>
      <button class="que-cancel-edit-question-btn btn btn-default btn-xs">Cancel</button>
    </div>
  </div>
</div>