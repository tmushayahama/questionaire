<?php $this->beginContent('//layouts/que_main'); ?>
<div >
	<div class="navbar navbar-top">
		<div class="navbar-inner">
			<div class="container">
				<div class="row span12">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="span1 brand">
						Questionnaire
					</a>
					<div class="span10">
						<ul class="nav rm-nav nav-pills inline">
							<li><a href="#">Explore </a></li>
							<li><a class="" href="#">Features </a></li>
						</ul>
						<?php echo CHtml::link('Register', Yii::app()->getModule('user')->loginUrl, array('class' => 'pull-right span2 btn btn-success')); ?>			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="content">
	<div class="row span12"> 
		<div class="span5 "> 
			
		</div>
		<div class="span4 pull-rightr"> 
			<?php echo $content ?>
		</div>
	</div>
</div>
<?php $this->endContent(); ?>
