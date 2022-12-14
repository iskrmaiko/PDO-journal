<?php

// for jrd

$host = "sddb0040343921.cgidb";
$dbName = "sddb0040343921";
// $user = "iphtt_highbi";
// $password = "wNVFh0!D";
$user = "sddbNjY4NDA4";
$password = "Tgvk#xK8";
$dsn1 = "mysql:host={$host};dbname={$dbName};charser=utf8";
$error_dir2 = 0;
try {
   $connection1 = new PDO($dsn1, $user, $password);
} catch (Exception $e) {
    $error_dir2 = "error for jrd";

}
echo $error_dir2;
$mysqli = new mysqli($host,$user,$password,$dbName);
// Check connection
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
}else{
    echo "connect ok";
}
?>