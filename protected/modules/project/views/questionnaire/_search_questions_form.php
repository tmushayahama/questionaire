<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
 'id' => 'search-question-form',
 'enableAjaxValidation' => false,
 'htmlOptions' => array(
  'class' => 'form',
  'onsubmit' => "return false;")
  ));
?>
<div class="input-group input-group-md row">
  <input id="que-question-keyword-search-input" class="col-lg-10" placeholder="Search Question by context, year, etc."type="text">
  <button id="que-question-keyword-search-btn" class="btn btn-primary" >Search</button>
</div>
<div id="que-filters-container" class="que-hide">
  <h4 class="que-additional-filter-question-btn">Additional Filters</h4>
  <div class="row">
    <!-- <div id="que-tool-dropdown" class="span12">
    <?php
    /* echo CHtml::activeDropDownList(
      $model, 'tool', CHtml::listData($toolList, 'tool', 'tool'), array(
      'id' => 'que-question-tool-dropdown',
      'filter-type' => QuestionBank::$FILTER_TOOL,
      'empty' => 'Select a Questionnaire',
      'class' => 'input-block-level'
      )); */
    ?>
     </div> -->
  </div>
  <div class="row">
    <div id="que-concept-dropdown" filter-type="<?php echo QuestionBank::$FILTER_CONCEPT ?>" class="col-lg-12 col-sm-12 col-xs-12">
      <?php
      echo CHtml::activeDropDownList(
        $model, 'concept', CHtml::listData($conceptList, 'concept', 'concept'), array(
       'id' => 'que-question-concept-dropdown',
       'filter-type' => QuestionBank::$FILTER_CONCEPT,
       'empty' => 'Select a Concept',
       'class' => 'input-block-level'
      ));
      ?>
    </div>
  </div>
  <div class="row">
    <div id="que-year-dropdown" filter-type="<?php echo QuestionBank::$FILTER_YEAR ?>" class="col-lg-12 col-sm-12 col-xs-12">
      <?php
      echo CHtml::activeDropDownList(
        $model, 'year', CHtml::listData($yearList, 'year', 'year'), array(
       'id' => 'que-question-year-dropdown',
       'filter-type' => QuestionBank::$FILTER_YEAR,
       'empty' => 'Select Year',
       'class' => 'input-block-level'
      ));
      ?>
    </div>
  </div>
  <div id="que-filter-selected" class="row">

  </div>
</div>
<div class="well row">
  <?php //echo CHtml::submitButton('Search', array('id' => 'que-search-question-btn', 'class' => 'btn que-btn-red-border-1')); ?>
  <button type="button" id="que-clear-search-btn" class="btn btn-default">Clear</button>
</div>
<?php $this->endWidget(); ?>
