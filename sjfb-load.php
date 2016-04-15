<?php
//The demo string is below. Normally, you would just grab the saved json string from your database and echo it out here.

$valid = true;

$id = $_GET['form_id'];

if($valid){
require 'database.php';
$pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT form FROM forms where id = (:id)";
            $q = $pdo->prepare($sql);
            $q->bindParam(':id', $id);
            $q->execute();
            $data = $q->fetchColumn();
        Database::disconnect();
$valid = false;
echo $data;

}


if(!empty($_POST)) {
        $json = json_encode($_POST);
        require 'database.php';
        $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO FormSubmission (submission) values(:submission)";
            $q = $pdo->prepare($sql);
            $q->bindParam(':submission', $json);
            $q->execute();
            Database::disconnect();

}

