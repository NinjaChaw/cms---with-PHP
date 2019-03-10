
<?php
    if(isset($_POST['checkBoxArray'])) {
        foreach($_POST['checkBoxArray'] as $checkBoxPostId) {
            $bulk_options = $_POST['bulk_options'];
            
            switch($bulk_options) {
                case 'published':
                    $query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$checkBoxPostId} ";
                    $update_to_published_status = mysqli_query($connection, $query);
                    successQuery($update_to_published_status);
                    break;
                
                case 'draft':
                    $query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id={$checkBoxPostId} ";
                    $update_to_draft_status = mysqli_query($connection, $query);
                    successQuery($update_to_draft_status);
                    break;
                    
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id={$checkBoxPostId} ";
                    $delete_to_checked_posts = mysqli_query($connection, $query);
                    successQuery($delete_to_checked_posts);
                    break;
            }
        }
    }
?>
   <form action="" method="POST">
    <table class="table table-hover">
    <div class=" col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select option</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class=" col-xs-4">
        <input type="submit" class="btn btn-success">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add new</a>
    </div>
    <thead>
       <th><input type="checkbox" name="selectAllBoxes"></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>tages</th>
        <th>Comments</th>
        <th>Date</th>
    </thead>
    <tbody>
       <?php
            $query = "SELECT * FROM posts";

            $select_all_post_query = mysqli_query($connection, $query);
            if(!$select_all_post_query) {
                die("CONNECTION ERROR".mysqli_error($connection));
            }

            while($row = mysqli_fetch_assoc($select_all_post_query)) {
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
        <tr>
           <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
            <td><?php echo $post_id; ?></td>
            <td><?php echo $post_author; ?></td>
            <td><?php echo $post_title; ?></td>
            <td><?php echo $post_category_id; ?></td>
            <td><?php echo $post_status; ?></td>
            <td><img src="../images/<?php echo $post_image; ?>" alt="Post image" class="img-responsive" height="100px" width="200px"></td>
            <td><?php echo $post_tags; ?></td>
            <td><?php echo $post_comment_count; ?></td>
            <td><?php echo $post_date; ?></td>
            <td><a class="btn btn-success btn-xs" href="./posts.php?source=edit_post&edit_id=<?php echo $post_id; ?>">Edit</a></td>
            <td><a onClick=\"javascript: return confirm('Confirm delete..');\" class="btn btn-danger btn-xs" href="./posts.php?delete=<?php echo $post_id; ?>">Delete</a></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    </form>
    
   
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