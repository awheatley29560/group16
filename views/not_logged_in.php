

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ideagen</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">

</head>

<body  style="background-color: #CAD7EB;">
    <nav class="navbar navbar-default navbar-fixed-top">
    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  id="menu-toggle">
                      <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img alt="Brand" src="img/ideagen.png" height="125%";></a>        
                </div><!-- navbar-header-->
    </nav>
  
    <!-- Page Content -->
        <div class="container">
    <div class="row" style="margin-top:50px">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
echo "<div class='alert alert-info'>
  <strong>"; 
            echo $error;
echo "</strong></div>";
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
echo "<div class='alert alert-info'>
  <strong>"; 
            echo $message;
echo "</strong> 
</div>";
        }
    }
}
?>
            <div class="animated fadeInLeft box-login">
               
               <div id="rotator">
                <img class="signin-logo" src="img/roboto.png"alt="">
                </div>
                <hr>
                <form class="form-signin" action="index.php?source=Home" method="post" name="loginform">
                <input id="login_input_username" name="user_name" type="text" class="form-control login_input" placeholder="Username" required autofocus>
                
                <input id="login_input_password"type="password" class="form-control login_input" placeholder="Password" name="user_password" autocomplete="off" required>
                <button class="btn btn-lg btn-primary btn-block" name="login" value="Log in" type="submit">
                    Sign in</button>
                </form>
                <!-- login form box -->
            </div>
        </div>
    </div>
</div>
    <!--
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/sidebar_menu.js"></script>
</body>

</html>