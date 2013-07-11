<?php $this->beginContent('//home_layouts/home_nav'); ?>
<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb que-breadcrumb">
			<li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-success')); ?> <span class="divider">/</span></li>
			<li class="active"><?php echo $projectModel->name ?></li>
			<li class="pull-right"><a href="#new-project-modal" role="button" class="btn btn-primary" data-toggle="modal">Create A Questionnaire</a></li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<ul class="thumbnails ">
		<br>
		<?php foreach ($projectQuestionnaire as $questionnaire): ?>
			<li class="span3 que-project-entry">
				<div class="thumbnail">
					<img data-src="holder.js/300x200" alt="">
					<h4><?php echo CHtml::link($questionnaire->name, Yii::app()->getModule('project')->viewProjectUrl . '', array('class' => '')); ?></h4>
				</div>
				<span class="label pull-right"><i>Created 12-12-12</i></span>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<div id="new-project-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Create Questionnaire</h3>
  </div>

	<?php
	$form = $this->beginWidget('CActiveForm', array(
			'id' => 'questionnaire-form',
			'enableAjaxValidation' => false,
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
</div>
<?php $this->endContent(); ?>

