<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Page</title>
</head>
    <body>
        <?php include 'header.php' ?>
      
  
        <?php include 'db.php' ?>
            <?php
            $sql = "SELECT * FROM posts ORDER BY created_at DESC";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $posts = $statement->fetchAll();
              
            ?>
    </body>
    <main role="main" class="container">
<div class="row">
<div class="col-sm-8 blog-main">
            <div class="blog-post">

                <?php foreach($posts as $post) { ?>
                    <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo $post['id'];?>"><?php echo $post['title'];?></a></h2>
                    <p class="blog-post-meta"><?php echo $post['created_at'];?> <a href="#"><?php echo $post['author'];?></a></p>
                    <p><?php echo $post['body'];?></p>
                <?php } ?>

                <hr>

            </div><!-- /.blog-post -->
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>
           
        </div><!-- /.blog-main -->

<?php include 'sidebar.php' ?>
<?php include 'footer.php' ?>    

</html>