<?php
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password: $password<br>";
echo "Hash: $hash<br><br>";

echo "Copy this SQL:<br>";
echo "<textarea style='width:100%; height:100px;'>";
echo "UPDATE users SET password = '$hash' WHERE username = 'admin';";
echo "</textarea>";
?>
