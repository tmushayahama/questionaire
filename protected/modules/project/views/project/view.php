<?php $this->beginContent('//layouts/que_main'); ?>
<div class="navbar navbar-inverse navbar-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo CHtml::link('Questionnaire', Yii::app()->getModule('user')->returnUrl, array('class' => 'brand ')); ?>
			<div class="nav-collapse collapse">
				<ul class="pull-right nav">
					<?php echo CHtml::link('Logout', Yii::app()->getModule('user')->logoutUrl, array('class' => 'pull-right span1 btn btn-danger')); ?>	
					<li><?php echo CHtml::link(Yii::app()->user->email, Yii::app()->getModule('user')->logoutUrl, array('class' => 'pull-right ')); ?></li>	
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div> <!--navbar-->
<div class="row-fluid">
	<div class="span10">
		<ul class="breadcrumb que-breadcrumb">
			<li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-success')); ?> <span class="divider">/</span></li>
			<li class="active"><?php echo $projectModel->name ?></li>
			<li class="pull-right"><a href="#new-project-modal" role="button" class="btn btn-primary" data-toggle="modal">Create A Questionnaire</a></li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div id="gb-home-nav" class=" row-fluid span10">
		<a class=""><i class="icon-check"></i> 1 Contributer</a>
		<a class=""><i class="icon-time"></i> 2 Questionnaire </a>
		<a class=""><i class="icon-book"></i> 2 Questions </a>
	</div>
	<table class="span10 table">
		<tbody>
			<tr class="que-questionaire-entry">>
				<?php foreach ($projectQuestionnaire as $questionnaire): ?>

					<td class="span8">
						<h4><?php echo CHtml::link($questionnaire->name, array(Yii::app()->getModule('project')->viewQuestionnaireUrl, 'projectId' => $projectModel->id, 'questionnaireId' => $questionnaire->id), array('class' => '')); ?></h4>
					</td>
					<td class="span4 label"><i>Created 12-12-12</i></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
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

