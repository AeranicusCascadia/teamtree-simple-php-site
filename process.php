<?php

$name = $_POST["name"];
$email = $_POST["email"];
$details = $_POST["details"];

echo "<pre>";

$email_body = "";
$email_body .= "Name: " . $name .  "<br>";
$email_body .= "Email: " . $email . "<br>";
$email_body .= "details: " . $details . "<br>";

echo $email_body;

echo "</pre>";

// Do: send email
header("location:thanks.php");

?>
