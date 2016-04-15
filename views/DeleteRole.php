<?php
    require 'database.php';
 

    if ( !empty($_POST)) {
$name = $_GET['name'];
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM roles WHERE user_role = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name));
            Database::disconnect();
            header("Location: index.php?source=ViewRole&msg=1");

    } 

$name = $_GET['name'];

$status = "Open";
$pdo = Database::connect();
$count=$pdo->prepare("select user_role from users where user_role =:role");
$count->bindParam(":role",$name);
$count->execute();
$no=$count->rowCount();
if($no >0 ){ ?>
<form class="form-horizontal" method="post" action="?source=DeleteRole&id=<?php echo $id?>">
<fieldset>

<!-- Form Name -->
<legend>Delete Role</legend>


<div class="form-group">
 <div style="max-width:500px;" class="alert alert-danger">
You cannot Delete role as it has users assigned.
</div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirm"></label>
  <div class="col-md-4">
    <div class="form-actions">
                          <a class="btn btn-primary" href="index.php?source=ViewRole">Back</a>
                        </div>
  </div>
</div>


</form> <?php
} else { 
?>

<form class="form-horizontal" method="post" action="?source=DeleteRole&name=<?php echo $name?>">
<fieldset>

<!-- Form Name -->
<legend>Archive User</legend>


<div class="form-group">
 <div style="max-width:500px;" class="alert alert-danger">
Are you sure you want to Delete Role?
</div>
  <div class="col-md-4">
  <input value="1" id="deleterole" name="deleterole" type="text" class="hidden">
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirm"></label>
  <div class="col-md-4">
    <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <button type="button" class="btn btn-danger" onclick="goBack()">Back</button>
                        </div>
  </div>
</div>


</form>


<?php } 

Database::disconnect();
?>
