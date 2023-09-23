<?php
session_start();
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}
// Check if the candidateID is passed as a parameter in the URL
if (isset($_GET['candidateID'])) {
    // Retrieve the candidate ID from the URL
    $candidateID = $_GET['candidateID'];



    $servername = "localhost";
    $username = "root";
    $password = "Naruto@123";
    $dbname = "UrmApp";

    // Create a database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to fetch the candidate details from URM_Candidate table using the candidateID
    $sql = "SELECT * FROM URM_Candidate WHERE CandidateID = '$candidateID'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and if candidate exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch the candidate details
        $candidate = mysqli_fetch_assoc($result);

        // Display the candidate details
        echo '<h2>Candidate Profile</h2>';
        echo '<p>Name: ' . $candidate['FName'] . ' ' . $candidate['LName'] . '</p>';
        echo '<p>Email: ' . $candidate['Email'] . '</p>';

        echo '<p>Education Level: ' . $candidate['EducationLevel'] . '</p>';
        echo '<p>Research Experience: ' . $candidate['R_Experience'] . '</p>';
        echo '<p>Nationality: ' . $candidate['Nationality'] . '</p>';

        echo '<p>Ethincity: ' . $candidate['Ethnicity'] . '</p>';
        echo '<p>Personal Statement: ' . $candidate['Personal_Statement'] . '</p>';
        echo '<p>Publications: ' . $candidate['Publications'] . '</p>';


        // Add more details as needed
    } else {
        // If the candidate doesn't exist, display a message or handle as needed
        echo '<p>Candidate not found.</p>';
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If candidateID is not provided in the URL, display an error or handle as needed
    echo '<p>Error: Candidate ID not provided.</p>';
}
