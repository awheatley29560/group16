<?php

if(isset($_GET['id'])){
$id = $_GET['id'];

require 'database.php';
 $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT (submission) FROM FormSubmission WHERE (form_id) = (:id)";
            $q = $pdo->prepare($sql);
            $q->bindParam(':id', $id);
            $q->execute();
            $json = $q->fetchColumn();
            Database::disconnect();
$json= str_ireplace(array("\r","\n",'\r','\n'),'<br>', $json);

}

 if ( !empty($_POST)) {

$status = "Open";
$id = $_GET['id'];

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE FormSubmission set status = ?, submit_date = NOW() WHERE form_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($status, $id));
header("Location: index.php?source=ViewSubmittedReports&msg=submit");
            Database::disconnect();

}
 ?>

<script>
		$(function(){

			var jsonObj = $.parseJSON('<?php echo $json; ?>');
			var html = '<table class="table table-hover table-bordered"><thead></thead>';
			$.each(jsonObj, function(key, value){
key = key.replace(/[_-]/g, " "); 
				html += '<tbody><tr>';
				html += '<td style="max-width:150px">' + key + '</td>';
				html += '<td>' + value + '</td>';
				html += '</tr></tbody>';
			});
			html += '</table>';

			$('#read').html(html);
		});
		  
</script>



<div class="col-md-8">
<div id="read"></div>

<form method="post" class="form-horizontal">
<fieldset>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Submit"></label>
  <div class="col-md-4">
    <button id="Submit" name="Submit" class="btn btn-success">SUBMIT FOR REVIEW</button>
                      
  </div>
<div class="col-md-4">
<button type="button" class="btn btn-danger four" onclick="goBack()">Back</button>
</div>
</div>

</fieldset>
</form>





</div>