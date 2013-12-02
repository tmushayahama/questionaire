<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
 'id' => 'search-questionnaire-form',
 'enableAjaxValidation' => false,
 'htmlOptions' => array(
  'class' => 'form',
  'onsubmit' => "return false;")
  ));
?>
<div class="row">
  <div class="span3">
    <h4 class="pull-right">Keyword Search</h4>
  </div>
  <div class="span8">
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
      <input class="span11" id="appendedPrependedDropdownButton" class="que-input-large" placeholder="Keyword Search."type="text">
    </div>
  </div> 
</div>
<br>
<div class="row">
  <div class="span3"><h4 class="pull-right">Select Questionnaire</h4></div>
  <div class="span8">
    <div class="row-fluid">
      <ul class="nav que-checkbox-nav">
        <?php
        echo CHtml::activeCheckboxList(
          $model, 'questionnaireSelected', CHtml::listData($questionnaireList, 'name', 'name'), array(
         'labelOptions' => array('style' => 'display:inline'),
         'separator' => '',
         'template' => '<li>{input} {label}</li>'
          )
        );
        ?>
      </ul>
    </div>


  </div> 
</div>
<div class="form-footer span11">
  <?php echo CHtml::submitButton('Search', array('id'=>'que-search-questionnaire-btn', 'class' => 'btn que-btn-red-border-1')); ?>
  <a class="btn que-btn-red-border-1 ">Clear</a>
  <a href="#que-search-summary-modal" class="btn que-btn-red-border-1 pull-right" role="button" data-toggle="modal"><h5>View Search Criteria</h5></a>

</div>
<?php $this->endWidget(); ?>
