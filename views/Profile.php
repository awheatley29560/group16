
<?php
    require 'database.php';

$id = $_SESSION['user_id'];
$target_name = basename($_FILES["fileToUpload"]["name"]);
    if ( !empty($_POST)) {
        // keep track validation errors


if($target_name != null){

function image_fix_orientation($filename) {
    $exif = exif_read_data($filename);
    if (!empty($exif['Orientation'])) {
        $image = imagecreatefromjpeg($filename);
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }

        imagejpeg($image, $filename, 90);
    }
}
$temp = $_FILES['fileToUpload']['tmp_name'];

image_fix_orientation($temp);

$target_dir = "uploads/";
$target_name = basename($_FILES["fileToUpload"]["name"]);
$target_name_new = uniqid('', true);
$target_file = $target_dir . $target_name_new;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
        $uploadOk = 1;
}

// Check if file already exists
if (file_exists($target_file)) { ?>
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     Sorry, your file already exists.  </div> <?php
    $uploadOk = 0;
}

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      
        $uploadOk = 1;
    } else { ?>
<div class="alert alert-danger">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     Sorry, your file is not an image.  </div> <?php
        $uploadOk = 0;
    }
}

if(isset($_POST["submit"])) {
if ($uploadOk == 0) {

} else {
    if (move_uploaded_file($temp, $target_file)) {

$name = $_POST['user_name'];
     $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users set newname = ?, oldname = ? WHERE user_name = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($target_name_new,$_FILES["fileToUpload"]["name"],$name));
            Database::disconnect();
    } else {
     ?>
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     Sorry, there was an error uploading your file.  </div> <?php
    }
}
}
}
        $nameError = null;
        $emailError = null;
        $firstnameError = null;
        $lastnameError = null;

        // keep track post values
        $name = $_POST['user_name'];
        $email = $_POST['user_email'];
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        
                $user_password = $_POST['user_password_new'];
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

        // validate input
        $valid = true;

  $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT user_name FROM users WHERE user_name = ? AND user_id <> ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$id));
            Database::disconnect();
if($q->rowCount() > 0){
?>
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
    <strong>Warning</strong> Username already exists. Try again.
  </div>
<?php 
} else {


     $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT user_name FROM users WHERE user_email = ? AND user_id <> ?";
            $q = $pdo->prepare($sql);
$id = $_SESSION['user_id'];
            $q->execute(array($email,$id));
            Database::disconnect();
if($q->rowCount() > 0){ ?>
  <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Email exists already. Please try again.  </div>
<?php
} else {


if($user_password){
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users set user_name = ?, user_email = ?, first_name = ?, last_name = ?, user_password_hash = ? WHERE user_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$firstname,$lastname,$user_password_hash,$id));
$msg = true;
            Database::disconnect();
        }
} else {
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users set user_name = ?, user_email = ?, first_name = ?, last_name = ? WHERE user_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$firstname,$lastname,$id));
 header("Location: index.php?source=Profile&msg=1");
$msg = true;
            Database::disconnect();
        }
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
$newname = $data['newname'];
$oldname= $data['oldname'];
        Database::disconnect();
    }
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
if(isset($msg)){
?>

  <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Your Profile has been updated.  </div>

<?php
}

?>
    <link href="css/animate.css" rel="stylesheet">
<div class="animated slideInLeft">
<div class="col-md-2"></div>
			 <div class="col-md-8"><img height="150" width="150" src="uploads/<?php if($newname) { echo $newname; } else { echo 'default.png'; } ?>" class="img-circle center-block" alt="">

<form class="form-horizontal" method="post" action="?source=Profile" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>Profile</legend>

<!-- Text input-->
<div class="form-group <?php echo !empty($nameError)?'error':'';?>">
  <label class="col-md-4 control-label" for="login_input_username">Username</label>  
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

<div class="form-group">
  <label class="col-md-4 control-label"">Profile Picture</label>
  <div class="col-md-4">
    <div class="input-group">
   <input type="file" name="fileToUpload" id="fileToUpload" >
    </div>
  </div>
</div>


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
    <button type="submit" class="btn btn-success one" name="submit">Update</button>
  </div>
</div>


</form>
</div>
