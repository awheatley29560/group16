<?php

if(isset($_GET['Template'])) {
    $template = $_GET['TemplateName'];
} 

?>

<div class="col-md-8">

<?php
if(isset($_GET['msg'])){
?>

  <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Your Report Template has been created.  </div>

<?php
}

?>

    <link href="css/animate.css" rel="stylesheet">
<div class="animated slideInLeft">

<form method="get" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Create Report Template</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="TemplateName">Template Name</label>  
  <div class="col-md-4">
  <input id="TemplateName" name="TemplateName" type="text" placeholder="Enter Template Name" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="TemplateName"></label>
  <div class="col-md-4">
    <button id="TemplateName" class="btn btn-success one">Next</button>
  </div>
</div>

</fieldset>
</form>
</div>
</div>