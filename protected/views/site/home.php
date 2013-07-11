<?php $this->beginContent('//home_layouts/home_nav'); ?>
<div class="row-fluid que-breadcrumb">
	<div class="span6">
		<h3>Add A Project</h3>
	</div>
	<div class="span6">
		<h3><a href="#new-project-modal" role="button" class="btn btn-primary pull-right" data-toggle="modal">Create New Project</a></h3>
	</div>
</div>
<?php foreach ($projects as $userProject): ?>
	<div class="row-fluid">
		<ul class='nav nav-list que-project-entry'>
			<li>
				<h4>
					<?php echo CHtml::link($userProject->project->name, Yii::app()->getModule('project')->viewProjectUrl . $userProject->project->id, array('class' => '')); ?>
					<span class="label pull-right"><i>Created: 12-12-12</i></span>
				</h4>
			</li>
			<li>Type: <?php echo $userProject->project->type ?></li>
			<li><p><?php echo $userProject->project->description ?></p></li>
		</ul>
	</div>
<?php endforeach; ?>

<div id="new-project-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Create Project</h3>
  </div>
	<?php echo $this->renderPartial('_form', array('model' => $projectModel)); ?>
</div>
<?php $this->endContent(); ?>