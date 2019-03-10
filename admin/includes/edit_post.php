<?php
    if(isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
        
            $query = "SELECT * FROM posts WHERE post_id={$edit_id}";
            $select_edit_post_query = mysqli_query($connection, $query);
            successQuery($select_edit_post_query);

            while($row = mysqli_fetch_assoc($select_edit_post_query)) {
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
        }
    }

    //Update post
    if(isset($_POST['update_post'])) {
        $post_title = $_POST["post_title"];
        $post_category_id = $_POST["post_category_id"];
        $post_author = $_POST["post_author"];
        $post_status = $_POST["post_status"];
        
        $post_image = $_FILES["post_image"]["name"];
        $post_image_tmp = $_FILES["post_image"]["tmp_name"];
        
        $post_tags = $_POST["post_tags"];
        $post_content = $_POST["post_content"];
        $post_date = date('d-m-y');
        $post_comment_count = 3;
        
        //Delete previous file releted this post
        $query = "SELECT * FROM posts WHERE post_id={$post_id}";
        $delete_image_query = mysqli_query($connection, $query);
        successQuery($delete_image_query);
        while($row = mysqli_fetch_assoc($delete_image_query)) {
            $post_prev_image = $row['post_image'];
            unlink("../images/{$post_prev_image}");
        }
        
        //Move uploaded file
        move_uploaded_file($post_image_tmp, "../images/$post_image");
        
        //Database update
        $query = "UPDATE posts SET ";
        $query .= "post_category_id={$post_category_id}, post_title='{$post_title}', post_author='{$post_author}', post_date='{$post_date}', post_image='{$post_image}', post_content='{$post_content}', post_tags='{$post_tags}', post_comment_count={$post_comment_count}, post_status='{$post_status}' ";
        $query .= "WHERE post_id={$edit_id} ";
        
        $create_post_query = mysqli_query($connection, $query);
        successQuery($create_post_query);
        
        header("Location: posts.php");
    }
?>
   
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <div class="form-group">
            <label for="post_title">Post Title</label>
            <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
        </div>
        <div class="form-group">
            <label for="post_category_id">Post Category Id</label>
            <input type="text" class="form-control" name="post_category_id" value="<?php echo $post_category_id; ?>">
        </div>
        <div class="form-group">
            <label for="post_author">Post Author</label>
            <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
        </div>
        <div class="form-group">
            <label for="post_status">Post Status</label>
            <br>
            <select name="post_status" id="">
                <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
                <?php
                if($post_status == 'published') {
                    echo "<option value='draft'>Draft</option>";
                }else {
                    echo "<option value='published'>Published</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post_image">Choose an image</label>
            <input type="file" class="form-control" name="post_image">
        </div>
        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
        </div>
        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea name="post_content" class="form-control" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success" name="update_post">Update</button>
        </div>
    </div>
</form>