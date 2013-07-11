<?php $this->beginContent('//layouts/que_main'); ?>
<div class="navbar navbar-inverse navbar-top">
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
					<li><?php echo CHtml::link(Yii::app()->user->email, Yii::app()->getModule('user')->logoutUrl, array('class' => 'pull-right ')); ?></li>	
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div> <!--navbar-->
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span3">
			<div class="well sidebar-nav que-sidebar">
				<ul class="nav nav-list">
					<li><h3><?php echo CHtml::link(Yii::app()->user->firstname . ' ' . Yii::app()->user->lastname, '', array('class' => '')); ?></h3></li>
					<li class="nav-header">My Statistics</li>
					<li><a href="#"><?php echo $this->projectCount ?> Projects</a></li>
					<li><a href="#">0 Questionnaires</a></li>
					<li><a href="#">0 Questions</a></li>
					<li class="nav-header">How To</li>
					<li><a href="#">Create a Project</a></li>
					<li><a href="#">Create a Questionnaire</a></li>
					<li><a href="#">Select Questions</a></li>
				</ul>
			</div><!--/.well -->
		</div><!--/span-->
		<div class="span6">
			<?php echo $content ?>
		</div>
	</div>
</div>
<?php $this->endContent(); ?>
