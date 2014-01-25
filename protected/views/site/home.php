<?php
$this->beginContent('//home_layouts/navbar');
/* @var $this SiteController */
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/home.js', CClientScript::POS_END
);
?>
<div class="container-fluid">
  <ul class="row breadcrumb que-breadcrumb">
    <li><?php echo CHtml::link('Home', Yii::app()->user->returnUrl, array('class' => 'btn btn-link')); ?><span class="divider"></span></li>
  </ul>
  <div class="que-topbar-nav container">
    <div class="row">
      <h4 class="pull-left">Home</h4>
      <ul id="que-topbar-nav-list" class="que-nav-1 pull-right">
        <li class="active"><a href="#que-projects-pane" data-toggle="tab">Projects</a></li>
        <li class=""><a href="#que-activity-log-pane" data-toggle="tab">Activity Log</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="container tab-content">
  <div class="tab-pane active row-fluid" id="que-projects-pane">
    <div class="que-sidebar row-fluid">
      <h3 class="sub-heading-1">Create Project</h3>
      <div id="que-project-add-container">
        <!-- <div id="que-project-add-btn" class="hide">
          <img src="<?php //echo Yii::app()->request->baseUrl;    ?>/img/plus.png" alt=""><br>
          <h2>New Project</h2>
        </div> -->
        <div id="" class="new-project-form">
          <?php echo $this->renderPartial('_create_project_form', array('model' => $projectModel)); ?>
        </div>
      </div>
    </div>
    <div class="que-middle-container row-fluid">
      <div class="tab-heading">
        <div class="pull-left">My Projects</div>
        <div class="pull-right">
          <?php echo UserProject::getUserProjectCount(); ?>
        </div>
      </div>
      <?php foreach ($projects as $userProject): ?>

        <div class="que-project-entry">
          <div class="title">
            <h4><?php echo CHtml::link($userProject->project->name, Yii::app()->getModule('project')->viewProjectUrl . $userProject->project->id, array('class' => 'active')); ?>
            </h4>
          </div>
          <div class="date que-padding">
            <span class="span6"><i>Created: 12-12-12</i></span>
            <span class="span6"><i class="pull-right">Modified: 12-12-12</i></span>
          </div>
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
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="tab-pane" id="que-activity-log-pane">
    <div class="que-sidebar row-fluid">
      <h3 class="sub-heading-1">Activity Log</h3>
      <ul id="que-questionnaire-activity-nav" class="que-sidebar-nav-1">
        <li class="active"><a href="#que-activity-log-all-pane" data-toggle="tab">All<i class="icon-chevron-right pull-right"></i></a></li>
        <li class=""><a href="#que-activity-log-projects-pane" data-toggle="tab">Projects<i class="icon-chevron-right pull-right"></i></a></li>
        <li class=""><a href="#que-activity-log-questionnaires-pane" data-toggle="tab">Questionnaires<i class="icon-chevron-right pull-right"></i></a></li>
      </ul>
    </div><!--/span-->
    <div class="que-middle-container row-fluid">
    </div>
  </div>
</div>
<?php $this->endContent(); ?>