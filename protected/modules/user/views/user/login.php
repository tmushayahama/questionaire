<?php $this->beginContent('//login_layouts/login_nav'); ?>
<?php if (Yii::app()->user->hasFlash('loginMessage')): ?>

	<div class="success">
		<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
	</div>

<?php endif; ?>



<?php
echo CHtml::beginForm('', 'post', array(
		'class' => 'form-horizontal que-form-container'));
?>

<fieldset class="que-margin">
	<legend><?php echo UserModule::t("Registration"); ?></legend>
	<?php echo CHtml::errorSummary(array($model), NULL, NULL, array('class' => 'alert alert-error')); ?>
	<div class="control-group">
		<div class="control-label">
			<?php echo CHtml::activelabelEx($model, 'username'); ?>
		</div>
		<div class="controls">
			<?php echo CHtml::activeTextField($model, 'username'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo CHtml::activeLabelEx($model, 'password'); ?>
		</div>
		<div class="controls">
			<?php echo CHtml::activePasswordField($model, 'password') ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<p>Stay Signed In
				<?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
			</p>
		</div>
		<div class="controls">
			<?php echo CHtml::submitButton(UserModule::t("Login"), array('class' => 'btn btn-primary right')); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo CHtml::link(UserModule::t("Register"), Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
	</div>
</fieldset>
<?php echo CHtml::endForm(); ?>



<?php
$form = new CForm(array(
		'elements' => array(
				'username' => array(
						'type' => 'text',
						'maxlength' => 32,
				),
				'password' => array(
						'type' => 'password',
						'maxlength' => 32,
				),
				'rememberMe' => array(
						'type' => 'checkbox',
				)
		),
		'buttons' => array(
				'login' => array(
						'type' => 'submit',
						'label' => 'Login',
				),
		),
				), $model);
?>
<?php $this->endContent(); ?>