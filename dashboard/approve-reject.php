<?php
session_start();
include_once 'dbCon.php';
$con = connect();

// Check if the database connection is successful
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Reject Booking Request
if (isset($_GET['breject_id'])) {
    $id = $_GET['breject_id'];

    // Secure query using prepared statements
    $stmt = $con->prepare("UPDATE booking_details SET status = 0 WHERE id = ?");
    if ($stmt === false) {
        die('Error preparing query: ' . $con->error); // Debugging
    }
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Booking Rejected.");</script>';
        echo '<script>window.location="booking-list.php"</script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Approve Booking Request
if (isset($_GET['bapprove_id'])) {
    $id = $_GET['bapprove_id'];

    // Fetch restaurant's email dynamically (using restaurant_info table)
    $stmt = $con->prepare("SELECT 
                            restaurant_info.restaurent_name AS username,
                            restaurant_info.email 
                          FROM booking_details 
                          JOIN restaurant_info ON restaurant_info.id = booking_details.c_id 
                          WHERE booking_details.id = ?");
    if ($stmt === false) {
        die('Error preparing query: ' . $con->error); // Debugging
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $r = $result->fetch_assoc();
        $cname = $r['username'];
        $email = $r['email']; // Use dynamically fetched restaurant email
    } else {
        echo '<script>alert("Restaurant email not found.");</script>';
        echo '<script>window.location="booking-list.php"</script>';
        exit;
    }

    $stmt->close();

    // Approve booking request
    $stmt = $con->prepare("UPDATE booking_details SET status = 1 WHERE id = ?");
    if ($stmt === false) {
        die('Error preparing query: ' . $con->error); // Debugging
    }
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Include PHPMailer and initialize mail sender
        require 'mailSender.php';
        $mail = new PHPMailer(true);

        try {
            // Set up email details
            $mail->setFrom('resndine@gmail.com', 'Premium Dine & Seat Planner');
            $mail->addAddress($email, $cname); // Send email to restaurant

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Booking Confirmation';
            $mail->Body = "<html><body>
                            Hello $cname,<br><br>
                            Your table booking has been <strong>confirmed</strong>!<br>
                            Thank you for choosing Premium Dine.<br><br>
                            Regards,<br>
                            The Premium Dine Team
                           </body></html>";
            $mail->AltBody = "Hello $cname, your table booking has been confirmed!";

            if ($mail->send()) {
                echo '<script>alert("Booking Confirmed & Email Sent.");</script>';
                echo '<script>window.location="booking-list.php"</script>';
            } else {
                echo '<script>alert("Mail not sent: ' . $mail->ErrorInfo . '")</script>';
                echo '<script>window.location="booking-list.php"</script>';
            }
        } catch (Exception $e) {
            echo '<script>alert("Mail not sent: ' . $mail->ErrorInfo . '")</script>';
            echo '<script>window.location="booking-list.php"</script>';
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close Database Connection
$con->close();
?>
