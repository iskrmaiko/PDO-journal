<?php
    include 'database.php';

    $No = $_GET['No']; // get id through query string
    $sql = "SELECT * from `jrd_news` where No = '$No'";
    $list = $connection->query($sql); // list query
?>