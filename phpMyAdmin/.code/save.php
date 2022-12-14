<?php
    // session_start();
    require_once('database.php');

    $No = $_GET['No']; // get id through query string
    $sql = "SELECT * from `deetrading_co_jp_news` where No = '$No'";
    $list = $connection->query($sql); // list query
?>