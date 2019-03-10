<?php
    if(isset($_POST['update'])) {
        if($_POST['updated_title'] == "" || empty($_POST['updated_title'])) {
            echo "Categoty field can not be empty";
        }else {
            $updated_title = $_POST["updated_title"];
            $query = "UPDATE categories SET title=('{$updated_title}') WHERE id=($edit_id) ";
            $update_category_query = mysqli_query($connection, $query);
        }
    }
?>
    <form action="" method="post">
        <div>
            <div class="form-group">
                <label for="updated_title">Update Category</label>
                <?php
                    $query = "SELECT * FROM categories WHERE id=($edit_id)";
                    $select_one_category_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_one_category_query)) {
                        $edit_title = $row['title'];
                    }
                ?>
                <input type="text" class="form-control" name="updated_title" value="<?php echo $edit_title; ?>">
            </div>
            <div class="form-group">
                <button class="btn btn-success" name="update" type="submit">
                    Update
                </button>
            </div>
        </div>
    </form>