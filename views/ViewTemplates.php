    <link href="css/animate.css" rel="stylesheet">
<?php if(isset($_GET['current']) || isset($_GET['query'])){
}
else { ?>
<div class="animated slideInLeft">
<?php } ?>
<div class="col-md-8 table-responsive">

<?php
if(isset($_GET['msg'])){
if($_GET['msg'] == 1){
?>

  <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> The Template has been deleted.  </div>
<?php
} else if($_GET['msg'] == 'arc'){ ?>
 <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> The Template has been archived.  </div> 
<?php
} else if($_GET['msg'] == 'act'){ ?>
 <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> The Template has been re-activated.  </div>
<?php 
} 
else { ?> 
 <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> The Template has been updated.  </div>
<?php 
} 
}
?>

<form class="form-horizontal pull-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
<fieldset>

<legend>View Templates</legend>

<!-- Appended Input-->
<div class="form-group" >


  <label class="col-md-4 control-label" for="appendedtext"></label>
  <div class="col-md-8">
    <div class="input-group">
<input type="hidden" name="source" value="ViewTemplate">
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
                      <th>Template Name</th>
<th>Submitted By</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php

                       include 'templatepaginator.php';
                       include 'database.php';
                       $pdo = Database::connect();

                       $paginator = new Paginator();

                       $sql = "SELECT count(*) FROM forms";
                       $paginator->paginate($pdo->query($sql)->fetchColumn());

                       $sql = "SELECT * FROM forms ";

                       $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';
                       $sql .= "WHERE form_name LIKE :query  ";

                       $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                       $length = ($paginator->itemsPerPage);
                       $sql .= "ORDER BY id DESC ";
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
                            echo '<td>'. $row['form_name'] . '</td>';
echo '<td>'. $row['user_name'] . '</td>';
echo '<td><a class="btn btn-success one" href="?source=ViewReportTemplate&id='.$row['id'].'">View</a>';
echo ' ';
if($_SESSION['UpdateTemplate'] == 1){
echo '<a class="btn btn-info two" href="?source=UpdateTemplate&id='.$row['id'].'">Update</a>';
}
echo ' ';
if($row['Archive'] == 0){
                            echo '<a class="btn btn-danger three" href="?source=ArchiveTemplate&id='.$row['id'].'">Archive</a>';
echo ' ';
} else {
echo '<a class="btn btn-info five" href="?source=ActivateTemplate&id='.$row['id'].'">Activate</a>';
echo ' '; 
}
if($_SESSION['DeleteTemplate'] == 1){
                            echo '<a class="btn btn-danger four" href="?source=DeleteTemplate&id='.$row['id'].'">Delete</a></td>';
}
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
</table>

<?php if(empty($_GET['query'])){ echo $paginator->pageNav(); }?>

</div>
</div>
</div>