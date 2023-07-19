<?php
require './PHPMailer/PHPMailer-master/src/PHPMailer.php';
require './PHPMailer/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Create a new PHPMailer instance
$mail = new PHPMailer();

// Enable SMTP debugging (optional)
$mail->SMTPDebug = SMTP::DEBUG_OFF;

// Set the mailer to use SMTP
$mail->isSMTP();

// Set the SMTP server details
$mail->Host = 'smtp.example.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

// Set SMTP authentication
$mail->SMTPAuth = true;
$mail->Username = 'your-email@example.com';
$mail->Password = 'your-email-password';

// Set the sender and recipient
$mail->setFrom('your-email@example.com', 'Your Name');
$mail->addAddress('recipient@example.com', 'Recipient Name');

// Set the email subject and body
$mail->Subject = 'Test Email';
$mail->Body = 'This is a test email sent using PHPMailer.';

// Send the email
if ($mail->send()) {
    echo 'Email sent successfully.';
} else {
    echo 'Email sending failed. Error: ' . $mail->ErrorInfo;
}
