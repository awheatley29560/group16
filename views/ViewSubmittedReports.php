    <link href="css/animate.css" rel="stylesheet">
<?php if(isset($_GET['current']) || isset($_GET['query'])){
}
else { ?>
<div class="animated slideInLeft">
<?php } ?>

<div class="col-md-12 table-responsive">
<?php
if(isset($_GET['msg'])){
?>

  <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php if($_GET['msg'] == 'dlt') { echo "Report has been deleted."; } else if($_GET['msg'] == 'submit'){ echo "Report has been submitted."; } else {  echo "Report has been updated."; }?></div>

<?php
}

?>

<legend> View My reports </legend>
<table class="table table-striped table-bordered table-responsive">
                  <thead>
                    <tr>
                      <th style="max-width:85px !important;">Report Type</th>
                      <th>Submitted By</th>
                      <th>Creation Date</th>
<th> Status </th>
<th style="max-width:80px">Severity</th>
<th>Actions </th>
<th>Attachments</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php

$name = $_SESSION['user_name'];

                   include 'database.php';
include 'viewreportspaginator.php';
                   $pdo = Database::connect();
$paginator = new Paginator();
$sql = "SELECT count(*) FROM FormSubmission WHERE user_name = '$name'";
$paginator->paginate($pdo->query($sql)->fetchColumn());
 
$start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
$length = ($paginator->itemsPerPage);


                   $sql = "SELECT * FROM FormSubmission WHERE user_name = '$name' ORDER BY form_id DESC limit $start, $length" ;
                   $q = $pdo->prepare($sql);
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';

$pdo = Database::connect();
$count=$pdo->prepare("select form_name from forms where id =:id");
$count->bindParam(":id",$row['formt_id']);
$count->execute();
Database::disconnect();
$result=$count->fetchColumn();

                            echo '<td style="max-width:85px !important;">'. $result . '</td>';
                            echo '<td>'. $row['user_name'] . '</td>';
                            echo '<td>'. $row['date'] . '</td>';
                            echo '<td>'. $row['status'] . '</td>';
                            echo '<td>'. $row['Severity'] . '</td>';
                            echo '<td> <a class="btn btn-success one" href="?source=ReadReport&id='.$row['form_id'].'">Read</a>';

echo ' ';

$status = $row['status'];
if ($status == "Draft"){
 echo '<a class="btn btn-warning two" href="?UpdateReport='.$row['formt_id'].'&vsr=true&id='.$row['form_id'].'">Update</a>';
echo ' ';
                            echo '<a class="btn btn-info three" href="?source=SubmitReport&id='.$row['form_id'].'">Submit</a>';
echo ' ';
                            echo '<a class="btn btn-info four" href="?source=DeleteMyReport&id='.$row['form_id'].'">Delete</a></td>';

} 
echo ' ';
                            echo '<td><a class="btn btn-info five" href="?source=Upload&id='.$row['form_id'].'">Attachments</a></td>';

                            echo '</tr>';
                   }
                   Database::disconnect();

                  ?>
                  </tbody>
</table>
<?php echo $paginator->pageNav();?>
</div>
</div>
