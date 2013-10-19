<?php $this->beginContent('//login_layouts/registration_nav'); ?>
<?php $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
?>
<?php if (Yii::app()->user->hasFlash('registration')): ?>
  <div class="success">
    <?php echo Yii::app()->user->getFlash('registration'); ?>
  </div>
<?php else: ?>


  <?php
  $form = $this->beginWidget('UActiveForm', array(
      'id' => 'registration-form',
      'enableAjaxValidation' => false,
      'clientOptions' => array(
          'validateOnSubmit' => true,
      ),
      'htmlOptions' => array(
          'enctype' => 'multipart/form-data',
          'class' => 'form-horizontal',
      ),
  ));
  ?>

  <fieldset class="que-margin">
    <legend><?php echo UserModule::t("Registration"); ?></legend>
    <?php echo $form->errorSummary(array($model), NULL, NULL, array('class' => 'alert alert-error')); ?>
    <div class="control-group">
      <div class="control-label">
        <?php echo $form->labelEx($model, 'email'); ?>
      </div>
      <div class="controls">
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <?php echo $form->labelEx($model, 'password'); ?>
      </div>
      <div class="controls">
        <?php echo $form->passwordField($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>
      </div>
    </div>

    <div class="control-group">
      <div class="control-label">
        <?php echo $form->labelEx($model, 'verifyPassword'); ?>
      </div>
      <div class="controls">
        <?php echo $form->passwordField($model, 'verifyPassword'); ?>
        <?php echo $form->error($model, 'verifyPassword'); ?>
      </div>
    </div>


    <div class="control-group">
      <div class="control-label">
        <?php echo $form->labelEx($model, 'firstname'); ?>
      </div>
      <div class="controls">
        <?php echo $form->textField($model, 'firstname'); ?>
        <?php echo $form->error($model, 'firstname'); ?>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <?php echo $form->labelEx($model, 'lastname'); ?>
      </div>
      <div class="controls">
        <?php echo $form->textField($model, 'lastname'); ?>
        <?php echo $form->error($model, 'lastname'); ?>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <?php echo $form->labelEx($model, 'organization'); ?>
      </div>
      <div class="controls">
        <?php echo $form->textField($model, 'organization'); ?>
        <?php echo $form->error($model, 'organization'); ?>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <?php echo CHtml::submitButton(UserModule::t("Register"), array('class' => 'btn btn-primary pull-right')); ?>
      </div>
    </div>
  </fieldset>

  <?php $this->endWidget(); ?>
<?php endif; ?>
<?php $this->endContent(); ?>