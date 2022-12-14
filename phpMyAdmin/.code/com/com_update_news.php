<?php
include 'database.php';
include "db_deetrading_com.php";

$No = $_POST['No'];
$date = $_POST['date'];
$title = $_POST['title'];
$information = $_POST['information'];
$other_link = $_POST['other_link'];
$video = $_POST['message_url'];
$original_img1 = $_POST['file_org'];
$original_img2 = $_POST['file2_org'];
$uploaded_img1 = $_FILES['file']['name'];
$uploaded_img2 = $_FILES['file2']['name'];
$sendTo = $_POST['sendTo'];

$db = mysqli_connect($host, $idd, $passd, $dbName);
$information = mysqli_real_escape_string($db, $_POST['information']);
$title = mysqli_real_escape_string($db, $_POST['title']);

$name = '';
$image = '';
$name2 = '';
$image2 = '';
$sql_sendTo = '';

//アップロード済画像
$del_pic1 = '';
$sql_test = "SELECT `img1_name` FROM `deetrading_com_news` WHERE `No`='$No'";
$result_test = $connection1->query($sql_test);
while($rows1=$result_test->fetch(PDO::FETCH_ASSOC)){
    $del_pic1 = $rows1["img1_name"];
}

$del_pic2 = '';
$sql_test = "SELECT `img2_name` FROM `deetrading_com_news` WHERE `No`='$No'";
$result_test2 = $connection1->query($sql_test);
while($rows2=$result_test2->fetch(PDO::FETCH_ASSOC)){
    $del_pic2 = $rows2["img2_name"];
}

// moving file
if($sendTo != 'com' && $del_pic1){
    $org_pic1 = 'upload/upload1/'.$del_pic1;
    $move_pic1 = '../upload/upload1/'.$del_pic1;
    copy($org_pic1, $move_pic1);

    $type = pathinfo($move_pic1, PATHINFO_EXTENSION);
    $data = file_get_contents($move_pic1);
    $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
    $name = $_POST['file_org'];
}

if($sendTo != 'com' && $del_pic2){
$org_pic2 = 'upload/upload2/'.$del_pic2;
$move_pic2 = '../upload/upload2/'.$del_pic2;
copy($org_pic2, $move_pic2);

$type = pathinfo($move_pic2, PATHINFO_EXTENSION);
$data = file_get_contents($move_pic2);
$image2 = 'data:image/' . $type . ';base64,' . base64_encode($data);
$name2 = $_POST['file2_org'];
}

// deleting file
if($uploaded_img1 || $sendTo == "jp"){
if($uploaded_img1 != $del_pic1 && $del_pic1){
    $del_pic1 = 'upload/upload1/'.$del_pic1;
    if (file_exists($del_pic1) && $del_pic1) {
        unlink($del_pic1);
        $del_pic1 = '';
    }
    $sql = "UPDATE `deetrading_com_news` SET `img1_name`='',`image1`='' WHERE `No`='$No' ";
    $result = $connection1->query($sql);
}
}

if($uploaded_img2 || $sendTo == "jp"){
if($uploaded_img2 != $del_pic2 && $del_pic2){
    $del_pic2 = 'upload/upload2/'.$del_pic2;
    if (file_exists($del_pic2)) {
        unlink($del_pic2);
        $del_pic2 = '';
    }
    $sql = "UPDATE `deetrading_com_news` SET `img2_name`='',`image2`='' WHERE `No`='$No' ";
    $result2 = $connection1->query($sql);
}
}

//Original画像を削除だけのとき
if(!$original_img1 && $del_pic1){
    $del_pic1 = 'upload/upload1/'.$del_pic1;
    if (file_exists($del_pic1)) {
        unlink($del_pic1);
    }
    $sql = "UPDATE `deetrading_com_news` SET `img1_name`='',`image1`='' WHERE `No`='$No' ";
    $result = $connection1->query($sql);
}

if(!$original_img2 && $del_pic2){
    $del_pic2 = 'upload/upload2/'.$del_pic2;
    if (file_exists($del_pic2)) {
        unlink($del_pic2);
    }
    $sql = "UPDATE `deetrading_com_news` SET `img2_name`='',`image2`='' WHERE `No`='$No' ";
    $result2 = $connection1->query($sql);
}

