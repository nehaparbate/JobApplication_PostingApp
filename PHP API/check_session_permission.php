<?php
echo sys_get_temp_dir();
// Check the current session save path
$sessionSavePath = session_save_path();
echo "Current session save path: " . $sessionSavePath . "<br>";

// Check if the session save path is writable
if (is_writable($sessionSavePath)) {
    echo "Session save path is writable.<br>";
} else {
    echo "Session save path is NOT writable.<br>";
}

// Check the current session save path permissions
$permissions = fileperms($sessionSavePath);
echo "Current session save path permissions: " . decoct($permissions) . "<br>";

// Calculate the decimal equivalent of the desired permission (for example, 0777 for full read, write, and execute permissions)
$desiredPermissions = 0777;

// Compare the desired permissions with the actual permissions
if (($permissions & $desiredPermissions) === $desiredPermissions) {
    echo "Session save path has the correct permissions.<br>";
} else {
    echo "Session save path does NOT have the correct permissions. Please set the correct permissions to the session save path.<br>";
}
phpinfo();
