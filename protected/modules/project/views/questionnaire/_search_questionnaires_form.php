<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>
<div class="row">
  <div class="span3">
    <h4 class="pull-right">Keyword Search</h4>
  </div>
  <div class="span8">
    <div class="row-fluid input-prepend input-append">
      <div class="btn-group">
        <button class="btn dropdown-toggle" data-toggle="dropdown">
          All
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a>All</a></li>
          <li><a>Content</a></li>
          <li><a>Tool</a></li>
          <li><a>Year</a></li>
        </ul>
      </div>
      <input class="span9" id="appendedPrependedDropdownButton" class="que-input-large" placeholder="Keyword Search."type="text">
      <a class="btn que-btn-red-border-1 ">Search</a>
    </div>
  </div> 
</div>

<?php
$form = $this->beginWidget('CActiveForm', array(
 'id' => 'search-questionnaire-form-from-q',
 'enableAjaxValidation' => false,
 'htmlOptions' => array(
  'class' => 'form',
  'onsubmit' => "return false;")
  ));
?>

<br>
<div class="row">
  <div class="span3"><h4 class="pull-right">C Questionnaire Only</h4></div>
  <div class="span8">
    <div class="accordion" id="questionnaire-search-1-1">
      <div class="accordion-group">
        <div class="accordion-heading">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#question-search-1-1" href="#collapse-question-search-1-2">
            Questionnaire<i class="pull-right icon-chevron-down"></i>
          </a>
        </div>
        <div id="collapse-question-search-1-2" class="accordion-body collapse">
          <div class="accordion-inner">
            <div class="row-fluid">
              <ul class="nav que-checkbox-nav">
                <?php
                echo CHtml::activeCheckboxList(
                  $questionnaireSearchFromQModel, '[2]questionnaireSelected', CHtml::listData($toolList, 'tool', 'tool'), array(
                 'labelOptions' => array('style' => 'display:inline'),
                 'separator' => '',
                 'template' => '<li>{input} {label}</li>'
                  )
                );
                ?>
              </ul>
            </div>
            <div class="form-footer span11">
              <?php echo CHtml::submitButton('Search', array('id' => 'que-search-questionnaire-from-q-btn', 'class' => 'btn que-btn-red-border-1')); ?>
              <a class="btn que-btn-red-border-1 ">Clear</a>
              <a href="#que-search-summary-modal" class="btn que-btn-red-border-1 pull-right" role="button" data-toggle="modal">View Search Criteria</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>

<?php $this->endWidget(); ?>


<?php
$form = $this->beginWidget('CActiveForm', array(
 'id' => 'search-questionnaire-form-from-cy',
 'enableAjaxValidation' => false,
 'htmlOptions' => array(
  'class' => 'form',
  'onsubmit' => "return false;")
  ));
?>
<div class="row">
  <div class="span3"><h4 class="pull-right">Concept and Year</h4></div>
  <div class="span8">
    <div class="accordion" id="questionnaire-search-1-1">
      <div class="accordion-group">
        <div class="accordion-heading">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#questionnaire-search-1-1" href="#collapse-questionnaire-search-1-1">
            Concept<i class="pull-right icon-chevron-down"></i>
          </a>
        </div>
        <div id="collapse-questionnaire-search-1-1" class="accordion-body in collapse">
          <div class="accordion-inner">
            <div class="row-fluid">
              <ul class="nav que-checkbox-nav">
                <?php
                echo CHtml::activeCheckboxList(
                  $questionnaireSearchFromCYModel, '[3]questionConceptList', CHtml::listData($conceptList, 'concept', 'concept'), array(
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
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#questionnaire-search-1-1" href="#collapse-questionnaire-search-1-3">
            Year<i class="pull-right icon-chevron-down"></i>
          </a>
        </div>
        <div id="collapse-questionnaire-search-1-3" class="accordion-body collapse">
          <div class="accordion-inner">
            <div class="row-fluid">
              <ul class="nav que-checkbox-nav">
                <?php
                echo CHtml::activeCheckboxList(
                  $questionnaireSearchFromCYModel, '[3]questionYearList', CHtml::listData($yearList, 'year', 'year'), array(
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
    </div>
    <div class="form-footer span11">
      <?php echo CHtml::submitButton('Search', array('id' => 'que-search-questionnaire-from-cy-btn', 'class' => 'btn que-btn-red-border-1')); ?>
      <a class="btn que-btn-red-border-1 ">Clear</a>
      <a href="#que-search-summary-modal" class="btn que-btn-red-border-1 pull-right" role="button" data-toggle="modal">View Search Criteria</a>
    </div>
  </div> 
</div>

<?php $this->endWidget(); ?>
