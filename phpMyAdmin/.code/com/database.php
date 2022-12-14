<?php

$host = "mysql38.onamae.ne.jp";
$dbName = "iphtt_deetrading_jp";
// $user = "iphtt_highbi";
// $password = "wNVFh0!D";
$idd = 'iphtt_highbi';
$passd = 'wNVFh0!D';
$sql = null;
$res = null;
$error_dir = 0;
$error_msg = '';

$dsn = "mysql:host={$host};dbname={$dbName};charser=utf8";

try {
   $connection = new PDO($dsn, $idd, $passd);
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
//    echo "<span class='error'>エラーがありました。</span><br>";
//    echo $e->getMessage();
//    exit();
    $error_dir = 1;
    $error_msg = "データベースはエラーがありました。";
}

?>