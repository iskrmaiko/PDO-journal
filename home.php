<h1>Home</h1>
<p>  aliquam malesuada bibendum arcu vitae.
        Scelerisque eleifend donec pretium vulputate sapien. 
        Rhoncus urna neque viverra justo nec ultrices.
        Consectetur adipiscing elit duis tristique.
        Scelerisque eleifend donec pretium vulputate sapien.  </p>
<p>  Arcu dui vivamus arcu felis bibendum. Sapien nec sagittis 
        aliquam malesuada bibendum arcu vitae. 
        Consectetur adipiscing elit duis tristique.
        Scelerisque eleifend donec pretium vulputate sapien. 
        Rhoncus urna neque viverra justo nec ultrices. 
        Arcu dui vivamus arcu felis bibendum. Sapien nec sagittis 
        aliquam malesuada bibendum arcu vitae.
        Scelerisque eleifend donec pretium vulputate sapien. </P>


<?php


// PDO QUERY

$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->query('SELECT * FROM blog');


// SEND DATA

while($posts = $stmt->fetch(PDO::FETCH_ASSOC)){
   $truncContent= substr($posts["content"],0,150);
   echo "<h2>" . $posts["title"]. "</h2>" ;
   echo  $truncContent. "..<a href='post.php?title=". $posts["title"]."'> Read </a>"; 
  }

?>

<?php if($stmt->rowCount() === 0): ?>
	  <h2>There are no posts</h2>
  <?php endif; 
$pdo = null; ?>