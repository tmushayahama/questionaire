<?php $this->beginContent('//layouts/que_main'); ?>
<div class="navbar navbar-top ">
  <div class="navbar-inner">
    <div class="container-fluid">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo CHtml::link('Questionnaire', Yii::app()->getModule('user')->returnUrl, array('class' => 'brand ')); ?>

      <div class="nav-collapse collapse">
        <?php echo CHtml::link('Logout', Yii::app()->getModule('user')->logoutUrl, array('class' => 'pull-right que-btn que-btn-logout')); ?>
        <div id="navbar-user-info" class="pull-right">
          <img class="pull-right" src="<?php echo Yii::app()->request->baseUrl; ?>/img/que_avatar.jpg" alt="">
          <div class="pull-right">
            <h5>
              <a>
                <?php echo User::getFirstname(); ?><br>
                  <?php echo User::getLastname(); ?>
              </a>
            </h5>
            <h6><a>Edit Profile</a></h6>
          </div>
        </div>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div> <!--navbar-->
<div id="ajax-loader" class="hide">
  <div class="progress progress-striped active">
    <div class="bar" style="width: 100%;"></div>
  </div>
</div>
<?php echo $content ?>
<?php $this->endContent(); ?>
