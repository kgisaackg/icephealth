<?php

    //Appointment
    require_once ('connection.php') ;
    require_once ('adminController.php');

    $patientApp = array();
    $app = array();
    $dateError  = "";
    $appoimentError = "";
    $noSpaceError = "";
    $numErrors = array();

      //Create appointment
    if(isset($_POST['dateSent'])){

        $visitDate = $_POST['visitDate'];
        $time = $_POST['time'];
        $patientId = $_POST['pI'];

        //have to send error if date is null
        if(empty($visitDate)){
            $dateError = "Date cannot be empty";
            $numErrors['one'] = "one";
        }

        $appointmentQuery = "SELECT * FROM appointment WHERE patientId = ? LIMIT 1";
        $stmt = $db->prepare($appointmentQuery);
        $stmt->bind_param('s', $patientId);
        $stmt->execute();
        $result = $stmt->get_result();
        $userCount = $result->num_rows;

        if($userCount > 0 ){
            $numErrors['two'] = "two";
            $appoimentError = "Already have a pending appointment";
        }else{
            $appointmentQuery = "SELECT * FROM appointment WHERE visitdate = ? AND time = ?";
            $stmt = $db->prepare($appointmentQuery);
            $stmt->bind_param('ss', $visitDate, $time);
            $stmt->execute();
            $result = $stmt->get_result();
            $userCount = $result->num_rows;

            if($userCount >= $morningNum && $time === "Morning"){
                $noSpaceError = "Fully booked for the morning try different times";
                $numErrors['three'] = "three";
            }else if($userCount >= $afternoonNum && $time === "Afternoon"){
                $noSpaceError = "Fully booked for the afternoon try different times";
                $numErrors['four'] = "three";
            }
        }

        if(count($numErrors) === 0){
            
            $appQuery = "INSERT INTO appointment(visitdate, time, patientId) VALUES
                            ( ?, ?, ?)";
            $stmt = $db->prepare($appQuery);
            $pId = $patientId; //sometimes this equate to null??
            $stmt->bind_param('ssi', $visitDate,  $time, $pId); 
            $execute_success = $stmt->execute();

            if($execute_success){
                header("location: appointmentDelete.php");
                exit();
            }
        }
    } //End of create appointment


     //Get specific appointment
     if(isset($_SESSION['patientId'])){
        $pId = $_SESSION['patientId'];
        $appQuery = "SELECT * FROM appointment WHERE patientId = ?";
        $stmt = $db->prepare($appQuery);
        $stmt->bind_param('s', $pId);
        $stmt->execute();
        $app = $stmt->get_result();
        $patientApp = $app->fetch_assoc();
     }//End of get specific appointment


    //Delete  appointment
    $msg = "";
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deleteQuery = "DELETE FROM appointment WHERE appointmentId = ?";
        $stmt = $db->prepare($deleteQuery);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        header("location: appointmentDelete.php");
        exit();
    }//End of delete appointment


    //Update appointment
    //End of update appoitment
    $numUpdateError = array();

    if(isset($_POST['appointmentUpdate'])){
       
        $id = $_GET['Id'];
        $time = $_POST['time'];
        $date = $_POST['date'];


        $appointmentQuery = "SELECT * FROM appointment WHERE visitdate = ? AND time = ?";
        $stmt = $db->prepare($appointmentQuery);
        $stmt->bind_param('ss', $date, $time);
        $stmt->execute();
        $result = $stmt->get_result();
        $userCount = $result->num_rows;

        
        if($userCount >= $morningNum && $time === "Morning"){
            $noSpaceError = "Fully booked for the morning try different times";
            $numUpdateError['one'] = "Error";
        }
        else if($userCount >= $afternoonNum  && $time === "Afternoon"){
            $noSpaceError = "Fully booked for the afternoon try different times";
            $numUpdateError['two'] = "Error";
        }

        if(count($numUpdateError) === 0) {
            $editQuery = "UPDATE appointment SET time = ?, visitdate = ? WHERE appointmentId = ?";
            $stmt = $db->prepare($editQuery);
            $stmt->bind_param('ssi', $time, $date, $id);
            $stmt->execute();
            header("location: appointmentDelete.php");
            exit();
        }
    }

?>