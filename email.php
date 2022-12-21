<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

require_once "/Users/ashams001/pear/share/pear/Mail.php";
//require_once "Mail.php";
$host = "ssl://smtp.gmail.com";
$username = "admin@plantnavigator.com";
$password = "S@@rgummi_2022";
$port = "465";
$to = "ayesha@hematechservices.com";
$email_from = "admin@plantnavigator.com";
$email_subject = "Subject Line Here:" ;
$email_body = "whatever you like" ;
$email_address = "";

//$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject);
$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $email_body);


if (PEAR::isError($mail)) {
	echo("<p>" . $mail->getMessage() . "</p>");
} else {
	echo("<p>Message successfully sent!</p>");
}
?>