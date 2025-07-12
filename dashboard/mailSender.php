$mail = new PHPMailer(true); // Enable exceptions

try {
    // Set mailer to use SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'resndine@gmail.com';  // Your Gmail address
    $mail->Password = 'dine12345';  // Your Gmail password or App password if 2FA is enabled
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Use TLS encryption
    $mail->Port = 587;  // Port number for TLS

    // Sender's info
    $mail->setFrom('resndine@gmail.com', 'Premium Dine & Seat Planner');
    $mail->addAddress($email, $cname);  // Add recipient (dynamically fetched restaurant email)

    // Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Booking Confirmation';
    $mail->Body = "<html><body>
                    Hello $cname,<br><br>
                    Your table booking has been <strong>confirmed</strong>!<br>
                    Thank you for choosing Premium Dine.<br><br>
                    Regards,<br>
                    The Premium Dine Team
                   </body></html>";
    $mail->AltBody = "Hello $cname, your table booking has been confirmed!";

    // Enable verbose debugging
    $mail->SMTPDebug = 2;  // Set to 2 for full debugging output

    // Send email
    if ($mail->send()) {
        echo '<script>alert("Booking Confirmed & Email Sent.");</script>';
        echo '<script>window.location="booking-list.php"</script>';
    } else {
        echo 'Mailer Error: ' . $mail->ErrorInfo;  // Show the detailed error
    }
} catch (Exception $e) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;  // Show the detailed error
}
