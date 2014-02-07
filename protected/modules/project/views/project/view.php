<?php $this->beginContent('//home_layouts/navbar'); ?>

<div class="row-fluid">
  <ul class="breadcrumb que-breadcrumb">
    <li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-link')); ?> <span class="divider">/</span></li>
    <li class="active"><?php echo $projectModel->name ?></li>

    <!--<li class="offset7"><a href="#new-project-modal" role="button" class="gb-btn" data-toggle="modal">Manage Questionnaire</a></li>-->
  </ul>
  <div class="que-topbar-nav container">
    <div class="row">
      <ul id="que-topbar-nav-list" class="que-nav-1">
        <li class="active"><a><?php echo $projectModel->name ?></a></li>
      </ul>
    </div>
  </div>
</div>

<div class="container">
  <!-- <div id="gb-home-nav" class=" row-fluid span10">
    <a class=""><i class="icon-check"></i> 1 Contributer</a>
    <a class=""><i class="icon-time"></i> 2 Questionnaire </a>
    <a class=""><i class="icon-book"></i> 2 Questions </a>
  </div> -->
  <div class="row que-questionnaires-content">
    <div class="que-sidebar row-fluid">
      <h3 class="sub-heading-1">Create Questionnaires</h3>
      <div id="new-questionnaire-form" class="">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
         'id' => 'questionnaire-form',
         'enableAjaxValidation' => false,
         'htmlOptions' => array(
          'class' => 'form',
         ),
        ));
        ?>
        <div class="row-fluid">
          <div class="span12">
            <?php echo $form->errorSummary(array($questionnaireModel), NULL, NULL, array('class' => 'alert alert-error')); ?>
            <div class="control-group">
              <div class="controls">
                <?php echo $form->textField($questionnaireModel, 'name', array("class" => "input-block-level", "placeholder" => "Name")); ?>
                <?php echo $form->error($questionnaireModel, 'name'); ?>
              </div>
            </div>
          </div>
          <?php echo CHtml::submitButton('Create', array('class' => 'que-btn pull-right que-btn-blue-2')); ?>
          <button type="button" class="que-btn pull-right que-btn-grey-1">Cancel</button>

        </div>
        <?php $this->endWidget(); ?>
      </div>
    </div><!--/span-->
    <div class="que-middle-container row-fluid">

      <div class="tab-heading">
        <div class="pull-left">My Questionnaires </div>
        <div class="">
          (<?php echo ProjectQuestionnaire::getProjectQuestionnairesCount($projectModel->id); ?>)
        </div>
      </div>
      <br>
      <table class="que-white-background table table-hover">
        <thead>
          <tr>
            <th class="span1">
            </th>
            <th class="span8">
              Name
            </th>
            <th class="span3">
            </th>
          </tr>
        </thead>
        <tbody>
          <tr class="que-questionaire-entry">
            <?php
            $row = 1;
            foreach ($projectQuestionnaires as $projectQuestionnaire):
              ?>
              <td class="">
                <?php echo $row++; ?>
              </td>
              <td class="name">
                <h4><?php echo CHtml::link($projectQuestionnaire->userQuestionnaire->name, array(Yii::app()->getModule('project')->viewQuestionnaireUrl, 'projectId' => $projectModel->id, 'questionnaireId' => $projectQuestionnaire->userQuestionnaire->id), array('class' => '')); ?></h4>
                <p><i class="que-space-right">Created: 12/12/12</i> <i>Last Modified: 12/12/12</i></p>
              </td>
              <td class="">
                <i class ="icon-edit"></i>
                <i class ="icon-trash"></i>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php $this->endContent(); ?>

