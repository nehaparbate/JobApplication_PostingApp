<?php
session_start();
echo 'hell1';
// if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
//   header("Location: login.php");
//   exit();
// }
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
if (isset($_POST['signup'])) {
    $_SESSION['x'] = $_POST['firstname'];
    // Retrieve the values from the form submission
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userRole = $_POST['role'];
    // You can set a default role for new users

    // Generate the user ID by combining the first letter of the user role with a random 2-digit number
    $firstLetter = strtoupper(substr($userRole, 0, 1));
    $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
    $generatedUserId = $firstLetter . $randomNumber;

    // Check if the generated user ID already exists in the database
    $checkUserIdQuery = "SELECT * FROM Users WHERE UserID = '$generatedUserId'";
    $userIdResult = mysqli_query($conn, $checkUserIdQuery);

    // If the generated user ID exists, modify it by adding first letter of first name and last letter of last name
    if (mysqli_num_rows($userIdResult) > 0) {
        $generatedUserId = strtoupper(substr($firstname, 0, 1)) . substr($lastname, -1);
    }

    // Check if the email is already registered in the database
    $checkEmailQuery = "SELECT * FROM Users WHERE Email = '$email'";
    $emailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($emailResult) > 0) {
        // Email is already registered
        echo "Email is already registered. Please use a different email.";
    } else {
        // Email is not registered, proceed with sign-up
        $insertQuery = "INSERT INTO Users (UserID, UserRole, Email, Password) VALUES ('$generatedUserId',  '$userRole', '$email', '$password')";
        if (mysqli_query($conn, $insertQuery)) {
            // Sign-up successful, send confirmation email
            $to = $email;
            $subject = "Welcome to URM Application";
            $message = "Dear User,\n\nThank you for signing up on URM Application. Your account has been successfully created.\n\nBest regards,\nURM Application Team";
            $nodePath = "/usr/local/bin/node"; // Replace this with the path to your Node.js executable
            $scriptPath = "JS/triggerMail.js";
            // Call the Node.js function to send the email
            $cmd = "{$nodePath} {$scriptPath} " . escapeshellarg($to) . " " . escapeshellarg($subject) . " " . escapeshellarg($message);
            exec($cmd, $output, $returnCode);


            if ($returnCode === 0) {
                echo "Sign-up successful! You can now log in with your credentials. A confirmation email has been sent to your email address.";
            } else {
                echo 'email';
                echo $returnCode;
                // Sign-up failed, show error message
                echo "Sign-up failed. Please try again later.";
            }
        }
    }
} else {
    echo 'last';
    // Sign-up failed, show error message
    echo "Sign-up failed. Please try again later.";
}
echo 'hell2';

// if (isset($_POST['signup'])) {
//   echo 'first success';
//   $userRole = $_POST['role'];
//   $email = $_POST['email'];
//   $password = $_POST['password'];

//   if ($userRole === "URM Candidate") {
//     $cfirstname = $_POST['cfirstname'];
//     $clastname = $_POST['clastname'];
//     $education = $_POST['education'];
//     $research_experience = $_POST['research_experience'];
//     $nationality = $_POST['nationality'];
//     $ethincity = $_POST['ethincity'];
//     // Generate the user ID by combining the first letter of the user role with a random 2-digit number
//     $firstLetter = strtoupper(substr($userRole, 0, 1));
//     $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
//     $generatedUserId = $firstLetter . $randomNumber;

//     // Check if the generated user ID already exists in the database
//     $checkUserIdQuery = "SELECT * FROM URM_Candidate WHERE CandidateID = '$generatedUserId'";
//     $userIdResult = mysqli_query($conn, $checkUserIdQuery);

//     // If the generated user ID exists, modify it by adding first letter of first name and last letter of last name
//     if (mysqli_num_rows($userIdResult) > 0) {
//       $generatedUserId = strtoupper(substr($firstname, 0, 1)) . substr($lastname, -1);
//     }

