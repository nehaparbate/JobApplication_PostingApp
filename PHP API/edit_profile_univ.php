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
$sqlProfile = "SELECT * FROM University WHERE UnivID='$userID'";
$resultProfile = mysqli_query($conn, $sqlProfile);
$recruiter = mysqli_fetch_assoc($resultProfile);

// Check if the form has been submitted for updating the profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo " post";
    // // Fetch and sanitize the form data (you can add more fields here)
    // $univName = mysqli_real_escape_string($conn, $_POST['universityname']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    // $personalStatement = mysqli_real_escape_string($conn, $_POST['personalStatement']);

    // // Handle the uploaded resume
    // if (isset($_FILES['resumeFile']) && $_FILES['resumeFile']['error'] === UPLOAD_ERR_OK) {
    //     // Update the profile information in the database

    //     // Get the temporary location of the uploaded resume
    //     $resumeTmpFilePath = $_FILES['resumeFile']['tmp_name'];

    //     // Read the contents of the resume
    //     $resumeContent = file_get_contents($resumeTmpFilePath);
    $updateProfileQuery = "UPDATE University SET Contact=?, Address=? WHERE UnivID=?";

    $stmt = mysqli_prepare($conn, $updateProfileQuery);

    //     // Bind the parameters to the prepared statement, using 'b' for binary data
    mysqli_stmt_bind_param($stmt, 'sss', $contact, $address, $userID);
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to the profile page after successful update
        header("Location: UniversityDashboard.php");
        exit();
    } else {
        echo "hi";
        // Handle the error scenario as per your requirement (e.g., display an error message)
        $errorMessage = "Error updating profile: " . mysqli_error($conn);
    }
    // }
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
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <label>Contact:</label>

                    <br /> <textarea name="contact" required><?php echo $recruiter['Contact']; ?></textarea>

                    <br />

                    <label>Address:</label>

                    <textarea name="address" required><?php echo $recruiter['Address']; ?></textarea>
                    <br />

                    <!-- <label>Personal Statement:</label>
                    <textarea name="personalStatement" required><?php echo $candidate['Personal_Statement']; ?></textarea>
                    <br />
                    <label>Upload Resume:</label>

                    <input type="file" name="resumeFile"> -->
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