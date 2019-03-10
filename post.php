<?php include("includes/db_connection.php") ?>

<!DOCTYPE html>
<html lang="en">

<?php 
    include("includes/head.php"); 
?>

<body>

    <!-- Navigation -->
    <?php
        include("includes/navigation.php");
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Single Blog Post -->
                <?php
                    if(isset($_GET['p_id'])) {
                        $single_post_id = $_GET['p_id'];
                
                        $query = "SELECT * FROM posts WHERE post_id={$single_post_id}";
                        $single_posts_query = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($single_posts_query)) {
                            $post_id = $row["post_id"];
                            $post_category_id = $row["post_category_id"];
                            $post_title = $row["post_title"];
                            $post_author = $row["post_author"];
                            $post_date = $row["post_date"];
                            $post_image = $row["post_image"];
                            $post_content = $row["post_content"];
                            $post_tags = $row["post_tags"];
                            $post_comment_count = $row["post_comment_count"];
                            $post_status = $row["post_status"];
                        
                ?>
                
                <h2>
                    <a href="./post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <div class="pull-right"><span class="btn btn-success btn-xs" style="border-radius: 14%;">Like</span>  <span class="btn btn-info btn-xs" style="border-radius: 14%;">Share</span> <span class="btn btn-danger btn-xs" style="border-radius: 14%;">Send to Friend</span></div>
                <br>
                <hr>
                
                <?php } ?> <!-- /.End "while($row = mysqli_fetch_assoc($single_posts_query))" statement -->

                <!-- Save comment to database -->
                <?php
                    if(isset($_POST['submit'])) {
                        $the_post_id = $_GET['p_id'];
                        
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        $comment_status = "Unapproved";
                        
                        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query .= "VALUES({$the_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', '{$comment_status}', now()) ";
                        $comment_insert_query = mysqli_query($connection, $query);
                    }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                       <div class="form-group">
                            <input type="form-control" class="form-control" value="Name here" name="comment_author">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" value="Email here" name="comment_email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content">Your comment</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

               <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id={$post_id}";
                    $select_comments_query = mysqli_query($connection, $query);
                    if(!$select_comments_query) {
                        die("Query Faild".mysqli_error($connection));
                    }
                    while($row = mysqli_fetch_assoc($select_comments_query)) {
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_date = $row['comment_date'];
                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <?php } ?> <!-- /.End Comment while loop-->

                <!-- Comment -->
<!--
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                         Nested Comment 
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
-->
                        <!-- End Nested Comment -->
<!--
                    </div>
                </div>
-->
                    <?php }else {
                        echo "<h2 class='text-info text-center'>OPPS! Post not found, Something went wrong.</h2>";
                    } ?> <!-- /.End of "if(isset($_GET['p_id']))" statement -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
               
                <?php
                    include("includes/sidebar_widgets.php");
                ?>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php
            include("includes/footer.php");
        ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
