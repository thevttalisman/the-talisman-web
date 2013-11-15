<?php
$selected = " class=\"selected\"";
?>
		<ul id="nav">
			<li><a href="/index.html"<?php echo ($_GET['page'] == "home" ? $selected : ""); ?>>Home</a></li>
			<li>
				<a href="#" onclick="return false;">Newspapers</a>
				<ul>
					<!--li><a href="/index.html#e=201304">April 2013</a></li-->
					<li><a href="/index.html#e=201309">September 2013</a></li>
					<li><a href="/index.html#e=201310">October 2013</a></li>
					<li><a href="/index.html#e=201311">November 2013</a></li>
				</ul>
			</li>
			<li><a href="/submit.html"<?php echo ($_GET['page'] == "submit" ? $selected : ""); ?>>Submit</a></li>
			<li><a href="/photos.html"<?php echo ($_GET['page'] == "photos" ? $selected : ""); ?>>Photos</a></li>
			<li><a href="/team.html"<?php echo ($_GET['page'] == "team" ? $selected : ""); ?>>The Team</a></li>
		</ul>