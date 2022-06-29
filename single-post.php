<?php include 'db.php'; ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">

  <title>Vivify Blog</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="styles/blog.css" rel="stylesheet">
  <link href="styles/styles.css" rel="stylesheet">
</head>

<body>

  <?php include 'header.php'; ?>

  <main role="main" class="container">
    <div class="row">
      <div class="col-sm-8 blog-main">
        <div class="blog-post">
          <?php
          if (isset($_GET['post_id'])) {
            $sql = "SELECT title, body, author, created_at FROM posts WHERE id = {$_GET['post_id']}";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $singlePost = $statement->fetch();
          ?>

            <article class="va-c-article">
              <header>
                <h1><?php echo $singlePost['title'] ?></h1>
                <div class="va-c-article__meta"><?php echo $singlePost['created_at'] ?> by <?php echo $singlePost['author'] ?></div>
              </header>

              <div><?php echo $singlePost['body'] ?></div>
              <div id="comments" class="comments">
              <h3>comments</h3>

              <?php

              $sql = "SELECT * FROM comments WHERE post_id = {$_GET['post_id']}";
              $statement = $connection->prepare($sql);
              $statement->execute();
              $statement->setFetchMode(PDO::FETCH_ASSOC);
              $comments = $statement->fetchAll();

              foreach ($comments as $comment) {
                ?>
                  <ul>
                    <li>
                      <div class="single-comment">
                        <div>by: <strong><?php echo $comment['author'] ?> </strong></div>
                        <div> <?php echo $comment['text'] ?></div>
                      </div>
                      <hr>
                    </li>
                  </ul>
                <?php } ?>
              </div>
            </article>
          <?php } ?>
        </div>
      </div>
      <?php include 'sidebar.php'; ?>
  </main>
  <?php include 'footer.php'; ?>
</body>

</html>