//     // Check if the email is already registered in the database
//     $checkEmailQuery = "SELECT * FROM URM_Candidate WHERE Email = '$email'";
//     $emailResult = mysqli_query($conn, $checkEmailQuery);
//     if (mysqli_num_rows($emailResult) > 0) {
//       // Email is already registered
//       echo "Email is already registered. Please use a different email.";
//     } else {
//       // Email is not registered, proceed with sign-up
//       // Insert data into URM_Candidate table
//       $insertCandidateQuery = "INSERT INTO URM_Candidate (CandidateID, FName, LName, Email, Password, Nationality, Ethnicity, Education, Research_Experience) VALUES ('$generatedUserId', '$cfirstname', '$clastname', '$email', '$password', '$nationality', '$ethincity', '$education', '$research_experience')";
//       if (mysqli_query($conn, $insertCandidateQuery)) {
//         // Sign-up successful, send confirmation email
//         $to = $email;
//         $subject = "Welcome to URM Application";
//         $message = "Dear User,\n\nThank you for signing up on URM Application. Your account has been successfully created.\n\nBest regards,\nURM Application Team";
//         $nodePath = "/usr/local/bin/node"; // Replace this with the path to your Node.js executable
//         $scriptPath = "JS/triggerMail.js";
//         // Call the Node.js function to send the email
//         $cmd = "{$nodePath} {$scriptPath} " . escapeshellarg($to) . " " . escapeshellarg($subject) . " " . escapeshellarg($message);
//         exec($cmd, $output, $returnCode);


//         if ($returnCode === 0) {
//           echo "Sign-up successful! You can now log in with your credentials. A confirmation email has been sent to your email address.";
//         } else {
//           echo 'email';
//           echo $returnCode;
//           // Sign-up failed, show error message
//           echo "Sign-up failed. Please try again later.";
//         }
//       }
//     }

//     //   ??-------

//   } elseif ($userRole === "University") {
//     $universityName = $_POST['university'];


//     $firstLetter = strtoupper(substr($userRole, 0, 1));
//     $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
//     $generatedUserId = $firstLetter . $randomNumber;

//     // Check if the generated user ID already exists in the database
//     $checkUserIdQuery = "SELECT * FROM University WHERE UnivID = '$generatedUserId'";
//     $userIdResult = mysqli_query($conn, $checkUserIdQuery);

//     // If the generated user ID exists, modify it by adding first letter of first name and last letter of last name
//     if (mysqli_num_rows($userIdResult) > 0) {
//       $generatedUserId = strtoupper(substr($firstname, 0, 1)) . substr($lastname, -1);
//     }

//     // Check if the email is already registered in the database
//     $checkEmailQuery = "SELECT * FROM University WHERE Email = '$email'";
//     $emailResult = mysqli_query($conn, $checkEmailQuery);
//     if (mysqli_num_rows($emailResult) > 0) {
//       // Email is already registered
//       echo "Email is already registered. Please use a different email.";
//     } else {
//       $insertUniversityQuery = "INSERT INTO University (UnivID, UniversityName, Email, Password) VALUES ('$generatedUserId', '$universityName', '$email', '$password')";
//       if (mysqli_query($conn, $insertinsertUniversityQueryQuery)) {
//         // Sign-up successful, send confirmation email
//         $to = $email;
//         $subject = "Welcome to URM Application";
//         $message = "Dear User,\n\nThank you for signing up on URM Application. Your account has been successfully created.\n\nBest regards,\nURM Application Team";
//         $nodePath = "/usr/local/bin/node"; // Replace this with the path to your Node.js executable
//         $scriptPath = "JS/triggerMail.js";
//         // Call the Node.js function to send the email
//         $cmd = "{$nodePath} {$scriptPath} " . escapeshellarg($to) . " " . escapeshellarg($subject) . " " . escapeshellarg($message);
//         exec($cmd, $output, $returnCode);


//         if ($returnCode === 0) {
//           echo "Sign-up successful! You can now log in with your credentials. A confirmation email has been sent to your email address.";
//         } else {
//           echo 'email';
//           echo $returnCode;
//           // Sign-up failed, show error message
//           echo "Sign-up failed. Please try again later.";
//         }
//       }
//     }

