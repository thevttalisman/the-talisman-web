
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
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/masonry.min.js"></script>
	<style>
		.member {
			width: 395px;
			height: auto;
			margin: 24px;
			padding: 15px;
			border: 1px solid #ddd;
			background-color: #ddd;
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
		}
		
		.member .pic {
			width: 124px;
			height: 124px;
			background-color: #fff;
			background-size: 124px;
			background-image: url(pics/faces/missing.png);
			margin: 0px 15px 15px 0px;
			float:left;
		}
		
		.member .name {
			width: 256px;
			height: 50px;
			margin-bottom: 10px;
			float: left;
			font-family: IntriqueScript;
			font-size: 42pt;
		}
		
		.member .title {
			width: 256px;
			float: left;
			font-size: 14pt;
		}
		
		.member .bio {
			width: 395px;
		}
	</style>
</head>
<body>
	<div id="header">
		<div id="logo"></div>
		<ul id="nav">
			<li><a href="/index.html">Home</a></li>
			<li>
				<a href="#" onclick="return false;">Newspapers</a>
				<ul>
					<!--li><a href="/index.html#e=201304">April 2013</a></li-->
					<li><a href="/index.html#e=201309">September 2013</a></li>
					<li><a href="/index.html#e=201310">October 2013</a></li>
				</ul>
			</li>
			<li><a href="/submit.html">Submit</a></li>
			<li><a href="/team.html" class="selected">The Team</a></li>
		</ul>
	</div>
	
	<div id="content-wrapper" class="js-masonry" data-masonry-options='{ "columnWidth": 475, "itemSelector": ".member" }'>
		<div class="member">
			<div class="pic" style="background-image: url(pics/faces/jessica.jpg);"></div>
			<div class="name">Jessica Sung</div>
			<div class="title">&raquo; Club President</div>
			<div class="title">&raquo; Editor in Chief</div>
			<div class="title">&raquo; School Events Section Head</div>
			<div class="clear"></div>
			<!--div class="bio">Hi, this is Jessica.  She likes puns.  But gummy worms are cool.  Teemo.</div-->
		</div>
		<div class="member">
			<div class="pic" style="background-image: url(pics/faces/steve.jpg);"></div>
			<div class="name">Steve Lam</div>
			<div class="title">&raquo; Tech Producer</div>
			<div class="title">&raquo; Web Developer / Web Master</div>
			<div class="title">&raquo; Technology Section Head</div>
			<div class="clear"></div>
		</div>
		<div class="member">
			<div class="pic"></div>
			<div class="name">Cindy Cao</div>
			<div class="title">&raquo; Club Vice President</div>
			<div class="title">&raquo; Lifestyles Section Head</div>
			<div class="clear"></div>
		</div>
		<div class="member">
			<div class="pic"></div>
			<div class="name">Mychelle Wong</div>
			<div class="title">&raquo; Club Secretary</div>
			<div class="title">&raquo; Entertainment Section Head</div>
			<div class="clear"></div>
		</div>
		<div class="member">
			<div class="pic" style="background-image: url(pics/faces/amanda.jpg);"></div>
			<div class="name" style="font-size: 35pt">Amanda Coccimiglio</div>
			<div class="title">&raquo; Music Section Head</div>
			<div class="clear"></div>
		</div>
		<div class="member">
			<div class="pic"></div>
			<div class="name">Dora Xiong</div>
			<div class="title">&raquo; Reviews Section Head</div>
			<div class="clear"></div>
		</div>
		<div class="member">
			<div class="pic"></div>
			<div class="name">Jenny Huang</div>
			<div class="title">&raquo; Club Treasurer</div>
			<div class="clear"></div>
		</div>
		<div class="member">
			<div class="pic"></div>
			<div class="name">June Lu</div>
			<div class="title">&raquo; Photographer</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="footer-wrapper">
		<a href="/index.html">Home</a>
		<a href="/submit.html">Submit</a>
		<a href="/team.html">The Team</a>
		<div class="licence"></div>
	</div>
	
</body>
</html>
