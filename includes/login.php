<?php include("db_connection.php"); ?>
<?php session_start(); ?>

<?php

    if(isset($_POST['login'])) {
        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];
        
        $login_username = mysqli_real_escape_string($connection, $login_username);
        $login_password = mysqli_real_escape_string($connection, $login_password);
    }

    $query = "SELECT * FROM users";

    $select_all_users_query = mysqli_query($connection, $query);
    if(!$select_all_users_query) {
        die("CONNECTION ERROR".mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($select_all_users_query)) {
        $user_name = $row["user_name"];
        $user_password = $row["user_password"];
        $user_email = $row["user_email"];
        $user_role = $row["user_role"];
    }

    $login_password = crypt($login_password, $user_password);

    if($login_username !== $user_name && $login_password !== $user_password) {
        header('Location: ../index.php');
        
    }else if($login_username === $user_name && $login_password === $user_password) {
        
        $_SESSION['username'] = $login_username;
        $_SESSION['password'] = $login_password;
        $_SESSION['role'] = $user_role;
        header('Location: ../admin');
        
    }else {
        header('Location: ../index.php');
    }
?>