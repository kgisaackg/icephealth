<?php


    require_once ('connection.php') ;

    $dbConnError = "";
     
    $patientQuery = "SELECT * FROM appointment";
    $stmt = $db->prepare($patientQuery);
    $stmt->execute();
    $patients  = $stmt->get_result();
    $numOfAppointment = $patients->num_rows;
    $stmt->close();

    $patientQuery = "SELECT * FROM patient";
    $stmt = $db->prepare($patientQuery);
    $stmt->execute();
    $patients  = $stmt->get_result();
    $numOfPatient = $patients->num_rows;
    $stmt->close();

    $appointments = array();
    $patients = array();


    $patientQuery = "SELECT * FROM patient";
    $stmt = $db->prepare($patientQuery);
    $stmt->execute();
    $patients  = $stmt->get_result();
    $stmt->close();

    $appointmentQuery = "SELECT patient.patientId, patient.firstname, appointment.time, appointment.visitdate, appointment.appointmentId
    FROM patient
    INNER JOIN appointment ON patient.patientId = appointment.patientId";
     
    $stmt = $db->prepare($appointmentQuery);
    $stmt->execute();
    $appointments = $stmt->get_result();
    $stmt->close();
    

    if(isset($_POST['deleteAppointmentNo'])){
        $id = $_POST['deleteAppointmentNo'];

        $name = $_POST['firstname'];
        $time = $_POST['time'];
        $vdate = $_POST['vdate'];
        $hasAttend = "False";

        $history = "INSERT INTO history(name, vdate, time, attend, appid) VALUES ( ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($history);
        $stmt->bind_param('sssss', $name, $vdate, $time, $hasAttend, $id);
        $execute_success = $stmt->execute();
        
        $deleteQuery = "DELETE FROM appointment WHERE appointmentId = ?";
        $stmt = $db->prepare($deleteQuery);
        $stmt->bind_param('s', $id);
        $stmt->execute();

        header("location: admindashboard.php");
        exit();
    }

    if(isset($_POST['deleteAppointmentYes'])){
        $id = $_POST['deleteAppointmentYes'];

        $name = $_POST['firstname'];
        $time = $_POST['time'];
        $vdate = $_POST['vdate'];
        $hasAttended = "True";
        $num = 2;

        $history = "INSERT INTO history(name, vdate, time, attend, appid) VALUES ( ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($history);
        $stmt->bind_param('sssss', $name, $vdate, $time, $hasAttended, $id); 
        $execute_success = $stmt->execute();

        
        $dbConnError = $execute_success;
        $deleteQuery = "DELETE FROM appointment WHERE appointmentId = ?";
        $stmt = $db->prepare($deleteQuery);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        header("location: admindashboard.php");
        exit();
    }
    
    
    //End of modify the above 

    $manageAppointmentPrimaryKey = "1";

    if(isset($_POST['manageAppointment'])){

        $morningPatient = $_POST['morningPatients'];
        $afternoonPatient = $_POST['afternoonPatients'];

        $editQuery = "UPDATE manageappointment SET morningpatient = ?, afternoonpatient = ? WHERE mId = ?";
        $stmt = $db->prepare($editQuery);
        $stmt->bind_param('iii', $morningPatient, $afternoonPatient, $manageAppointmentPrimaryKey);
        $stmt->execute();
        header("location: admindashboard.php");
        exit();
    }


    $mAQuery = "SELECT * FROM manageappointment WHERE mId = ?";
    $stmt = $db->prepare($mAQuery);
    $stmt->bind_param('i', $manageAppointmentPrimaryKey);
    $stmt->execute();
    $app = $stmt->get_result();
    $manageAppointment = $app->fetch_assoc();

    $morningNum = $manageAppointment['morningpatient'];
    $afternoonNum = $manageAppointment['afternoonpatient'];

    $attendenceQuery = "SELECT * FROM history";
    $stmt = $db->prepare($attendenceQuery);
    $stmt->execute();
    $attendences = $stmt->get_result();
    $stmt->close();

?>