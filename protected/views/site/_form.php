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
				'class' => 'form-horizontal',
		),
				));
?>
<div class="modal-body">
	<?php echo $form->errorSummary(array($model), NULL, NULL, array('class' => 'alert alert-error')); ?>
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model, 'name'); ?>
		</div>
		<div class="controls">
			<?php echo $form->textField($model, 'name'); ?>
			<?php echo $form->error($model, 'name'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model, 'type'); ?>
		</div>
		<div class="controls">
			<?php echo $form->textField($model, 'type'); ?>
			<?php echo $form->error($model, 'type'); ?>
		</div>
	</div>

	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model, 'description'); ?>
		</div>
		<div class="controls">
			<?php echo $form->textArea($model, 'description'); ?>
			<?php echo $form->error($model, 'description'); ?>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	<?php echo CHtml::submitButton('Create', array('class' => 'btn btn-primary')); ?>
</div>
<?php $this->endWidget(); ?>