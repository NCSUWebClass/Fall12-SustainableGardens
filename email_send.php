<?php
if(isset($_POST['from'])) {
	// Error code header and footer
	function died($error) {
		echo "We are very sorry, but there were error(s) found with the form you submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors. <br /><br />";
		die();
	}
	
	// Validate input data
	if(!isset($_POST['name']) || 
		!isset($_POST['from']) || 
		!isset($_POST['to']) || 
		!isset($_POST['subject']) ||
		!isset($_POST['message'])) {
			died('We are sorry, but there appears to be a problem with the form you submitted.');       
	}
	
	// Store each input to local php vars
	$name = $_POST['name'];
	$email_from = $_POST['from'];
	$email_to = $_POST['to'];
	$email_subject = $_POST['subject'];
	$message = $_POST['message'];
	
	// Start error message as an empty string
	$error_message = "";
	
	// Valid email address format
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if(!preg_match($email_exp,$email_from)) {
		$error_message .= 'From address you entered does not appear to be valid.<br />';
	}
	if(!preg_match($email_exp,$email_to)) {
		$error_message .= 'To address you entered does not appear to be valid.<br />';
	}
	
	// Valid string format for name and message
	$string_exp = "/^[A-Za-z .'-]+$/";
	if(!preg_match($string_exp,$name)) {
		$error_message .= 'Name you entered does not appear to be valid.<br />';
	}
	if(strlen($message) < 2) {
		$error_message .= 'The message you entered does not appear to be valid.<br />';
	}
	
	// If any error message is generated, terminate
	if(strlen($error_message) > 0) {
		died($error_message);
	}
	
	// Function to clean string
	function clean_string($string) {
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad,"",$string);
	}
	
	// Clean all string to prevent email injection
	clean_string($name);
	clean_string($email_from);
	clean_string($email_to);
	clean_string($email_subject);
	clean_string($message);
	
	// Generate email message with input data
	$email_message = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <!-- Facebook sharing information tags -->
        <meta property="og:title" content="*|MC:SUBJECT|*" />
        
        <title>*|MC:SUBJECT|*</title>
		<style type="text/css">
			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
			body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
			body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */
			
			/* Reset Styles */
			body{margin:0; padding:0;}
			img{border-width: 3; border-color: #4E6172; border-style: single; height:auto; line-height:100%; outline:none; text-decoration:none;}
			table td{border-collapse:collapse;}
			#backgroundTable{height:100% !important; margin:0; padding:5px; width:100% !important;}
			
			/* Template Styles */
			
			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: COMMON PAGE ELEMENTS /\/\/\/\/\/\/\/\/\/\ */
			
			/**
			* @tab Page
			* @section background color
			*/
			body, #backgroundTable{
				background-color: #FAFAFA;
			}
			
			/**
			* @tab Page
			* @section email border
			*/
			#templateContainer{
				border-color: #855723;
				border-style: solid;
				border-width: 3px;
			}
			
			/**
			* @tab Page
			* @section heading 1
			*/
			h1, .h1{
				color: #D57500;
				font-size: 48px;
				font-weight: bold;
				font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif;
				margin-top:14px;
				margin-bottom:14px;
				text-align: center;
				text-shadow: 2px 3px 3px #000000;
			}

			/**
			* @tab Page
			* @section heading 2
			* @tip Set the styling for all second-level headings in your emails.
			* @style heading 2
			*/
			h2, .h2{
				color:#202020;
				display:block;
				font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif;
				font-size:30px;
				font-weight:bold;
				line-height:100%;
				margin-top:10px;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:center;
			}

			/**
			* @tab Page
			* @section heading 3
			*/
			h3, .h3{
				color:#202020;
				display:block;
				font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif;
				font-size:26px;
				font-weight:bold;
				line-height:100%;
				margin-top:8px;
				margin-right:0;
				margin-bottom:8px;
				margin-left:0;
				text-align:center;
			}

			/**
			* @tab Page
			* @section heading 4
			* @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
			* @style heading 4
			*/
			h4, .h4{
				color:#202020;
				display:block;
				font-family:Arial;
				font-size:22px;
				font-weight:bold;
				line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}
			
			
			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: MAIN BODY /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Body
			* @section body style
			* @tip Set the background color for your email's body area.
			*/
			#templateContainer, .bodyContent{
				background-color:#DBCA69;
			}
			
			/**
			* @tab Body
			* @section body text
			* @tip Set the styling for your email's main content text. Choose a size and color that is easy to read.
			* @theme main
			*/
			.bodyContent div{
				color:#404F24;
				font-family:Arial;
				font-size:14px;
				line-height:150%;
				text-align:left;
			}
			
			/**
			* @tab Body
			* @section body link
			*/
			.bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{
				color:#4E6172;
				font-weight:normal;
				text-decoration:underline;
			}
			
			.bodyContent img{
				display:inline;
				height:auto;
				max-width: 700px
			}
			
			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: FOOTER /\/\/\/\/\/\/\/\/\/\ */
			
			/**
			* @tab Footer
			* @section footer style
			*/
			#templateFooter{
				background-color:#A3ADB8;
				border-top:0;
			}
			
			/**
			* @tab Footer
			* @section footer text
			*/
			.footerContent div{
				color:#493829;
				font-family:Arial;
				font-size:14px;
				line-height:125%;
				text-align:left;
			}
			
			/**
			* @tab Footer
			* @section footer link
			* @tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.
			*/
			.footerContent div a:link, .footerContent div a:visited, /* Yahoo! Mail Override */ .footerContent div a .yshortcuts /* Yahoo! Mail Override */{
				color:#4E6172;
				font-weight:normal;
				text-decoration:underline;
			}
			
			.footerContent img{
				display:inline;
			}
			
			/**
			* @tab Footer
			* @section social bar style
			* @tip Set the background color and border for your email's footer social bar.
			* @theme footer
			*/
			#social{
				background-color:#A3ADB8;
				border:0;
			}
			
			/**
			* @tab Footer
			* @section social bar style
			*/
			#social div{
				color:#493829;
				font-family:Arial;
				font-size:14px;
				line-height:125%;
				text-align:left;
			}
			
			/**
			* @tab Footer
			* @section utility bar style
			*/
			#utility{
				background-color:#A3ADB8;
				border:0;
			}

			/**
			* @tab Footer
			* @section utility bar style
			* @tip Set the background color and border for your email's footer utility bar.
			*/
			#utility div{
				color:#493829;
				font-family:Arial;
				font-size:14px;
				line-height:125%;
				text-align:center;
			}
			
			#monkeyRewards img{
				max-width:190px;
			}
			
			/*use to center objects/text*/
			.centerStuff{ 
				text-align: center;
			}
		</style>
	</head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	<center>
        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
            	<tr>
                	<td align="center" valign="top">
                    	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
                        	<tr>
                            	<td align="center" valign="top">
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- // Begin Template Body \\ -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
                                    	<tr>
                                            <td valign="top" class="bodyContent">
                                
                                                <!-- // Begin Module: Standard Postcard Content \\ -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr mc:repeatable>
                                                        <td valign="top">
															<div mc:edit="std_content00">
															<strong>From:</strong> Insert sender name here
															<br>
                                                            <strong>To:</strong> Insert receipient name here<br />
															<br />
															</div>
                                                        	<div mc:edit="postcard_heading00">
                                                                <h1 class="h1">Happy Birthday!</h1>
                                                            </div>
                                                            <div mc:edit="std_content00">
                                                      
                                                                <h3 class="h3">&nbsp;</h3>
                                                                <strong>Message:</strong>
                                                                <br>Message goes here<br />
                                                                
                                                            </div>
															<br><img src="http://ecard.comule.com/asclepias_tuberosa_blooms_buds.jpg" style="max-width:600px;" mc:label="postcard_image" mc:edit="postcard_image" mc:allowtext />
                                                            <br><br>
															image description here
															<br><br>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Postcard Content \\ -->
                                                
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Body \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
								<!-- // Begin Module: Standard Footer \\ -->
                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td colspan="2" align="center" valign="middle" id="social">
														<div>
														Using native plants in urban landscapes provides habitat and food for native wildlife including butterflies, songbirds, hummingbirds and more; helps promote genetic diversity; reduces reliance on pesticides, fertilizers, supplemental irrigation and maintenance; and restores a sense of place by celebrating the natural ecology while adding beauty to the landscape.
														<br><br>
														&nbsp;Visit the Consumer Hort Page at <a href="http://www.ces.ncsu.edu/depts/hort/garden/">http://www.ces.ncsu.edu/depts/hort/garden/</a>&nbsp;
														</div>
														</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" valign="middle" id="utility">
                                                            <div mc:edit="std_utility">
                                                                &nbsp;<a href = "http://www.ces.ncsu.edu/"><img src = "http://ecard.comule.com/NCCE_Logo.jpg" /></a>&nbsp;
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Footer \\ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Footer \\ -->
                                </td>
                            </tr>
                        </table>
                        <br />
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>
EOF;

	// create email headers
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$email_from."\r\n".'Reply-To: '.$email_from."\r\n".'X-Mailer: PHP/'.phpversion();
	
	@mail($email_to, $email_subject, $email_message, $headers); 
?>

<!-- Success HTML -->
Your message has been sent!

<?php
}
die();
?>	