<?php $_GET['page'] = "photos"; ?>
<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>	<html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>	<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>	<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="noie"> <!--<![endif]-->
<head>
	<title>The Crew - The Talisman</title>
	<meta name="viewport" content="width=1200" />
	<link type="text/css" rel="stylesheet" href="fonts/fonts.css"></link>
	<link type="text/css" rel="stylesheet" href="css/general.css"></link>
	<style>
		.album-cover {
			width: 204px;
			min-height: 204px;
			padding: 15px;
			border: 1px solid #ccc;
			background-color: #ddd;
			background-size: auto;
			background-repeat: no-repeat;
			background-position: center 37px;
			text-align: center;
		}
		
		.album-cover p {
			padding-top: 204px;
			padding-bottom: 7px;
			margin: 0;
		}
		
		.galleria {
			width: 700px;
			height: 497px !important;
			margin-top: 10px;
		}
		
		.back {
			color: #000;
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<div id="header">
		<div id="logo"></div>
<?php include "navigation.php"; ?>
	</div>

	<div id="content-wrapper"></div>

	<div id="footer-wrapper">
		<a href="/index.html">Home</a>
		<a href="/submit.html">Submit</a>
		<a href="/team.html">The Team</a>
		<div class="licence"></div>
	</div>
	<script type="text/javascript" src="js/LAB.min.js"></script>
	<script>
	$LAB
	.script("js/jquery-1.8.3.min.js").wait()
	.script("js/hash.min.js")
	.script("js/hashchange.min.js")
	.script("js/masonry.min.js")
	.script("js/galleria/galleria-1.3.2.min.js").wait()
	.script("js/gallery_init.js");
	</script>
</body>
</html>
