<?php $this->beginContent('//home_layouts/home_nav'); ?>
<div class="row-fluid que-breadcrumb">
	<div class="span6">
		<h3>Add A Project</h3>
	</div>
	<div class="span6">

		<h3><a href="#new-project-modal" role="button" class="btn btn-primary pull-right" data-toggle="modal">Create New Project</a></h3>
	</div>
</div>
<div class="row-fluid">
	<ul class="thumbnails ">
		<br>
		<?php foreach ($projects as $userProject): ?>

			<li class="span5 que-project-entry">
				<div class="thumbnail">
					<img data-src="holder.js/300x200" alt="">
					<h4><?php echo CHtml::link($userProject->project->name, Yii::app()->getModule('project')->viewProjectUrl . $userProject->project->id, array('class' => 'active')); ?></h4>
					<p><?php echo $userProject->project->description ?></p>
				</div>
				<span ><?php echo $userProject->project->type ?></span>
				<span class="label pull-right"><i>Created 12-12-12</i></span>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<div id="new-project-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Create Project</h3>
  </div>
	<?php echo $this->renderPartial('_form', array('model' => $projectModel)); ?>
</div>
<?php $this->endContent(); ?>