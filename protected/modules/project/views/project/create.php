<?php $this->beginContent('//home_layouts/home_nav'); ?>
<h1>Create Project</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->endContent(); ?>