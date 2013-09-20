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
				<p class="navbar-text pull-right">
					<?php echo CHtml::link('Log In', Yii::app()->getModule('user')->loginUrl, array('class' => 'btn ')); ?>
				</p>
				<ul class="nav">
					<li><a href="#about">About</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div> <!--navbar-->
<div class="content">
	<div class="row span12"> 
		<div class="span8 "> 

		</div>
		<div class="span4 pull-right "> 
			<div class="row que-form-container">
				<?php echo $content ?>
			</div>
		</div>
	</div>
</div> 
<?php $this->endContent(); ?>