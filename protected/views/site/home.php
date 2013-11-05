<?php
$this->beginContent('//layouts/que_main');
/* @var $this SiteController */
Yii::app()->clientScript->registerScriptFile(
  Yii::app()->baseUrl . '/js/home.js', CClientScript::POS_END
);
?>
<div class="navbar navbar-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo CHtml::link('Questionnaire', Yii::app()->getModule('user')->returnUrl, array('class' => 'brand ')); ?>
      <div class="nav-collapse collapse">
        <ul class="pull-right nav">
          <?php echo CHtml::link('Logout', Yii::app()->getModule('user')->logoutUrl, array('class' => 'pull-right span1 btn btn-danger')); ?>	
          <li id="navemail"><?php echo Yii::app()->user->email; ?></li>	
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div> <!--navbar-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="sidebar-nav que-home-sidebar">
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/que_avatar.jpg" alt=""><br>
      <div class="span7">
        <h4><?php echo CHtml::link($firstname . "\n" . $lastname, '', array('class' => '')); ?></h4>
      </div>
      <div class="span4">
        <button class="pull-right que-btn que-btn-green-1">Edit</button>
      </div>
      <br>
      <br>
      <ul class="nav nav-list nav-stacked">
        <li class="nav-header">My Statistics</li>
        <li><a href="#"><?php echo $this->projectCount ?> Projects</a></li>
        <li><a href="#">0 Questionnaires</a></li>
        <li><a href="#">0 Questions</a></li>
        <li class="nav-header">How To</li>
        <li><a href="#">Create a Project</a></li>
        <li><a href="#">Create a Questionnaire</a></li>
        <li><a href="#">Select Questions</a></li>
      </ul>
    </div><!--/span-->
    <div class="span8">
      <div class="row-fluid que-topbar">
        <div class="span6">
          <h2>My Projects (<?php echo $this->projectCount ?>)</h2>
        </div>
        <!--<button class="pull-right que-btn que-btn-blue-2">Manage Projects</button>-->

      </div>
      <div class="row-fluid">
        <ul class="nav ">
          <div id="que-project-add-container">
            <div id="que-project-add-btn">
              <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/plus.png" alt=""><br>
              <h2>New Project</h2>
            </div>
            <div id="" class="hide new-project-form">
              <h3>Create Project</h3>
              <?php echo $this->renderPartial('_form', array('model' => $projectModel)); ?>
            </div>
          </div>
          <?php foreach ($projects as $userProject): ?>
            <li class="que-project-entry">
              <div class="title">
                <h3><?php echo CHtml::link($userProject->project->name, Yii::app()->getModule('project')->viewProjectUrl . $userProject->id, array('class' => 'active')); ?>
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
                <?php if (Questionnaire::getQuestionnairesCount($userProject->project->id) == 0): ?>
                  <h4 class="text-center text-warning">No Questionnaire Created</h4>
                <?php else: ?>
                  <h6 class="text-left">Questionnaire(s)</h6>
                  <table class="table table-hover table-condensed">
                    <tbody>
                      <?php foreach (Questionnaire::getQuestionnaires($userProject->project->id) as $questionnaire): ?>
                        <tr>
                          <td>
                            <a><?php echo $questionnaire->name; ?></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <tr>
                        <td>
                          <?php if (Questionnaire::getQuestionnairesCount($userProject->project->id) > 3): ?>
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
      <div id="onew-project-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel">Create Project</h3>
        </div>
        <?php echo $this->renderPartial('_form', array('model' => $projectModel)); ?>
      </div>
    </div>
  </div>
</div>
<?php $this->endContent(); ?>