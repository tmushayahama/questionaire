<?php $this->beginContent('//layouts/que_main'); ?>
<div class="navbar navbar-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">

                <?php
                echo CHtml::beginForm('', 'post', array(
                    'class' => 'pull-right span6'));
                ?>

                <table id="login-form-table">
                    <?php echo CHtml::errorSummary(array($loginModel), NULL, NULL, array('class' => 'alert alert-error')); ?>
                    <tbody>
                        <tr class="">
                            <td class="">
                                <?php echo CHtml::activelabelEx($loginModel, 'username'); ?>
                            </td>
                            <td class="">
                                <?php echo CHtml::activeLabelEx($loginModel, 'password'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="">
                                <?php echo CHtml::activeTextField($loginModel, 'username'); ?>
                            </td>
                            <td class="">
                                <?php echo CHtml::activePasswordField($loginModel, 'password') ?>
                            </td>
                            <td class="">
                                <?php echo CHtml::submitButton(UserModule::t("Login"), array('class' => 'que-btn que-btn-login que-btn-blue-2')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a>
                                    <?php echo CHtml::activeCheckBox($loginModel, 'rememberMe'); ?>
                                    Stay Signed In
                                </a>
                            </td>
                            <td class="">
                                <?php echo CHtml::link(UserModule::t("Register"), Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

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
                        ), $loginModel);
                ?>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div> <!--navbar-->
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span8 "> 

        </div>
        <div class="span4"> 
            <div class="accordion" id="register-accordion">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#register-accordion" href="#collapse-register-accordion">
                            <h2>Sign Up<i class="pull-right icon-white icon-chevron-down"></i></h2>
                        </a>
                    </div>
                    <div id="collapse-register-accordion" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <div class="row-fluid">
                                <div class="span12 ">
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

                                    <fieldset class="que-blue-border-1">
                                        <?php echo $form->errorSummary(array($registerModel), NULL, NULL, array('class' => 'alert alert-error')); ?>
                                        <div class="control-group">
                                            <div class="control-label">
                                                <?php echo $form->labelEx($registerModel, 'email'); ?>
                                            </div>
                                            <div class="controls">
                                                <?php echo $form->textField($registerModel, 'email'); ?>
                                                <?php echo $form->error($registerModel, 'email'); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="control-label">
                                                <?php echo $form->labelEx($registerModel, 'password'); ?>
                                            </div>
                                            <div class="controls">
                                                <?php echo $form->passwordField($registerModel, 'password'); ?>
                                                <?php echo $form->error($registerModel, 'password'); ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="control-label">
                                                <?php echo $form->labelEx($registerModel, 'verifyPassword'); ?>
                                            </div>
                                            <div class="controls">
                                                <?php echo $form->passwordField($registerModel, 'verifyPassword'); ?>
                                                <?php echo $form->error($registerModel, 'verifyPassword'); ?>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <div class="control-label">
                                                <?php echo $form->labelEx($registerModel, 'firstname'); ?>
                                            </div>
                                            <div class="controls">
                                                <?php echo $form->textField($registerModel, 'firstname'); ?>
                                                <?php echo $form->error($registerModel, 'firstname'); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="control-label">
                                                <?php echo $form->labelEx($registerModel, 'lastname'); ?>
                                            </div>
                                            <div class="controls">
                                                <?php echo $form->textField($registerModel, 'lastname'); ?>
                                                <?php echo $form->error($registerModel, 'lastname'); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="control-label">
                                                <?php echo $form->labelEx($registerModel, 'organization'); ?>
                                            </div>
                                            <div class="controls">
                                                <?php echo $form->textField($registerModel, 'organization'); ?>
                                                <?php echo $form->error($registerModel, 'organization'); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <?php echo CHtml::submitButton(UserModule::t("Register"), array('class' => 'btn btn-primary pull-right')); ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <?php $this->endWidget(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<?php $this->endContent(); ?>
