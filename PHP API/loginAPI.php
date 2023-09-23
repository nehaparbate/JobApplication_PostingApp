<?php
require_once 'enable-cors.php';

// Start the session
session_start();
if (!isset($_SESSION['session_start_time'])) {
    $_SESSION['session_start_time'] = time();
}

// Database connection parameters
$servername = "localhost:3306";

$username = "nxp7046_root";

$password = "WdmFall2023@123";

$dbname = "nxp7046_urm_DB";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process login form submission
if (isset($_POST['Email']) && isset($_POST['Password'])) {

    $email = $_POST['Email'];
    $password = $_POST['Password'];
    // $email = "khsshiva@gmail.com";
    // $password = '123';
    echo "Received email: " . $email . "\n";
    echo "Received password: " . $password . "\n";

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM Users WHERE Email=? AND Password=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Prepare the response data as an associative array
    $response = array();

    if (mysqli_num_rows($result) === 1) {
        $response['status'] = 'mysqli_num_rows($result)';
        $row = mysqli_fetch_assoc($result);
        $userRole = $row['UserRole'];
        $userID = $row['UserID'];

        // Set the user role and ID in the session
        $_SESSION['userRole'] = $userRole;
        $_SESSION['userID'] = $userID;

        // Verify the password
        if ($password === $row['Password']) {
            $_SESSION['isLoggedIn'] = true;

            // Set the response data for a successful login
            $response['isLoggedIn'] = true;
            $response['userRole'] = $userRole;

            // Redirect the user based on their role
            switch ($userRole) {
                case "Admin":
                    $response['redirect'] = "/adminDashboard";
                    break;
                case "Candidate":
                    $response['redirect'] = "/candidateDashboard";
                    break;
                case "DEI_Officer":
                    $response['redirect'] = "/deiDashboard";
                    break;
                case "Recruiter":
                    $response['redirect'] = "/recruiterDashboard";
                    break;
                case "university":
                    $response['redirect'] = "/universityDashboard";
                    break;
                default:
                    // Handle any other roles as needed
                    break;
            }
        } else {
            // Invalid password
            $response['isLoggedIn'] = false;
            $response['error'] = "Invalid email/username or password. Please try again.";
        }
    } else {
        // User not found
        $response['isLoggedIn'] = false;
        $response['error'] = "User not found. Please check your email/username.";
    }

    // Convert the response data to a JSON string and send it as the response
    header('Content-Type: application/json');
    echo  json_encode($response);

    // Exit the script to prevent further execution
    exit();
}
