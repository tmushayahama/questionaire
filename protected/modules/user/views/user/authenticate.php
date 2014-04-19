<?php $this->beginContent('//layouts/que_main2'); ?>
<div class="navbar que-navbar navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">iUSuR</a>
    </div>
    <div class="navbar-collapse collapse">
      <?php
      echo CHtml::beginForm('', 'post', array(
       'class' => 'navbar-form navbar-right'));
      ?>
      <div class="form-group">
        <?php echo CHtml::activeTextField($loginModel, 'username', array("class" => "form-control", "placeholder" => "Username")); ?>
      </div>
      <div class="form-group">
        <?php echo CHtml::activePasswordField($loginModel, 'password', array("class" => "form-control", "placeholder" => "Password")); ?>
      </div>
      <?php echo CHtml::submitButton(UserModule::t("Login"), array('class' => 'btn btn-primary')); ?>
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
    </div><!--/.navbar-collapse -->
  </div>
</div> <!--navbar-->
<div class="" id="main-container">
  <div class="container">
    <div class="row">
      <div class="introduction col-lg-8 col-sm-8 col-xs-12">
        <h1>Introduction</h1>
        <hr>
        <div class="introbody">
          <p>Usability testing is an indispensable step for biomedical researchers to evaluate a medical product by testing it on users like physicians or patients. Surveys or questionnaires are widely used to collect users’ feedback. Unfortunately, researchers often find themselves struggling with creating questions and interpreting survey results since there are few consistent standards established. This website is a tool for research scientists to create usability questionnaires by choosing professional usability questions from our Question Bank. They can customize the questions according to their preferences. Later on, our research group will also analyze their information and preferences to build up a systematic and consistent questionnaire system for research scientists conducting usability testing.</p>

        </div>
      </div>

      <div class="col-lg-4 col-sm-4 col-xs-12 que-no-padding"> 
        <div class="row">
          <div class="panel panel-default que-no-padding">
            <div class="panel-heading">
              <a class="">
                <h2>Sign Up<i class="pull-right"></i></h2>
              </a>
            </div>
            <div class="panel-body">
              <?php
              $form = $this->beginWidget('UActiveForm', array(
               'id' => 'registration-form',
               'enableAjaxValidation' => false,
               'clientOptions' => array(
                'validateOnSubmit' => true,
               ),
               'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'class' => 'form',
               ),
              ));
              ?>
              <div class="form-group row">
                <?php echo $form->textField($registerModel, 'email', array("class" => "form-control col-lg-12 col-sm-12 col-xs-12", "placeholder" => "Your Email")); ?>
                <?php echo $form->error($registerModel, 'email'); ?>

              </div>
              <div class="form-group row">
                <?php echo $form->passwordField($registerModel, 'password', array("class" => "form-control col-lg-12 col-sm-12 col-xs-12", "placeholder" => "Password")); ?>
                <?php echo $form->error($registerModel, 'password'); ?>
              </div>

              <div class="form-group row">
                <?php echo $form->passwordField($registerModel, 'verifyPassword', array("class" => "form-control col-lg-12 col-sm-12 col-xs-12", "placeholder" => "Verify Password")); ?>
                <?php echo $form->error($registerModel, 'verifyPassword'); ?>
              </div>


              <div class="form-group row">
                <?php echo $form->textField($registerModel, 'firstname', array("class" => "form-control col-lg-12 col-sm-12 col-xs-12", "placeholder" => "First Name")); ?>
                <?php echo $form->error($registerModel, 'firstname'); ?>
              </div>
              <div class="form-group row">
                <?php echo $form->textField($registerModel, 'lastname', array("class" => "form-control col-lg-12 col-sm-12 col-xs-12", "placeholder" => "Last Name")); ?>
                <?php echo $form->error($registerModel, 'lastname'); ?>
              </div>
              <div class="form-group row">
                <?php echo $form->textField($registerModel, 'organization', array("class" => "form-control col-lg-12 col-sm-12 col-xs-12", "placeholder" => "Organization")); ?>
                <?php echo $form->error($registerModel, 'organization'); ?>
              </div>
              <div class="form-actions">
                <?php echo CHtml::submitButton(UserModule::t("Register"), array('class' => 'btn btn-success col-lg-12 col-sm-12 col-xs-12')); ?>
              </div>
              <?php $this->endWidget(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->endContent(); ?>
