<?php
$this->beginContent('//layouts/que_main1');
/* @var $this SiteController */
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/que_questionnaire.js', CClientScript::POS_END
);
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/que_home_tour.js', CClientScript::POS_END
);
?>
<script>
  var deleteProjectUrl = "<?php echo Yii::app()->createUrl("project/project/deleteProject"); ?>";
</script>
<div class="container">
  <div id="que-start-tour-btn" class="btn btn-default col-lg-12 col-sm-12 col-xs-12 alert alert-block alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="text-info">Take a Tour - Home Page</h4>
  </div>
  <div class="row">
    <div class="sub-heading-3">
      <span class="pull-left">My Projects </span>
      <span id="que-project-heading-count" class="">
        &nbsp(<?php echo UserProject::getUserProjectCount(); ?>)
      </span>
    </div>
    <div class="que-sidebar col-lg-3 col-sm-12 col-xs-12 que-no-padding">
      <div id="que-create-project-panel" class="panel panel-primary"> 
        <div class="panel-heading">
          <h3 class="sub-heading-2">Create Project</h3>
        </div>
        <div id="que-project-add-container" class="panel-body">
          <div id="" class="new-project-form">
            <?php echo $this->renderPartial('_create_project_form', array('model' => $projectModel)); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-9 col-sm-12 col-xs-12 que-no-padding">
      <br>
      <div id="que-projects-container" class="row">
        <?php foreach ($projects as $userProject): ?>
          <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="que-project-entry panel panel-default" project-id="<?php echo $userProject->project_id; ?>">
              <div class="title panel-heading">
                <h3><?php echo CHtml::link($userProject->project->name, Yii::app()->getModule('project')->viewProjectUrl . $userProject->project->id, array('class' => '')); ?></h3>
              </div>
              <!-- <div class="date que-padding">
                 <span class="span6"><i>Created: 12-12-12</i></span>
                 <span class="span6"><i class="pull-right">Modified: 12-12-12</i></span>
               </div> -->
              <div class="panel-body">
                <div class="description">
                  <p><?php echo $userProject->project->description ?></p>
                </div>
                <div class="questionnaire-summary">
                  <?php if (ProjectQuestionnaire::getProjectQuestionnairesCount($userProject->project->id) == 0): ?>
                    <p class="text-center">No Questionnaire Created</p>
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
              </div>
              <div class="panel-footer">
                <a class="que-delete-project-btn btn"> <i class ="glyphicon glyphicon-trash"></i></a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php $this->endContent(); ?>