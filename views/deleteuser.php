<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM users WHERE user_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index.php?source=ViewUser&msg=dlt");
         
    }


$name = $_GET['name'];
$id = $_GET['id'];

$status = "Open";
$pdo = Database::connect();
$count=$pdo->prepare("select status from FormSubmission where status =:status AND user_name =:name");
$count->bindParam(":status",$status);
$count->bindParam(":name",$name);
$count->execute();
$no=$count->rowCount();
if($no >0 ){ ?>

<form class="form-horizontal" method="post" action="?source=ArchiveUser&id=<?php echo $id?>">
<fieldset>

<!-- Form Name -->
<legend>Delete User</legend>


<div class="form-group">
 <div style="max-width:500px;" class="alert alert-danger">
You cannot delete a user with open reports.
</div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirm"></label>
  <div class="col-md-4">
    <div class="form-actions">
                          <a class="btn btn-primary" href="index.php?source=ViewUser">Back</a>
                        </div>
  </div>
</div>


</form> <?php
} else if ($_SESSION['user_name'] == $name) { 
?>
 

<form class="form-horizontal" method="post" action="?source=ArchiveUser&id=<?php echo $id?>">
<fieldset>

<!-- Form Name -->
<legend>Delete User</legend>


<div class="form-group">
 <div style="max-width:500px;" class="alert alert-danger">
You cannot delete yourself.
</div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirm"></label>
  <div class="col-md-4">
    <div class="form-actions">
                          <a class="btn btn-primary" href="index.php?source=ViewUser">Back</a>
                        </div>
  </div>
</div>


</form> <?php } else { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Delete a Customer</h3>
                    </div>
                     
                    <form class="form-horizontal" action="?source=DeleteUser&id=<?php echo $id?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                                           <div style="max-width:500px;" class="alert alert-danger">
Are you sure want delete this user?
  </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <button type="button" class="btn btn-danger" onclick="goBack()">Back</button>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>

<?php

}

Database::disconnect();
?>