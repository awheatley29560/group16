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
echo $_GET['id'];

$valid = true;

if(isset($_GET['id'])){

$id = $_GET['id'];

if($valid){
require 'database.php';
 $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE forms set form  = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($formFields,$id));
            Database::disconnect();
$valid = false;
}
}
