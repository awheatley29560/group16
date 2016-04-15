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

 ?>

<script>
		$(function(){

			var jsonObj = $.parseJSON('<?php echo $json; ?>');
			var html = '<table class="table table-hover table-bordered"><thead></thead>';
			$.each(jsonObj, function(key, value){
                                key = key.replace(/[_-]/g, " "); 
value = value.replace(/\W+/g, " ")
				html += '<tbody><tr>';
				html += '<td style="max-width:250px !important;">' + key + '</td>';
				html += '<td>' + value + '</td>';
				html += '</tr></tbody>';
			});
			html += '</table> <button type="button" class="btn btn-danger" onclick="goBack()">Back</button>';

			$('#read').html(html);
		});
		  
</script>


<div class="col-md-8">
<div id="read"></div>
</div>