<?php include 'config/data.php'; ?>
<?php include 'header.php'; ?>


<h1>Compose</h1>
    <form class="" action="compose.php" method="POST">
      <div class="form-group">
        <label>Title</label>
                <input type="text" class="form-control" name="title" id="title" >
      
                <label>Content</label>
                <textarea class="form-control" name="content" id="content" rows="5" cols="30" ></textarea>
            </div>
            <button type="submit" name="publish" class="btn btn-primary">Publish</button>
    </form>

<?php include 'footer.php'; ?>   