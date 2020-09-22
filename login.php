<?php
session_start();
/**
 * Created by  jibon Bikash Roy.
 * User: jibon
 * Date: 8/29/20
 * Time: 11:08 PM
 * Copyright jibon <jibon.bikash@gmail.com>
 */

if(!empty($_SESSION["adminlogin"] )){
    header('Location: index.php');
    exit;
}

$message='';
if (isset($_POST['submit'])) {
    if($_POST['username']=='admin' && $_POST['password']=='admin12345'){
        $_SESSION["adminlogin"] = uniqid();
        header("Location: index.php");
        exit();

    }
    else{

        $message=' <h3>Invalid username or password</h3>';
    }

}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>IT Grow Division Ltd</title>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">IT Grow Division Ltd.</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


</nav>

<div class="container mt-5">
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 mx-auto form p-4">

            <div class="card">
                <div class="card-header ">
                    Login
                </div>
                <div class="card-body">
                    <form id="login-form" class="form" action="" method="post">
                        <?php
                        if(!empty($message)){
                            echo '<div class="alert alert-danger" role="alert">'.$message.'</div>';
                        }

                        ?>
                        <div class="form-group">
                            <label for="username">Username:</label><br>
                            <input type="text" name="username" id="username" value="admin" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label><br>
                            <input type="password" name="password" id="password" value="admin12345" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <br>
                            <input type="submit" name="submit" class="btn btn-primary btn-md" value="submit">
                        </div>
                        <div id="register-link" class="text-right">

                        </div>
                    </form>
                    <p>
                       Username: admin<br />
                       Password: admin12345<br />
                    </p>
                </div>
            </div>
            </div>
            </div>


        </div>
    </div>
</div>

</body>

</html>