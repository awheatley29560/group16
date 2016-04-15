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
        $archive = $_POST['archive'];
$id = $_GET['id'];
        // validate input
        $valid = true;
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE forms set Archive = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($archive,$id));
            Database::disconnect();
            header("Location: index.php?source=ViewTemplate&msg=arc");
        }
    } 

$id = $_GET['id'];

?>

<form class="form-horizontal" method="post" action="?source=ArchiveTemplate&id=<?php echo $id?>">
<fieldset>

<!-- Form Name -->
<legend>Archive Template</legend>


<div class="form-group">
 <div style="max-width:500px;" class="alert alert-danger">
Are you sure you want to Archive Template?
</div>
  <div class="col-md-4">
  <input value="1" id="archive" name="archive" type="text" class="hidden">
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

