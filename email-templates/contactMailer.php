<?php
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true;
    $mail->Username   = 'foodleresto12@gmail.com';
    $mail->Password   = 'pmvv ggrp jrri zdbf'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587; 

    
    $name    = $_POST['name'] ?? 'Anonymous';
    $email   = $_POST['email'] ?? 'no-reply@yourdomain.com'; 
    $phone   = $_POST['phone'] ?? '00000';
    $subject = $_POST['subject'] ?? 'No Subject';
    $message = $_POST['comment'] ?? 'No message provided.';

    
    $mail->setFrom('foodleresto12@gmail.com', 'BRX-Mailer');

    
    $mail->addAddress('mohammadrawass12@gmail.com', 'BRX');

    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail->addReplyTo($email, $name);
    }

    
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = "
        <h3>New Contact Form Submission</h3>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Phone Number:</strong> {$phone}</p>
        <p><strong>Subject:</strong> {$subject}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";

    
    if ($mail->send()) {
        echo '{ "alert": "alert alert-success alert-dismissable", "message": "Your message has been sent successfully!" }';
    } else {
        echo '{ "alert": "alert alert-danger alert-dismissable", "message": "Your message could not be sent!" }';
    }
} catch (Exception $e) {
    echo '{ "alert": "alert alert-danger alert-dismissable", "message": "Mail Error: ' . $mail->ErrorInfo . '" }';
}
?>
