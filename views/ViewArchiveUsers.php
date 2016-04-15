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
$msg = $_GET['msg'];
?>

  <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php   if($msg == 'arc'){ echo "User was re-activated."; } ?> </div>

<?php
}

?>

<div class="col-md-7 table-responsive">

<form class="form-horizontal pull-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
<fieldset>

<legend>Archived Users</legend>

<!-- Appended Input-->
<div class="form-group" >
<div class="col-md-4">
</div>
  <label class="col-md-4 control-label" for="appendedtext"></label>
  <div class="col-md-4">
    <div class="input-group">
<input type="hidden" name="source" value="ViewArchiveUser">
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
                      <th>UserName</th>
                      <th>Email Address</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php

                       include 'archivepaginator.php';
                       include 'database.php';
                       $pdo = Database::connect();

                       $paginator = new Paginator();

                       $sql = "SELECT count(*) FROM users WHERE Archive = 1";
                       $paginator->paginate($pdo->query($sql)->fetchColumn());

                       $sql = "SELECT * FROM users ";

                       $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';
                       $sql .= "WHERE Archive = 1 AND (user_name LIKE :query OR user_email LIKE :query OR Archive LIKE :query)  ";

                       $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                       $length = ($paginator->itemsPerPage);
                       $sql .= "ORDER BY user_id DESC ";
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
if($row['Archive'] == 1){
                            echo '<tr>';
                            echo '<td>'. $row['user_name'] . '</td>';
                            echo '<td>'. $row['user_email'] . '</td>';
                            echo '<td>'. $row['user_role'] . '</td>';
                            echo '<td> <a class="btn btn-success one" href="?source=UpdateUser&id='.$row['user_id'].'">Update</a>';
echo ' ';
                            echo '<a class="btn btn-warning two" href="?source=ActivateUser&id='.$row['user_id'].'&name='.$row['user_name'].'">Re-Activate</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger four" href="?source=DeleteUser&id='.$row['user_id'].'">Delete</a></td>';
                            
                            echo '</tr>';}
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
</table>

<?php if(empty($_GET['query'])){ echo $paginator->pageNav(); }?>

</div>
</div>
</div>
</div>
</div>