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
