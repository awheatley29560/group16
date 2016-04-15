<?php
$form_data = json_decode(file_get_contents('php://input'));

foreach ($form_data as $key => $value) {
    $field[$value->name] = $value->value;
}

//here's the formID
$formID = $field['formID'];

//and here's the form fields (converted back into json)
$formFields = json_encode($field['formFields']);

//now just save it to your database.
//echo $_GET['TemplateName'];

$valid = true;

if(isset($_GET['TemplateName'])){

$template = $_GET['TemplateName'];
$username = $_GET['name'];

if($valid){
require 'database.php';
 $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO forms (form, form_name,user_name) values(?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($formFields,$template,$username));
            Database::disconnect();

$valid = false;
}
}