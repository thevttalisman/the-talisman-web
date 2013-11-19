<?php
$output = array();
$ignore = array(".", "..", ".DS_Store", ".htaccess", "index.html");

date_default_timezone_set("Canada/Pacific");

foreach(scandir("../papers/") as $year) {
	if(in_array($year, $ignore)) continue;
	foreach(scandir("../papers/" . $year . "/") as $month) {
		if(in_array($month, $ignore)) continue;
		
		$pages = 0;
		foreach(scandir("../papers/" . $year . "/" . $month) as $page) {
			if(!in_array($page, $ignore)) $pages++;
		}
		
		$output[$year . date('m', strtotime($month))] = array("$year/$month/", $pages / 2);
	}
}

echo json_encode($output);
?>
