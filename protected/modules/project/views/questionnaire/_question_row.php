<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>
<tr class="question-table-row">
	<td>
		<?php echo $question_content->question->content; ?>
	</td>
	<td>
		<?php echo $question_content->question->scale; ?>
	</td>
	<td>
		<a href="#edit-question-modal" question-content="<?php echo $question_content->question->content ?>" question_id="<?php echo $question_content->question->id ?>"role="button" data-toggle="modal" class="edit-question-btn">Edit</a>
	</td>
</tr>