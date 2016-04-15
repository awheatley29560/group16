    <link href="css/animate.css" rel="stylesheet">

<div class="col-md-8">
<div class="jumbotron animated bounceInLeft">
  <h1>Hello <?php echo ucfirst($_SESSION['first_name']);?></h1>
<?php

require "database.php";
 $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT newname FROM users where user_name = ?";
        $q = $pdo->prepare($sql);
$name = $_SESSION['user_name'];
        $q->execute(array($name));
        $data = $q->fetchColumn();
        Database::disconnect();
?>

  <p>Welcome to Group 16's Report Management System.</p>

</div>
</div>
<div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading five" style="color:white !important;"><?php echo $_SESSION['user_name']; ?> is logged in.</div>
      <div class="panel-body">
<img height="100" width="100" src="uploads/<?php if($data) { echo $data; } else { echo 'default.png'; } ?>" class="img-circle center-block animated rotateIn" alt="">
<div class="col-xs-12" style="height:25px;"></div>
<?php 
$datetime = new DateTime($_SESSION['login']);

$date = $datetime->format('Y-m-d');
$time = $datetime->format('H:i:s');
if($_SESSION['login'] != '0000-00-00 00:00:00'){
echo "<div class='text-center'><p>You last logged in on " . $date . " at " . $time . "</p></div>";
}
?>
<legend></legend>
<div class="text-center">
<button class="btn btn-primary"  data-toggle="modal" data-target=".bs-example-modal-sm">Logout</button>
</div>

<div class="modal bs-example-modal-sm " tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm animated fadeInRight" >
    <div class="modal-content">
      <div class="modal-header text-center" style="margin-left:25px !important;"><div id="rotator"><img src="img/roboto.png"></div></div>
      <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</div>
      <div class="modal-footer"><a href="index.php?logout" class="btn btn-primary btn-block">Logout</a></div>
    </div>
  </div>
</div></div>
    </div>
</div>
<div class="col-md-6">

<?php

$status = 'Draft';
$pdo = Database::connect();
$count=$pdo->prepare("select status from FormSubmission where status =:status AND user_name =:name");
$count->bindParam(":status",$status);
$count->bindParam(":name",$_SESSION['user_name']);
$count->execute();
Database::Disconnect();
$no=$count->rowCount();


if($_SESSION['CreateReport'] == 1){
if($no >0 ){ ?>

  <div class="alert alert-warning three animated bounceInLeft" style="color:black !important;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>You have <?php echo $no; ?> report<?php if($no > 1){ echo "'s"; } ?> waiting to be submitted!</strong> 
  </div>

 
<?php } }?>

<?php

$status = 'Open';
$pdo = Database::connect();
$count=$pdo->prepare("select status from FormSubmission where status =:status");
$count->bindParam(":status",$status);
$count->execute();
Database::Disconnect();
$no=$count->rowCount();

if($_SESSION['CloseReport'] == 1){
if($no >0 ){ ?>

  <div class="alert alert-warning one animated bounceInLeft" style="color:black !important;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>There <?php if($no > 1){ echo "are"; } else { echo "is"; } ?> <?php echo $no; ?> report<?php if($no > 1){ echo "'s"; } ?> waiting to be reviewed and closed!</strong> 
  </div>
 </div>
<?php } }?>



