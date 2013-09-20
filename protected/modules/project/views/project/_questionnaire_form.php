<?php
	$form = $this->beginWidget('CActiveForm', array(
			'id' => 'questionnaire-form',
			'enableAjaxValidation' => true,
			'htmlOptions' => array(
					'class' => 'form-horizontal',
			),
	));
	?>
	<div class="modal-body">
		<?php echo $form->errorSummary(array($questionnaireModel), NULL, NULL, array('class' => 'alert alert-error')); ?>
		<div class="control-group">
			<div class="control-label">
				<?php echo $form->labelEx($questionnaireModel, 'name'); ?>
			</div>
			<div class="controls">
				<?php echo $form->textField($questionnaireModel, 'name'); ?>
				<?php echo $form->error($questionnaireModel, 'name'); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<?php echo CHtml::submitButton('Create', array('class' => 'btn btn-primary')); ?>
	</div>
	<?php $this->endWidget(); ?>