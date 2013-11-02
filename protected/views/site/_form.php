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
<div class="span12">
	<?php echo $form->errorSummary(array($model), NULL, NULL, array('class' => 'alert alert-error')); ?>
	<div class="control-group">
		<div class="controls">
			<?php echo $form->textField($model, 'name', array('placeholder' => 'Name', 'class'=>'input-block-level')); ?>
			<?php echo $form->error($model, 'name'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<?php echo $form->textField($model, 'type', array('placeholder' => 'Type', 'class'=>'input-block-level')); ?>
			<?php echo $form->error($model, 'type'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<?php echo $form->textArea($model, 'description', array('rows' => 3, 'placeholder' => 'Description', 'class'=>'input-block-level')); ?>
			<?php echo $form->error($model, 'description'); ?>
		</div>
	</div>
</div>
<div class="">
	<?php echo CHtml::submitButton('Create', array('class' => 'que-btn btn-large que-btn-green-1 pull-right')); ?>
	<a id="que-btn-close-project-form" class="btn btn-large pull-right">Cancel</a>
</div>
<?php $this->endWidget(); ?>