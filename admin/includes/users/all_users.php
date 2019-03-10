
    <table class="table table-hover table-responsive">
    <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Image</th>
        <th>Email</th>
        <th>Role</th>
        <th>Randsalt</th>
    </thead>
    <tbody>
       <?php
            $query = "SELECT * FROM users";

            $select_all_users_query = mysqli_query($connection, $query);
            if(!$select_all_users_query) {
                die("CONNECTION ERROR".mysqli_error($connection));
            }

            while($row = mysqli_fetch_assoc($select_all_users_query)) {
                $user_id = $row["user_id"];
                $user_name = $row["user_name"];
                $user_email = $row["user_email"];
                $user_image = $row["user_image"];
                $user_role = $row["user_role"];
                $user_randsalt = $row["user_randsalt"];
        ?>
        <tr>
            <td><?php echo $user_id; ?></td>
            <td><?php echo $user_name; ?></td>
            <td><img src="../images/<?php echo $user_image; ?>" alt="User image" class="img-responsive" height="200px" width="200px"></td>
            <td><?php echo $user_email; ?></td>
            <td><?php echo $user_role; ?></td>
            <td><?php echo $user_randsalt; ?></td>
            <td><a href="" class="btn btn-defailt btn-xs">Edit</a></td>
            <td><a href="" class="btn btn-danger btn-xs">Delete</a></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    
   
<?php
    if(isset($_GET['delete'])) {
        $del_post_id = $_GET['delete'];
        
        $query = "SELECT * FROM posts WHERE post_id={$del_post_id}";
        $del_post_query = mysqli_query($connection, $query);
        successQuery($del_post_query);
        while($row = mysqli_fetch_assoc($del_post_query)) {
            $del_post_image = $row['post_image'];
            unlink("../images/{$del_post_image}");
        }
        
        $query = "DELETE FROM posts WHERE post_id={$del_post_id}";
        $del_post_query = mysqli_query($connection, $query);
        successQuery($del_post_query);
        
        header("Location: posts.php");
    }
?>