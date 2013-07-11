<?php
/* @var $this QuestionnaireController */
/* @var $model Questionnaire */

$this->breadcrumbs=array(
	'Questionnaires'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Questionnaire', 'url'=>array('index')),
	array('label'=>'Create Questionnaire', 'url'=>array('create')),
	array('label'=>'Update Questionnaire', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Questionnaire', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Questionnaire', 'url'=>array('admin')),
);
?>

<h1>View Questionnaire #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'project_id',
	),
)); ?>
