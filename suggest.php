<?php

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

	echo "<pre>";
	$email_body = "";
	$email_body .= "Name: " . $name .  "<br>";
	$email_body .= "Email: " . $email . "<br>";
	$email_body .= "details: " . $details . "<br>";
	echo $email_body;
	echo "</pre>";

	// To Do: send email ... not yet implemented, but this is where it (or other processing of form data) should happen.
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
