<?php
$host='localhost';
$user='maiko';
$password='11111';
$dbname='php_dev';

// be-iserver db
// $host='sddb0040030286.cgidb';
// $user='sd_dba_NDQzMzIxN';
// $password='Rtc$I8Ws';
// $dbname='sddb0040030286';

// 000webhost db
// <?php
// $host='localhost';
// $user='id19976904_maiko';
// $password='PeG5JUx4Mjj%pqTA';
// $dbname='id19976904_blog';

// Set DSN
$dsn = 'mysql:host='. $host .';dbname='. $dbname;

// Create a PDO instance
$pdo = new PDO($dsn, $user, $password);

if (!$pdo) {
	die("Connection failed: " . mysqli_connect_error());
}

// SEND DATA 

if(ISSET($_POST['publish'])){
	$title = $_POST['title'];
	$content = $_POST['content'];
		try{
			$sql = 'INSERT INTO blog(title, content) VALUES(:title, :content)';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['title' => $title, 'content' => $content]);
			$pdo = null;
		    header("location: index.php");
		    
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	
	}

	if(ISSET($_GET['id'])){
		$id = $_GET['id'];
		
		try{
			$sql = 'DELETE FROM blog WHERE id = :id';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['id' => $id]);
		    
		}catch(PDOException $e){
			echo $e->getMessage();
		}

	}


	
?>


