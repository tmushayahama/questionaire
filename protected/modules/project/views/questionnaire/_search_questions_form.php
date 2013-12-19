<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
 'id' => 'search-question-form',
 'enableAjaxValidation' => false,
 'htmlOptions' => array(
  'class' => 'form',
  'onsubmit' => "return false;")
  ));
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
      <input class="span11" id="appendedPrependedDropdownButton" class="que-input-large" placeholder="Keyword Search."type="text">
    </div>
  </div> 
</div>
<br>
<div class="row">
  <div class="span3"><h4 class="pull-right">Additional Filters</h4></div>
  <div class="span8">
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
            Questionnaire<i class="pull-right icon-chevron-down"></i>
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
      <div class="accordion-group">
        <div class="accordion-heading">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#question-search-1-1" href="#collapse-question-search-1-3">
            Year<i class="pull-right icon-chevron-down"></i>
          </a>
        </div>
        <div id="collapse-question-search-1-3" class="accordion-body collapse">
          <div class="accordion-inner">
            <div class="row-fluid">
              <ul class="nav que-checkbox-nav">
                <?php
                echo CHtml::activeCheckboxList(
                  $model, 'questionYearList', CHtml::listData($yearList, 'year', 'year'), array(
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
  </div> 
</div>
<div class="form-footer span11">
  <?php echo CHtml::submitButton('Search', array('id' => 'que-search-question-btn', 'class' => 'btn que-btn-red-border-1')); ?>
  <a class="btn que-btn-red-border-1 ">Clear</a>
  <a href="#que-search-summary-modal" class="btn que-btn-red-border-1 pull-right" role="button" data-toggle="modal"><h5>View Search Criteria</h5></a>
</div>
<?php $this->endWidget(); ?>
