<?php
require_once('lib/recaptchalib.php');
$publickey = "6LesL-cSAAAAAKWqJhjrA0JiAyLGHxSmLhfZPTml";
$msg = "";
$errors = array("name" => false,
				"grade" => false,
				"title" => false,
				"content" => false,
				"captcha" => false,
				"email" => false);

if($_POST)
{

	$from_add = $_POST['email']; 
	$name = $_POST['name'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$grade = $_POST['grade'];
	
	$privatekey = "6LesL-cSAAAAAPalCCfaWB8Gogzpt-pQ1sD9cYFd";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	$string_exp = "/^[A-Za-z .'-]+$/";
	
	$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
	
	if(!preg_match($string_exp, $name)) {
		$msg .= '<li>The Name you entered does not appear to be valid.</li>';
		$errors['name'] = true;
	}
	if(strlen($grade) == 0) {
		$msg .= '<li>The Grade field appears to be blank.</li>';
		$errors['grade'] = true;
	}
	if(!preg_match($email_exp, $from_add)) {
		$msg .= '<li>The Email Address you entered does not appear to be valid.</li>';
		$errors['email'] = true;
	}
	if(strlen($title) == 0) {
		$msg .= '<li>The Title field appears to be blank.</li>';
		$errors['title'] = true;
	}
	if(strlen($content) == 0) {
		$msg .= '<li>The Content field appears to be blank.</li>';
		$errors['content'] = true;
	}
	if(!$resp->is_valid) {
		$msg .= '<li>The Captcha response do not appear to be valid.</li>';
		$errors['captcha'] = true;
	}
	if(strlen($msg) == 0) {

		$to_add = "submit@thetalisman.ca";
	
		$headers = "From: $name <$from_add> \r\n";
		$headers .= "Reply-To: $name <$from_add> \r\n";
		$headers .= "Return-Path: $name <$from_add>\r\n";
		$headers .= "X-Mailer: PHP \r\n";
		
		$message = <<<EOS
$title

$content
EOS;
	
	
		if(mail($to_add, "Newspaper Submission from " . $name . " in ". $grade, $message, $headers)) 
		{
			$msg = "Submission Recieved!";
			$_POST['name'] = $msg;
			$_POST['grade'] = $msg;
			$_POST['title'] = $msg;
			$_POST['content'] = $msg;
			$_POST['email'] = $msg;
		}
		else
		{
	 		die("Code Error!  Please report to <a href='mailto:slamchops@thetalisman.ca'>slamchops@thetalisman.ca</a>");
		}
	
	}
} else {
	$_POST['name'] = $msg;
	$_POST['grade'] = $msg;
	$_POST['title'] = $msg;
	$_POST['content'] = $msg;
	$_POST['email'] = $msg;
}

function errorCheck($field){ 
	global $errors;
	if($errors[$field]) echo " error";
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Submit Your Article - The Talisman</title>
	<link type="text/css" rel="stylesheet" href="fonts/fonts.css"></link>
	<link type="text/css" rel="stylesheet" href="css/general.css"></link>
	<link type="text/css" rel="stylesheet" href="css/submissions.css"></link>
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript">
		var RecaptchaOptions = {
			theme : 'custom',
			custom_theme_widget: 'recaptcha_widget'
		};
	</script>
</head>

<body>
	<div id="header">
		<div id="logo"></div>
		<ul id="nav">
			<li><a href="/index.html">Home</a></li>
			<li>
				<a href="javascript:void(0);">Newspapers</a>
				<ul>
					<!--li><a href="/index.html#e=201304">April 2013</a></li-->
					<li><a href="/index.html#e=201309">September 2013</a></li>
					<li><a href="/index.html#e=201310">October 2013</a></li>
				</ul>
			</li>
			<li><a href="/submit.html" class="selected">Submit</a></li>
			<li><a href="/team.html">The Team</a></li>
		</ul>
	</div>
	
	<?php if(strlen($msg) > 0) echo "<ul>$msg</ul>"; ?>

	<center>You can directly email us your document at 
	s<a href="http://www.google.com/recaptcha/mailhide/d?k=01uTI6cn0kZ2fdzSmGR325VA==&amp;c=Z-tvV3uDiqtXpN3ztxXuZ6sd_W5EuwvKTyk4HsGeGZE=" onclick="$(this).replaceWith('ubmit'); return false;" title="Reveal this e-mail address">...</a>@thetalisman.ca</center>
	
	<center style="font-size:30px;padding: 20px 0;">OR</center>
	
	<form accept-charset="utf-8" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" style="width: 500px; margin: 0 auto; padding-bottom: 35px;" novalidate>
		<center>You can send us your article via this form</center>
	
		<p class="form">First & Last Name: <span style="font-weight: bolder; color: red;">*</span> <br /><input type="text" class="form<?php errorCheck('name'); ?>"  name="name" value="<?php echo $_POST['name']; ?>" /></p>
		<p class="form">Grade: <span style="font-weight: bolder; color: red;">*</span> <br /><input type="text" class="form<?php errorCheck('grade'); ?>"  name="grade" value="<?php echo $_POST['grade']; ?>" /></p>
		<p class="form">E-Mail Address: <span style="font-weight: bolder; color: red;">*</span> <br /><input type="email" class="form<?php errorCheck('email'); ?>"  name="email" value="<?php echo $_POST['email']; ?>" /></p>
		<p class="form">Article Title: <span style="font-weight: bolder; color: red;">*</span> <br /><input type="text" class="form<?php errorCheck('title'); ?>"  name="title" value="<?php echo $_POST['title']; ?>" /></p>
		<p class="form">Article Content: <span style="font-weight: bolder; color: red;">*</span> (Please include links to any images for us to use) <br /><textarea name="content" rows="9" class="form<?php errorCheck('content'); ?>"><?php echo $_POST['content']; ?></textarea></p>
		<p class="form">AntiSpam Protection: <span style="font-weight: bolder; color: red;">*</span> <br />
			<center><table style="border: none;border-spacing: 0px;">
				<tr>
					<td style="width:75px">
						<div id="recaptcha_widget" style="display:block">
							<div id="recaptcha_image" style="width: 300px; height: 57px;"></div>
							<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="captcha<?php errorCheck('captcha'); ?>" />
						</div>
						<noscript>
							<iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $publickey; ?>" height="300" width="500" frameborder="0"></iframe><br>
							<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
							<input type="hidden" name="recaptcha_response_field" class="captcha<?php errorCheck('captcha'); ?>" value="manual_challenge">
						</noscript>
					</td>
					<td style="padding-left: 1em;">
						<div><a href="javascript:Recaptcha.reload()"><img src="http://www.google.com/recaptcha/api/img/clean/refresh.gif" /></a></div>
						<div><a href="javascript:Recaptcha.showhelp()"><img src="http://www.google.com/recaptcha/api/img/clean/help.gif" /></a></div>
					</td>
				</tr>
			</table></center>
		</p>
		<div id="bottom">
			<input type="submit" value="Send message!" class="formsubmit" /> 
			<p class="formklein">All fields marked with <span style="font-weight: bolder; color: red;">*</span> are required.</p>
		</div>
	</form>
	<div id="footer-wrapper">
		<a href="/index.html">Home</a>
		<a href="/submit.html">Submit</a>
		<a href="/team.html">The Team</a>
		<div class="licence"></div>
	</div>

	<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $publickey; ?>"></script>
</body>
</html>