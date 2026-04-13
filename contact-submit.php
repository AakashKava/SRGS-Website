<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'includes/phpmailer/PHPMailer.php';
require 'includes/phpmailer/SMTP.php';
require 'includes/phpmailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $service = $_POST['service'];
    $message = $_POST['message'];

    include 'includes/db.php';

    // SAVE TO DB FIRST
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, service, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $service, $message);
    $stmt->execute();

    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'akworks88@gmail.com'; // 🔴 CHANGE THIS
        $mail->Password = 'khithpxbmwnrrgfw';   // 🔴 CHANGE THIS

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // EMAIL SETTINGS
        $mail->setFrom('akworks88@gmail.com', 'SRGS Website');

        $mail->addReplyTo($email, $name);

        $mail->addAddress('ak.kava81@gmail.com'); // 🔴 CLIENT EMAIL

        // CONTENT
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Message';

        $mail->Body = "
            <div style='font-family:Arial; padding:15px;'>
                <h2 style='color:#1c2539;'>New Contact Message</h2>

                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Service:</strong> $service</p>

                <p><strong>Message:</strong></p>
                <p style='background:#f5f5f5; padding:10px; border-radius:5px;'>
                    $message
                </p>
            </div>
        ";

        $mail->send();
        $mail->SMTPDebug = 2;

        header("Location: contact.php?success=1");

    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request");
}