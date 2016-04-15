    <link href="css/animate.css" rel="stylesheet">
<?php if(isset($_GET['current']) || isset($_GET['query'])){
}
else { ?>
<div class="animated slideInLeft">
<?php } ?>
<legend> Roles </legend>
<div class="container">
<div class="row">

<div class="col-md-4 table-responsive">
<?php
if(isset($_GET['msg'])){
$msg = $_GET['msg'];
?>

  <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php if($msg == 1){ echo "Role was deleted."; }  if($msg == 2){ echo "Role was updated."; } ?> </div>

<?php
}

?>
<table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Role Name</th>
<th>Action's </th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php

                   include 'database.php';
include 'rolepaginator.php';
                   $pdo = Database::connect();
$paginator = new Paginator();
$sql = "SELECT count(*) FROM roles";
$paginator->paginate($pdo->query($sql)->fetchColumn());
 
$start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
$length = ($paginator->itemsPerPage);
                   $sql = "SELECT * FROM roles ORDER BY role_id DESC limit $start, $length";
                   $q = $pdo->prepare($sql);
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['user_role'] . '</td>';
echo '<td > <a class="btn btn-success one" href="?source=UpdateRole&id='.$row['role_id'].'">Update</a>';
echo ' ';
                            echo '<a class="btn btn-danger four" href="?source=DeleteRole&name='.$row['user_role'].'">Delete</a></td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
</table>
</div>
</div>
</div>
<?php echo $paginator->pageNav();?>
</div>