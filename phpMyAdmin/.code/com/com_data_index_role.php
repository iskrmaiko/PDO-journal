<?php
session_start();
require_once('db_deetrading_com.php');

//stored in cache values
$idd = "ID";
$idd = $_SESSION['idd'];

$sql = "SELECT * FROM `deetrading_com_news` ORDER BY `No` DESC";
$result_com = $connection1->query($sql);
//listing data by member
// $result = ($pdo->prepare($sql));
$sql_member = "SELECT * FROM `deetrading_com_news` WHERE `id` = '$idd' ORDER BY `No` DESC ";
$result2_com = $connection1->query($sql_member);
?>