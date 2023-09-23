<?php
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}
// if ($_SESSION['isLoggedIn'] === true && $_SESSION['userRole'] !== 'Admin' && $_SESSION['userRole'] === 'Candidate' && $_SESSION['userRole'] !== 'DEI_Officer' && $_SESSION['userRole'] !== 'Recruiter') {
//     // Redirect to a restricted access page if the user doesn't have the required role
//     header("Location: CandidateDashboard.php");
//     exit();
// }// Fetch job postings from the database
// Database connection parameters
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

// Check connection
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['searchQuery'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_GET['searchQuery']);
    $sql = "SELECT * FROM Jobs WHERE JobTitle LIKE '%$searchQuery%' OR Description LIKE '%$searchQuery%'";
} else {
    // If there is no search query, fetch all job postings
    $sql = "SELECT * FROM Jobs";
}
$result = mysqli_query($conn, $sql);
$userID = $_SESSION['userID'];
$sqlProfile = "SELECT * FROM URM_Candidate where CandidateID='$userID'";
$resultProfile = mysqli_query($conn, $sqlProfile);
$candidate = mysqli_fetch_assoc($resultProfile);

// echo $userID;
// Check if there are any job postings
// if (mysqli_num_rows($result) > 0) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $jobTitle = $row['JobID'];
//         $jobDate = $row['Date'];
//         $jobDescription = $row['Description'];
//         // You can fetch other job-related data as needed

//         // Generate the HTML for each job posting dynamically
//         echo '<div class="postingpanel">';
//         echo '<div class="posting1">';
//         echo '<img class="jobimg" src="../Img/job4.jpeg" height="130px" width="200px">';
//         echo '<div class="parentjobhead">';
//         echo '<div class="jobhead">';
//         echo '<div class="jobtitle">';
//         echo '<p style="font-size: 22px; font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif; font-weight: 600;">' . $jobTitle . '</p>';
//         echo '</div>';
//         echo '<div class="job date">';
//         echo '<p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, \'Times New Roman\', serif; color: grey;">' . $jobDate . '</p>';
//         echo '</div>';
//         echo '</div>';
//         echo '<div class="jobdesc">';
//         echo '<p style="font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;">' . $jobDescription . '</p>';
//         echo '</div>';
//         echo '</div>';
//         echo '</div>';
//         echo '</div>';
//     }
// } else {
//     // If there are no job postings, display a message or handle as needed
//     echo '<p>No job postings found.</p>';
// }
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="CSS\CandidateDashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Dashboard</title>
</head>

