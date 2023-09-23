<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

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

$userID = $_SESSION['userID'];
$sqlProfile = "SELECT * FROM URM_Candidate WHERE CandidateID='$userID'";
$resultProfile = mysqli_query($conn, $sqlProfile);
$candidate = mysqli_fetch_assoc($resultProfile);
echo " pre post";
// Check if the form has been submitted for updating the profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo " post";
    // Fetch and sanitize the form data (you can add more fields here)
    $educationLevel = mysqli_real_escape_string($conn, $_POST['educationLevel']);
    $researchExperience = mysqli_real_escape_string($conn, $_POST['researchExperience']);
    $publications = mysqli_real_escape_string($conn, $_POST['publications']);
    $personalStatement = mysqli_real_escape_string($conn, $_POST['personalStatement']);
    echo " post1";
    $folder_path = 'downloads/';
    $filename = basename($_FILES['file']['name']);
    $newname = $folder_path . $filename;
    echo  $filename;
    echo '----------';
    echo  $newname;

    //isset($_FILES['file']["tmp_name"]) && 
    // Handle the uploaded resume
    if (($_FILES["file"]["type"] == 'application/pdf')) {
        // Update the profile information in the database
        echo 'resume if';
        // Get the temporary location of the uploaded resume
        // $file_name =  $_FILES['file']['name'];
        // $file_tmp = $_FILES['file']['tmp_name'];

        // move_uploaded_file($_FILES['file']['tmp_name'], $newname);
        // Read the contents of the resume
        // $resumeContent = file_get_contents($resumeTmpFilePath);
        $updateProfileQuery = "UPDATE URM_Candidate SET EducationLevel=?, R_Experience=?, Publications=?, Personal_Statement=?, Resume=? WHERE CandidateID=?";

        $stmt = mysqli_prepare($conn, $updateProfileQuery);

        // Bind the parameters to the prepared statement, using 'b' for binary data
        mysqli_stmt_bind_param($stmt, 'ssssbs', $educationLevel, $researchExperience, $publications, $personalStatement, $filename, $userID);
        if (mysqli_stmt_execute($stmt)) {
            echo 'stmt';
            // Redirect to the profile page after successful update
            header("Location: CandidateDashboard.php");
            exit();
        } else {
            echo "hi";
            // Handle the error scenario as per your requirement (e.g., display an error message)
            $errorMessage = "Error updating profile: " . mysqli_error($conn);
        }
    } else {
        echo 'no resume';
        $updateProfileQuery = "UPDATE URM_Candidate SET EducationLevel=?, R_Experience=?, Publications=?, Personal_Statement=? WHERE CandidateID=?";

        $stmt = mysqli_prepare($conn, $updateProfileQuery);

        // Bind the parameters to the prepared statement, using 'b' for binary data
        mysqli_stmt_bind_param($stmt, 'sssss', $educationLevel, $researchExperience, $publications, $personalStatement, $userID);
        if (mysqli_stmt_execute($stmt)) {
            echo 'stmt';
            // Redirect to the profile page after successful update
            // header("Location: CandidateDashboard.php");
            exit();
        } else {
            echo "hi";
            // Handle the error scenario as per your requirement (e.g., display an error message)
            $errorMessage = "Error updating profile: " . mysqli_error($conn);
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="CSS\CandidateDashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>
    <div class="panel1">
        <!-- Header and Navigation code -->
        <!-- ... -->
    </div>

    <div class="midpanel">
        <div class="midleft">
            <div class="edit-profile-form">
                <h2>Edit Your Profile</h2>
                <?php
                if (isset($errorMessage)) {
                    echo '<p style="color: red;">' . $errorMessage . '</p>';
                }
                ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <label>Education Level:</label>
                    <input type="text" name="educationLevel" value="<?php echo $candidate['EducationLevel']; ?>" required>
                    <br />
                    <label>Research Experience(Please provide your years of experience with Research field ):</label>

                    <br /> <textarea name="researchExperience" required><?php echo $candidate['R_Experience']; ?></textarea>

                    <br />

                    <label>Publications:</label>

                    <textarea name="publications" required><?php echo $candidate['Publications']; ?></textarea>
                    <br />

                    <label>Personal Statement:</label>
                    <textarea name="personalStatement" required><?php echo $candidate['Personal_Statement']; ?></textarea>
                    <br />
                    <label>Upload Resume:</label>

                    <!-- <form method="post" action="upload.php" enctype="multipart/form-data"> -->
                    <!-- Your form elements here -->

                    <input type="file" name="file" />
                    <!-- <button type="submit">Save Changes</button> -->
                    <!-- <input type="submit" value="Upload Resume" name="submit" /> -->
                    <!-- </form> -->


                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </div>
        <div class="midright">
            <!-- Content for the right panel of the dashboard (if any) -->
            <!-- ... -->
        </div>
        <!-- ... -->
    </div>
    <!-- ... -->
</body>

</html>