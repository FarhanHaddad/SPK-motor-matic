<?php
require './includes/config.php';

$page_title = 'login';
$err = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($dbc, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = true;
        header("Location: index.php");
        echo "Berhasil Login";
    }
    $err = true;
}

include './includes/header.php';
?>

<!--bootstrap-->
<link href="tampilan/css/bootstrap.min.css" rel="stylesheet">
<link href="styles/slider.css" rel="stylesheet" type="text/css" media="all">
<link href="styles/layout.css" rel="stylesheet" type="text/css" media="all">


<div class="col-md-4 col-md-offset-4">
    <div class="page-header">
        <h1 class="text-center">Login</h1>
    </div>
    <form method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <br />
    <p class="help-block">username: admin dan password: admin</p>

    <?php
    if ($err) {
        echo '<div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Username</strong> atau <strong>Password</strong> salah.
            </div>';
    }
    ?>

</div>



<?php
include './includes/footer.php';
?>