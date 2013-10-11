<?php $this->beginContent('//home_layouts/home_nav_questionnaire'); ?>
<?php
Yii::app()->clientScript->registerScriptFile(
				Yii::app()->baseUrl . '/js/que_questionnaire.js', CClientScript::POS_END
);
?>
<script id="record-task-url" type="text/javascript">
	var addQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/addquestion/questionnaireId/" . $questionnaireId); ?>";
	var editQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/editquestion/questionnaireId/". $questionnaireId); ?>";
	var moreInfoQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/moreinfoquestion"); ?>";
        var removeQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/removequestion/questionnaireId/".$questionnaireId); ?>"
        var qRemoveQuestionUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/qremovequestion/questionnaireId/".$questionnaireId); ?>"
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
	<div id="que-questions-container"class="span5">
		<div class="row-fluid">
			<div class="span4">
				<h5 class="pull-left">Results <?php echo $pages->currentPage . ' to ' . $pages->pageCount . ' of ' . $questionCount; ?>
				</h5>
			</div>
			<div class="span8">
				<?php
				$this->widget('CLinkPager', array(
						'pages' => $pages,
				))
				?>
			</div>
			<br>
			<a href="#que-search-summary-modal" role="button" data-toggle="modal">View Search Criteria</a>
		</div>
		<table class="table table-condensed">
			<tbody>
				<?php
				$count = 1;
                                $color="transparent";
				foreach ($questions as $question):
                                    if (UserQuestion::getModified($question->id)==0)//number of times added
                                        $color="transparent";
                                    else
                                        $color="lightblue";
					?>
					<tr class="<?php echo $color ?>" id="<?php echo 'display-question-'.$question->id ?>">
						<td class="span1">
							<?php echo ($pages->currentPage * $pages->pageSize) + $count++; ?>
						</td>
						<td class="span9">
							<p id="<?php echo 'add-question-'.$question->id ?>"><?php echo $question->content ?> </p>
							<p><small>-<?php echo $question->author ?> <i><?php echo $question->year ?></i></small><br>
								<a id="question-modified-btn" question-id="<?php echo $question->id ?>" >Added <i><?php echo UserQuestion::getModified($question->id); ?></i></a><br>
									<a id="que-more-question-info-btn" question-id="<?php echo $question->id ?>" >More Details</a>
							</p>
						</td>
						<td class="span2">
							<a question-id="<?php echo $question->id ?>" href="#" class="add-question-btn pull-right btn-link">Add</a><br>
							<a question-id="<?php echo $question->id ?>" href="#" class="edit-add-question-btn pull-right btn-link">Edit Add</a>
                                                        <a question-id="<?php echo $question->id ?>" href="#" class="qRemove-question-btn pull-right btn-link">Remove</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="span4">
		<h4><?php echo $model->name . " Preview" ?></h4>
		<br>
		<table class="table table-condensed table-hover">
			<thead>
			<th>
				Content
			</th>
			<th>
				Scale
			</th>
			</thead>
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
	<span><h3>Edit Question</h3>
	</span>
	<div class="modal-body">
		<div class="span12">
			<textarea class="span12" id="edit-question-input" rows=3> </textarea>
		</div>
	</div>
	<div class="modal-footer">
		<button id="que-save-edited-btn" class="btn btn-success" data-dismiss="modal" aria-hidden="true">Save</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>
<div id="question-more-info-modal" class="modal hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<span><h3>Question Info</h3>
	</span>
	<div class="modal-body">
		<div class="span12">
			<dl class="dl-horizontal">
				<dt>
				Content
				</dt>
				<dd>
					<p id="que-more-info-question-content">
					</p>
				</dd>
				<dt>
				Concept
				</dt>
				<dd>
					<p id="que-more-info-question-concept">
					</p>
				</dd>
				<dt>
				Tool
				</dt>
				<dd>
					<p id="que-more-info-question-tool">
					</p>
				</dd>
				<dt>
				Author
				</dt>
				<dd>
					<p id="que-more-info-question-author">
					</p>
				</dd>
				<dt>
				Year
				</dt>
				<dd>
					<p id="que-more-info-question-year">
					</p>
				</dd>
			</dl>
		</div>
	</div>
	<div class="modal-footer">
		<button id="add-question" class="btn btn-success" data-dismiss="modal" aria-hidden="true">Add</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>
<div id="edit-add-question-modal" class="modal hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<span><h3>Edit and Add</h3>
	</span>
	<div class="modal-body">
		<div class="span12">
			<dl class="dl-horizontal">
				<dt>
				Content
				</dt>
				<dd>
					<textarea class="span12" id="edit-add-question-input" rows=3> </textarea>
				</dd>
				<dt>
				Scale
				</dt>
				<dd>
					<textarea class="span12" id="edit-scale-input" rows=3> 
					</textarea>
				</dd>
			</dl>
		</div>
	</div>
	<div class="modal-footer">
		<button id="add-question" class="btn btn-success" data-dismiss="modal" aria-hidden="true">Add</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>
<?php $this->endContent(); ?>