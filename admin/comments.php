<!DOCTYPE html>
<html lang="en">

<?php include("includes/admin_header.php") ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/admin_navigation.php") ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        
                        <?php
                        if(isset($_GET['source'])) {
                            $source = $_GET['source'];
                        }else {
                            $source = "";
                        }
    
                        switch ($source) {
                            default:
                                include("includes/comments/read_comments.php");
                                break;
                        }
                        ?>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include("includes/admin_footer.php") ?>

</body>

</html>
