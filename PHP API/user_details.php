<?php
session_start();
// require 'sendCongratsMail.js';
// if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
//     header("Location: AdminDashboard.php");
//     exit();
// }
// Check if the user's ID is provided in the URL
if (isset($_GET['id'])) {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "Naruto@123";
    $dbname = "UrmApp";

    // Create a database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the user's ID from the URL parameter
    $userID = $_GET['id'];

    // Fetch user details from the database based on the provided ID
    $sql = "SELECT * FROM Users WHERE UserID = '$userID'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // Check if the Confirm button is clicked
    if (isset($_POST['confirm'])) {
        // Update the status to "Approved" in the database
        // $updateSql = "UPDATE Users SET Status = 'Approved' WHERE UserID = '$userID'";
        // mysqli_query($conn, $updateSql);

        $to = $user['Email'];
        $subject = "Welcome to URM Application";
        $message = "Dear User,\n\nCongratulations! Your profile on URM Application has been approved by the admin. You can now access your account and use all the features.\n\nBest regards,\nURM Application Team`,";
        $nodePath = "/usr/local/bin/node";
        $scriptPath = "JS/sendCongratsMail.js";
        // Call the Node.js function to send the email
        $cmd = "{$nodePath} {$scriptPath} " . escapeshellarg($to) . " " . escapeshellarg($subject) . " " . escapeshellarg($message);
        exec($cmd, $output, $returnCode);

        if ($returnCode === 0) {
            $updateSql = "UPDATE Users SET Status = 'Approved' WHERE UserID = '$userID'";
            mysqli_query($conn, $updateSql);
            echo '<script>document.getElementById("message").innerHTML = "Approved successful! You can now log in with your credentials. A confirmation email has been sent to your email address.";</script>';
            // echo "Sign-up successful! You can now log in with your credentials. A confirmation email has been sent to your email address.";
        } else {
            // Sign-up failed, show error message
            // echo "Sign-up failed. Please try again later.";
            echo '<script>document.getElementById("message").innerHTML = "Approve Unsuccessful! However, there was an error sending the confirmation email. Please contact support for further assistance.";</script>';
        }
        // Redirect back to the User Registrations page
        header("Location: AdminDashboard.php");
        exit();
    }
} else {
    // If the ID is not provided, redirect back to the User Registrations page
    header("Location: AdminDashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="CSS/user_details.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>

<body>
    <div class="user-details-container">
        <h2>User Details</h2>
        <div class="user-details">
            <p><strong>User ID:</strong> <?php echo $user['UserID']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
            <p><strong>User Role:</strong> <?php echo $user['UserRole']; ?></p>
            <p><strong>Status:</strong> <?php echo $user['Status']; ?></p>
        </div>
        <!-- Add Confirm Button -->
        <form method="post">
            <button type="submit" name="confirm" class="confirm-btn">Confirm Approval</button>
        </form>
    </div>
</body>

</html>