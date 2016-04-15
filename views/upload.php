<?php


$target_dir = "uploads/";
$target_name = basename($_FILES["fileToUpload"]["name"]);
$target_name_new = uniqid('', true);
$target_file = $target_dir . $target_name_new;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
require "database.php";
if(isset($_POST["submit"])) {
        $uploadOk = 1;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if(isset($_POST["submit"])) {
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
?>
  <div class="alert alert-success">
    <strong>Success!</strong> <?php echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";?> </div> 
<?php

     $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO upload(newname,oldname,form_id) values(?,?,?)";
            $q = $pdo->prepare($sql);
$id = $_GET['id'];
            $q->execute(array($target_name_new,$_FILES["fileToUpload"]["name"],$id));
header("Location: index.php?source=Upload&id=".$id."&msg=upl");
            Database::disconnect();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}

?>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Attatchment</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

<?php

$id = $_GET['id'];
 $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT user_name FROM FormSubmission where form_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetchColumn();
Database::disconnect();

include 'uploadpaginator.php';
$id = $_GET['id'];
                   $pdo = Database::connect();
$paginator = new Paginator();
$sql = "SELECT count(*) FROM upload WHERE form_id = $id";
$paginator->paginate($pdo->query($sql)->fetchColumn());
 

$start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
$length = ($paginator->itemsPerPage);
                   $sql = "SELECT * FROM upload WHERE form_id = $id ORDER BY upload_id DESC limit $start, $length";
                   $q = $pdo->prepare($sql);
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['oldname'] . '</td>';
echo '<td > <a class="btn btn-success one" href="uploads/' . $row['newname'] . '" download="' . $row['oldname'] .'">Dowload</a>';
                            echo ' ';
if($_SESSION['DeleteAttatchment'] == 1 || $data == $_SESSION['user_name']) { 
                            echo '<a class="btn btn-danger four" href="?source=DeleteUpload&idt='.$id.'&id='.$row['upload_id'].'">Delete</a></td>';
}

                            echo '</tr>';
                   } 
                   Database::disconnect();
                  ?>
                  </tbody>
  </table>

<?php 

$id = $_GET['id'];
 $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT user_name FROM FormSubmission where form_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetchColumn();
Database::disconnect();

if($_SESSION['AddAttatchment'] == 1 || $data == $_SESSION['user_name']) { 

 $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT status FROM FormSubmission where form_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data1 = $q->fetchColumn();
Database::disconnect();

 $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT user_name FROM FormSubmission where form_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data2 = $q->fetchColumn();
Database::disconnect();

$username = $_SESSION['user_name'];

if($data1 == 'Draft' AND $data2 == $username){
?>

<form method="post" enctype="multipart/form-data">
    Select file to upload:

    <input type="file" name="fileToUpload" id="fileToUpload" >

    <input type="submit" value="Upload File" name="submit">
</form>

<?php }  

if($data1 == 'Open' AND $_SESSION['AddAttatchment'] == 1){
?>

<form method="post" enctype="multipart/form-data">
    Select file to upload:

    <input type="file" name="fileToUpload" id="fileToUpload" >

    <input type="submit" value="Upload File" name="submit">
</form>

<?php }} ?>
                          <button type="button" class="btn btn-danger four" onclick="goBack()">Back</button>
