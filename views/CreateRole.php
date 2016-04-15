 <?php 

 if ( !empty($_POST)) {

if(!isset($_POST['CreateTemplate'])){ $CreateTemplate = 0; }
else { $CreateTemplate = 1; }
if(!isset($_POST['CreateReport'])){ $CreateReport = 0; }
else { $CreateReport = 1; }
if(!isset($_POST['DeleteReport'])){ $DeleteReport = 0; }
else { $DeleteReport = 1; }
if(!isset($_POST['EditReport'])){ $EditReport = 0; }
else { $EditReport = 1; }
if(!isset($_POST['CloseReport'])){ $CloseReport = 0; }
else { $CloseReport = 1; }
if(!isset($_POST['OpenReport'])){ $OpenReport = 0; }
else { $OpenReport = 1; }
if(!isset($_POST['UserManagement'])){ $UserManagement = 0; }
else { $UserManagement = 1; }
if(!isset($_POST['DeleteTemplate'])){ $DeleteTemplate = 0; }
else { $DeleteTemplate = 1; }
if(!isset($_POST['UpdateTemplate'])){ $UpdateTemplate = 0; }
else { $UpdateTemplate = 1; }
if(!isset($_POST['AddAttatchment'])){ $AddAttatchment= 0; }
else { $AddAttatchment= 1; }
if(!isset($_POST['DeleteAttatchment'])){ $DeleteAttatchment= 0; }
else { $DeleteAttatchment= 1; }

$RoleName = $_POST['RoleName'];


require 'database.php';
$pdo = Database::connect();

$query = $pdo->prepare('SELECT * FROM roles WHERE user_role= :role');
$query->bindParam(':role', $RoleName);
$query->execute();

if($query->rowCount() == 0){
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO roles (user_role, CreateTemplate, CreateReport, DeleteReport, EditReport, CloseReport, OpenReport, delete_template, user_management, update_template, AddAttatchment, DeleteAttatchment) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoleName, $CreateTemplate, $CreateReport, $DeleteReport, $EditReport, $CloseReport, $OpenReport, $DeleteTemplate, $UserManagement, $UpdateTemplate,$AddAttatchment,$DeleteAttatchment));
?> 
<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
    <strong>Success </strong> Role created and ready to assign to users.
  </div>
<?php
} else { 
?>
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
    <strong>Warning </strong> Role name already took. Please try again.
  </div>
<?php
}


            Database::disconnect();
}

?>
    <link href="css/animate.css" rel="stylesheet">
<div class="animated slideInLeft">
<div class="col-md-8">
<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend>Create Role</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Role Name</label>  
  <div class="col-md-5">
  <input id="textinput" name="RoleName" type="text" placeholder="Role Name" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Multiple Checkboxes -->
<div class="form-group">
  <label class="col-md-4 control-label" for="checkboxes">Permissions</label>
  <div class="col-md-4">
  <div class="checkbox">
    <label for="checkboxes-0">
      <input type="checkbox" name="CreateTemplate" id="checkboxes-0" value="1">
      Create Report Template
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-1">
      <input type="checkbox" name="CreateReport" id="checkboxes-1" value="1">
      Create and Submit Record
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-2">
      <input type="checkbox" name="DeleteReport" id="checkboxes-2" value="1">
      Delete report Record
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-3">
      <input type="checkbox" name="EditReport" id="checkboxes-3" value="1">
      Edit Report Details
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-4">
      <input type="checkbox" name="CloseReport" id="checkboxes-4" value="1">
      Close Report
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-5">
      <input type="checkbox" name="OpenReport" id="checkboxes-5" value="1">
      Open Report
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-5">
      <input type="checkbox" name="DeleteTemplate" id="checkboxes-5" value="1">
      Delete Template
    </label>
	</div>

  <div class="checkbox">
    <label for="checkboxes-5">
      <input type="checkbox" name="UpdateTemplate" id="checkboxes-5" value="1">
      Update Template
    </label>
	</div>

  <div class="checkbox">
    <label for="checkboxes-5">
      <input type="checkbox" name="AddAttatchment" id="checkboxes-5" value="1">
      Add Attatchment's
    </label>
	</div>

  <div class="checkbox">
    <label for="checkboxes-5">
      <input type="checkbox" name="DeleteAttatchment" id="checkboxes-5" value="1">
      Delete Attatchment's
    </label>
	</div>


  <div class="checkbox">
    <label for="checkboxes-6">
      <input type="checkbox" name="UserManagement" id="checkboxes-6" value="1">
      User Management
    </label>
	</div>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="SaveRole"></label>
  <div class="col-md-4">
    <button id="SaveRole" name="SaveRole" class="btn btn-success one">Save</button>
  </div>
</div>

</fieldset>
</form>
</div>
</div>