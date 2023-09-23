<?php
session_start();

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

// // Fetch data from the database
// $sql = "SELECT * FROM Users WHERE Status = 'In Review'";
// $result = mysqli_query($conn, $sql);

// // Generate the HTML table with the fetched data
// echo '<div class="tablediv div-2">';
// echo '<div class="card">';
// echo '<h2>User Registrations</h2>';
// echo '<br>';
// echo '<br>';
// echo '<table class="user-table">';
// echo '<tr>';
// echo '<th>User ID</th>';
// echo '<th>Email</th>';
// echo '<th>User Role</th>';
// echo '<th>Status</th>';
// echo '<th>Action</th>';
// echo '</tr>';

// while ($row = mysqli_fetch_assoc($result)) {
//     echo '<tr>';
//     echo '<td>' . $row['UserID'] . '</td>';
//     echo '<td>' . $row['Email'] . '</td>';
//     echo '<td>' . $row['UserRole'] . '</td>';
//     echo '<td>' . $row['Status'] . '</td>';
//     echo '<td><button class="approve-btn">Approve</button></td>';
//     echo '</tr>';
// }

// echo '</table>';
// echo '</div>';
// echo '</div>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="CSS\admindashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="panel1">
        <div class="nav">
            <a class="navtext">URM Application</a>
            <a class="navtext" href="AdminDashboard.php">Dashboard</a>
            <a class="navtext" href="user_registrations.html">User Registrations</a>
            <a class="navtext" href="report.html">Reports</a>
            <a class="navtext" href="logout.php">Logout</a>
        </div>
        <div class="secbar">
            <h1>Admin Dashboard</h1>
        </div>
    </div>

    <div class="partdiv">
        <div class="partition">
        </div>
    </div>

    <div class="panel2">
        <div>
            <h3>Welcome, Admin</h3>
        </div>
        <div class="panel2right">
            <div class="chatbag">
                <p>💬</p>
            </div>
            <div class="panel2subright">
                <p style="margin-right: 10px; font-size: 15px;">🔍</p>
                <input type="text" placeholder="Search">
            </div>
        </div>
    </div>
    <!-- <div class="panel3">
        <p class = "copyright">Copyright © All rights are reserved</p>
    </div> -->
    <div class="midpanel" class="display-inline">
        <div class="row">
            <div class="midleft div-2">

                <!-- <add stats graph> -->
                <div class="">
                    <h2>Jobs and Application Stats</h2>
                    <br>
                    <br>
                    <div class="posting1">

                        <div class="dashboard-info">
                            <div class="info-box">
                                <h3>Number of Postings</h3>
                                <p>100</p>
                            </div>
                            <div class="info-box">
                                <h3>Status of Applications</h3>
                                <p>75</p>
                            </div>
                            <div class="info-box">
                                <h3>New URM Candidates</h3>
                                <p>30</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div>
                    <img class="card-image" src="../Img/graph.png" alt="graph">
                </div>
            </div>

            <!--Add Image Here  -->
            <div class="tablediv div-2">
                <div class="card">
                    <h2>User Registrations</h2>
                    <br>
                    <br>
                    <table class="user-table">
                        <tr>
                            <th>UserID</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        // Fetch data from the database
                        $sql = "SELECT * FROM Users WHERE Status = 'In Review'";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['UserID'] . '</td>';
                            echo '<td>' . $row['Email'] . '</td>';
                            echo '<td>' . $row['UserRole'] . '</td>';
                            echo '<td>' . $row['Status'] . '</td>';
                            echo '<td><a href="user_details.php?id=' . $row['UserID'] . '">View Details</a></td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="div-2">
                    <div class="card">
                        <br>
                        <br>
                        <h2>User Issues</h2><br><br>
                        <table class="user-table">
                            <tr>
                                <th>Ticket Number</th>
                                <th>Issue Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>INC12345</td>
                                <td>Website gateway error</td>
                                <td>Assigned</td>
                                <td><button class="approve-btn">Start Work</button></td>
                            </tr>
                            <tr>
                                <td>INC54322</td>
                                <td>Page is taking longer time to load</td>
                                <td>Resolved</td>
                                <td><button class="approve-btn" disabled>Resolve</button></td>
                            </tr>
                            <tr>
                                <td>INC54325</td>
                                <td>Not able to upload documents</td>
                                <td>In Progress</td>
                                <td><button class="approve-btn">Resolve</button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



    </div>
    <div class="footer">
        <p class="footer-text">&copy; Copyright All rights are reserved 2023</p>
    </div>
</body>

</html>