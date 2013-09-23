<?php $this->beginContent('//home_layouts/home_nav_questionnaire'); ?>
<div class="row-fluid">
	<div class="span3">
		<div class="sidebar-nav que-sidebar">
			<h4>Search Criteria</h4>
			<?php
			echo $this->renderPartial('_search_questions_form', array('model' => $questionSearchModel,
					'toolList' => $toolList,
					'conceptList' => $conceptList));
			?>
			<ul class="nav nav-list">
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
	<div class="span6">
		<div class="row-fluid">
			<h4 class="pull-right">Showing Results <b><?php echo $questionCount; ?></b>
				<a href="#que-search-summary-modal" role="button" data-toggle="modal">View Search Criteria</a>
			</h4>
		</div>
		<table class="table table-condensed table-hover table-striped">
			<tbody>
				<?php 
				$count = 1;
				foreach ($questions as $question): ?>
				<tr>
					<td class="span1">
						<?php echo $count++; ?>
					</td>
					<td class="span9">
						<p><?php echo $question->content ?> <br>
							<small>-<?php echo $question->author ?> <i><?php echo $question->year ?></i></small><br>
							<a>More Details</a>
							</p>
					</td>
					<td class="span2">
						<a href="#" class="pull-right btn btn-mini"><i class="icon-plus"></i>Add</a>
					</td>
				</tr>
				
			<?php endforeach; ?>
			</tbody>
		</table>
		<?php
		/* @var $this QuestionnaireController */
		/* @var $model Questionnaire */

		/* 	$this->breadcrumbs = array(
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
		  'content',
		  array(
		  'class' => 'CButtonColumn',
		  ),
		  ),
		  )); */
		?>

	</div>
	<div class="span3">
		<h4><?php echo $model->name." Preview"?></h4>
		<table>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>

<div id="que-search-summary-modal" class="modal hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<span><h3>Search Criteria Summary</h3>
	</span>
	<div class="modal-body">
		<div class="span6">
			Selected Tool(s)
		</div>
		<div class="span6">
			Selected Concept(s)
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>
<?php $this->endContent(); ?>