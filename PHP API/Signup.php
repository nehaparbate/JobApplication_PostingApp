<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Database connection parameters
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

  $userRole = $_POST['role'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($userRole === "urm-candidate") {
    $cfirstname = $_POST['candidate_firstname'];
    $clastname = $_POST['candidate_lastname'];
    $education = $_POST['education'];
    $researchExperience = $_POST['research_experience'];
    $nationality = $_POST['nationality'];
    $ethnicity = $_POST['ethincity'];

    echo $cfirstname . ',' . $cfirstname;
    // Generate the user ID by combining the first letter of the user role with a random 2-digit number
    $firstLetter = strtoupper(substr('candidate', 0, 1));
    $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
    $generatedUserId = $firstLetter . $randomNumber;

    // Check if the generated user ID already exists in the database
    $checkUserIdQuery = "SELECT * FROM URM_Candidate WHERE CandidateID = '$generatedUserId'";
    $userIdResult = mysqli_query($conn, $checkUserIdQuery);

    // If the generated user ID exists, modify it by adding the first letter of the first name and the last letter of the last name
    if (mysqli_num_rows($userIdResult) > 0) {
      $generatedUserId = strtoupper(substr($cfirstname, 0, 1)) . substr($clastname, -1);
    }

    // Check if the email is already registered in the database
    $checkEmailQuery = "SELECT * FROM URM_Candidate WHERE Email = '$email'";
    $emailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($emailResult) > 0) {
      // Email is already registered
      echo "Email is already registered. Please use a different email.";
    } else {
      // Email is not registered, proceed with sign-up
      // Insert data into URM_Candidate table
      $insertCandidateQuery = "INSERT INTO URM_Candidate (CandidateID, FName, LName, Email, Password, Nationality, Ethnicity, EducationLevel, R_Experience) VALUES ('$generatedUserId', '$cfirstname', '$clastname', '$email', '$password', '$nationality', '$ethnicity', '$education', '$researchExperience')";
      if (mysqli_query($conn, $insertCandidateQuery)) {
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
          // Sign-up failed, show error message
          echo "Sign-up failed. Please try again later.";
        }
      }
    }
  } elseif ($userRole === "university") {
    $universityName = $_POST['university'];
    echo $universityName;

    // Generate the user ID by combining the first letter of the user role with a random 2-digit number
    $firstLetter = strtoupper(substr($userRole, 0, 1));
    $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
    $generatedUserId = $firstLetter . $randomNumber;

    // Check if the generated user ID already exists in the database
    $checkUserIdQuery = "SELECT * FROM University WHERE UnivID = '$generatedUserId'";
    $userIdResult = mysqli_query($conn, $checkUserIdQuery);

    // If the generated user ID exists, modify it by adding the first letter of the first name and the last letter of the last name
    if (mysqli_num_rows($userIdResult) > 0) {
      $generatedUserId = strtoupper(substr($cfirstname, 0, 1)) . substr($clastname, -1);
    }

    // Check if the email is already registered in the database
    $checkEmailQuery = "SELECT * FROM University WHERE Email = '$email'";
    $emailResult = mysqli_query($conn, $checkEmailQuery);
    if (mysqli_num_rows($emailResult) > 0) {
      // Email is already registered
      echo "Email is already registered. Please use a different email.";
    } else {
      // Insert data into University table
      $insertUniversityQuery = "INSERT INTO University (UnivID, UniversityName, Email, Password) VALUES ('$generatedUserId', '$universityName', '$email', '$password')";
      if (mysqli_query($conn, $insertUniversityQuery)) {
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
          // Sign-up failed, show error message
          echo "Sign-up failed. Please try again later.";
        }
      }
    }
  } elseif ($userRole === "recruiter") {
    $rfirstname = $_POST['recruiter_firstname'];
    $rlastname = $_POST['recruiter_lastname'];
    echo $rfirstname . ',' . $rlastname;

    // Generate the user ID by combining the first letter of the user role with a random 2-digit number
    $firstLetter = strtoupper(substr($userRole, 0, 1));
    $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
    $generatedUserId = $firstLetter . $randomNumber;

    // Check if the generated user ID already exists in the database
    $checkUserIdQuery = "SELECT * FROM Recruiter WHERE RID = '$generatedUserId'";
    $userIdResult = mysqli_query($conn, $checkUserIdQuery);

    // If the generated user ID exists, modify it by adding the first letter of the first name and the last letter of the last name
    if (mysqli_num_rows($userIdResult) > 0) {
      $generatedUserId = strtoupper(substr($rfirstname, 0, 1)) . substr($rlastname, -1);
    }

    // Check if the email is already registered in the database
    $checkEmailQuery = "SELECT * FROM Recruiter WHERE Email = '$email'";
    $emailResult = mysqli_query($conn, $checkEmailQuery);
    if (mysqli_num_rows($emailResult) > 0) {
      // Email is already registered
      echo "Email is already registered. Please use a different email.";
    } else {
      // Insert data into Recruiter table
      $insertRecQuery = "INSERT INTO Recruiter (RID, FName, LName, Email, Password) VALUES ('$generatedUserId', '$rfirstname', '$rlastname', '$email', '$password')";
      if (mysqli_query($conn, $insertRecQuery)) {
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
          // Sign-up failed, show error message
          echo "Sign-up failed. Please try again later.";
        }
      }
    }
  } elseif ($userRole === "dei-officer") {
    $dfirstname = $_POST['dei_firstname'];
    $dlastname = $_POST['dei_lastname'];
    echo $dfirstname . ',' . $dlastname;

    // Generate the user ID by combining the first letter of the user role with a random 2-digit number
    $firstLetter = strtoupper(substr($userRole, 0, 1));
    $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
    $generatedUserId = $firstLetter . $randomNumber;

    // Check if the generated user ID already exists in the database
    $checkUserIdQuery = "SELECT * FROM DEI_Officer WHERE DEI_ID = '$generatedUserId'";
    $userIdResult = mysqli_query($conn, $checkUserIdQuery);

    // If the generated user ID exists, modify it by adding the first letter of the first name and the last letter of the last name
    if (mysqli_num_rows($userIdResult) > 0) {
      $generatedUserId = strtoupper(substr($dfirstname, 0, 1)) . substr($dlastname, -1);
    }

    // Check if the email is already registered in the database
    $checkEmailQuery = "SELECT * FROM DEI_Officer WHERE Email = '$email'";
    $emailResult = mysqli_query($conn, $checkEmailQuery);
    if (mysqli_num_rows($emailResult) > 0) {
      // Email is already registered
      echo "Email is already registered. Please use a different email.";
    } else {
      // Insert data into DEI_Officer table
      $insertDEIQuery = "INSERT INTO DEI_Officer (DEI_ID, FName, LName, Email, Password) VALUES ('$generatedUserId', '$dfirstname', '$dlastname', '$email', '$password')";
      if (mysqli_query($conn, $insertDEIQuery)) {
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

          echo '<script>document.getElementById("message").innerHTML = "Sign-up successful! You can now log in with your credentials. A confirmation email has been sent to your email address.";</script>';
          // echo "Sign-up successful! You can now log in with your credentials. A confirmation email has been sent to your email address.";
        } else {
          // Sign-up failed, show error message
          // echo "Sign-up failed. Please try again later.";
          echo '<script>document.getElementById("message").innerHTML = "Sign-up successful! However, there was an error sending the confirmation email. Please contact support for further assistance.";</script>';
        }
      }
    }
  } else {
    echo "Invalid user role. Please select a valid user role.";
  }

  // Close the database connection
  mysqli_close($conn);
}



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
      <li><a href="login.php">Login</a></li>
    </ul>
  </nav>
  <section id="main-section">
    <div class="main-content">
      <div class="card-container">
        <div class="card">
          <div class="signup-container">
            <h4 class="signup-title">Create an Account</h4>
            <div id="message"></div>
            <form method="post" action="">

              <label for="role">I am signing up as:</label>
              <select name="role" id="role">
                <option value="urm-candidate">URM Candidate</option>
                <option value="university">University</option>
                <option value="recruiter">Recruiter</option>
                <option value="dei-officer">DEI Officer</option>
              </select>

              <br />

              <!-- Additional fields for URM Candidate sign-up -->
              <div id="urm-candidate-fields" style="display: none;">
                <label for=" firstname">First Name:</label>
                <input type="text" name="candidate_firstname" id="candidate_firstname">
                <br />
                <label for="lastname">Last Name:</label>
                <input type="text" name="candidate_lastname" id="candidate_lastname">
                <br />
                <label for="education">Education:</label>
                <input type="text" name="education" id="education">
                <br />
                <label for="research_experience">Research Experience:</label>
                <textarea name="research_experience" id="research_experience"></textarea>
                <br />
                <label for="nationality">Nationality:</label>
                <input type="text" name="nationality" id="nationality">
                <br />
                <label for="ethincity">Ethnicity:</label>
                <input type="text" name="ethincity" id="ethincity">
                <br />
              </div>

              <!-- Additional fields for University sign-up -->
              <div id="university-fields" style="display: none;">
                <label for="university">University Name:</label>
                <input type="text" name="university" id="university">
                <br />
              </div>

              <!-- Additional fields for Recruiter sign-up -->
              <div id="recruiter-fields" style="display: none;">
                <label for="firstname">First Name:</label>
                <input type="text" name="recruiter_firstname" id="recruiter_firstname">
                <br />
                <label for="lastname">Last Name:</label>
                <input type="text" name="recruiter_lastname" id="recruiter_lastname">
                <br />
              </div>

              <!-- Additional fields for DEI Officer sign-up -->
              <div id="dei-officer-fields" style="display: none;">
                <label for="firstname">First Name:</label>
                <input type="text" name="dei_firstname" id="dei_firstname">
                <br />
                <label for="lastname">Last Name:</label>
                <input type="text" name="dei_lastname" id="dei_lastname">
                <br />
              </div>

              <label for="email">Email:</label>
              <input type="email" name="email" id="email" required>

              <br />
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" required>
              <br><br>
              <label for="confirm password">Confirm Password:</label>
              <input type="password" name="confirm password" id="confirm password" required>
              <br><br>

              <input type="submit" value="Sign Up">
            </form>

            <div class="login-account">
              <a href="login.php">Already have an account? Login</a>
            </div>
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