
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
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="js/hash.min.js"></script>
	<script type="text/javascript" src="js/hashchange.min.js"></script>
	<script type="text/javascript" src="js/turn.min.js"></script>
	<script type="text/javascript" src="js/zoom.min.js"></script>
	<style></style>
</head>
<body>
	<div id="header">
		<div id="logo"></div>
		<ul id="nav">
			<li><a href="/index.html" class="selected">Home</a></li>
			<li>
				<a href="#" onclick="return false;">Newspapers</a>
				<ul>
					<!--li><a href="#" onclick="switchEdition('201304');return false;">April 2013</a></li-->
					<li><a href="#" onclick="switchEdition('201309');return false;">September 2013</a></li>
					<li><a href="#" onclick="switchEdition('201310');return false;">October 2013</a></li>
				</ul>
			</li>
			<li><a href="/submit.html">Submit</a></li>
			<li><a href="/team.html">The Team</a></li>
		</ul>
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
	
	<script type="text/javascript" src="js/flipbook_init.js"></script>
</body>
</html>
