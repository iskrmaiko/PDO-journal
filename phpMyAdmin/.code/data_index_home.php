<?php
session_start();
require_once('database.php');

$sql = "SELECT * FROM `deetrading_co_jp_news` ORDER BY `date` DESC limit 5";
$result = $connection->query($sql);

?>