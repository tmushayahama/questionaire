<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
 'id' => 'project-form',
 'enableAjaxValidation' => false,
 'htmlOptions' => array(
  'class' => 'form',
 ),
  ));
?>
<div class="row-fluid">
  <div class="span12">
    <?php echo $form->errorSummary(array($model), NULL, NULL, array('class' => 'alert alert-error')); ?>
    <div class="control-group">
      <?php echo $form->textField($model, 'name', array('placeholder' => 'Name', 'class' => 'input-block-level')); ?>
      <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="control-group">
      <?php echo $form->textArea($model, 'description', array('rows' => 3, 'placeholder' => 'Description', 'class' => 'input-block-level')); ?>
      <?php echo $form->error($model, 'description'); ?>
    </div>
  </div>
  <div class="">
    <?php echo CHtml::submitButton('Create', array('class' => 'que-btn que-btn-blue-2 pull-right')); ?>
    <button id="que-btn-close-project-form" class="que-btn que-btn-grey-1 pull-right">Cancel</button>
  </div>
</div>
<?php $this->endWidget(); ?>