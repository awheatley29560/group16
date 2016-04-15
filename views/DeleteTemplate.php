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
        $sql = "DELETE FROM forms WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index.php?source=ViewTemplate&msg=1");
         
    }

$id = $_GET['id'];

$pdo = Database::connect();
$count=$pdo->prepare("select formt_id from FormSubmission where formt_id=:id");
$count->bindParam(":id",$id);
$count->execute();
$no=$count->rowCount();
if($no >0 ){ ?>

<form class="form-horizontal" method="post" action="?source=ArchiveUser&id=<?php echo $id?>">
<fieldset>

<!-- Form Name -->
<legend>DeleteTemplate</legend>


<div class="form-group">
 <div style="max-width:500px;" class="alert alert-danger">
You cannot Delete a report with submitted Reports on the system. Why not just archive the template?</div>

</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirm"></label>
  <div class="col-md-4">
    <div class="form-actions">
                          <button type="button" class="btn btn-danger four" onclick="goBack()">Back</button>
                        </div>
  </div>
</div>


</form> <?php
} else { 
?>


    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Delete a Template</h3>
                    </div>
                     
                    <form class="form-horizontal" action="?source=DeleteTemplate&id=<?php echo $id?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                                           <div style="max-width:500px;" class="alert alert-danger">
Are you sure you want to delete this template?
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
<?php } Database::Disconnect(); ?>