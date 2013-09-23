<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
			'id' => 'question-form',
			'enableAjaxValidation' => false,
	));
?>
<div class="accordion" id="question-search-1-1">
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#question-search-1-1" href="#collapse-question-search-1-1">
				Concept<i class="pull-right icon-chevron-down"></i>
			</a>
		</div>
		<div id="collapse-question-search-1-1" class="accordion-body in collapse">
			<div class="accordion-inner">
				<div class="row-fluid">
					<ul class="nav que-checkbox-nav">
						<?php
						echo CHtml::activeCheckboxList(
										$model, 'questionConceptList', CHtml::listData($conceptList, 'concept', 'concept'), array(
								'labelOptions' => array('style' => 'display:inline'),
								'separator' => '',
								'template' => '<li>{input} {label}</li>'
										)
						);
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#question-search-1-1" href="#collapse-question-search-1-2">
				Tools<i class="pull-right icon-chevron-down"></i>
			</a>
		</div>
		<div id="collapse-question-search-1-2" class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="row-fluid">
					<ul class="nav que-checkbox-nav">
						<?php
						echo CHtml::activeCheckboxList(
										$model, 'questionToolList', CHtml::listData($toolList, 'tool', 'tool'), array(
								'labelOptions' => array('style' => 'display:inline'),
								'separator' => '',
								'template' => '<li>{input} {label}</li>'
										)
						);
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-medium btn-block btn-primary')); ?>

</div>

<?php $this->endWidget(); ?>
