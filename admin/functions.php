<?php

//Insert into category table query
function createCategory() {
    global $connection;
    
    if(isset($_POST["submit"])) {
        if($_POST['category_title'] == "" || empty($_POST['category_title'])) {
            echo "Categoty field can not be empty";
        }else {
            $category_title = $_POST["category_title"];
            $query = "INSERT INTO categories(title) VALUE('{$category_title}') ";
            $insert_category_query = mysqli_query($connection, $query);
        }
    }                            
}
//End Insert into category table query


//start Query from database for show data table
function databaseRead() {
    global $connection;
    
    $query = "SELECT * FROM categories";
    $select_all_category_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_all_category_query)) {
        $category_id = $row["id"];
        $category_title = $row["title"];

        echo "<tr>";
        echo "<td>{$category_id}</td>";
        echo "<td>{$category_title}</td>";
        echo "<td><a class='btn btn-xs btn-danger' href='create_category.php?delete={$category_id}'>Delete</a></td>";
        echo "<td><a href='create_category.php?edit={$category_id}' class='btn btn-success btn-xs'>Edit</a></td>";
        echo "</tr>";
    }
}
//End database query for show data table

//Connection failed query
function successQuery($result) {
    global $connection;
    if(!$result) {
        die('QUERY FAILD .' .mysqli_error($connection));
    }
}
// End connection  faild query

?>