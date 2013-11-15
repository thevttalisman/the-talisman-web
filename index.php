<?php $_GET['page'] = "home"; ?>
<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>	<html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>	<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>	<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="noie"> <!--<![endif]-->
<head>
	<title>The Talisman</title>
	<meta name="viewport" content="width=1200" />
	<link type="text/css" rel="stylesheet" href="fonts/fonts.css"></link>
	<link type="text/css" rel="stylesheet" href="css/general.css"></link>
	<style></style>
</head>
<body>
	<div id="header">
		<div id="logo"></div>
<?php include "navigation.php"; ?>
	</div>
	
	<div id="zoom-viewport">
		<div id="arrow-left" onclick="$('#flipbook').turn('previous');"></div>
		<div id="arrow-right" onclick="$('#flipbook').turn('next');"></div>
		<div id="flipbook">
		</div>
	</div>
	
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
	.script("js/turn.min.js")
	.script("js/zoom.min.js").wait()
	.script("js/flipbook_init.js");
	</script>
</body>
</html>
