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
			<div class="footer">
				<div id="banner">
					<div id="info" class="span-12">
						<b>The Ohio State University College of Medicine</b><br />
						3190 Graves Hall, 333W. 10th Avenue<br />
						Columbus, OH 43210 <br />
						<b> 614-292-4778 </b> <br />
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

