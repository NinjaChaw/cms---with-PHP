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
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        <div class="col-md-6">
                           <!-- Delete from category table query -->
                           <?php
                            if(isset($_GET['delete'])) {
                                $del_cat_id = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE id=($del_cat_id) ";
                                $del_cat_query = mysqli_query($connection, $query);
                                header("Location: create_category.php");
                            }
                            ?>
                           <!-- /.End Delete from category table query -->
                           
                            <!-- Insert into category table query -->
                            <?php createCategory(); ?>
                            <!-- /.End Insert into category table query -->
                            
                            <form action="" method="post">
                                <div>
                                    <div class="form-group">
                                        <label for="category_title">Add Category</label>
                                        <input type="text" class="form-control" name="category_title">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" name="submit" type="submit">
                                            Add Category
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                            <!-- Update form -->
                            <?php //Update query
                            if(isset($_GET['edit'])) {
                                $edit_id = $_GET['edit'];
                                
                                include('includes/update_categories.php');
                                
                                }
                            ?> <!-- /. End Update query -->
                            
                        </div>
                        <div class="col-md-6">
                           <h3>All Categories</h3>
                            <table class="table table-hover">
                                <thead>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                </thead>
                                <tbody>
                                    <!-- Query from database for show data table-->
                                    <?php databaseRead(); ?>
                                    <!-- /.End database query for show data table -->
                                </tbody>
                            </table>
                        </div>
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
