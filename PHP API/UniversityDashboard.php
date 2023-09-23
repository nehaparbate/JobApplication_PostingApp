<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "Naruto@123";
$dbname = "UrmApp";
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
  // Redirect the user back to the login page or any other appropriate action
  header("Location: login.php");
  exit();
}

$userID = $_SESSION['userID'];
// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sqlStatus = "SELECT UniversityName FROM University WHERE UnivID='$userID'";
// ... (your existing code)

$result = mysqli_query($conn, $sqlStatus);

// Check if the query was successful
if (!$result) {
  echo "Error fetching data: " . mysqli_error($conn);
} else {
  // Fetch the data from the result set
  $row = mysqli_fetch_assoc($result);
  // Assign the UniversityName to the session variable
  $_SESSION['universityName'] = $row['UniversityName'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="CSS/DashboardAcademia.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard1</title>
</head>

<body>
  <div class="panel1">
    <!-- <div class="topbar">
            <div class="topleft">
                <h2>URM APPLICATION</h2>
                <img class="pfp" src = "urm.png" height="30px" width="30px">
            </div>
            <div class="topright">
                <a href="dashboard1.html" style="text-decoration: none; color: black; font-family: monospace;">Profile</a>
                <a href="dashboard1.html" style="text-decoration: none; color: black; font-family: monospace;">Home</a>
                <a href="dashboard1.html" style="text-decoration: none; color: black; font-family: monospace;">About</a>
                <a href="dashboard1.html" style="text-decoration: none; color: black; font-family: monospace;">Services</a>
                <a href="dashboard1.html" style="text-decoration: none; color: black; font-family: monospace;">Contact</a>
                <a href="dashboard1.html" style="text-decoration: none; color: black; font-family: monospace;">Logout</a>
            </div>
        </div> -->
    <div class="nav">
      <a class="navtext" href="#">URM Application</a>
      <a class="navtext" href="edit_profile_univ.php">Profile</a>
      <a class="navtext" href="DashboardAcademia.html">Home</a>
      <a class="navtext" href="About.html">About</a>
      <a class="navtext" href="Services.html">Services</a>
      <a class="navtext" href="Contact.html">Contact Us</a>
      <a class="navtext" href="login.php">Log Out</a>
    </div>
    <div class="secbar">
      <h1>Academia Dashboard</h1>
    </div>
  </div>
  <div class="partdiv">
    <div class="partition"></div>
  </div>
  <div class="panel2">
    <div>
      <h3>Welcome, XYZ University</h3>
    </div>
    <div class="panel2right">
      <div class="chatbag">
        <p>💬</p>
      </div>
      <div class="panel2subright">
        <p style="margin-right: 10px; font-size: 15px">🔍</p>
        <input type="text" placeholder="Search" />
      </div>
    </div>
  </div>
  <!-- <div class="panel3">
        <p class = "copyright">Copyright © All rights are reserved</p>
    </div> -->
  <div class="midpanel">
    <div class="midleft">
      <div class="midlefttop">
        <div class="button">
          <!-- <a href="PostJob.php">Post a Job</a> -->
          <a href="PostJob.php"> <button type="button"> Post a Job</button></a>

        </div>
        <div class="button">
          <button type="button">Total No of Postings ></button>
        </div>
        <div class="button">
          <button type="button">Total Candidates ></button>
        </div>
      </div>
      <!-- <div class="postingpanel">
        <div class="posting1">
          <img class="jobimg" src="../Img/job4.jpeg" height="130px" width="200px" />
          <div class="parentjobhead">
            <div class="jobhead">
              <div class="jobtitle">
                <p style="
                      font-size: 22px;
                      font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                        'Trebuchet MS', sans-serif;
                      font-weight: 600;
                    ">
                  Software Engineer
                </p>
              </div>
              <div class="job date">
                <p style="
                      font-size: 16px;
                      font-family: Cambria, Cochin, Georgia, Times,
                        'Times New Roman', serif;
                      color: rgb(0, 0, 0);
                    ">
                  June 5, 2023
                </p>
              </div>
            </div>
            <div class="jobdesc">
              <p style="
                    font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                      'Trebuchet MS', sans-serif;
                  ">
                Develops and maintains software applications for various platforms. </p>

              </p>
            </div>
          </div>
        </div>
        <div class="posting1">
          <img class="jobimg" src="../Img/job2.jpeg" height="130px" width="200px" />
          <div class="parentjobhead">
            <div class="jobhead">
              <div class="jobtitle">
                <p style="
                      font-size: 22px;
                      font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                        'Trebuchet MS', sans-serif;
                      font-weight: 600;
                    ">
                  Marketing Specialist
                </p>
              </div>
              <div class="job date">
                <p style="
                      font-size: 16px;
                      font-family: Cambria, Cochin, Georgia, Times,
                        'Times New Roman', serif;
                      color: rgb(0, 0, 0);
                    ">
                  June 5, 2023
                </p>
              </div>
            </div>
            <div class="jobdesc">
              <p style="
                    font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                      'Trebuchet MS', sans-serif;
                  ">
                Executes marketing campaigns and analyzes performance metrics. </p>

              </p>
            </div>
          </div>
        </div>
        <div class="posting1">
          <img class="jobimg" src="../Img/job3.jpeg" height="130px" width="200px" />
          <div class="parentjobhead">
            <div class="jobhead">
              <div class="jobtitle">
                <p style="
                      font-size: 22px;
                      font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                        'Trebuchet MS', sans-serif;
                      font-weight: 600;
                    ">
                  Customer Service Representative
                </p>
              </div>
              <div class="job date">
                <p style="
                      font-size: 16px;
                      font-family: Cambria, Cochin, Georgia, Times,
                        'Times New Roman', serif;
                      color: rgb(0, 0, 0);
                    ">
                  June 5, 2023
                </p>
              </div>
            </div>
            <div class="jobdesc">
              <p style="
                    font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                      'Trebuchet MS', sans-serif;
                  ">
                Assists customers with inquiries and provides excellent service. </p>

              </p>
            </div>
          </div>
        </div>
        <div class="posting1">
          <img class="jobimg" src="../Img/job1.jpeg" height="130px" width="200px" />
          <div class="parentjobhead">
            <div class="jobhead">
              <div class="jobtitle">
                <p style="
                      font-size: 22px;
                      font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                        'Trebuchet MS', sans-serif;
                      font-weight: 600;
                    ">
                  Financial Analyst
                </p>
              </div>
              <div class="job date">
                <p style="
                      font-size: 16px;
                      font-family: Cambria, Cochin, Georgia, Times,
                        'Times New Roman', serif;
                      color: rgb(0, 0, 0);
                    ">
                  June 5, 2023
                </p>
              </div>
            </div>
            <div class="jobdesc">
              <p style="
                    font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                      'Trebuchet MS', sans-serif;
                  ">
                Analyzes financial data and prepares reports for decision-making </p>

              </p>
            </div>
          </div>
        </div>
        <div class="posting1">
          <img class="jobimg" src="../Img/job1.jpeg" height="130px" width="200px" />
          <div class="parentjobhead">
            <div class="jobhead">
              <div class="jobtitle">
                <p style="
                      font-size: 22px;
                      font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                        'Trebuchet MS', sans-serif;
                      font-weight: 600;
                    ">
                  Data Engineer
                </p>
              </div>
              <div class="job date">
                <p style="
                      font-size: 16px;
                      font-family: Cambria, Cochin, Georgia, Times,
                        'Times New Roman', serif;
                      color: rgb(0, 0, 0);
                    ">
                  June 5, 2023
                </p>
              </div>
            </div>
            <div class="jobdesc">
              <p style="
                    font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                      'Trebuchet MS', sans-serif;
                  ">
                Need to bridge the gap between Data Analyst and Data Scientists
              </p>
            </div>
          </div>
        </div> -->

      <div class="posting1">
        <?php
        // Assuming you have already established a database connection
        // Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
        // $connection = mysqli_connect('your_host', 'your_username', 'your_password', 'your_database');
        if (!$conn) {
          die('Database connection failed: ' . mysqli_connect_error());
        }

        // Assuming you have a university ID (replace 'YOUR_UNIVERSITY_ID' with the actual ID)
        $userID1 = $_SESSION['userID'];

        // Fetch job details based on the university ID
        $query = "SELECT * FROM Jobs WHERE UnivID = '$userID1'";
        $result = mysqli_query($conn, $query);

        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            // Get job details from the database
            $jobTitle = $row['JobTitle'];
            $jobDate = $row['Date'];
            $jobDescription = $row['Description'];
            // $jobImage = $row['JobImage']; // Assuming you have a column for the job image file name

            // Generate the HTML for each job posting
            // echo '<div class="posting1">';
            echo '<img class="jobimg" src=" " height="130px" width="200px" />';
            echo '<div class="parentjobhead">';
            echo '<div class="jobhead">';
            echo '<div class="jobtitle">';
            echo '<p style="font-size: 22px; font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif; font-weight: 600;">' . $jobTitle . '</p>';
            echo '</div>';
            echo '<div class="job date">';
            echo '<p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, \'Times New Roman\', serif; color: rgb(0, 0, 0);">' . $jobDate . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<div class="jobdesc">';
            echo '<p style="font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;">' . $jobDescription . '</p>';
            echo '</div>';
            echo '</div>';
            // echo '</div>';
          }
          // Free result set
          mysqli_free_result($result);
        } else {
          echo 'Error in fetching job details: ' . mysqli_error($conn);
        }

        // Close the database connection
        // mysqli_close($conn);
        ?>
      </div>
    </div>
  </div>
  <div class="midright">
    <div class="midpart"></div>
  </div>
  <div class="tablepanel">
    <div ID="univ-section">
      <h1>Welcome to ABC University</h1>
      <br />
      <div class="section">
        <h2>About Us</h2>
        <p>ABC University is a leading institution dedicated to providing high-quality education and fostering academic excellence.</p>
        <p>Our campus offers state-of-the-art facilities, modern infrastructure, and a vibrant learning environment.</p>
      </div>
      <br />
      <div class="section">
        <h2>Academic Programs</h2>
        <p>We offer a diverse range of undergraduate and graduate programs to suit the interests and aspirations of our students.</p>
        <p>Our faculty comprises experienced professionals and scholars who are committed to nurturing student growth.</p>
      </div>
      <br />
      <div class="section">
        <h2>Research & Innovation</h2>
        <p>At ABC University, we encourage research and innovation, and our students have access to cutting-edge research facilities.</p>
        <p>We actively promote interdisciplinary collaborations and provide ample opportunities for research funding.</p>
      </div>
      <br />
      <div class="section">
        <h2>Campus Life</h2>
        <p>Our campus offers a rich student life with various clubs, organizations, and extracurricular activities.</p>
        <p>Students can participate in sports, arts, community service, and many other activities to enrich their university experience.</p>
      </div>
      <br />
      <div class="section">
        <h2>Global Opportunities</h2>
        <p>ABC University fosters global connections and offers study abroad programs in collaboration with prestigious international institutions.</p>
        <p>Our students get exposure to diverse cultures and experiences, preparing them to thrive in a globalized world.</p>
      </div>

    </div>
    <!-- <div class="bottomright"> -->
    <!-- <div class="bottomright1">
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
                font-weight: 600;
                font-size: 20px;
              ">
          Applications (6)
        </p>
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
                font-weight: 600;
                font-size: 20px;
              ">
          Status
        </p>
      </div> -->
    <div class="bottomright2">
      <!-- <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Application 1
        </p>
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Pending
        </p> -->

    </div>
    <!-- <div class="bottomright2">
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Application 2
        </p>
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Reviewed
        </p>
      </div>
      <div class="bottomright2">
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Application 3
        </p>
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Declined
        </p>
      </div>
      <div class="bottomright2">
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Application 4
        </p>
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Accepted
        </p>
      </div>
      <div class="bottomright2">
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Application 5
        </p>
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Accepted
        </p>
      </div>
      <div class="bottomright2">

        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Application 6
        </p>
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
              ">
          Reviewed
        </p>
      </div> -->
    <!-- </div> -->
    <?php
    $userID2 = $_SESSION['userID'];

    // Query to fetch the applications for the given universityID
    $sql2 = "SELECT ApplicationID, Status FROM applications WHERE UnivID = '$userID2'";
    $result = mysqli_query($conn, $sql2);

    // Check if the query was successful and if applications exist
    if (mysqli_num_rows($result) > 0) {
      // Display the applications
      echo '<div class="bottomright">';
      echo '<div class="bottomright1">';
      echo '<p style="font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif; font-weight: 600; font-size: 20px;">Applications (' . mysqli_num_rows($result) . ')</p>';
      echo '<p style="font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif; font-weight: 600; font-size: 20px;">Status</p>';
      echo '<p style="font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif; font-weight: 600; font-size: 20px;">Review</p>';

      echo '</div>';

      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="bottomright2">';
        echo '<p style="font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;">Application ' . $row['ApplicationID'] . '</p>';

        echo '<p style="font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;">' . $row['Status'] . '</p>';
        echo '<div class="accept-reject-buttons">';
        echo '<button class="accept-button">Accept</button>';
        echo '<button class="reject-button">Reject</button>';
        echo '</div>';
        echo '</div>';
      }

      echo '</div>'; // Close the 'bottomright' div
    } else {
      // If there are no applications, display a message or handle as needed
      echo '<p>No applications found.</p>';
    }

    // Close the database connection
    // mysqli_close($conn);
    //  } else {
    //      // If universityID is not provided in the URL, display an error or handle as needed
    //      echo '<p>Error: University ID not provided.</p>';
    //  }
    ?>

    <div class="bottomright">
      <div class="bottomright1">
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
                font-weight: 600;
                font-size: 20px;
                margin-right: 50px;
                
              ">
          Jobs (6)
        </p>
        <p style="
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri,
                  'Trebuchet MS', sans-serif;
                font-weight: 600;
                font-size: 20px;
               
                
              ">
          Number of Applications
        </p>
      </div>
      <div class="bottomright2">
        <p class="job-id">JOB1001979</p>
        <p class="num-applications">100</p>
      </div>

      <!-- Job 2 -->
      <div class="bottomright2">
        <p class="job-id">JOB10019792</p>
        <p class="num-applications">200</p>
      </div>

      <!-- Job 3 -->
      <div class="bottomright2">
        <p class="job-id">JOB10019793</p>
        <p class="num-applications">12</p>
      </div>

      <!-- Job 4 -->
      <div class="bottomright2">
        <p class="job-id">JOB10019794</p>
        <p class="num-applications">43</p>
      </div>

      <!-- Job 5 -->
      <div class="bottomright2">
        <p class="job-id">JOB10019795</p>
        <p class="num-applications">16</p>
      </div>

      <!-- Job 6 -->
      <div class="bottomright2">
        <p class="job-id">JOB1001986</p>
        <p class="num-applications">77</p>
      </div>

    </div>
  </div>

  </div>
  </div>
  </div>
  <div class="footer">
    <p class="footer-text">&copy; Copyright All rights are reserved</p>
  </div>
</body>

</html>