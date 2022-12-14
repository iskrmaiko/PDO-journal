<?php include 'config/data.php'; ?>
<?php include 'header.php'; ?>


<?php

$title = $_GET['title'];
  $sql = 'SELECT * FROM blog WHERE title = :title';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['title' => $title]);
  $post = $stmt->fetch(PDO::FETCH_ASSOC);

  echo "<h1 style='text-align:center'>".$post['title']."</h1>";
  echo "<p>".$post['content']."</p>
  <a href='index.php?id=". $post["id"]."'> Delete </a>";
   ?>

  
<?php include 'footer.php'; ?>   


