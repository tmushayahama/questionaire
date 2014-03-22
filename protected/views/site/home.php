<?php
$this->beginContent('//home_layouts/navbar');
/* @var $this SiteController */
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/que_questionnaire.js', CClientScript::POS_END
);
?>
<script>
  var deleteProjectUrl = "<?php echo Yii::app()->createUrl("project/project/deleteProject"); ?>";
</script>
<div class="container-fluid">
  <ul class="row breadcrumb que-breadcrumb">
    <li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-link')); ?><span class="divider"></span></li>
  </ul>
</div>
<div class="container">
  <div class="row-fluid" id="que-projects-pane">
    <div class="sub-heading-3">
      <div class="pull-left">My Projects </div>
      <div class="">
        &nbsp(<?php echo UserProject::getUserProjectCount(); ?>)
      </div>
    </div>
    <div class="que-sidebar row-fluid">
      <h3 class="sub-heading-2">Create Project</h3>
      <div id="que-project-add-container">
        <div id="" class="new-project-form">
          <?php echo $this->renderPartial('_create_project_form', array('model' => $projectModel)); ?>
        </div>
      </div>
    </div>
    <div class="que-middle-container row-fluid">

      <?php foreach ($projects as $userProject): ?>

        <div class="que-project-entry" project-id="<?php echo $userProject->project_id; ?>">
          <div class="title que-padding">
            <?php echo CHtml::link($userProject->project->name, Yii::app()->getModule('project')->viewProjectUrl . $userProject->project->id, array('class' => 'active')); ?>
          </div>
          <!-- <div class="date que-padding">
             <span class="span6"><i>Created: 12-12-12</i></span>
             <span class="span6"><i class="pull-right">Modified: 12-12-12</i></span>
           </div> -->
          <div class="content que-padding">
            <p><?php echo $userProject->project->description ?></p>
          </div>
          <div class="questionnaire-summary que-padding">
            <?php if (ProjectQuestionnaire::getProjectQuestionnairesCount($userProject->project->id) == 0): ?>
              <h4 class="text-center">No Questionnaire Created</h4>
            <?php else: ?>
              <h6 class="text-left">Questionnaire(s)</h6>
              <table class="table table-hover table-condensed">
                <tbody>
                  <?php foreach (ProjectQuestionnaire::getProjectQuestionnaires($userProject->project->id) as $questionnaire): ?>
                    <tr>
                      <td>
                        <a href="<?php echo Yii::app()->createUrl('project/questionnaire/view', array('projectId' => $userProject->project_id, 'questionnaireId' => $questionnaire->userQuestionnaire->id)); ?>">
                          <?php echo $questionnaire->userQuestionnaire->name; ?>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  <tr>
                    <td>
                      <?php if (ProjectQuestionnaire::getProjectQuestionnairesCount($userProject->project->id) > 3): ?>
                        <a class="pull-left que-btn">More</a>
                      <?php endif; ?>
                    </td>
                  </tr>
                </tbody>
              </table>

            <?php endif; ?>
          </div>
          <div class="que-footer">
            <a class="que-delete-project-btn pull-right btn btn-danger"> <i class ="icon-white icon-trash"></i></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php $this->endContent(); ?>