    <link href="css/animate.css" rel="stylesheet">
<?php if(isset($_GET['current']) || isset($_GET['query'])){
}
else { ?>
<div class="animated slideInLeft">
<?php } ?>
<div class="container">
<div class="row">

<?php
if(isset($_GET['msg'])){
?>

  <div class="alert alert-success col-md-6">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php if($_GET['msg'] == 'dlt') { echo "Report has been deleted."; } else if($_GET['msg'] == 'close'){ echo "Report Closed."; }  else if($_GET['msg'] == 'open'){ echo "Report Opened."; }  else {  echo "Report has been updated."; }?></div>

<?php
}

?>

<div class="col-md-10 table-responsive">
<form class="form-horizontal pull-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
<fieldset>

<!-- Form Name -->
<legend>View Submitted Reports</legend>

<!-- Appended Input-->
<div class="form-group" >
<div class="col-md-4">
</div>
  <label class="col-md-4 control-label" for="appendedtext"></label>
  <div class="col-md-4">
    <div class="input-group">
<input type="hidden" name="source" value="ViewReports">
      <input id="appendedtext" name="query" class="form-control" placeholder="Search" type="text" value="<?php echo isset($_GET['query'])?$_GET['query']:'';?>">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Search</button>
      </span>
    </div>
    
  </div>
</div>
</fieldset>
</form>

<table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Report Type</th>
                      <th>Submitted By</th>
                      <th>Submission Date</th>
<th> Status </th>
<th>Actions </th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
$Draft= "Draft";
                   include 'database.php';
include 'reportspaginator.php';

                   $pdo = Database::connect();


                       $paginator = new Paginator();

                       $sql = "SELECT count(*) FROM FormSubmission WHERE status <> '$Draft'";
                       $paginator->paginate($pdo->query($sql)->fetchColumn());

                       $sql = "SELECT * FROM FormSubmission ";

                       $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';
                       $sql .= "WHERE status <> '$Draft' AND (user_name LIKE :query OR status LIKE :query OR Severity LIKE :query) ";

                       $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                       $length = ($paginator->itemsPerPage);
                       $sql .= "ORDER BY form_id DESC ";
if(empty($_GET['query'])){
$sql .= " limit :start, :length ";
}
                       $sth = $pdo->prepare($sql);
if(empty($_GET['query'])){
                       $sth->bindParam(':start',$start,PDO::PARAM_INT);
                       $sth->bindParam(':length',$length,PDO::PARAM_INT);
}
                       $sth->bindParam(':query',$query,PDO::PARAM_STR);
                       $sth->execute();

	 				   foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
                            echo '<tr>';
$pdo = Database::connect();
$count=$pdo->prepare("select form_name from forms where id =:id");
$count->bindParam(":id",$row['formt_id']);
$count->execute();
Database::disconnect();
$type=$count->fetchColumn();
                            echo '<td>'. $type . '</td>';
$pdo = Database::connect();
$count=$pdo->prepare("select Archive from users where user_name =:name");
$count->bindParam(":name",$row['user_name']);
$count->execute();
Database::disconnect();
$result=$count->fetchColumn();
if($result == 1){ 
$result = "  <span class='label label-danger'>Archived</span>";
} else { $result = ''; }
                            echo '<td>'. $row['user_name'] . $result .' </td>';
                            echo '<td>'. $row['submit_date'] . '</td>';
                            echo '<td>'. $row['status'] . '</td>';
                            echo '<td> <a class="btn btn-success one" href="?source=ReadReport&id='.$row['form_id'].'">Read</a>';

echo ' ';
$status = $row['status'];
if ($status == "Open" && $_SESSION['CloseReport'] == 1){
                            echo '<a class="btn btn-warning five" href="?source=CloseReport&id='.$row['form_id'].'">Close</a>';
echo ' ';
if($_SESSION['EditReport'] ==1){
echo '<a class="btn btn-info two" href="?UpdateReport='.$row['formt_id'].'&id='.$row['form_id'].'">Update</a>';
}
} else if ($status == "Closed" && $_SESSION['OpenReport'] == 1){
echo ' ';
echo '<a class="btn btn-primary three" href="?source=OpenReport&id='.$row['form_id'].'">Open</a>';
}
echo ' ';
if($_SESSION['DeleteReport'] == 1){
                            echo '<a class="btn btn-danger four" href="?source=DeleteReport&id='.$row['form_id'].'">Delete</a>';
}
echo ' ';
                            echo '<a class="btn btn-info five" href="?source=Upload&id='.$row['form_id'].'">Attatchments</a></td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
</table>
<?php if(empty($_GET['query'])){echo $paginator->pageNav();}?>
</div>
</div>
</div>
</div>
</div>