<body>
    <div class="panel1">

        <div class="nav">
            <a class="navtext" href="#">URM Application</a>
            <a class="navtext" href="edit_profile.php">Profile</a>
            <a class="navtext" href="CandidateDashboard.html">Home</a>
            <a class="navtext" href="About.html">About</a>
            <a class="navtext" href="Services.html">Services</a>
            <a class="navtext" href="Contact.html">Contact Us</a>
            <a class="navtext" href="logout.php">Log Out</a>
        </div>
        <div class="secbar">
            <h1>URM Candidate Dashboard </h1>
        </div>
    </div>
    <div class="partdiv">
        <div class="partition">
        </div>
    </div>
    <div class="panel2">
        <div>
            <h3>Welcome, <?php echo   $_SESSION['userRole'] . ' with ' . $_SESSION['userID']; ?></h3>
        </div>
        <div class="panel2right">
            <div class="chatbag">
                <p>💬</p>
            </div>
            <div class="panel2subright">

                <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <input type="text" name="searchQuery" placeholder="Search Jobs">
                    <button type="submit">Search</button>
                </form>

            </div>
        </div>
    </div>
    <!-- <div class="panel3">
        <p class = "copyright">Copyright © All rights are reserved</p>
    </div> -->
    <div class="midpanel">
        <div class="midleft">
            <div class="midlefttop">
                <!-- <div class="button">
                    <button type="button">Add Job Posting ></button>
                </div> -->
                <div class="button">
                    <a href="PositionsCandidate.html">
                        <button type="button">See All Postings ></button>
                    </a>
                </div>

            </div>
            <?php if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $jobId = $row['JobID'];
                    $jobDate = $row['Date'];
                    $jobTitle = $row['JobTitle'];
                    $formattedDate = date("Y-m-d", strtotime($jobDate));
                    $userID = $_SESSION['userID'];
                    $jobDescription = $row['Description'];

                    // echo  $jobId . ',' . $userID;
                    // You can fetch other job-related data as needed


                    // Prepare the SQL statement
                    $sql1 = "SELECT * FROM Applications WHERE CandidateID = ? AND JobID = ?";

                    // Prepare the statement
                    $stmt = mysqli_prepare($conn, $sql1);

                    // Bind parameters to the prepared statement
                    mysqli_stmt_bind_param($stmt, "ss", $userID, $jobId);

                    // Execute the prepared statement
                    mysqli_stmt_execute($stmt);
                    // Check for errors
                    if (mysqli_stmt_error($stmt)) {
                        echo "Error executing query: " . mysqli_stmt_error($stmt);
                    }

                    // Get the result from the executed statement
                    $resultApp = mysqli_stmt_get_result($stmt);
                    // echo mysqli_num_rows($resultApp);

                    // If a record is found, the candidate has already applied for this job
                    // So, hide the "Apply" button

                    // Generate the HTML for each job posting dynamically
                    echo '<div class="postingpanel">';
                    echo '<div class="posting1">';
                    echo '<img class="jobimg" src="../Img/job4.jpeg" height="130px" width="200px">';
                    echo '<div class="parentjobhead">';
                    echo '<div class="jobhead">';
                    echo '<div class="jobtitle">';
                    echo '<p style="font-size: 22px; font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif; font-weight: 600;">' . $jobTitle . '</p>';
                    echo '</div>';
                    echo '<div class="job date">';
                    echo '<p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, \'Times New Roman\', serif; color: grey;">' . $formattedDate . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="jobdesc">';
                    echo '<p style="font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;">' . $jobDescription . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    // Add the Apply button with a form to submit the application
                    // echo mysqli_num_rows($resultApp);
                    if (mysqli_num_rows($resultApp) > 0) {
                        // Candidate has already applied for this job, hide the "Apply" button
                        echo '<form method="post" action="CandidateDashboard.php" style="display: none;">';
                        echo '<input type="hidden" name="jobID" value="' . $jobId . '">';
                        echo '<button type="submit">Apply</button>';
                        echo '</form>';
                    } else {
                        // Candidate has not applied, show the "Apply" button
                        echo '<form method="post" action="CandidateDashboard.php">';
                        echo '<input type="hidden" name="jobID" value="' . $jobId . '">';
                        echo '<button type="submit">Apply</button>';
                        echo '</form>';
                    }

                    // Close the statement
                    mysqli_stmt_close($stmt);


                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // If there are no job postings, display a message or handle as needed
                echo '<p>No job postings found.</p>';
            }
            ?>
            <!-- <div class="postingpanel">
                <div class="posting1">
                    <img class="jobimg" src="../Img/job4.jpeg" height="130px" width="200px">

                    <div class="parentjobhead">
                        <div class="jobhead">
                            <div class="jobtitle">
                                <p style="font-size: 22px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: 600;">Financial Analyst </p>
                            </div>
                            <div class="job date">
                                <p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: grey;">June 5, 2023</p>
                            </div>
                        </div>
                        <div class="jobdesc">
                            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                Analyzes financial data and prepares reports for decision-making </p>
                        </div>
                    </div>
                </div>
                <div class="posting1">
                    <img class="jobimg" src="../Img/job2.jpeg" height="130px" width="200px">
                    <div class="parentjobhead">
                        <div class="jobhead">
                            <div class="jobtitle">
                                <p style="font-size: 22px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: 600;">Customer Service Representative</p>
                            </div>
                            <div class="job date">
                                <p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: grey;">June 5, 2023</p>
                            </div>
                        </div>
                        <div class="jobdesc">
                            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                Assists customers with inquiries and provides excellent service.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="posting1">
                    <img class="jobimg" src="../Img/job3.jpeg" height="130px" width="200px">
                    <div class="parentjobhead">
                        <div class="jobhead">
                            <div class="jobtitle">
                                <p style="font-size: 22px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: 600;">Marketing Specialist</p>
                            </div>
                            <div class="job date">
                                <p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: grey;">June 5, 2023</p>
                            </div>
                        </div>
                        <div class="jobdesc">
                            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                Executes marketing campaigns and analyzes performance metrics. </p>
                        </div>
                    </div>
                </div>
                <div class="posting1">
                    <img class="jobimg" src="../Img/job1.jpeg" height="130px" width="200px">
                    <div class="parentjobhead">
                        <div class="jobhead">
                            <div class="jobtitle">
                                <p style="font-size: 22px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: 600;">Software Developer</p>
                            </div>
                            <div class="job date">
                                <p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: grey;">June 5, 2023</p>
                            </div>
                        </div>
                        <div class="jobdesc">
                            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                Develops and maintains software applications for various platforms. </p>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="midright">
            <div class="midpart">
            </div>
        </div>
        <div class="tablepanel">
            <div>
                <p style="font-size: 22px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: 600;">Your Profile</p>
            </div>
            <div class="profile">
                <p><span class="label">Name:</span> <?php echo $candidate['FName'] . $candidate['LName']; ?></p>
                <p><span class="label">Education:</span> <?php echo $candidate['EducationLevel']; ?></p>
                <p><span class="label">Research Experience:</span> <?php echo $candidate['R_Experience']; ?></p>
                <p><span class="label">Publications:</span> <?php echo $candidate['Publications']; ?></p>
                <p><span class="label">Personal Statement:</span> <?php echo $candidate['Personal_Statement']; ?></p>
                <p><span class="label">Contact Information:</span> <?php echo $candidate['Contact']; ?></p>
                <p><span class="label">Resume/CV:</span> <?php echo $candidate['Resume']; ?></p>
                <p><span class="label">Cover Letter:</span> Cover_Letter.pdf</p>
                <p><span class="label">Academic Record:</span> Transcript.pdf</p>
                <br> </br>
                <p><span class="label"><a href="edit_profile.php"><button class="btn">Edit Profile</button></a></span>

            </div>

            <div style="padding-left: 15%;" class="bottomtable">
                <?php

                // Query to fetch data from jobs and applications table
                $sqlStatus = "SELECT j.UnivName, j.JobID, a.Status,a.ApplicationID
                                 FROM Jobs j JOIN Applications a ON j.JobID = a.JobID
        WHERE a.CandidateID='$userID'";


                $result = mysqli_query($conn, $sqlStatus);

                // Check if the query was successful
                if (!$result) {
                    echo "Error fetching data: " . mysqli_error($conn);
                } else {
                    // Display the data in a table
                    echo '<table border="1px">
          <thead>
            <tr><th>Application ID</th>
        
              <th>University</th>
               <th>Job ID</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        // Get the University Name using UniversityID from the "jobs" table
                        $universityName = $row['UnivName'];
                        // $universityQuery = "SELECT UniversityName FROM University WHERE UnivID = '$universityID'";
                        // $universityResult = mysqli_query($conn, $universityQuery);
                        // $universityName = mysqli_fetch_assoc($universityResult)['UniversityName'];

                        echo '<tr>';
                        echo '<td>' . $row['ApplicationID']  . '</td>';
                        echo '<td>' . $row['UnivName'] . '</td>';
                        echo '<td>' . $row['JobID'] . '</td>';

                        echo '<td>' . $row['Status'] . '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody></table>';
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
                <!-- <table border="1px">
                    <thead>
                        <tr>
                            <th>University</th>
                            <th>Application ID</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Arizona State University</td>
                            <td>Associate Professor</td>
                            <td>Rejected</td>
                        </tr>
                        <tr>
                            <td>Texas State University</td>
                            <td>Senior Lecturer</td>
                            <td>Applied</td>
                        </tr>
                        <tr>
                            <td>California State University</td>
                            <td>Visiting Professor</td>
                            <td>Accepted</td>
                        </tr>
                    </tbody>
                </table> -->
            </div>
        </div>
    </div>
</body>
<div class="footer">
    <p class="footer-text">&copy; Copyright All rights are reserved</p>
</div>

</html>