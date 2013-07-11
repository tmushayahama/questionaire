<?php $this->beginContent('//home_layouts/home_nav_questionnaire'); ?>
<div class="row-fluid">
	<div class="span3">
		<div class="well sidebar-nav que-sidebar">
			<h3>Search Criteria</h3>
			<?php echo $this->renderPartial('_search_questions_form', array('model' => $questionSearchModel)); ?>
			<ul class="nav nav-list">
				<li><h3><?php echo CHtml::link(Yii::app()->user->firstname . ' ' . Yii::app()->user->lastname, '', array('class' => '')); ?></h3></li>
				<li class="nav-header">My Statistics</li>
				<li><a href="#"><?php echo $this->projectCount ?> Projects</a></li>
				<li><a href="#">0 Questionnaires</a></li>
				<li><a href="#">0 Questions</a></li>
				<li class="nav-header">How To</li>
				<li><a href="#">Create a Project</a></li>
				<li><a href="#">Create a Questionnaire</a></li>
				<li><a href="#">Select Questions</a></li>
			</ul>
		</div><!--/.well -->
	</div><!--/span-->
	<div class="span7">
		<?php
		/* @var $this QuestionnaireController */
		/* @var $model Questionnaire */

		$this->breadcrumbs = array(
				'Questionnaires' => array('index'),
				'Manage',
		);

		$this->menu = array(
				array('label' => 'List Questionnaire', 'url' => array('index')),
				array('label' => 'Create Questionnaire', 'url' => array('create')),
		);

		Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#questionnaire-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
		?>

		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
				'id' => 'questionnaire-grid',
				'dataProvider' => $questionSearchModel->search(),
				'filter' => $questionSearchModel,
				'columns' => array(
						'concept',
						array(
								'class' => 'CButtonColumn',
						),
				),
		));
		?>

	</div>
</div>

<?php $this->endContent(); ?>