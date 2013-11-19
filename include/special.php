<?php
date_default_timezone_set("Canada/Pacific");
if(getMonth() == 12) echo "<div class=\"xmas-lights\" style=\"background-image: url(pics/xmas-lights/anim-" . rand(1, 3) . ".gif);\"></div>";


function getMonth() {
  if(isset($_GET['override_month'])) return $_GET['override_month'];
  else return date("n");
}
?>
