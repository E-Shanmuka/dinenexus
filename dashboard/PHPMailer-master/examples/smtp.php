<?php
// Set timezone (ensure accurate timestamps)
date_default_timezone_set('Etc/UTC');

require 'PHPMailer-master/PHPMailerAutoload.php';

// Create a new PHPMailer instance
$mail = new PHPMailer;
$mail->SMTPDebug = 2; // Enable debugging (set to 0 for production)
$mail->Debugoutput = 'html'; // Show debug output in readable format

// SMTP Configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'resndine@gmail.com';
$mail->Password = 'dine12345'; // Use Gmail App Password
$mail->SMTPSecure = 'tls';

// Set sender details
$mail->setFrom('resndine@gmail.com', 'OCTUPOS');
$mail->addReplyTo('resndine@gmail.com', 'OCTUPOS'); // Default Reply-To

// **Dynamic Reply-To Handling**
if (isset($_POST['reply_email']) && isset($_POST['reply_name'])) {
    $replyEmail = filter_var($_POST['reply_email'], FILTER_SANITIZE_EMAIL);
    $replyName = htmlspecialchars($_POST['reply_name'], ENT_QUOTES, 'UTF-8');
    $mail->addReplyTo($replyEmail, $replyName);
}

// Set recipient dynamically
$recipientEmail = $_POST['recipient_email'] ?? 'default@example.com';
$recipientName = $_POST['recipient_name'] ?? 'Default Recipient';
$mail->addAddress($recipientEmail, $recipientName);

// Email Content
$mail->isHTML(true);
$mail->Subject = 'Booking Confirmation';
$mail->Body = "<html><body>
                 Hello $recipientName,<br>
                 Your booking has been confirmed!<br>
                 Thank you for choosing us.
               </body></html>";
$mail->AltBody = "Hello $recipientName, Your booking has been confirmed! Thank you.";

// Send Email and Handle Errors
if (!$mail->send()) {
    echo '<script>alert("Mail not sent: ' . $mail->ErrorInfo . '")</script>';
} else {
    echo '<script>alert("Mail sent successfully!")</script>';
}
?>
