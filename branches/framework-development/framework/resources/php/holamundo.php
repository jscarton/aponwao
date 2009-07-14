<html>
	<head>
		<title>
		<?php echo getAppCodeName().":".getAppTitle();?>
		</title>
	</head>
	<body>
	<div align="center" width="100%"><img src="resources/images/a-logo-text.png"/></div>
	<HR/>
	<?php if (!isset ($err)){ ?>
		<div align="center" width="50%" ><h3><?php echo $msg;?></h3></div>
	<?php }else {?>
		<div align="center" width="50%" ><h4><?php echo $err;?></h4></div>
	<?php }?>
	<HR/>
	<div align="center" width="100%" ><a href="http://aponwaophp.org" target="_blank">(c) 2009, PROYECTO APONWAO</a></div>
	</body>
</html>