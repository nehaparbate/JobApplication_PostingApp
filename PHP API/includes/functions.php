<?php

// Validate user registration inputs
function validate_registration($username, $password, $confirm_password, $email){
    $errors = array();
    // Validate username
    if(empty($username)){
        $errors[] = "Username is required";
    }else{
        if(strlen($username) < 3 || strlen($username) > 20){
            $errors[] = "Username must be between 3 and 20 characters";
        }
        if(!preg_match("/^[a-zA-Z0-9_]+$/", $username)){
            $errors[] = "Username may only contain letters, numbers, and underscores";
        }
    }
    // Validate password
    if(empty($password)){
        $errors[] = "Password is required";
    }else{
        if(strlen($password) < 6 || strlen($password) > 20){
            $errors[] = "Password must be between 6 and 20 characters";
        }
        if($password !== $confirm_password){
            $errors[] = "Passwords do not match";
        }
    }
    // Validate email
    if(empty($email)){
        $errors[] = "Email is required";
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Email is not valid";
        }
    }
    return $errors;
}

// Submit user registration to database
function submit_registration($db, $username, $password, $email){
	$host = 'localhost';
$db_username = 'root';
$db_password = 'Naruto@123';
$database = 'LoanAppData';
// Create a new mysqli object
$conn = new mysqli($host, $db_username, $db_password, $database);
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
   // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
   $stmt->bind_param('sss', $username, $password, $email);
    if($stmt->execute()){
        echo " registered";
        return array('success' => true, 'message' => 'Registration successful');
    }else{
        return array('success' => false, 'message' => 'Registration failed');
    }
}

// Validate user login inputs
function validate_login($username, $password){
    $errors = array();
    // Validate username
    if(empty($username)){
        $errors[] = "Username is required";
    }
    // Validate password
    if(empty($password)){
        $errors[] = "Password is required";
    }
    return $errors;
}

// Authenticate user login credentials
function authenticate_user($db, $email, $password){
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ? and password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1){
    $user = $result->fetch_assoc();
	echo '<p>Password: ' . $password . '</p>';
    print_r($user);

	echo '<p>UserId: ' . $user['user_id'] . '</p>';
    if($password == $user['password']){
        echo '<p>Username: ' . $user['username'] . '</p>';
         
        return array('success' => true, 'user_id' => $user['user_id'], 'username' => $user['username']);
      
    } else {
		return array('success' => false,'message' => 'Incorrect user');
	}
}else{
    return array('success' => false, 'message' => 'User not found');
}

}

// Submit loan application to database
function submit_loan_application($db, $user_id, $loan_amount, $interest_rate, $loan_term){
    $stmt = $db->prepare("INSERT INTO customer (user_id, loan_amount, interest_rate, loan_term) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iddd", $user_id, $loan_amount, $interest_rate, $loan_term);
    if($stmt->execute()){
        return array('success' => true, 'message' => 'Loan application submitted successfully');
}else{
return array('success' => false, 'message' => 'Loan application failed');
}
}

// Retrieve loan applications for a user
// function get_user_loan_applications($db, $user_id){
// $stmt = $db->prepare("SELECT * FROM customer WHERE user_id = ?");
// $stmt->bind_param("i", $user_id);
// $stmt->execute();
// $result = $stmt->get_result();
// $customer = array();
// while($row = $result->fetch_assoc()){
// $customer[] = $row;
// }
// return $customer;
// }

// Retrieve loan applications for a user
function get_all_user_loan_applications(){
    $host = 'localhost';
$db_username = 'root';
$db_password = 'Naruto@123';
$database = 'LoanAppData';
   // Connect to the database
   $conn = new mysqli($host, $db_username, $db_password, $database);

// Check if the connection was successful
if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

// Prepare the SQL statement
$sql = "SELECT * FROM loan_applications";

// Execute the SQL statement
$result = mysqli_query($conn, $sql);
 return $result;

}
function get_all_pending_loan_applications(){
    $host = 'localhost';
    $db_username = 'root';
    $db_password = 'Naruto@123';
    $database = 'LoanAppData';
       // Connect to the database
       $conn = new mysqli($host, $db_username, $db_password, $database);
    
    // Check if the connection was successful
    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    
    // Prepare the SQL statement
    $sql = "SELECT * FROM loan_applications where loan_status='pending' and verification_status='Verified'";
    
    // Execute the SQL statement
    $result = mysqli_query($conn, $sql);
     return $result;
}

function get_user_loan_applications($user_id){
    $host = 'localhost';
    $db_username = 'root';
    $db_password = 'Naruto@123';
    $database = 'LoanAppData';
       // Connect to the database
       $conn = new mysqli($host, $db_username, $db_password, $database);
    
    // Check if the connection was successful
    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    
    // Prepare the SQL statement
    $sql = "SELECT * FROM loan_applications where user_id='$user_id'";
    
    // Execute the SQL statement
    $result = mysqli_query($conn, $sql);
     return $result;
}
// function user_loan_verify(){
//     if(creditScore>750  && propertyAmount>loanAmount){
//         if(Salary*(2*(tenure/12))){
//             Tenure = (Loan Amount / (Annual Income * Loan-to-Income Ratio)) * (1 / (Monthly Interest Rate * 12))


//         }

//     }
// }

function get_all_verify_pending_loan_applications(){
    $host = 'localhost';
    $db_username = 'root';
    $db_password = 'Naruto@123';
    $database = 'LoanAppData';
       // Connect to the database
       $conn = new mysqli($host, $db_username, $db_password, $database);
    
    // Check if the connection was successful
    if(!$conn){
      die("Connection failed: " . mysqli_connect_error());
    }
    
    // Prepare the SQL statement
    $sql = "SELECT * FROM loan_applications where loan_status='pending' and verification_status='Not Verified'";
    
    // Execute the SQL statement
    $result = mysqli_query($conn, $sql);
     return $result;
}
function loanApproval($app_ID){
    $host = 'localhost';
    $db_username = 'root';
    $db_password = 'Naruto@123';
    $database = 'LoanAppData';
    
     // Connect to the database
     $conn = new mysqli($host, $db_username, $db_password, $database);
    
     // Check if the connection was successful
     if(!$conn){
       die("Connection failed: " . mysqli_connect_error());
     }
     
     // Prepare the SQL statement
     $sql = "UPDATE loan_applications
     SET loan_status = 'approved'
     WHERE id = $app_ID;";
     
     // Execute the SQL statement
     $result = mysqli_query($conn, $sql);
      return $result;
}
function loanVerify(){
    $host = 'localhost';
    $db_username = 'root';
    $db_password = 'Naruto@123';
    $database = 'LoanAppData';
}
?>