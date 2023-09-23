<?php
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "Naruto@123";
$dbname = "UrmApp";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// echo'conn:'.$dbname;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the job ID and candidate ID from the form
    $jobID = $_POST['jobID'];
    $candidateID = $_SESSION['userID']; // Assuming candidate ID is stored in the session
    // $status = "Applied"; // Set the initial status as "Applied"
    $currentDate = date("Y-m-d");
    // Insert the application data into the database
    $sql_get_univ_id = "SELECT UnivID FROM Jobs WHERE JobID = '$jobID'";
    $result_univ_id = mysqli_query($conn, $sql_get_univ_id);

    if (mysqli_num_rows($result_univ_id) > 0) {
        $row = mysqli_fetch_assoc($result_univ_id);
        $univID = $row['UnivID'];
        // Insert the application data into the database
        $sql_insert_application = "INSERT INTO Applications (JobID, CandidateID, ApplicationDate, UnivID) VALUES ('$jobID', '$candidateID', '$currentDate', '$univID')";

        if (mysqli_query($conn, $sql_insert_application)) {
            // Application successful, you can redirect to a success page or take any other action
            header("Location: CandidateDashboard.php");
            exit();
        } else {
            // Application failed, you can redirect to an error page or take any other action
            header("Location: CandidateDashboard.php");
            exit();
        }
    } else {
        // Invalid JobID, you can redirect to an error page or take any other action
        header("Location: CandidateDashboard.php");
        exit();
    }
}
