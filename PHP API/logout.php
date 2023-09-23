
<?php
session_start();
$_SESSION['isLoggedIn'] = false;
unset($_SESSION['userRole']);
unset($_SESSION['isLoggedIn']);
unset($_SESSION['userRole']);

unset($_SESSION['userID']);
session_destroy();
header('location:login.php');

echo $_SESSION['isLoggedIn'];
echo $_SESSION['userRole'];
?>