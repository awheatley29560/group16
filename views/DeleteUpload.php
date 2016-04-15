<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( !empty($_GET['idt'])) {
        $idt = $_REQUEST['idt'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
        $idt = $_POST['idt'];
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM upload WHERE upload_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index.php?source=Upload&id=".$idt."&msg=dlt");
         
    }
?>
 
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
                        <h3>Delete Attatchment</h3>
                    </div>
                     
                    <form class="form-horizontal" action="?source=DeleteUpload&idt<?php echo $idt?>=&id=<?php echo $id?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
 <input type="hidden" name="idt" value="<?php echo $idt;?>"/>
                                           <div style="max-width:500px;" class="alert alert-danger">
Are you sure you want to delete this attatchment?
  </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <button type="button" class="btn btn-danger four" onclick="goBack()">Back</button>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>