<?php $this->beginContent('//home_layouts/navbar'); ?>

<div class="">
  <ul class="breadcrumb que-breadcrumb">
    <li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-link')); ?> <span class="divider">/</span></li>
    <li class="active"><?php echo $projectModel->name ?></li>

    <!--<li class="offset7"><a href="#new-project-modal" role="button" class="gb-btn" data-toggle="modal">Manage Questionnaire</a></li>-->
  </ul>
</div>

<div class="row-fluid que-project-container">
  <!-- <div id="gb-home-nav" class=" row-fluid span10">
    <a class=""><i class="icon-check"></i> 1 Contributer</a>
    <a class=""><i class="icon-time"></i> 2 Questionnaire </a>
    <a class=""><i class="icon-book"></i> 2 Questions </a>
  </div> -->
  <h2 class=""><?php echo $projectModel->name ?></h2>
  <table class="span6 table table-condensed table-hover table-striped">
    <thead>
      <tr>
        <th class="span1">
        </th>
        <th class="span8">
          Name
        </th>
        <th class="span3">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="que-questionaire-entry">
        <?php
        $row = 1;
        foreach ($projectQuestionnaire as $questionnaire):
          ?>
          <td class="">
            <?php echo $row++; ?>
          </td>
          <td class="name">
            <h4><?php echo CHtml::link($questionnaire->name, array(Yii::app()->getModule('project')->viewQuestionnaireUrl, 'projectId' => $projectModel->id, 'questionnaireId' => $questionnaire->id), array('class' => '')); ?></h4>
            <p><i class="que-space-right">Created: 12/12/12</i> <i>Last Modified: 12/12/12</i></p>
          </td>
          <td class="">
            <i class ="question-icon icon-edit"></i>
            <i class ="question-icon icon-trash"></i>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div id="new-project" class="span3">
    <div class="header">
      <h3> Create Questionnaire</h3>
    </div>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
     'id' => 'questionnaire-form',
     'enableAjaxValidation' => false,
     'htmlOptions' => array(
      'class' => 'form',
     ),
    ));
    ?>
    <div class="span12">
      <?php echo $form->errorSummary(array($questionnaireModel), NULL, NULL, array('class' => 'alert alert-error')); ?>
      <div class="control-group">
        <div class="controls">
          <?php echo $form->textField($questionnaireModel, 'name', array("class" => "input-block-level", "placeholder" => "Name")); ?>
          <?php echo $form->error($questionnaireModel, 'name'); ?>
        </div>
      </div>
    </div>
    <?php echo CHtml::submitButton('Create', array('class' => 'que-btn que-btn-blue-2 btn-large btn-block')); ?>

    <?php $this->endWidget(); ?>
  </div>
</div>

<?php $this->endContent(); ?>

