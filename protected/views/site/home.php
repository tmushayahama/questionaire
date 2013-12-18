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
  <div class="row que-topbar-nav ">
    <ul id="que-topbar-nav-list">
      <li class="que-active">
        <a href="#que-projects-pane" data-toggle="tab">
          <h4>My Projects</h4>
          <h5><small>(<?php echo $this->projectCount ?> active)</small></h5>
        </a>
      </li>
      <li>
        <a href="#que-activity-log-pane" data-toggle="tab">
          <h4>Activity Log</h4>
          <h5><small>0 activities</small></h5>
        </a>
      </li>
      <li>
        <a href="#que-announcements-pane" data-toggle="tab">
          <h4>Announcements</h4>
          <h5><small>0 new</small></h5>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="container tab-content">
  <div class="tab-pane active" id="que-projects-pane">
    <div class="row">
      <div id="que-projects-sidebar" class="span3">
        <div id="que-project-add-container">
          <div id="que-project-add-btn">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/plus.png" alt=""><br>
            <h2>New Project</h2>
          </div>
          <div id="" class="hide new-project-form">
            <h3>Create Project</h3>
            <?php echo $this->renderPartial('_create_project_form', array('model' => $projectModel)); ?>
          </div>
        </div>
      </div>
      <div class="span8">

        <div class="row-fluid">
          <ul class="nav ">
            <?php foreach ($projects as $userProject): ?>

              <li class="que-project-entry">
                <div class="title">
                  <h3><?php echo CHtml::link($userProject->project->name, Yii::app()->getModule('project')->viewProjectUrl . $userProject->project->id, array('class' => 'active')); ?>
                  </h3>
                </div>
                <div class="date">
                  <span class="span6"><i>Created: 12-12-12</i></span>
                  <span class="span6"><i class="pull-right">Modified: 12-12-12</i></span>
                </div>
                <div class="content">
                  <p><?php echo $userProject->project->description ?></p>
                </div>
                <div class="questionnaire-summary">
                  <?php if (ProjectQuestionnaire::getProjectQuestionnairesCount($userProject->project->id) == 0): ?>
                    <h4 class="text-center text-warning">No Questionnaire Created</h4>
                  <?php else: ?>
                    <h6 class="text-left">Questionnaire(s)</h6>
                    <table class="table table-hover table-condensed">
                      <tbody>
                        <?php foreach (ProjectQuestionnaire::getProjectQuestionnaires($userProject->project->id) as $questionnaire): ?>
                          <tr>
                            <td>
                              <a><?php echo $questionnaire->userQuestionnaire->name; ?></a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                        <tr>
                          <td>
                            <?php if (ProjectQuestionnaire::getProjectQuestionnairesCount($userProject->project->id) > 3): ?>
                              <button class="que-btn que-btn-blue-1">Preview All</button>
                            <?php endif; ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                  <?php endif; ?>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane" id="que-activity-log-pane">
    <ul class="nav nav-stacked nav-tabs">
      <li><a>All</a></li>
      <li><a>Projects Activities</a></li>
      <li><a>Questionnaire Activities</a></li>
    </ul>
  </div>
  <div class="tab-pane" id="que-announcements-pane">
    Announcements
  </div>
</div>
<?php $this->endContent(); ?>