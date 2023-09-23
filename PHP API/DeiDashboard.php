<?php
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="CSS/DEI_OfficerDashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEI Officer</title>
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
            <a class="navtext" href="edit_profile_dei.php">Profile</a>
            <a class="navtext" href="DeiDashboard.html">Home</a>
            <a class="navtext" href="About.html">About</a>
            <a class="navtext" href="Services.html">Services</a>
            <a class="navtext" href="Contact.html">Contact Us</a>
            <a class="navtext" href="logout.php">Log Out</a>
        </div>
    </div>
    <div class="secbar">
        <h1>DEI Officer Dashboard</h1>
    </div>
    </div>
    <div class="partdiv">
        <div class="partition">
        </div>
    </div>
    <div class="panel2">
        <div>
            <h3>Welcome, XYZ Officer</h3>
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
    <div class="midpanel">
        <div class="midleft">
            <div class="midlefttop">
                <div class="button">
                    <button type="button">View all job Postings ></button>
                </div>
                <div class="button">
                    <button type="button">Edit DEI Initiatives ></button>
                </div>
            </div>
            <div class="postingpanel">
                <div class="posting1">
                    <img class="jobimg" src="../Img/job4.jpeg" height="130px" width="200px">
                    <div class="parentjobhead">
                        <div class="jobhead">
                            <div class="jobtitle">
                                <p style="font-size: 22px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: 600;">Software Engineer</p>
                            </div>
                            <div class="job date">
                                <p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: grey;">June 5, 2023</p>
                            </div>
                        </div>
                        <div class="jobdesc">
                            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                Develops and maintains software applications for various platforms. </p>
                        </div>
                        <div>
                            <button style="margin-top: 10px; background-color: #4CAF50; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; font-family: Arial, sans-serif; cursor: pointer;">Approve</button>
                        </div>
                    </div>
                </div>
                <div class="posting1">
                    <img class="jobimg" src="../Img/job2.jpeg" height="130px" width="200px">
                    <div class="parentjobhead">
                        <div class="jobhead">
                            <div class="jobtitle">
                                <p style="font-size: 22px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: 600;">Marketing Specialist</p>
                            </div>
                            <div class="job date">
                                <p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: grey;">June 5, 2023</p>
                            </div>
                        </div>
                        <div class="jobdesc">
                            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                Executes marketing campaigns and analyzes performance metrics. </p>
                        </div>
                        <div>
                            <button style="margin-top: 10px; background-color: #4CAF50; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; font-family: Arial, sans-serif; cursor: pointer;">Approve</button>
                        </div>
                    </div>
                </div>
                <div class="posting1">
                    <img class="jobimg" src="../Img/job3.jpeg" height="130px" width="200px">
                    <div class="parentjobhead">
                        <div class="jobhead">
                            <div class="jobtitle">
                                <p style="font-size: 22px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: 600;">Customer Service Representative</p>
                            </div>
                            <div class="job date">
                                <p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: grey;">June 5, 2023</p>
                            </div>
                        </div>
                        <div class="jobdesc">
                            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                Assists customers with inquiries and provides excellent service. </p>
                        </div>
                        <div>
                            <button style="margin-top: 10px; background-color: #4CAF50; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; font-family: Arial, sans-serif; cursor: pointer;">Approve</button>
                        </div>
                    </div>
                </div>
                <div class="posting1">
                    <img class="jobimg" src="../Img/job1.jpeg" height="130px" width="200px">
                    <div class="parentjobhead">
                        <div class="jobhead">
                            <div class="jobtitle">
                                <p style="font-size: 22px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-weight: 600;">Financial Analyst </p>
                            </div>
                            <div class="job date">
                                <p style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: grey;">June 5, 2023</p>
                            </div>
                        </div>
                        <div class="jobdesc">
                            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                Analyzes financial data and prepares reports for decision-making </p>
                        </div>
                        <div>
                            <button style="margin-top: 10px; background-color: #4CAF50; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; font-family: Arial, sans-serif; cursor: pointer;">Approve</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="midright">
            <div class="midpart">
            </div>
        </div>
        <div class="tablepanel">
            <div class="tablediv">
                <div id="diversity-info">
                    <h3>Diversity and Inclusion Initiatives</h3>
                    <ul>
                        <li> Diversity Hiring</li>
                        <li> Inclusive Workplace Policies</li>
                        <li> Training and Education</li>
                        <li> Employee Resource Groups (ERGs)</li>
                        <li> Pay Equity and Transparency</li>
                    </ul>
                    <p>Building a diverse and inclusive workplace is essential for fostering innovation and a positive company culture.</p>
                </div>

            </div>
            <div class=bottomright>
                <h2>Diversity Insights</h2>
                <br>
                <div class="dashboard-info">
                    <div class="info-box">
                        <h3>Number of job postings</h3>
                        <p>100</p>
                    </div>
                    <div class="info-box">
                        <h3>Number of postings meeting DEI criteria</h3>
                        <p>85</p>
                    </div>
                    <div class="info-box">
                        <h3>Number of URM candidates interested</h3>
                        <p>30</p>
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