//     /////..........


//   } elseif ($userRole === "Recruiter") {
//     $rfirstname = $_POST['rfirstname'];
//     $rlastname = $_POST['rlastname'];

//     $firstLetter = strtoupper(substr($userRole, 0, 1));
//     $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
//     $generatedUserId = $firstLetter . $randomNumber;

//     // Check if the generated user ID already exists in the database
//     $checkUserIdQuery = "SELECT * FROM Recruiter WHERE RID = '$generatedUserId'";
//     $userIdResult = mysqli_query($conn, $checkUserIdQuery);

//     // If the generated user ID exists, modify it by adding first letter of first name and last letter of last name
//     if (mysqli_num_rows($userIdResult) > 0) {
//       $generatedUserId = strtoupper(substr($firstname, 0, 1)) . substr($lastname, -1);
//     }

//     // Check if the email is already registered in the database
//     $checkEmailQuery = "SELECT * FROM Recruiter WHERE Email = '$email'";
//     $emailResult = mysqli_query($conn, $checkEmailQuery);
//     if (mysqli_num_rows($emailResult) > 0) {
//       // Email is already registered
//       echo "Email is already registered. Please use a different email.";
//     } else {
//       $insertRecQuery = "INSERT INTO Recruiter (RID, FName,LName, Email, Password) VALUES ('$generatedUserId', '$rfirstname','$rlastname', '$email', '$password')";
//       if (mysqli_query($conn, $insertRecQuery)) {
//         // Sign-up successful, send confirmation email
//         $to = $email;
//         $subject = "Welcome to URM Application";
//         $message = "Dear User,\n\nThank you for signing up on URM Application. Your account has been successfully created.\n\nBest regards,\nURM Application Team";
//         $nodePath = "/usr/local/bin/node"; // Replace this with the path to your Node.js executable
//         $scriptPath = "JS/triggerMail.js";
//         // Call the Node.js function to send the email
//         $cmd = "{$nodePath} {$scriptPath} " . escapeshellarg($to) . " " . escapeshellarg($subject) . " " . escapeshellarg($message);
//         exec($cmd, $output, $returnCode);


//         if ($returnCode === 0) {
//           echo "Sign-up successful! You can now log in with your credentials. A confirmation email has been sent to your email address.";
//         } else {
//           echo 'email';
//           echo $returnCode;
//           // Sign-up failed, show error message
//           echo "Sign-up failed. Please try again later.";
//         }
//       }
//     }
//   } elseif ($userRole === "DEI Officer") {
//     $dfirstname = $_POST['dfirstname'];
//     $dlastname = $_POST['dlastname'];

//     $firstLetter = strtoupper(substr($userRole, 0, 1));
//     $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
//     $generatedUserId = $firstLetter . $randomNumber;

//     // Check if the generated user ID already exists in the database
//     $checkUserIdQuery = "SELECT * FROM DEI_Officer WHERE DEI_ID = '$generatedUserId'";
//     $userIdResult = mysqli_query($conn, $checkUserIdQuery);

//     // If the generated user ID exists, modify it by adding first letter of first name and last letter of last name
//     if (mysqli_num_rows($userIdResult) > 0) {
//       $generatedUserId = strtoupper(substr($firstname, 0, 1)) . substr($lastname, -1);
//     }

//     // Check if the email is already registered in the database
//     $checkEmailQuery = "SELECT * FROM DEI_Officer WHERE Email = '$email'";
//     $emailResult = mysqli_query($conn, $checkEmailQuery);
//     if (mysqli_num_rows($emailResult) > 0) {
//       // Email is already registered
//       echo "Email is already registered. Please use a different email.";
//     } else {
//       $insertDEIQuery = "INSERT INTO RecruDEI_Officeriter (DEI_ID, FName,LName, Email, Password) VALUES ('$generatedUserId', '$dfirstname','$dlastname', '$email', '$password')";
//       if (mysqli_query($conn, $insertDEIQuery)) {
//         // Sign-up successful, send confirmation email
//         $to = $email;
//         $subject = "Welcome to URM Application";
//         $message = "Dear User,\n\nThank you for signing up on URM Application. Your account has been successfully created.\n\nBest regards,\nURM Application Team";
//         $nodePath = "/usr/local/bin/node"; // Replace this with the path to your Node.js executable
//         $scriptPath = "JS/triggerMail.js";
//         // Call the Node.js function to send the email
//         $cmd = "{$nodePath} {$scriptPath} " . escapeshellarg($to) . " " . escapeshellarg($subject) . " " . escapeshellarg($message);
//         exec($cmd, $output, $returnCode);


