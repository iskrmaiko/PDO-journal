<?php
session_start();
require_once('database.php');
$id = $_POST['id'];
$pass = $_POST['pass'];
$idd = 'iphtt_highbi';
$passd = 'wNVFh0!D';
$sql = null;
$res = null;
try {
    $pdo = new PDO($dsn, $idd, $passd);
    // $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "データベース{$dbName}に接続しました。<br>";
    //  // SQL作成
     // $sql = "SELECT * FROM user_list";
 
     // // SQL実行
     // $res = $pdo->query($sql);
     // // 取得したデータを出力
     // foreach( $res as $value ) {
    //      echo "$value[id]<br>";
    //      echo "$value[pass]<br>";
    //  }
 } catch (Exception $e) {
    echo "<span class='error'>エラーがありました。</span><br>";
    echo $e->getMessage();
    exit();
 }

// データ取得
$sql = "SELECT id, pass, role FROM user_list WHERE id = ?";
$stmt = ($pdo->prepare($sql));
$stmt->execute(array($id));

//あらかじめ配列を生成しておき、while文で回します。
$memberList = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
   if($row['pass'] == $pass){
      $memberList[]=array(
         'result'=>"ok",
         'id' =>$row['id'],
         'role' =>$row['role'],
         'pass'=>"成功",
         'url'=>"/newslist"
      );
      //for php
      $_SESSION['idd'] = $_POST['id'];
   }
   else{
      $memberList[]=array(
         'result'=>"not ok"
      );
   }
}

//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);
return $memberList;
?>