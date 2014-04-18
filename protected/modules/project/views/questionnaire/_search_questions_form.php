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
<div class="row">
  <div class="col-lg-12">
    <div class="input-group input-group-lg">
      <input id="que-question-keyword-search-input" class="form-control" placeholder="Search Question by context, year, etc."type="text">
      <span class="input-group-btn">
        <button id="que-question-keyword-search-btn" class="btn btn-primary" >Search</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
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
    <div id="que-concept-dropdown" filter-type="<?php echo QuestionBank::$FILTER_CONCEPT ?>" class="col-lg-6 col-sm-12 col-xs-12">
      <?php
      echo CHtml::activeDropDownList(
        $model, 'concept', CHtml::listData($conceptList, 'concept', 'concept'), array(
       'id' => 'que-question-concept-dropdown',
       'filter-type' => QuestionBank::$FILTER_CONCEPT,
       'empty' => 'Select a Concept',
       'class' => 'form-control input-lg col-lg-12 col-sm-12 col-xs-12'
      ));
      ?>
    </div>
    <div id="que-year-dropdown" filter-type="<?php echo QuestionBank::$FILTER_YEAR ?>" class="col-lg-6 col-sm-12 col-xs-12">
      <?php
      echo CHtml::activeDropDownList(
        $model, 'year', CHtml::listData($yearList, 'year', 'year'), array(
       'id' => 'que-question-year-dropdown',
       'filter-type' => QuestionBank::$FILTER_YEAR,
       'empty' => 'Select Year',
       'class' => 'form-control input-lg col-lg-12 col-sm-12 col-xs-12'
      ));
      ?>
    </div>
  </div>
  <div id="que-filter-selected" class="row">
  </div>
  <div class="form-actions row">
    <?php //echo CHtml::submitButton('Search', array('id' => 'que-search-question-btn', 'class' => 'btn que-btn-red-border-1')); ?>
    <button type="button" id="que-clear-search-btn" class="btn btn-default">Clear</button>
  </div>
</div>
<?php $this->endWidget(); ?>
