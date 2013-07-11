<?php
/* @var $this QuestionnaireController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Questionnaires',
);

$this->menu=array(
	array('label'=>'Create Questionnaire', 'url'=>array('create')),
	array('label'=>'Manage Questionnaire', 'url'=>array('admin')),
);
?>

<h1>Questionnaires</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
