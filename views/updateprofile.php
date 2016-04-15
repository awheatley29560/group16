<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
?>
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" >&times;</a>
    <strong>Warning </strong> <?php echo $error; ?>
  </div>

<button type="button" class="btn btn-danger" onclick="goBack()">Back</button>
            <?php
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
?>
<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php echo $message; ?>
  </div>

            <?php
include"views/CreateUser.php";
        }
    }
}
?>
