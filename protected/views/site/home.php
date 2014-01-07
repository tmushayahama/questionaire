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
  <div class="que-topbar-nav">
    <div class=" container">
      <div class="row">
        <h4 class="pull-left">Home</h4>
        <ul id="que-topbar-nav-list" class="que-nav-1 pull-right">
          <li class="active"><a href="#que-projects-pane" data-toggle="tab">Projects</a></li>
          <li class=""><a href="#que-activity-log-pane" data-toggle="tab">Activity Log</a></li>
        </ul>
      </div>
    </div>
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
    <div class="row-fluid">
      <ul class="nav nav-stacked nav-tabs que-white-background span4">
        <li><a>All</a></li>
        <li><a>Projects Activities</a></li>
        <li><a>Questionnaire Activities</a></li>
      </ul>
    </div>
  </div>
</div>
<?php $this->endContent(); ?>