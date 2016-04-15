<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {

        // keep track post values
        $activate= $_POST['activate'];
$id = $_GET['id'];
        // validate input
        $valid = true;
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users set Archive = ? WHERE user_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($activate,$id));
            Database::disconnect();
            header("Location: index.php?source=ViewArchiveUser&msg=arc");
        }
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
<legend>Archive User</legend>


<div class="form-group">
 <div style="max-width:500px;" class="alert alert-danger">
You cannot Archive a user with open reports.
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
} else { 
?>

<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend>Activate User</legend>


<div class="form-group">
 <div style="max-width:500px;" class="alert alert-danger">
Are you sure you want to Re-activate User?
</div>
  <div class="col-md-4">
  <input value="0" id="archive" name="activate" type="text" class="hidden">
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
