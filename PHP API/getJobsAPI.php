<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// Start the session
session_start();


if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

// Database connection parameters

$host = "localhost:3306";
$username = "nxp7046_root2";
$password = "WdmFall2023";
$dbname = "nxp7046_urmapp";


try {

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    // Database connection failed, respond with an error message

    $response = array('status' => 'error', 'message' => 'Database connection failed: ' . $e->getMessage());
    http_response_code(500); // Internal Server Error
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;

}

// Initialize $searchQuery with an empty value
$searchQuery = "";

// Check if the connection was successful



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['searchQuery'])) {
    $searchQuery = '%' . $_GET['searchQuery'] . '%';
    $sql = "SELECT * FROM Jobs WHERE JobTitle LIKE :searchQuery OR Description LIKE :searchQuery";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_STR);
} else {
    // If there is no search query, fetch all job postings
    $sql = "SELECT * FROM Jobs";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);



// Set the appropriate response header for JSON data
header('Content-Type: application/json');

// Create an array to store the job data
$jobsData = array();

$jobsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Encode the data as JSON and send the response
echo json_encode($jobsData);


// Close the database connection

$conn = null;
//header('Content-Type: application/json');
//echo  json_encode($response);
// Exit the script to prevent further execution
exit();