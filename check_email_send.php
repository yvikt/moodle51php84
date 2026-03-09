<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$hostName = 'example.com'; // TODO - replace with your domain name
$from = 'noreply@' . $hostName;
$orgName = 'Some Organization'; // TODO - replace with your organization name
$recipientEmail = 'recipient@example.test'; // TODO - set real recipient email address

try {
    $mail->isSMTP();
    $mail->Host       = 'mailserver-postfix-1'; // full qualified container name
    $mail->SMTPAuth   = false;
    $mail->SMTPSecure = false;
    $mail->SMTPAutoTLS = false;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';
    $mail->Hostname = $hostName;

    $mail->setFrom($from, $orgName);
    $mail->addAddress($recipientEmail);

    $mail->isHTML(true);
    $mail->Subject = 'Welcome. Account Verification';
    $mail->Body    = "
<html>
    <body>
        <h2>Hello there,</h2>
        <p>Thank you for joining <b>Us</b>. We are excited to have you on board!</p>
        <p>This is a standard verification email to ensure that our mail server is communicating correctly with your inbox.
        As we are currently setting up our digital infrastructure, you might receive a few automated notifications like this one.</p>
    </body>
    </html>
";
    $mail->AltBody = "Hello!\n\nWelcome. Please verify your email by visiting our website\n\nBest regards,\nTeam";

    $mail->send();
    echo 'Sending email' . PHP_EOL;
} catch (Exception $e) {
    echo "Error while sending email" . $mail->ErrorInfo . PHP_EOL;
}
