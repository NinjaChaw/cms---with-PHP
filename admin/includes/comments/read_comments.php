
<table class="table table-hover">
<thead>
    <th>Id</th>
    <th>Comment Post Id</th>
    <th>Author</th>
    <th>Email</th>
    <th>Content</th>
    <th>Status</th>
    <th>In response to</th>
    <th>Date</th>
</thead>
<tbody>
   <?php
        $query = "SELECT * FROM comments";

        $select_all_comments_query = mysqli_query($connection, $query);
        if(!$select_all_comments_query) {
            die("CONNECTION ERROR".mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($select_all_comments_query)) {
            $comment_id = $row["comment_id"];
            $comment_post_id = $row["comment_post_id"];
            $comment_author = $row["comment_author"];
            $comment_email = $row["comment_email"];
            $comment_content = $row["comment_content"];
            $comment_status = $row["comment_status"];
            $comment_date = $row["comment_date"];
            
            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_post_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_status}</td>";
            echo "<td>{$comment_date}</td>";
            echo "<td>Approve</td>";
            echo "<td>Unapprove</td>";
            echo "<td><a class='btn btn-danger btn-xs' href='./read_comments.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }
    ?>
</tbody>
</table>
    
   
<?php
    if(isset($_GET['delete'])) {
        $del_comment_id = $_GET['delete'];
        
        $query = "DELETE FROM comments WHERE comment_id={$del_comment_id}";
        $del_comment_query = mysqli_query($connection, $query);
        successQuery($del_comment_query);
        
        header("Location: read_comments.php");
    }
?>