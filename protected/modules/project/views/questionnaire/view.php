<?php $this->beginContent('//home_layouts/home_nav_questionnaire'); ?>
<?php
Yii::app()->clientScript->registerScriptFile(
				Yii::app()->baseUrl . '/js/que_questionnaire.js', CClientScript::POS_END
);
?>
<script id="record-task-url" type="text/javascript">
	var addQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/addquestion/questionnaireId/" . $questionnaireId); ?>";

</script>
<div class="row-fluid">
	<div class="span3">
		<div class="sidebar-nav que-sidebar">
			<h4>Search Criteria</h4>
			<?php
			echo $this->renderPartial('_search_questions_form', array('model' => $questionSearchModel,
					'toolList' => $toolList,
					"yearList" => $yearList,
					'conceptList' => $conceptList));
			?>
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
				foreach ($questions as $question):
					?>
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
							<a question-id="<?php echo $question->id ?>" href="#" class="add-question-btn pull-right btn btn-mini"><i class="icon-plus"></i>Add</a>
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
		<h4><?php echo $model->name . " Preview" ?></h4>
		<table>
			<tbody id="question-row">
				<?php
				foreach ($question_contents as $question_content):
					echo $this->renderPartial('_question_row', array(
							'question_content' => $question_content));
				endforeach;
				?>
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
<div id="edit-question-modal" class="modal hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<span><h3>Search Criteria Summary</h3>
	</span>
	<div class="modal-body">
		<div class="span6">
			<textarea id="edit-question-input" rows=3> </textarea>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>
<?php $this->endContent(); ?>