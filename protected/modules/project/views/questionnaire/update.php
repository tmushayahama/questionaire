<?php
/* @var $this QuestionnaireController */
/* @var $model Questionnaire */

$this->breadcrumbs=array(
	'Questionnaires'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Questionnaire', 'url'=>array('index')),
	array('label'=>'Create Questionnaire', 'url'=>array('create')),
	array('label'=>'View Questionnaire', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Questionnaire', 'url'=>array('admin')),
);
?>

<h1>Update Questionnaire <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>