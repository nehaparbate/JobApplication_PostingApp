<?php
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
  header("Location: login.php");
  exit();
}
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

// if ($_SESSION['userRole'] !== 'Admin' && $_SESSION['userRole'] !== 'Candidate' && $_SESSION['userRole'] !== 'DEI_Officer' && $_SESSION['userRole'] === 'Recruiter') {
//   // Redirect to a restricted access page if the user doesn't have the required role
//   header("Location: RecruiterDashboard.php");
//   exit();
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="CSS\RecruiterDashboard.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recruiter Dashboard</title>
</head>

<body>
  <div class="panel1">
    <div class="nav">
      <a class="navtext" href="#">URM Application</a>
      <a class="navtext" href="edit_profile_rec.php">Profile</a>
      <a class="navtext" href="RecruiterDashboard.html">Home</a>
      <a class="navtext" href="About.html">About</a>
      <a class="navtext" href="Services.html">Services</a>
      <a class="navtext" href="Contact.html">Contact Us</a>
      <a class="navtext" href="logout.php">Log Out</a>
    </div>
    <div class="secbar">
      <h1>Recruiter Dashboard</h1>
    </div>
  </div>
  <div class="partdiv">
    <div class="partition"></div>
  </div>
  <div class="panel2">
    <div>
      <h3>Welcome, XYZ Recruiter</h3>
    </div>
    <div class="panel2right">
      <div class="chatbag">
        <p>💬</p>
      </div>
      <div class="panel2subright">
        <form method="get" action="">
          <p style="margin-right: 10px; font-size: 15px">🔍</p>
          <input type="text" name="search" placeholder="Search" />
          <button type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>

  <div class="midpanel">
    <div class="midleft">
      <div class="midlefttop">
        <div class="button">
          <button type="button">Add Job Posting ></button>
        </div>
        <div class="button">
          <a href="CandidatesList.html">
            <button type="button">See All Applicants ></button>
          </a>
        </div>
      </div>
      <div class="postingpanel">
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
                      color: grey;
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
                Develops and maintains software applications for various
                platforms.
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
                      color: grey;
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
                Executes marketing campaigns and analyzes performance metrics.
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
                      color: grey;
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
                Assists customers with inquiries and provides excellent
                service.
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
                      color: grey;
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
                Analyzes financial data and prepares reports for
                decision-making
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="midright">
      <div class="midpart"></div>
    </div>
    <div class="tablepanel">
      <div>
        <p style="
              font-size: 22px;
              font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS',
                sans-serif;
              font-weight: 600;
            ">
          Matching Candidates List
        </p>
      </div>
      <?php
      // Query to fetch candidate information
      if (isset($_GET['search'])) {
        $searchKeyword = $_GET['search'];
        // Add a WHERE clause to the SQL query to filter candidates based on the search keyword
        $sql = "SELECT * FROM URM_Candidate WHERE 
                (EducationLevel LIKE '%$searchKeyword%' OR 
                R_Experience LIKE '%$searchKeyword%' OR 
                Publications LIKE '%$searchKeyword%')";
      } else {
        // If there is no search query parameter, fetch all candidates
        $sql = "SELECT * FROM URM_Candidate";
      }
      $result = mysqli_query($conn, $sql);

      // Check if there are any candidates
      if (mysqli_num_rows($result) > 0) {
        // Loop through the candidates and generate the table rows
        echo '<div class="tablediv">';
        echo '<table border="1px">';
        echo '<thead>';
        echo '<tr style="font-size: 18px">';
        echo '<th>Name</th>';
        echo '<th>Education Level</th>';
        echo '<th>Research Experience</th>';
        echo '<th colspan="2">Manage</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . $row['FName'] . ' ' . $row['LName'] . '</td>';
          echo '<td>' . $row['EducationLevel'] . '</td>';
          echo '<td>' . $row['R_Experience'] . '</td>';
          echo '<td><a href="view_profile.php?candidateID=' . $row['CandidateID'] . '"><button class="viewButton">View</button></a></td>';
          echo '<td id="approval">';
          echo '<input type="checkbox" id="approval" />';
          echo '<label for="approval">Approve</label>';
          echo '</td>';
          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
      } else {
        // If there are no candidates, display a message or handle as needed
        echo '<p>No candidates found.</p>';
      }

      // Close the database connection

      // <!-- <div class="tablediv">
      //   <table border="1px">
      //     <thead>
      //       <tr style="font-size: 18px">
      //         <th>Name</th>
      //         <th>Education Level</th>
      //         <th>Major</th>
      //         <th colspan="2">Manage</th>
      //       </tr>
      //     </thead>
      //     <tbody>
      //       <tr>
      //         <td>Barney</td>
      //         <td>Bachelor</td>
      //         <td>Life Science</td>
      //         <td>
      //           <a href="CandidateProfile.html"><button class="viewButton">View</button></a>
      //         </td>
      //         <td id="approval">
      //           <input type="checkbox" id="approval" />
      //           <label for="approval">Approve</label>
      //         </td>
      //       </tr>
      //       <tr>
      //         <td>Ted</td>
      //         <td>Bachelor</td>
      //         <td>Computer Science</td>
      //         <td>
      //           <a href="CandidateProfile.html"><button class="viewButton">View</button></a>
      //         </td>
      //         <td id="approval">
      //           <input type="checkbox" id="approval" />
      //           <label for="approval">Approve</label>
      //         </td>
      //       </tr>
      //       <tr>
      //         <td>Dwight</td>
      //         <td>Master</td>
      //         <td>Aerospace Engineering</td>
      //         <td>
      //           <a href="CandidateProfile.html"><button class="viewButton">View</button></a>
      //         </td>
      //         <td id="approval">
      //           <input type="checkbox" id="approval" />
      //           <label for="approval">Approve</label>
      //         </td>
      //       </tr>
      //       <tr>
      //         <td>Alan</td>
      //         <td>Master</td>
      //         <td>Electrical Engineering</td>
      //         <td>
      //           <a href="CandidateProfile.html"><button class="viewButton">View</button></a>
      //         </td>
      //         <td id="approval">
      //           <input type="checkbox" id="approval" />
      //           <label for="approval">Approve</label>
      //         </td>
      //       </tr>
      //       <tr>
      //         <td>Michael</td>
      //         <td>P.hd</td>
      //         <td>Physics</td>
      //         <td>
      //           <a href="CandidateProfile.html"><button class="viewButton">View</button></a>
      //         </td>
      //         <td id="approval">
      //           <input type="checkbox" />
      //           <label for="approval">Approve</label>
      //         </td>
      //       </tr>
      //       <tr>
      //         <td>Sheldon</td>
      //         <td>P.hd</td>
      //         <td>Mathematics</td>
      //         <td>
      //           <a href="CandidateProfile.html"><button class="viewButton">View</button></a>
      //         </td>
      //         <td id="approval">
      //           <input type="checkbox" id="approval" />
      //           <label for="approval">Approve</label>
      //         </td>
      //       </tr>
      //       <tr>
      //         <td>Joey</td>
      //         <td>Post Doc</td>
      //         <td>Food Science</td>
      //         <td>
      //           <a href="CandidateProfile.html"><button class="viewButton">View</button></a>
      //         </td>
      //         <td id="approval">
      //           <input type="checkbox" id="approval" />
      //           <label for="approval">Approve</label>
      //         </td>
      //       </tr>
      //     </tbody>
      //   </table>
      // </div> -->



      // Query to fetch job information
      $sql1 = "SELECT UnivName, JobTitle, Status FROM Jobs";
      $result = mysqli_query($conn, $sql1);

      // Check if there are any jobs
      if (mysqli_num_rows($result) > 0) {
        // Loop through the jobs and generate the table rows
        echo '<div style="padding-left: 15%" class="bottomtable">';
        echo '<table border="1px">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>University</th>';
        echo '<th>Job</th>';
        echo '<th>Status</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . $row['UnivName'] . '</td>';
          echo '<td>' . $row['JobTitle'] . '</td>';
          echo '<td>' . $row['Status'] . '</td>';
          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
      } else {
        // If there are no jobs, display a message or handle as needed
        echo '<p>No jobs found.</p>';
      }

      // Close the database connection
      mysqli_close($conn);
      ?>
      <!-- <div style="padding-left: 15%" class="bottomtable">
        <table border="1px">
          <thead>
            <tr>
              <th>University</th>
              <th>Job</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Arizona State University</td>
              <td>Associate Professor</td>
              <td>Pending</td>
            </tr>
            <tr>
              <td>Texas State University</td>
              <td>Senior Lecturer</td>
              <td>Hired</td>
            </tr>
            <tr>
              <td>California State University</td>
              <td>Visiting Professor</td>
              <td>Rejected</td>
            </tr>
          </tbody>
        </table>
      </div> -->
      <!-- </div> -->
    </div>
  </div>
  <div class="footer">
    <p class="footer-text">&copy; Copyright All rights are reserved</p>
  </div>
</body>

</html>