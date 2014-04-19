<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
    <title>IUsUR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap3/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/que.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-tour.css" type="text/css" rel="stylesheet"/>
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>
  <body>
    <?php echo $content; ?>
        <!-- /container -->


    <!-- JavaScript -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery1.9.0.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.0.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap3/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-tour.js"></script>
    <script type='text/javascript'>
      $(document).ready(function() {
        /* off-canvas sidebar toggle */
        $('[data-toggle=offcanvas]').click(function() {
          $(this).toggleClass('visible-xs text-center');
          $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
          $('.row-offcanvas').toggleClass('active');
          $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
          $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
          $('#btnShow').toggle();
        });
      });
    </script>
  </body>
</html>


