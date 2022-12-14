<?php

// for jrd

$host = "mysql38.onamae.ne.jp";
$dbName = "iphtt_iphtt_jrd_orjp";
// $user = "iphtt_highbi";
// $password = "wNVFh0!D";
$user = "iphtt_iphtt_jrd_orjp";
$password = "JRDVFh0!D";
$dsn1 = "mysql:host={$host};dbname={$dbName};charser=utf8";
$error_dir2 = 0;
$error_dir2 = "Working";
try {
   $connection1 = new PDO($dsn1, $user, $password);
} catch (Exception $e) {
    $error_dir2 = "error for jrd";

}
echo $error_dir2;


?>