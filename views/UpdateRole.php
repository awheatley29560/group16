<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
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
if(!isset($_POST['DeleteTemplate'])){ $DeleteTemplate= 0; }
else { $DeleteTemplate= 1; }
if(!isset($_POST['UpdateTemplate'])){ $UpdateTemplate= 0; }
else { $UpdateTemplate= 1; }
if(!isset($_POST['AddAttatchment'])){ $AddAttatchment= 0; }
else { $AddAttatchment= 1; }
if(!isset($_POST['DeleteAttatchment'])){ $DeleteAttatchment= 0; }
else { $DeleteAttatchment= 1; }
$RoleName = $_POST['RoleName'];

if(isset($_POST['RoleName'])){

  $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM roles where role_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $UserRoleName= $data['user_role'];
         Database::disconnect();



            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users set user_role = ? WHERE user_role = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoleName,$UserRoleName));
            Database::disconnect();

        // validate input
        $valid = true;
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE roles set user_role = ?, CreateTemplate = ?, CreateReport = ?, DeleteReport = ?, EditReport = ?, CloseReport = ?, OpenReport = ?, user_management = ?, delete_template = ?, update_template = ?, AddAttatchment = ?, DeleteAttatchment = ? WHERE role_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($RoleName, $CreateTemplate, $CreateReport, $DeleteReport, $EditReport, $CloseReport, $OpenReport, $UserManagement,$DeleteTemplate,$UpdateTemplate,$AddAttatchment,$DeleteAttatchment,$id));
            header("Location: index.php?source=ViewRole&msg=2");
            Database::disconnect();
        }
}
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM roles  where role_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $RoleName= $data['user_role'];
$CreateTemplate= $data['CreateTemplate'];
$CreateReport= $data['CreateReport'];
$DeleteReport= $data['DeleteReport'];
$EditReport= $data['EditReport'];
$CloseReport= $data['CloseReport'];
$OpenReport= $data['OpenReport'];
$UserManagement= $data['user_management'];
$AddAttatchment= $data['AddAttatchment'];
$DeleteAttatchment= $data['DeleteAttatchment'];
$DeleteTemplate = $data['delete_template'];
$UpdateTemplate = $data['update_template'];
        Database::disconnect();
    }
?>

<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend>Update <?php echo $RoleName; ?> Permissions</legend>

<!-- Text input-->
<div class="form-group">
  <div class="col-md-5">
  <input id="textinput" name="RoleName" type="hidden" placeholder="Role Name" class="form-control input-md" required="" value="<?php echo $RoleName; ?>">
    
  </div>
</div>

<!-- Multiple Checkboxes -->
<div class="form-group">
  <label class="col-md-4 control-label" for="checkboxes">Permissions</label>
  <div class="col-md-4">
  <div class="checkbox">
    <label for="checkboxes-0">
      <input type="checkbox" name="CreateTemplate" id="checkboxes-0" value="1" <?php if($CreateTemplate == 1){ echo "checked"; } ?>>
      Create Report Template
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-1">
      <input type="checkbox" name="CreateReport" id="checkboxes-1" value="1" <?php if($CreateReport == 1){ echo "checked"; } ?>>
      Create and Submit Record
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-2">
      <input type="checkbox" name="DeleteReport" id="checkboxes-2" value="1" <?php if($DeleteReport == 1){ echo "checked"; } ?>>
      Delete report Record
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-3">
      <input type="checkbox" name="EditReport" id="checkboxes-3" value="1" <?php if($EditReport == 1){ echo "checked"; } ?>>
      Edit Report Details
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-4">
      <input type="checkbox" name="CloseReport" id="checkboxes-4" value="1" <?php if($CloseReport == 1){ echo "checked"; } ?>>
      Close Report
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-5">
      <input type="checkbox" name="OpenReport" id="checkboxes-5" value="1" <?php if($OpenReport == 1){ echo "checked"; } ?>>
      Open Report
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-6">
      <input type="checkbox" name="UserManagement" id="checkboxes-6" value="1" <?php if($UserManagement == 1){ echo "checked"; } ?>>
      User Management
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-5">
      <input type="checkbox" name="DeleteTemplate" id="checkboxes-5" value="1" <?php if($DeleteTemplate == 1){ echo "checked"; } ?>>
      Delete Template
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-5">
      <input type="checkbox" name="AddAttatchment" id="checkboxes-5" value="1" <?php if($AddAttatchment== 1){ echo "checked"; } ?>>
      Add Attatchment's    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-5">
      <input type="checkbox" name="DeleteAttatchment" id="checkboxes-5" value="1" <?php if($DeleteAttatchment== 1){ echo "checked"; } ?>>
      Delete Attatchment's
    </label>
	</div>
<div class="checkbox">
    <label for="checkboxes-5">
      <input type="checkbox" name="UpdateTemplate" id="checkboxes-5" value="1" <?php if($UpdateTemplate == 1){ echo "checked"; } ?>>
      Update Template
    </label>
	</div>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="SaveRole"></label>
  <div class="col-md-4">
    <button id="SaveRole" name="SaveRole" class="btn btn-success">Save</button>
<button type="button" class="btn btn-danger four" onclick="goBack()">Back</button>
  </div>
</div>

</fieldset>
</form>
    
   