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
				<ul class="pull-right nav">
					<?php echo CHtml::link('Logout', Yii::app()->getModule('user')->logoutUrl, array('class' => 'pull-right btn btn-link span1')); ?>	
					<li id="navemail"><?php echo Yii::app()->user->email; ?></li>	
				</ul>
			</div><!--/.nav-collapse -->
		</div>
        </div>
</div> <!--navbar-->
<?php echo $content ?>
<?php $this->endContent(); ?>