//差し替え画像
if($sendTo == 'com'){
    $target_dir1 = 'upload/upload1/';
    $name = $_FILES['file']['name'];
    $target_file1 = $target_dir1 . basename($_FILES["file"]["name"]);
    $file_name = $target_dir1 .$name ;

    $target_dir2 = 'upload/upload2/';
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
        // Upload file
        if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir1.$name)){
            // Convert to base64 
            $image_base64 = base64_encode(file_get_contents($target_dir1.$name) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
        }
    }
    // Check extension for image2
    if( in_array($imageFileType2,$extensions_arr) ){
        // Upload file
        if(move_uploaded_file($_FILES['file2']['tmp_name'],$target_dir2.$name2)){
            // Convert to base64 
            $image_base64 = base64_encode(file_get_contents($target_dir2.$name2) );
            $image2 = 'data:image/'.$imageFileType2.';base64,'.$image_base64;
        }
    }
}

if($sendTo == 'jp'){
    $sql1 = "DELETE from `deetrading_com_news` WHERE `No`= '$No'";
    $sql_sendTo = "INSERT INTO deetrading_co_jp_news (No, date, title, information, img1_name, image1, img2_name, image2, youtube_video, other_link, id, role, sendTo) VALUES ('0', '$date', '$title', '$information', '$name', '$image', '$name2', '$image2', '$video', '$other_link', '$loginUser', '$loginUserRole', 'jp')";

    //fire query to save entries and check it with if statement
    $result_sendTo = $connection->query($sql_sendTo);
    $rs = $connection1->query($sql1);

} else if($sendTo == 'both') {
    // This below line is a code to Send form entries to database
    if ($image && (strlen($image2) == 0)){
        $sql = "UPDATE `deetrading_com_news` SET `date`='$date',`title`='$title',`information`='$information',`img1_name`='$name',`image1`='$image',`other_link`='$other_link',`youtube_video`='$video' WHERE `No`='$No' ";
    } else if ($image2 && (strlen($image) == 0)){
        $sql = "UPDATE `deetrading_com_news` SET `date`='$date',`title`='$title',`information`='$information',`img2_name`='$name2',`image2`='$image2',`other_link`='$other_link',`youtube_video`='$video' WHERE `No`='$No' ";
    } else if($image && $image2){
        $sql = "UPDATE `deetrading_com_news` SET `date`='$date',`title`='$title',`information`='$information',`img1_name`='$name',`image1`='$image',`img2_name`='$name2',`image2`='$image2',`other_link`='$other_link',`youtube_video`='$video' WHERE `No`='$No' ";
    } else {
        $sql = "UPDATE `deetrading_com_news` SET `date`='$date',`title`='$title',`information`='$information',`other_link`='$other_link',`youtube_video`='$video' WHERE `No`='$No' ";
    }

    //deetrading.com
    $sql_sendTo = "INSERT INTO deetrading_co_jp_news (No, date, title, information, img1_name, image1, img2_name, image2, youtube_video, other_link, id, role, sendTo) VALUES ('0', '$date', '$title', '$information', '$name', '$image', '$name2', '$image2', '$video', '$other_link', '$loginUser', '$loginUserRole', 'jp')";

    //fire query to save entries and check it with if statement
    $result_sendTo = $connection->query($sql_sendTo);
    $rs = $connection1->query($sql);

} else {
    if ($image && (strlen($image2) == 0)){
        $sql = "UPDATE `deetrading_com_news` SET `date`='$date',`title`='$title',`information`='$information',`img1_name`='$name',`image1`='$image',`other_link`='$other_link',`youtube_video`='$video' WHERE `No`='$No' ";
    } else if ($image2 && (strlen($image) == 0)){
        $sql = "UPDATE `deetrading_com_news` SET `date`='$date',`title`='$title',`information`='$information',`img2_name`='$name2',`image2`='$image2',`other_link`='$other_link',`youtube_video`='$video' WHERE `No`='$No' ";
    } else if($image && $image2){
        $sql = "UPDATE `deetrading_com_news` SET `date`='$date',`title`='$title',`information`='$information',`img1_name`='$name',`image1`='$image',`img2_name`='$name2',`image2`='$image2',`other_link`='$other_link',`youtube_video`='$video' WHERE `No`='$No' ";
    } else {
        $sql = "UPDATE `deetrading_com_news` SET `date`='$date',`title`='$title',`information`='$information',`other_link`='$other_link',`youtube_video`='$video' WHERE `No`='$No' ";
    }
    $rs = $connection1->query($sql);
}

if($rs)
{
    mysqli_close($db); // Close connection
    header("location:/newslist?css=site2&" . time());// redirects to all records page
    // header("location:javascript://history.go(-1)");
    exit;
} else {
    echo $original_img1;
    echo "データベース更新をエラー";
}

?>