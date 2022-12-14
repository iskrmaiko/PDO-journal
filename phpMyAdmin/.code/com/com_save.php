<?php
    require_once('db_deetrading_com.php');

    $No = $_GET['No']; // get id through query string
    $sql = "SELECT * from `deetrading_com_news` where No = '$No'";
    $list = $connection1->query($sql); // list query
?>