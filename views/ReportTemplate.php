 <?php

$Severity = $_GET['ReportSeverity'];

 if(!empty($_POST)) {

$status = "Draft";

         $json = json_encode($_POST);

        require 'database.php';
        $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO FormSubmission (submission, user_name, formt_id,status,severity) values(?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($json,$_SESSION['user_name'], $_GET['ReportTemplate'], $status,$Severity));
 header("Location: index.php?source=CreateReports&msg=1");
            Database::disconnect();

} 

?>



   <!-- CSS -->
    <link href="style.css" rel="stylesheet" type="text/css" />

    <!-- Jquery JS -->
    <script src="js/jquery-2.1.4.min.js"></script> <!-- jQuery v1 should also work fine -->

    <!-- SJFB JS -->
    <script src="js/sjfb-html-generator.js" type="text/javascript" ></script> <!-- form generator -->

<script>
function generateForm(formID) {

    //empty out the preview area
    $("#sjfb-fields").empty();

function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}

var formID = $_GET('ReportTemplate');


    $.getJSON('sjfb-load.php?form_id=' + formID, function(data) {
        if (data) {
            //go through each saved field object and render the form HTML
            $.each( data, function( k, v ) {


                var fieldType = v['type'];
                var label = v['label'];
                //Add the field
                $('#sjfb-fields').append(addFieldHTML(fieldType, label));
                var $currentField = $('#sjfb-fields .sjfb-field').last();

                //Add the label
                $currentField.find('label').text(v['label']);


                //Any choices?
                if (v['choices']) {

                    var uniqueID = Math.floor(Math.random()*999999)+1;

                    $.each( v['choices'], function( k, v ) {

                        if (fieldType == 'select') {
                            var selected = v['sel'] ? ' selected' : '';
                            var choiceHTML = '<option' + selected + '>' + v['label'] + '</option>';
                            $currentField.find(".choices").append(choiceHTML);
                        }

                        else if (fieldType == 'radio') {
                            var selected = v['sel'] ? ' checked' : '';
                            var choiceHTML = '<label><input type="radio" name="' + label + '[]"' + selected + ' value="' + v['label'] + '">' + v['label'] + '</label>';
                            $currentField.find(".choices").append(choiceHTML);
                        }

                        else if (fieldType == 'checkbox') {
                            var selected = v['sel'] ? ' checked' : '';
                            var choiceHTML = '<label><input type="checkbox" name="' + label + '[]"' + selected + ' value="' + v['label'] + '">' + v['label'] + '</label>';
                            $currentField.find(".choices").append(choiceHTML);
                        }


                    } );
                }

                //Is it required?
                if (v['req']) {
                    if (fieldType == 'text') { $currentField.find("input").prop('required',true).addClass('required-choice') }
else if (fieldType == 'date') { $currentField.find("input").prop('required',true).addClass('required-choice') }
else if (fieldType == 'text2') { $currentField.find("input").prop('required',true).addClass('required-choice') }
else if (fieldType == 'text3') { $currentField.find("input").prop('required',true).addClass('required-choice') }
else if (fieldType == 'text4') { $currentField.find("input").prop('required',true).addClass('required-choice') }
                    else if (fieldType == 'textarea') { $currentField.find("textarea").prop('required',true).addClass('required-choice') }
                    else if (fieldType == 'select') { $currentField.find("select").prop('required',true).addClass('required-choice') }
                    else if (fieldType == 'radio') { $currentField.find("input").prop('required',true).addClass('required-choice') }
                    $currentField.addClass('required-field');
                }



            });


        }

        //HTML templates for rendering frontend form fields
 function addFieldHTML(fieldType, label) {

            var uniqueID = Math.floor(Math.random()*999999)+1;


switch (label) {
 case 'Report Raiser':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-text">' +
                        '<label for="text-' + uniqueID + '"></label>' +
                        '<input  name="' + label + '" type="text" id="text-' + label + '" value="<?php echo $_SESSION['user_name']; ?>" readonly>' +
                        '</div>';

 case 'Submission Date':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-text">' +
                        '<label for="text-' + uniqueID + '"></label>' +
                        '<input name="date" type="date" value="<?php echo date('Y-m-d');?>" readonly>' +
                        '</div>';
}

            switch (fieldType) {

                    case 'text':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-text">' +
                        '<label for="text-' + uniqueID + '"></label>' +
                        '<input  name="' + label + '" type="text" id="text-' + label + '">' +
                        '</div>';

 case 'text2':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-text">' +
                        '<label for="text-' + uniqueID + '"></label>' +
                        '<input  name="' + label + '" type="text" id="text-' + label + '">' +
                        '</div>';

 case 'text3':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-text">' +
                        '<label for="text-' + uniqueID + '"></label>' +
                        '<input  name="' + label + '" type="text" id="text-' + label + '">' +
                        '</div>';

 case 'text4':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-text">' +
                        '<label for="text-' + uniqueID + '"></label>' +
                        '<input  name="' + label + '" type="text" id="text-' + label + '">' +
                        '</div>';

 case 'date':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field">' +
                        '<label for="text-' + uniqueID + '"></label>' +
                        '<input  name="' + label + '" type="date" id="text-' + label + '">' +
                        '</div>';

                case 'textarea':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-textarea">' +
                        '<label for="textarea-' + uniqueID + '"></label>' +
                        '<textarea name="' + label + '" id="textarea-' + uniqueID + '"></textarea>' +
                        '</div>';

                case 'select':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-select">' +
                        '<label for="select-' + uniqueID + '"></label>' +
                        '<select name="' + label + '" id="select-' + uniqueID + '" class="choices choices-select"></select>' +
                        '</div>';

                case 'radio':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-radio">' +
                        '<label></label>' +
                        '<div class="choices choices-radio"></div>' +
                        '</div>';

                case 'checkbox':
                    return '' +
                        '<div id="sjfb-checkbox-' + uniqueID + '" class="sjfb-field sjfb-checkbox">' +
                        '<label class="sjfb-label"></label>' +
                        '<div class="choices choices-checkbox"></div>' +
                        '</div>';

                case 'agree':
                    return '' +
                        '<div id="sjfb-agree-' + uniqueID + '" class="sjfb-field sjfb-agree required-field">' +
                        '<input type="checkbox" required>' +
                        '<label></label>' +
                        '</div> <br>'
            }
       
        }
    });
}</script>

<script type="text/javascript">
//On document ready
$(function(){

    //load saved form by ID
    generateForm(formID);
    var formID = 1;

});
</script>


<?php
if(isset($_GET['msg'])){
?>

  <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Report has been created. To review and submit report please visit "View My reports".  </div>

<?php
}

?>

<div id="sjfb-wrap" class="col-lg-10">

    <h1>Create Report</h1>

    <form id="sjfb-sample" class="three" style="max-width:600px !important;" method="post">
        <div id="sjfb-fields">
        
        </div>
        <button type="submit" class="submit" >Save</button>
    </form>



</div>