//         if ($returnCode === 0) {
//           echo "Sign-up successful! You can now log in with your credentials. A confirmation email has been sent to your email address.";
//         } else {
//           echo 'email';
//           echo $returnCode;
//           // Sign-up failed, show error message
//           echo "Sign-up failed. Please try again later.";
//         }
//       }
//     }
//   }
// } else {
//   echo 'last';
//   // Sign-up failed, show error message
//   echo "Sign-up failed. Please try again later.";
// }



?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="CSS/SignupCandidate.css" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>URM Application</title>
</head>

<body>
    <nav class="navbar background">
        <ul class="nav-list">
            <div class="urm">URM Application</div>
            <li><a href="Home.html">Home</a></li>
            <li><a href="About.html">About</a></li>
            <li><a href="Services.html">Services</a></li>
            <li><a href="Contact.html">Contact Us</a></li>
            <li><a href="Login.html">Login/SignUp</a></li>
        </ul>
    </nav>
    <section id="main-section">
        <div class="main-content">
            <div class="card">
                <div class="signup-container">
                    <h4 class="signup-title">Create an Account</h4>
                    <form method="post">
                        <div class="signup-input">
                            <select id="role" name="role" required>
                                <option value=" " selected disabled>Select Role</option>
                                <option value="urm-candidate">URM Candidate</option>
                                <option value="university">University</option>
                                <option value="recruiter">Recruiter</option>
                                <option value="dei officer">DEI Officer</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <!-- <div class="signup-input" id="urm-candidate"> -->

                        <div class="signup-input">
                            <input type="text" id="firstname" name="firstname" placeholder="First Name" required />
                        </div>
                        <div class="signup-input">
                            <input type="text" id="lastname" name="lastname" placeholder="Last Name" required />
                        </div>
                        <!-- <div class="signup-input">
                <input type="text" id="username" name="username" placeholder="Username" required />
              </div> -->
                        <div class="signup-input">
                            <input type="text" id="education" name="education" placeholder="Education" required />
                        </div>
                        <div class="signup-input">
                            <input type="text" id="research experience" name="research experience" placeholder="Research Experience" required />
                        </div>

                        <div class="signup-input">
                            <input type="text" id="nationality" name="nationality" placeholder="Nationality" required />
                        </div>
                        <div class="signup-input">
                            <input type="text" id="ethincity" name="ethincity" placeholder="Ethincity" required />
                        </div>
                        <div class="signup-input">
                            <input type="email" id="email" name="email" placeholder="Email" required />
                        </div>
                        <div class="signup-input">
                            <input type="password" id="password" name="password" placeholder="Password" required />
                        </div>

                        <div class="signup-input">
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required />
                        </div>

                        <button type="submit" name="signup">Signup</button>


                        <!-- <div class="signup-input">
              <input type="email" id="email" name="email" placeholder="Email" required />
            </div>
            <div class="signup-input">
              <input type="password" id="password" name="password" placeholder="Password" required />
            </div>

            <div class="signup-input">
              <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required />
            </div>

            <button type="submit" name="signup">Signup</button> -->

                        <!-- <script>
              function redirectToLogin() {
                window.location.href = " login.php"; } </script> -->
                    </form>
                    <div class="login-account">
                        <a href="Login.html">Already have an account? Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <p class="text-footer">&copy; Copyright All rights are reserved</p>
    </footer>
    <script src="JS/Role.js"></script>
</body>

</html>