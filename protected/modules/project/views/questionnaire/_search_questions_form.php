<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
			'action' => Yii::app()->createUrl($this->route),
			'method' => 'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'tool'); ?>
		<?php echo $form->textField($model, 'tool', array('class'=>'input-block-level')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'concept'); ?>
		<?php echo $form->textField($model, 'concept', array('class'=>'input-block-level')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'content'); ?>
		<?php echo $form->textField($model, 'content', array('class'=>'input-block-level')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn btn-large btn-block btn-primary')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->