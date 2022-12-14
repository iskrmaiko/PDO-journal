<?php
session_start();
require_once('database.php');

//stored in cache values
$idd = "ID";
$idd = $_SESSION['idd'];

$sql = "SELECT * FROM `deetrading_co_jp_news` ORDER BY `No` DESC";
$result = $connection->query($sql);

//listing data by member
// $result = ($pdo->prepare($sql));
$sql_member = "SELECT * FROM `deetrading_co_jp_news` WHERE `id` = '$idd' ORDER BY `No` DESC ";
// $result1 = $connection->query($sql_member);
$result1 = $connection->query($sql_member);

?>