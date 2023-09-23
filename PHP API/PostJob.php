<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "Naruto@123";
    $dbname = "UrmApp";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ensure that the user is logged in and has a valid universityName in the session
        if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true || !isset($_SESSION['universityName'])) {
            // Redirect the user back to the login page or any other appropriate action
            header("Location: login.php");
            exit();
        }

        // Create a database connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }


        // Get the universityName from the session
        $universityName = $_SESSION['universityName'];
        $univID = $_SESSION['userID'];

        // Get the job details from the form data
        $jobTitle = $_POST['job_title'];
        $jobDescription = $_POST['job_description'];
        $jobPayScale = $_POST['job_pay'];
        $jobExpReq = $_POST['job_exp'];
        $jobPosition = $_POST['job_pos'];
        $jobDate = date('Y-m-d');

        // Insert the new job entry into the "Jobs" table

        $sql = "INSERT INTO Jobs (UnivID,JobTitle,PayScale,Exp_req,Position, Description, Date,UnivName) VALUES ('$univID','$jobTitle','$jobPayScale', ' $jobExpReq',' $jobPosition','$jobDescription', '$jobDate','$universityName')";

        if (mysqli_query($conn, $sql)) {
            echo "Job posted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job</title>
</head>

<body>
    <h2>Post a Job</h2>
    <form method="post">
        <label for="job_title">Job Title:</label>
        <input type="text" name="job_title" required><br>

        <label for="job_description">Job Description:</label>
        <textarea name="job_description" required></textarea><br>
        <label for="job_pay">Pay Scale:</label>
        <input type="text" name="job_pay" required><br>
        <label for="job_exp">Experience Required:</label>
        <input type="text" name="job_exp" required><br>
        <label for="job_pos">Position:</label>
        <input type="text" name="job_pos" required><br>

        <button type="submit">Post Job</button>
    </form>
</body>

</html>