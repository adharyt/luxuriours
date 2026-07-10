<?php $ci =& get_instance();?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?php echo $ci->ConfigModel->getAppInfo('TITLE');?> | 501</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Muli:400" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Passion+One" rel="stylesheet">

	<!-- Font Awesome Icon -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/web_template/error/500/css/font-awesome.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/web_template/error/500/css/style.css" />
  <link rel="icon" href="<?php echo $ci->ConfigModel->getAppInfo('FAVICON');?>" type="image/x-icon">
</head>

<body>

	<div id="notfound">
		<div class="notfound-bg"></div>
		<div class="notfound">
			<div class="notfound-404">
				<h1>500</h1>
			</div>
			<h2>Oops! There's an error!</h2>
			<p style="font-family:'Muli', sans-serif;font-weight:400">Don't worry, we're going to fix this. Try again in a few minutes!</p>
			<a href="<?php echo base_url();?>">Back To Homepage</a>
		</div>
	</div>

</body>

</html>
