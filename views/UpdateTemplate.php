<?php

require 'database.php';


$id = $_GET['id'];

$pdo = Database::connect();
$count=$pdo->prepare("select formt_id from FormSubmission where formt_id=:id");
$count->bindParam(":id",$id);
$count->execute();
$no=$count->rowCount();
if($no >0 ){ ?>

<form class="form-horizontal" method="post" action="?source=ArchiveUser&id=<?php echo $id?>">
<fieldset>

<!-- Form Name -->
<legend>Update Template</legend>


<div class="form-group">
 <div style="max-width:500px;" class="alert alert-danger">
You cannot Update a report with submitted Reports on the system. Why not create a new template?</div>

</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirm"></label>
  <div class="col-md-4">
    <div class="form-actions">
                          <button type="button" class="btn btn-danger four" onclick="goBack()">Back</button>
                        </div>
  </div>
</div>


</form> <?php
} else { 
?>


<script src="js/sjfb-builder1.js" type="text/javascript" ></script> <!-- form builder -->
<script src="js/sjfb-html-generator.js" type="text/javascript" ></script> <!-- form generator -->
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="sjfb-wrap" style="padding:0 !important;" class="col-lg-10">

    <h1>Report Template Maker</h1>

    <div class="add-wrap three" style="border-radius:30px !important;">
        <h3>Add Field:</h3>
        <ul id="add-field">
            <li><a id="add-text" data-type="text" href="#">Single Line Text</a></li>
<li><a id="add-text" data-type="date" href="#">Date</a></li>
            <li><a id="add-textarea" data-type="textarea" href="#">Multi Line Text</a></li>
            <li><a id="add-select" data-type="select" href="#">Select Box (Drop down list)</a></li>
            <li><a id="add-radio" data-type="radio" href="#">Radio Buttons</a></li>
            <li><a id="add-checkbox" data-type="checkbox" href="#">Checkboxes</a></li>
            <li><a id="add-agree" data-type="agree" href="#">Agree Box</a></li>
        </ul>
    </div>

  <form id="sjfb">
        <div id="form-fields">

        </div>
        <button type="submit" class="submit btn btn-info one" onclick="location.href = 'index.php?source=ViewTemplate&msg=2';"> Update Template</button>
    </form>

</div>


<?php } 

Database::disconnect();
?>

