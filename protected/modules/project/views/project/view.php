<?php
$this->beginContent('//layouts/que_main1');
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/que_questionnaire.js', CClientScript::POS_END
);
?>
<script>
  var deleteUserQuestionnaireUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/deleteUserQuestionnaire"); ?>";
  var copyQuestionnaireUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/copyQuestionnaire/", array('id' => $projectModel->id)); ?>";
  var moveQuestionnaireUrl = "<?php echo Yii::app()->createUrl("project/questionnaire/moveQuestionnaire/", array('id' => $projectModel->id)); ?>";
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
      <div class="que-hide edit-project row">
        <h3>Edit Project</h3>
        <br>
        <div class="form-group row">
          <input type="text" class="col-lg-12 col-sm-12 col-xs-12" value="<?php echo $projectModel->name ?>">
        </div>
        <div class="form-group row">
          <textarea class="col-lg-12 col-sm-12 col-xs-12" rows="2"><?php echo $projectModel->description; ?></textarea>
        </div>
        <div class="form-actions">
          <a class="btn btn-primary que-save-edit-project-name">Save</a>
          <a class="btn btn-default que-cancel-edit-project-name">Cancel</a>
        </div>
        <br>
      </div>
      <div class="project-name row">
        <h2>
          <div class="pull-left"><?php echo $projectModel->name ?> </div>
          <div class="">
            &nbsp(<?php echo ProjectQuestionnaire::getProjectQuestionnairesCount($projectModel->id); ?>)
            <a class="btn btn-mini que-edit-project-name">Edit Project</a>
          </div></h2>
        <p><?php //echo $projectModel->description;                        ?></p>

      </div>
    </div>
    <div class="row">
      <div class="que-sidebar col-lg-4 col-sm-12 col-xs-12 que-no-padding">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="sub-heading-2">Create Questionnaires</h3>
          </div>
          <div id="new-questionnaire-form" class="panel-body">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
             'id' => 'questionnaire-form',
             'enableAjaxValidation' => false,
             'htmlOptions' => array(
              'class' => 'form',
             ),
            ));
            ?>
            <div class="form-group row">
              <?php echo $form->textField($questionnaireModel, 'name', array("class" => "input-lg col-lg-12 col-sm-12 col-xs-12", "placeholder" => "Name")); ?>
              <?php echo $form->error($questionnaireModel, 'name'); ?>
            </div>
            <div class="form-actions">
              <?php echo CHtml::submitButton('Create', array('class' => 'btn btn-primary pull-right')); ?>
              <button type="button" class="btn btn-default pull-right">Cancel</button>
            </div>
            <?php $this->endWidget(); ?>
          </div>
        </div>
      </div><!--/span-->
      <div class="col-lg-8 col-sm-12 col-xs-12 que-no-padding">
        <table class="que-white-background table table-hover">
          <thead>
            <tr>
              <th class="col-lg-1 col-sm-1 col-xs-1">
              </th>
              <th class="col-lg-8 col-sm-8 col-xs-8">
                Questionnaires
              </th>
              <th class="col-lg-3 col-sm-3 col-xs-3">
              </th>
            </tr>
          </thead>
          <tbody id="questionnaire-container">
            <?php
            echo $this->renderPartial('_questionnaires', array(
             'projectQuestionnaires' => $projectQuestionnaires,
            ));
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- ---------------MODALS ------------------------>
<div id="copy-projects-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <h2>Copy Project
    <button class="pull-right gb-btn gb-btn-red-1 gb-btn-color-white skilllist-modal-close-btn" data-dismiss="modal" aria-hidden="true">close</button>
  </h2>
  <div class="modal-body">
    <div class="row-fluid">
      <div class="row-fluid">
        <select id="copy-project-select" class="input-block-level">
          <?php
          foreach ($projects as $project):
            if ($project->id == $projectModel->id):
              ?>
              <option selected="selected" value="<?php echo $project->id; ?>"><?php echo $project->name; ?></option>
            <?php else: ?> 
              <option value="<?php echo $project->id; ?>"><?php echo $project->name; ?></option>
            <?php
            endif;
          endforeach;
          ?>
        </select>
      </div>
      <a id="copy-questionnaire-btn" class="que-btn que-btn-blue-2">Copy Questionnaire</a>
    </div>
  </div>
</div>

<div id="move-projects-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <h2>Move Project
    <button class="pull-right gb-btn gb-btn-red-1 gb-btn-color-white skilllist-modal-close-btn" data-dismiss="modal" aria-hidden="true">close</button>
  </h2>
  <div class="modal-body">
    <div class="row-fluid">
      <div class="row-fluid">
        <select id="move-project-select" class="input-block-level">
          <?php
          foreach ($projects as $project):
            if ($project->id != $projectModel->id):
              ?>
              <option value="<?php echo $project->id; ?>"><?php echo $project->name; ?></option>
              <?php
            endif;
          endforeach;
          ?>
        </select>
      </div>
      <a id="move-questionnaire-btn" class="que-btn que-btn-blue-2">Move Questionnaire</a>
    </div>
  </div>
</div>
<?php $this->endContent(); ?>

