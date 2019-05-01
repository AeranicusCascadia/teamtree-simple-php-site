<?php

// reference to 3rd party library
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/src/Exception.php';
require 'vendor/phpmailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$name = trim(filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
	$details = trim(filter_input(INPUT_POST,"details",FILTER_SANITIZE_SPECIAL_CHARS));

	// check $name has value
	if ($name == "" || $email == "" || $details == "") {
		echo "Please fill in the required fields: Name, Email, and Details.";
		exit;
		}
		
	if ($_POST["address"] != "") {
		echo "Bad form input.";
		exit;
		}	
		
		
	if (!PHPMailer::validateAddress($email)) { // Does static class method return false (invalid email address)?
		echo "Invalid Email Address";
		exit;
		}
		
	$email_body = "";
	$email_body .= "Name: " . $name .  "<br>";
	$email_body .= "Email: " . $email . "<br>";
	$email_body .= "details: " . $details . "<br>";

	$mail = new PHPMailer;
	
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 2;
	//Set the hostname of the mail server
	$mail->Host = 'smtp.gmail.com';
	// use
	// $mail->Host = gethostbyname('smtp.gmail.com');
	// if your network does not support SMTP over IPv6
	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 587;
	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = "cascadiadevdomain@gmail.com";
	//Password to use for SMTP authentication
	$mail->Password = "zhjjsdyuowaldhvm";

	
	//It's important not to use the submitter's address as the from address as it's forgery,
	//which will cause your messages to fail SPF checks.
	//Use an address in your own domain as the from address, put the submitter's address in a reply-to
	$mail->setFrom('aaron.uusitalo@gmail.com',$name);
	$mail->addReplyTo($email, $name);
	$mail->addAddress('aaron.uusitalo@gmail.com','Aaron U');
	$mail->Subject = 'Library suggestion form from ' . $name;
	$mail->Body = $email_body;
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	}
	
	header("location:suggest.php?status=thanks"); // redirects to this page, but includes variable ('staus') that can be used in conditional.
	
}

$pageTitle = "Suggest a Media Item";
$section = "suggest";

include("inc/header.php");  

?>

<div class="section page">
	
	<div class="wrapper">

		<h1>Suggest a Media Item</h1>
		
		
		
	<?php if ( isset($_GET["status"]) && $_GET["status"] == "thanks" ) {
			echo "<p>Thanks for your email. I&apos;ll check out your suggestion soon.</p>";
			} else { ?>
			
		
		
		<p>If you think there is something I&apos;m missing, let me know. Complete the form to send me an email.</p>
		
		<form method="post" action="suggest.php">
			
			<table>
				
				<tr>
					<th><label for="name">Name</label></th>
					<td><input type="text" id="name" name="name" /></td>
				</tr>
				
				<tr>
					<th><label for="email">Email</label></th>
					<td><input type="text" id="email" name="email" /></td>
				</tr>
				
				<tr>
					<th><label for="details">Suggest Item Details</label></th>
					<td><textarea name="details" id="details">Default text</textarea></td>
				</tr>
				
				<!-- Spam honeypot field -->
				<tr style="display:none">
					<th><label for="address">Address</label></th>
					<td><textarea name="address" id="address"></textarea></td>
					<p>Please leave this field blank.</p>
				</tr>
				
			</table>
			
			<input type="submit" value="send" />
			
		</form>
		
		<?php } ?>
		
	</div>
	
</div>

<?php include("inc/footer.php"); ?>
