<!DOCTYPE html>
<html xml:lang="en" lang="en">
  <head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery1.9.0.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.0.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-responsive.js"></script>

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/que.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/mystyle.css" type="text/css" rel="stylesheet"/>

  </head>
  <body>
    <div class="container-fluid">
      <?php echo $content ?>
    </div>
    <div id="que-cornfirm-modal" class="modal hide in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <span><h3>iUSuR Says, </h3>
      </span>
      <div class="modal-body">
        <h3 id="que-confirm-message" class="text-warning"></h3>
      </div>
      <div class="modal-footer">
        <button id="que-confirm-btn" class="btn" data-dismiss="modal" aria-hidden="true">Yes</button>
        <button id="que-cancel-confirm-btn" class="btn" data-dismiss="modal" aria-hidden="true">No</button>
      </div>
    </div>
  </body>
</html>

