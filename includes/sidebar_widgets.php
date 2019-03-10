<!-- Sidebar Widgets -->
    
<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
        <div class="input-group">
        <input type="text" name="search" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
        </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Login form -->
<div class="well">
    <h4>Login</h4>
    <form action="./includes/login.php" method="post">
        <div class="form-group">
        <input type="text" name="login_username" class="form-control" placeholder="Username">
        </div>
        <div class="form-group">
        <input type="password" name="login_password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
        <button name="login" class="btn btn-success form-control" type="submit">
            Login
        </button>
        </div>
    </form>
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
               <?php
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        $category_name = $row["title"];
                        echo "<li><a href=\"#\">{$category_name}</a>
                </li>";
                    }
                ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>Side Widget Well</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div>