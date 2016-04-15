<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
$status = "Open";
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE FormSubmission set status = ? WHERE form_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($status, $id));
        Database::disconnect();
        header("Location: index.php?source=ViewReports&msg=open");
         
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
                        <h3>Re-open Report Status</h3>
                    </div>
                     
                    <form class="form-horizontal" action="?source=OpenReport&id=<?php echo $id?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                                           <div style="max-width:500px;" class="alert alert-danger">
Are you sure you want to re-open this report?
  </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="index.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>