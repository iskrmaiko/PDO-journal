<?php
include 'database.php';

$date = $_POST['date'];
$title = $_POST['title'];
$information = $_POST['information'];
$other_link = $_POST['other_link'];
$video = $_POST['message_url'];
$loginUser = $_POST['loginUser'];
$loginUserRole = $_POST['loginUserRole'];
$sendTo = $_POST['sendTo'];
// $flag = ($_POST['sendTo'] == 'jrd') ? "true" : "false";

$db = mysqli_connect($host, $idd, $passd, $dbName);
$information = mysqli_real_escape_string($db, $_POST['information']);
$title = mysqli_real_escape_string($db, $_POST['title']);

$name = '';
$image = '';
$name2 = '';
$image2 = '';


// start downloading
if($sendTo == 'jp' || $sendTo == 'both'){
    $target_dir1 = "upload/upload1/";
    $name = $_FILES['file']['name'];
    $target_file1 = $target_dir1 . basename($_FILES["file"]["name"]);
    $file_name = $target_dir1 .$name ;

    $target_dir2 = "upload/upload1/";
    $name2 = $_FILES['file2']['name'];
    $target_file2 = $target_dir2 . basename($_FILES["file2"]["name"]);
    $file_name2 = $target_dir2 .$name2 ;

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension for image1
    if( in_array($imageFileType,$extensions_arr) ){
        if (file_exists($file_name)) {
            $error_dir = 1;
            $error_msg = '①アップロード画像名変更する必要があります。';
        } else {
            // Upload file
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir1.$name)){
                // Convert to base64 
                $image_base64 = base64_encode(file_get_contents('upload/upload1/'.$name) );
                $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
            }
        }
    }

    // Check extension for image2
    if( in_array($imageFileType2,$extensions_arr) ){
        if (file_exists($file_name2)) {
            if($error_dir == 1){
                $error_msg = '①と②アップロード画像名変更する必要があります。';
            } else {
                $error_msg = '②アップロード画像名変更する必要があります。';
            }
            $error_dir = 2;
        } else {
            // Upload file
            if(move_uploaded_file($_FILES['file2']['tmp_name'],$target_dir2.$name2)){
                // Convert to base64 
                $image_base64 = base64_encode(file_get_contents('upload/upload2/'.$name2) );
                $image2 = 'data:image/'.$imageFileType2.';base64,'.$image_base64;
            }
        }
    }

}
if($sendTo == 'com' || $sendTo == 'both'){
    $target_dir1 = "com/upload/upload1/";
    $name = $_FILES['file']['name'];
    $target_file1 = $target_dir1 . basename($_FILES["file"]["name"]);
    $file_name = $target_dir1 .$name ;

    $target_dir2 = "com/upload/upload2/";
    $name2 = $_FILES['file2']['name'];
    $target_file2 = $target_dir2 . basename($_FILES["file2"]["name"]);
    $file_name2 = $target_dir2 .$name2 ;

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension for image1
    if( in_array($imageFileType,$extensions_arr) ){
        if (file_exists($file_name)) {
            $error_dir = 1;
            $error_msg = '①アップロード画像名変更する必要があります。';
        } else {
            // Upload file
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir1.$name)){
                // Convert to base64 
                $image_base64 = base64_encode(file_get_contents('com/upload/upload1/'.$name) );
                $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
            }
        }
    }

    // Check extension for image2
    if( in_array($imageFileType2,$extensions_arr) ){
        if (file_exists($file_name2)) {
            if($error_dir == 1){
                $error_msg = '①と②アップロード画像名変更する必要があります。';
            } else {
                $error_msg = '②アップロード画像名変更する必要があります。';
            }
            $error_dir = 2;
        } else {
            // Upload file
            if(move_uploaded_file($_FILES['file2']['tmp_name'],$target_dir2.$name2)){
                // Convert to base64 
                $image_base64 = base64_encode(file_get_contents('com/upload/upload2/'.$name2) );
                $image2 = 'data:image/'.$imageFileType2.';base64,'.$image_base64;
            }
        }
    }

}







if($error_dir == 0){
    //This below line is a code to Send form entries to database
    if($sendTo == 'jp' || $sendTo == 'both'){
        $sql = "INSERT INTO deetrading_co_jp_news (No, date, title, information, img1_name, image1, img2_name, image2, youtube_video, other_link, id, role, sendTo) VALUES ('0', '$date', '$title', '$information', '$name', '$image', '$name2', '$image2', '$video', '$other_link', '$loginUser', '$loginUserRole', '$sendTo')";
        //fire query to save entries and check it with if statement
        // $rs = mysqli_query($connection, $sql);
        $result = $connection->query($sql);
    }

    if($sendTo == 'com' || $sendTo == 'both'){
        include "db_deetrading_com.php";
        $sql_sendTo = "INSERT INTO deetrading_com_news (No, date, title, information, img1_name, image1, img2_name, image2, youtube_video, other_link, id, role, sendTo) VALUES ('0', '$date', '$title', '$information', '$name', '$image', '$name2', '$image2', '$video', '$other_link', '$loginUser', '$loginUserRole', '$sendTo')";
        $result_sendTo = $connection1->query($sql_sendTo);

    }

    //エラーチェック
    if($sendTo == 'both'){
        if(!$result_sendTo && !$result){
            $error_dir = 3;
            $error_msg = "deetradingのデータベースがエラーです。\njrdのデータベースがエラーです。";
        }
    }

    if($sendTo == 'jp'){
        if(!$result){
            $error_dir = 5;
            $error_msg = "deetradingのデータベース(Table)がエラーです。";
        }
    }

    if($sendTo == 'com'){
        if(!$result_sendTo){
            $error_dir = 4;
            // $error_dir = 0;
            $error_msg = "deetrading.comのデータベース(Table)がエラーです。";
        }
    }

    //データベースのエラー確認
    if($error_dir == 0){
        mysqli_close($db); // Close connection
        header("location: /newslist?" . time()); // redirects to all records page
        exit;
    } else {
        echo "<SCRIPT>
                alert('$error_msg')
                window.location.replace('/newsuplord');
            </SCRIPT>";
    }
}
//画像のエラー確認
else {
    echo "<SCRIPT>
            alert('$error_msg')
            window.location.replace('/newsuplord');
        </SCRIPT>";
}

?>