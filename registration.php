<?php  include "includes/db_connection.php"; ?>
<?php  include "includes/head.php"; ?>

<?php
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if(!empty($username) && !empty($email) && !empty($password)) {
            
            $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        
        $query = "SELECT user_randsalt FROM users ";
        $select_randsalt_query = mysqli_query($connection, $query);
        if(!$select_randsalt_query) {
            die("Query Faild". mysqli_error($connection));
        }
            $row = mysqli_fetch_array($select_randsalt_query);
            $salt = $row['user_randsalt'];
            $password = crypt($password, $salt);
            
            $query = "INSERT INTO users(user_name, user_email, user_password, user_role) ";
            $query .= "VALUE('{$username}', '{$email}', '{$password}', 'subscriber') ";
            $user_insert_query = mysqli_query($connection, $query);
            if(!$user_insert_query) {
                die("Query faild".mysqli_er ror($connection));
            }
            
        $message = "Registration has been submited.";
            
        }else {
            $message = "Filds cannot be empty.";
        }
    }else {
        $message = "";
    }
?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Register</h1>
                    <h5><?php echo $message; ?></h5>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

        <hr>

<?php include "includes/footer.php";?>