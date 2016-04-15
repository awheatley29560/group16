    <link href="css/animate.css" rel="stylesheet">
<div class="animated slideInLeft">
<form class="form-horizontal" method="post" action="?source=register" name="registerform">
<fieldset>

<!-- Form Name -->
<legend>Create User</legend>

<?php echo $_SESSION['template']; ?>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>  
  <div class="col-md-4">
  <input id="login_input_username" name="user_name" type="text" placeholder="Username" class="form-control input-md login_input" pattern="[a-zA-Z0-9]{2,64}" required="">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="login_input_first_name">First Name</label>  
  <div class="col-md-4">
  <input id="login_input_first_name" name="first_name" type="text" placeholder="First Name" class="form-control input-md login_input" required="">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="login_input_last_name">Last Name</label>  
  <div class="col-md-4">
  <input id="login_input_last_name" name="last_name" type="text" placeholder="Last Name" class="form-control input-md login_input" required="">
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="login_input_email">Email Address</label>  
  <div class="col-md-4">
  <input id="login_input_email" type="email" name="user_email" placeholder="Email Address" class="login_input form-control input-md" required="">
  </div>
</div>


<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Select Role</label>
  <div class="col-md-4">
       <select name="user_role" class="form-control">

<?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM roles ORDER BY role_id DESC';
                   foreach ($pdo->query($sql) as $row) {

echo '<option value=' . $row['user_role'] . '>' . $row['user_role'] . '</option>';

                   }
                   Database::disconnect();
                  ?>
    </select>
  </div>
</div>




<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="login_input_password_new">Password (min. 6 characters)</label>  
  <div class="col-md-4">
  <input id="login_input_password_new" name="user_password_new" pattern=".{6,}" type="password" placeholder="Password" class="login_input form-control input-md" required="" autocomplete="off">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="login_input_password_repeat">Confirm Password</label>  
  <div class="col-md-4">
  <input id="login_input_password_repeat" name="user_password_repeat" pattern=".{6,}" type="password" placeholder="Password" class="login_input form-control input-md" required="" autocomplete="off">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirm"></label>
  <div class="col-md-4">
    <button type="submit" id="confirm" name="register" class="btn btn-success one" value="Register">Create User</button>
  </div>
</div>

    </form>
    
   </div>