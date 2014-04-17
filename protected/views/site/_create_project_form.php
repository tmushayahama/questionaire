<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
 'id' => 'project-form',
 'enableAjaxValidation' => true,
 'htmlOptions' => array(
  'class' => 'form',
 ),
  ));
?>
<div class="row">
  <p>Organize your questionnaires in projects</p>
</div>
<div class="form-group row">
  <?php echo $form->textField($model, 'name', array('placeholder' => 'Name', 'class' => 'input-lg col-lg-12 col-sm-12 col-xs-12')); ?>
  <?php echo $form->error($model, 'name'); ?>
</div>
<div class="form-group row">
  <?php echo $form->textArea($model, 'description', array('rows' => 3, 'placeholder' => 'Description', 'class' => 'col-lg-12 col-sm-12 col-xs-12')); ?>
  <?php echo $form->error($model, 'description'); ?>
</div>
<div class="">
  <?php echo CHtml::submitButton('Create', array('class' => 'btn btn-primary pull-right')); ?>
  <button id="que-btn-close-project-form" class="btn btn-default pull-right" type="button">Cancel</button>
</div>
<?php $this->endWidget(); ?>