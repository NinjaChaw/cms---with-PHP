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
                
                <?php
                    if(isset($_POST["submit"])){
                        $search = $_POST["search"];
                        $search_query = "SELECT * FROM posts WHERE post_title LIKE '%$search%'";
                        $search_result = mysqli_query($connection, $search_query);
                        if(!$search_result) {
                            die("Query faild".mysqli_error($connection));
                        }
                        $count = mysqli_num_rows($search_result);
                        if($count == 0) {
                            echo "<h1>No result for \"{$search}\"</h1>";
                        }else {
                            echo "<h4>Showing results for \"{$search}\"</h4>";
                            while($row = mysqli_fetch_assoc($search_result)) {
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
                
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                
                <?php
                            }
                        }
                    }
                ?>

                <!-- Pager -->
                <?php
                    include("includes/pager.php");
                ?>

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
