<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $firstnameError = null;
        $lastnameError = null;

        // keep track post values
        $username = $_POST['user_name'];
        $email = $_POST['user_email'];
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
$role= $_POST['user_role'];
$userid= $_POST['id'];

                $user_password = $_POST['user_password_new'];
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

           $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT user_name FROM users WHERE user_name = ? AND user_id <> ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($username,$userid));
            Database::disconnect();
if($q->rowCount() > 0){ ?>
  <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Username exists already. Please try again.  </div>
<?php
} else {

     $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT user_name FROM users WHERE user_email = ? AND user_id <> ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($email,$userid));
            Database::disconnect();
if($q->rowCount() > 0){ ?>
  <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Email exists already. Please try again.  </div>
<?php
} else {
        // update data
        if ($user_password) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users set user_name = ?, user_email = ?, first_name = ?, last_name = ?, user_password_hash = ?, user_role = ? WHERE user_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($username,$email,$firstname,$lastname,$user_password_hash,$role, $id));
             header("Location: index.php?source=UpdateUser&id=".$id."&msg=success");
            Database::disconnect();
        } else {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users set user_name = ?, user_email = ?, first_name = ?, last_name = ?, user_role = ? WHERE user_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($username,$email,$firstname,$lastname,$role, $id));
             header("Location: index.php?source=UpdateUser&id=".$id."&msg=success");
            Database::disconnect();
}
}
}
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users where user_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['user_name'];
        $email = $data['user_email'];
        $firstname = $data['first_name'];
        $lastname = $data['last_name'];
        $UserRole = $data['user_role'];
$UserID = $data['user_id'];
        Database::disconnect();
    }
$id = $_GET['id'];
  $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users where user_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
$newname = $data['newname'];
        Database::disconnect();
?>

<?php
if(isset($_GET['msg'])){
?>

  <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> User has been updated..  </div>

<?php
}

?>

<div class="col-md-2"></div>
			 <div class="col-md-8"><img height="150" width="150" src="uploads/<?php if($newname) { echo $newname; } else { echo 'default.png'; } ?>" class="img-circle center-block" alt="">

<form class="form-horizontal" method="post" action="?source=UpdateUser&id=<?php echo $id?>">
<fieldset>

<!-- Form Name -->
<legend>Update User</legend>

<!-- Text input-->
<div class="form-group <?php echo !empty($nameError)?'error':'';?>">
  <label class="col-md-4 control-label" for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>  
  <div class="col-md-4">
  <input id="login_input_username" name="user_name" type="text" placeholder="Username" class="form-control input-md login_input" pattern="[a-zA-Z0-9]{2,64}" required="" value="<?php echo !empty($name)?$name:'';?>">
   <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
  </div>
</div>



<!-- Text input-->
<div class="form-group <?php echo !empty($emailError)?'error':'';?>">
  <label class="col-md-4 control-label" for="login_input_email">Email Address</label>  
  <div class="col-md-4">
  <input id="login_input_email" type="email" name="user_email" placeholder="Email Address" class="login_input form-control input-md" required="" value="<?php echo !empty($email)?$email:'';?>">
  <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="login_input_first_name">First Name</label>  
  <div class="col-md-4">
  <input value="<?php echo !empty($firstname)?$firstname:'';?>" id="login_input_first_name" name="first_name" type="text" placeholder="First Name" class="form-control input-md login_input" required="">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="login_input_last_name">Last Name</label>  
  <div class="col-md-4">
  <input value="<?php echo !empty($lastname)?$lastname:'';?>" id="login_input_last_name" name="last_name" type="text" placeholder="Last Name" class="form-control input-md login_input" required="">
  </div>
</div>


<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Select Role</label>
  <div class="col-md-4">
       <select name="user_role" class="form-control">

<?php

                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM roles ORDER BY role_id DESC';
                   foreach ($pdo->query($sql) as $row) {
$role = $row['user_role'];
if($UserRole == $role){
echo '<option value=' . $row['user_role'] . ' selected>' . $row['user_role'] . '</option>';
} else {
echo '<option value=' . $row['user_role'] . '>' . $row['user_role'] . '</option>';
}
                   }
                   Database::disconnect();
                  ?>
    </select>
  </div>
</div>
<input type="hidden" name="id" value="<?php echo !empty($UserID)?$UserID:'';?>">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="login_input_password_new">Password (min. 6 characters)</label>  
  <div class="col-md-4">
  <input id="login_input_password_new" name="user_password_new" pattern=".{6,}" type="password" placeholder="Password" class="login_input form-control input-md" autocomplete="off">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirm"></label>
  <div class="col-md-4">
    <button href="?source=ViewUser" type="submit" class="btn btn-success">Update</button>
<button type="button" class="btn btn-danger four" onclick="goBack()">Back</button>

  </div>
</div>


</form>
