<?php
if(isset($_GET['msg'])){
?>

  <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Report has been Created. Please review in "View My Reports" to submit for review.  </div>

<?php
}

?>

    <link href="css/animate.css" rel="stylesheet">
<div class="animated slideInLeft">
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Create Report</legend>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label">Select Report Template</label>
  <div class="col-md-4">
    <select name="ReportTemplate" class="form-control">

<?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM forms WHERE Archive = 0 ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {

echo '<option value=' . $row['id'] . '>' . $row['form_name'] . '</option>';

                   }
                   Database::disconnect();
                  ?>
    </select>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="ReportSeverity">Report Severity</label>
  <div class="col-md-4"> 
    <label class="radio-inline" for="ReportSeverity-0">
      <input type="radio" name="ReportSeverity" id="ReportSeverity-0" value="1" checked="checked">
      1
    </label> 
    <label class="radio-inline" for="ReportSeverity-1">
      <input type="radio" name="ReportSeverity" id="ReportSeverity-1" value="2">
      2
    </label> 
    <label class="radio-inline" for="ReportSeverity-2">
      <input type="radio" name="ReportSeverity" id="ReportSeverity-2" value="3">
      3
    </label> 
    <label class="radio-inline" for="ReportSeverity-3">
      <input type="radio" name="ReportSeverity" id="ReportSeverity-3" value="4">
      4
    </label> 
    <label class="radio-inline" for="ReportSeverity-4">
      <input type="radio" name="ReportSeverity" id="ReportSeverity-4" value="5">
      5
    </label>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label">Confirm</label>
  <div class="col-md-4">
    <button  class="btn btn-success one">Confirm</button>
  </div>
</div>

</fieldset>
</form>
</div>
