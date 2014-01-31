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
  <div class="span12">
    <div class="row-fluid input-prepend input-append">
      <div class="btn-group">
        <button class="btn dropdown-toggle" data-toggle="dropdown">
          All
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a>All</a></li>
          <li><a>Content</a></li>
          <li><a>Tool</a></li>
          <li><a>Year</a></li>
        </ul>
      </div>
      <input class="span8" id="que-question-keyword-search-input" class="que-input-large" placeholder="Search Question by context, year, etc."type="text">
      <button id="que-question-keyword-search-btn" class="que-btn que-btn-blue-2" >Keyword Search</button>
    </div>
  </div> 
</div>
<br>
<br>
<button class="que-additional-filter-question-btn que-btn que-btn-grey-1">Additional Filters</button>
<div class="row">
  <div id="que-tool-dropdown" class="span10">
    <?php
    echo CHtml::activeDropDownList(
      $model, 'tool', CHtml::listData($toolList, 'tool', 'tool'), array(
      'id'=> 'que-question-tool-dropdown',
       'empty' => 'Select a Questionnaire',
     'class' => 'input-block-level'
    ));
    ?>
  </div>
</div>
<div class="row">
  <div id="que-concept-dropdown" class="span10">
    <?php
    echo CHtml::activeDropDownList(
      $model, 'concept', CHtml::listData($conceptList, 'concept', 'concept'), array(
      'id'=> 'que-question-concept-dropdown',
       'empty' => 'Select a Concept',
     'class' => 'input-block-level'
    ));
    ?>
  </div>
</div>
<div class="row">
  <div id="que-year-dropdown" class="span10">
    <?php
    echo CHtml::activeDropDownList(
      $model, 'year', CHtml::listData($yearList, 'year', 'year'), array(
    'id'=> 'que-question-year-dropdown',
       'empty' => 'Select Year',
     'class' => 'input-block-level'
    ));
    ?>
  </div>
</div>
<div class="form-footer span11">
  <?php //echo CHtml::submitButton('Search', array('id' => 'que-search-question-btn', 'class' => 'btn que-btn-red-border-1')); ?>
  <button type="button" class="que-btn que-btn-grey-1 ">Clear</button>
</div>
<?php $this->endWidget(); ?>
