<?php
//Need to test different time intervals



//If time on page is less than 10 mins reset Session time
if(($_SESSION['timeout'] + 10 * 60) > time()){
  $_SESSION['timeout']= time();

} 

session_start();
$ADMIN_USER = "urbanhort";
$ADMIN_PASSWORD = "Extensi0n";

if(!$_SESSION['authenticated'] && (($_SESSION['timeout'] + 10 * 60) < time())   )

	if($_POST['loginbutton']) {
		$inputuser = $_POST['input_user'];
		$inputpassword = $_POST['input_password'];

		if(!strcmp($inputuser ,$ADMIN_USER) && !strcmp($inputpassword,$ADMIN_PASSWORD)) {
			$_SESSION['timeout']= time();
			$_SESSION['authenticated'] = 1;
			header("Location:".$_SERVER[PHP_SELF]);
		}
		else
			displayform(1);
	}
	else

		displayform(0);


function displayform($error) {
	echo "<html><head><title>Please login</title></head><body><style>body,td,input { font-family: verdana; font-size: 8pt; }</style>";
	if($error) echo "<p><b>Wrong credentials.</b></p>";
	echo "<form action=\"\" method=\"post\"><table width='400' border=1><tr><td width='100'>username:</td>";
	echo "<td><input type='text' name='input_user'></td></tr><tr><td>password:</td><td><input type='password' name='input_password'></td></tr>";
	echo "<tr><td colspan='2'><input type='Submit' value='Login&raquo;' name='loginbutton'></td></tr></table></form></body></html>";
	exit;
}
?>
