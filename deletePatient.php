<?php

require_once ('connection.php') ;

if(isset($_POST['patientDelete'])){
  

    $id = $_POST['patientId'];

    $deleteQuery = "DELETE FROM appointment WHERE patientId = ?";
    $stmt = $db->prepare($deleteQuery);
    $stmt->bind_param('s', $id);
    $stmt->execute();

    $deleteQuery = "DELETE FROM patient WHERE patientId = ?";
    $stmt = $db->prepare($deleteQuery);
    $stmt->bind_param('s', $id);
    $execute_success = $stmt->execute();
    
    if($execute_success){
        session_destroy();
        unset($_SESSION['patientId']);
        unset($_SESSION['firstname']);
        unset($_SESSION['lastname']);
        unset($_SESSION['gender']);
        unset($_SESSION['yearOfBirth']);
        unset($_SESSION['emailAddress']);
        header('location: login.php');
        exit();
    }
}

?>