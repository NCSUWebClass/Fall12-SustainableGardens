<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personalize your NCSU Horticulture E-Card!</title>
</head>

<style>
/*style defaults for our page*/
html, body, h1, form, fieldset, legend, ul, li {
	margin: 0;
	padding: 0;
}
h1 {
	color: #D57500;
	font-size: 38px;
	font-weight: bold;
	font-family: Papyrus, fantasy;
	margin-top:14px;
	margin-bottom:14px;
	text-align: center;
}
body {
	background: #FFFFFF;
	color: #404F24;
	font-family: Georgia, "Times New Roman", Times, serif;
	padding: 20px;
}
/*style the form*/
form {
	background: #493829;
	-moz-border-radius: 15px;
	-webkit-border-radius: 15px;
	border-radius: 15px;
	border-width: 3.5px;
	border-style: solid;
	border-color: #D57500;
	padding: 12px;
	width: 460px;
}
/*remove border around each fieldset and add bottom padding*/
form fieldset {
	border: none;
	margin-bottom: 10px;
}
/*dont need bottom padding on the last fieldset tag*/
form fieldset:last-of-type {
	margin-bottom: 0;
}
/*style the form legend tags*/
form legend {
	color: #DBCA69;
	font-size: 21px;
	font-weight: bold;
	padding-bottom: 10px;
	text-shadow: 2px 3.5px 3.5px #404F24;
}
/*style the form list tags*/
form ul li {
	background: #A9A18C;
	border-color: #DBCA69;
	border-style: solid;
	border-width: 2.5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	line-height: 30px;
	list-style: none;
	padding: 5px 10px;
	margin-bottom: 5px;
}
/*style the form labels*/
form label {
	float: left;
	font-size: 13px;
	font-weight: bold;
	width: 130px;
}
/*style the last label (for captcha) to be longer*/
label:last-of-type {

}
/*style all input and textarea elems*/
form input,
form textarea {
	background: #855723;
	border-width: 1px;
	border-color: #4E6172;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	-khtml-border-radius: 4px;
	border-radius: 4px;
	font: italic 14px Georgia, "Times New Roman", Times, serif;
	outline: none;
	padding: 4px;
	width: 250px;
}
/*style all form input and textarea elems when selected*/
form input:focus,
form textarea:focus {
	background: #D57500;
}
/*make the last input box (for captcha) smaller*/
form input:last-of-type {

}
/*style the form buttons*/
form button {
	background: #404F24;
	border-width: 3px;
	border-color: #668D3C;
	-moz-border-radius: 23px;
	-webkit-border-radius: 23px;
	-khtml-border-radius: 23px;
	border-radius: 23px;
	color: #BDD09F;
	display: block;
	font: 18px Georgia, "Times New Roman", Times, serif;
	letter-spacing: 1px;
	margin: auto;
	padding: 4px 12px;
	text-shadow: 0 2px 2px #000000;
	text-transform: uppercase;
}
/*style the form button on mouseover*/
form button:hover {
	background: #1e2506;
	cursor: pointer;
}
/*use to center objects/text*/
.centerStuff{ 
	text-align: center;
}
/*specify max-width for image so it fits in the form */
img {
        max-width: 420px;
}
</style>	


<body>

<form name="ecard" method="POST" action="captcha_email_send.php">
<fieldset>
		<legend>1. Verify Selected E-card</legend>
		<ul>
			<li>
				<label for=greeting>Greeting:</label>
				<br>
				<h1>Happy Birthday!</h1>
			</li>
			<li>
				<label for=image>Image:</label>
				<br>
				<div class="centerStuff">
				<img src="http://ecard.comule.com/asclepias_tuberosa_blooms_buds.jpg">
				</div>
			</li>
			<li>
				<label for=descrip>Description:</label>
				<br>Description will go here
			</li>
		</ul>
	</fieldset>

	<fieldset>
		<legend>2. Enter Recipient Information</legend>
		<ul>
			<li>
				<label for="name">Your Name:</label>
				<input  type="text" name="name" placeholder="First & Last Name">
			</li>
			<li>
				<label for="from">From:</label>
				<input  type="text" name="from" placeholder="your_email@domain.com">
			</li>
			<li>
				<label for="to">To:</label>
				<input  type="text" name="to" placeholder="recipient_email@domain.com">
			<li>
				<label for="subject">Subject:</label>
				<input  type="text" name="subject">
			</li>
			<li>
				<label for="message">Message:</label>
				<textarea  name="message" maxlength="900" rows="9"></textarea>
			</li>
		</ul>
	</fieldset>
	
	<fieldset>
		<legend>3. Authenticate & Send</legend>
		<ul>					
			<li>
				<img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>
				<label for='message'>Enter code above:</label><br>
				<input id="6_letters_code" name="6_letters_code" type="text"><br>
				<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
			</li>
		</ul>

	</fieldset>
	
	<fieldset>
		<div class="centerStuff">
		<button type=submit>Send!</button><button type=reset>Reset Form</button>
		</div>
	</fieldset>
</form>

<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>


</body>
</html>

	