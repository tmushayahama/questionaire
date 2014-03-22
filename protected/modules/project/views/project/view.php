<?php
$this->beginContent('//home_layouts/navbar');
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/que_questionnaire.js', CClientScript::POS_END
);
?>
<script>
  var deleteUserQuestionnaireUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/deleteUserQuestionnaire"); ?>";
</script>
<div class="row-fluid">
  <ul class="breadcrumb que-breadcrumb">
    <li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-link')); ?> <span class="divider">/</span></li>
    <li class="active"><?php echo $projectModel->name ?></li>

    <!--<li class="offset7"><a href="#new-project-modal" role="button" class="gb-btn" data-toggle="modal">Manage Questionnaire</a></li>-->
  </ul>
</div>

<div class="container">
  <div class="row que-questionnaires-content">
    <div class="sub-heading-3">
      <div class="hide edit-project row-fluid">
        <h3>Edit Project</h3>
        <br>
        <input type="text" class="input-block-level" value="<?php echo $projectModel->name ?>">
        <textarea class="span12" rows="2"><?php echo $projectModel->description; ?></textarea>
        <a class="btn que-save-edit-project-name">Save</a>
        <a class="btn que-cancel-edit-project-name">Cancel</a>
        <br>
        <br>
      </div>
      <div class="project-name row-fluid">
        <h2>
          <div class="pull-left"><?php echo $projectModel->name ?> </div>
          <div class="">
            &nbsp(<?php echo ProjectQuestionnaire::getProjectQuestionnairesCount($projectModel->id); ?>)
            <a class="btn btn-mini que-edit-project-name">Edit Project</a>
          </div></h2>
        <p><?php //echo $projectModel->description;    ?></p>

      </div>
    </div>
    <div class="que-sidebar row-fluid">
      <h3 class="sub-heading-2">Create Questionnaires</h3>
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
      <table class="que-white-background table table-hover">
        <thead>
          <tr>
            <th class="span1">
            </th>
            <th class="span8">
              Questionnaires
            </th>
            <th class="span3">
            </th>
          </tr>
        </thead>
        <tbody>

          <?php
          $row = 1;
          foreach ($projectQuestionnaires as $projectQuestionnaire):
            ?>
            <tr class="que-questionnaire-entry" user-questionnaire-id="<?php echo $projectQuestionnaire->id ?>">
              <td class="">
                <?php echo $row++; ?>
              </td>
              <td class="name">
                <h4><?php echo CHtml::link($projectQuestionnaire->userQuestionnaire->name, array(Yii::app()->getModule('project')->viewQuestionnaireUrl, 'projectId' => $projectModel->id, 'questionnaireId' => $projectQuestionnaire->userQuestionnaire->id), array('class' => '')); ?></h4>
                <p><i class="que-space-right">Created: 12/12/12</i> <i>Last Modified: 12/12/12</i></p>
              </td>
              <td class="">
                <div class="pull-right btn-group">
                  <button id="" class="btn  dropdown-toggle" data-toggle="dropdown"><i class =" icon-file"></i></button>
                  <button class="btn dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                     <li> <a class=""> <i class ="icon-white icon-file"></i>Copy To</a></li>
                   <li> <a class=""> <i class ="icon-white icon-file"></i>Move To</a></li>
                    <li> <a class="que-delete-questionnaire-btn"> <i class ="icon-white icon-trash"></i>Delete</a></li>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php $this->endContent(); ?>

