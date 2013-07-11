<?php $this->beginContent('//home_layouts/home_nav'); ?>
<div class="row">
	<h3>Project Name: <?php //echo $model->name ?> </h3>
	<?php echo CHtml::link('Back', Yii::app()->user->returnUrl, array('class' => 'span2 btn btn-danger')); ?>
	<?php echo CHtml::link('Create a New Questionnaire', Yii::app()->getModule('project')->createQuestionnaireUrl, array('class' => 'span2 btn btn-success')); ?>
</div>
<?php $this->endContent(); ?>
