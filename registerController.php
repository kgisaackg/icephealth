<?php

    require_once ('connection.php') ;
    session_start();
    

    $dbConnError = "";

    $execute = "start";

    $errors = array();
    $firstname = "";
    $lastname = "";
    $yearOfBirth= "";
    $emailAddress = "";
    $gender = "";
    $password = "";
    $passwordConfirmation = "";

    $firstnameError = "";
    $lastnameError = "";
    $emailError = "";
    $birthError = "";
    $passwordError = "";

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    if(isset($_POST['registerUser'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $yearOfBirth= $_POST['yearOfBirth'];
        $emailAddress = $_POST['emailAddress'];
        $gender =  $_POST['gender'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['passwordConfirmation'];

        if(empty($firstname)){
            $errors['firstname'] = "firstname is required ";
            $firstnameError = "firstname is required";
        }else {
            $name = test_input($_POST["firstname"]);
            if (!preg_match("/^[a-zA-Z ]{3,50}$/",$name)) {
              $firstnameError = "must have more than 3 letters and have letters only"; 
              $errors['firstname'] = "lastname is required";
            }
        }
       
        if(empty($lastname)){
            $errors['lastname'] = "lastname is required ";
            $lastnameError = "lastname is required";
        } else {
            $name = test_input($_POST["lastname"]);
            if (!preg_match("/^[a-zA-Z ]{3,50}$/",$name)) {
              $lastnameError = "must have more than 3 letters and have letters only"; 
              $errors['lastname'] = "Lastname is required ";
            }
        }

        if(empty($yearOfBirth)){
            $errors['yearOfBirth'] = "Year of birth is required";
            $birthError = "Year cannot be empty"; 
        } 
        else {
            $year = test_input($_POST["yearOfBirth"]);

            if (!preg_match('/^[0-9]{4}+$/', $year)) {
              $birthError = "Has to be 4 digits number"; 
              $errors['yearOfBirht'] = "Year of birth is required";
            } 
        }

        if(empty($emailAddress)){
            $errors['emailAddress'] = "Email Address is required";
            $emailError = "Email cannot be empty"; 
        }
        else {
                $email = test_input($_POST["emailAddress"]);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $emailError = "Invalid email format"; 
                  $errors['emailAddress'] = "Email Address is required";
                }
        }


        if($password !== $passwordConfirmation){
            $passwordError = "Passwords do not match";
            $errors['password'] = "The passwords do not match";
        }
        
        if(empty($password)){
            $errors['password'] = "password is required";
            $passwordError = "Password cannot be empty";
        }
        else{
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',$_POST['password'])){
                $passwordError = "Password must include uppper, lowercase letters, numbers and be 8 long";
                $errors['password'] = "The passwords short";
            }
        }

        $emailQuery = "SELECT * FROM patient WHERE emailaddress=? LIMIT 1";
        $stmt = $db->prepare($emailQuery);
        $stmt->bind_param('s', $emailAddress);
        $stmt->execute();
        $result = $stmt->get_result();
        $userCount = $result->num_rows;

        if($userCount > 0 ){
            $errors['emailAddress'] = "Email already exists";
        }

        if(count($errors) === 0){

            $query = "INSERT INTO patient(firstname, lastname, yearofbirth, emailaddress, gender, password) VALUES
                        ( ?, ?, ?, ?, ?, ?)";
            
            $stmt = $db->prepare($query);
            $stmt->bind_param('ssssss', $firstname, $lastname, $yearOfBirth, $emailAddress, $gender, $password);
            $execute_success = $stmt->execute();

            if($execute_success){

                $patientId = $db->insert_id;
                $_SESSION['patientId'] = $patientId;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['gender'] = $gender;
                $_SESSION['yearOfBirth'] = $yearOfBirth;
                $_SESSION['emailAddress'] = $emailAddress;
    
                header('location: patient.php');
                exit();
            }else if($db->connect_error){

                $errors['db'] = "Database failed to register" .$db->connect_error;
            }else{
                $errors['db'] = "No connect error" .$execute_success;
            }
        }
    } //End of registering a patient

    //update Patient
    $updateErrors = array();
    $lNameError = "";
    $fNameError = "";

    if(isset($_POST['updatePatient'])){
        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $id = $_SESSION['patientId'];

        if(empty($firstname)){
            $updateErrors['firstname'] = "firstname is required ";
            $fNameError = "name cannot be empty"; 
        }
        else {
            $name = test_input($_POST["lastname"]);

            if (!preg_match("/^[a-zA-Z ]{3,50}$/",$firstname)) {
              $fNameError = "must have more than 3 letters and have letters only"; 
              $updateErrors['firstnam'] = "first is required ";
            }
        }
       
        if(empty($lastname)){
            $updateErrors['lastname'] = "lastname is required ";
            $lNameError = "cannot be empty";
        } else {
            $name = test_input($_POST["lastname"]);
            if (!preg_match("/^[a-zA-Z ]{3,50}$/",$lastname)) {
              $lNameError = "must have more than 3 letters and have letters only"; 
              $updateErrors['lastname'] = "lastname is required ";
            }
        }

        if(count($updateErrors) === 0){

            $updateQuery = "UPDATE patient SET firstname = ?, lastname = ? WHERE patientId = ?";
            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param('sss', $firstname, $lastname, $id);
            $execute_success = $stmt->execute();

            if($execute_success){

                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                header("location: patient.php");
                exit();
            }
        }
    }


    //End of update patient

    //Login 
    if(isset($_POST['login-btn'])){
        $emailAddress = $_POST['emailAddress'];
        $password = $_POST['password'];

        if(empty($emailAddress)){
            $errors['emailAddress'] = "Email Address is required";
        }

        if(empty($password)){
            $errors['password'] = "password is required";
        }

        if(count($errors) === 0){

            $sqlLogin = "SELECT * FROM patient WHERE emailaddress=? LIMIT 1";
            $stmt = $db->prepare($sqlLogin);
            $stmt->bind_param('s', $emailAddress);
            $execute_success = $stmt->execute();
            $result = $stmt->get_result();
            $numRow = $result->num_rows;
            $patient = $result->fetch_assoc();

            if($numRow === 1){
                 if($password === $patient['password']){
                    $patientId = $patient['patientId'];
                    $_SESSION['patientId'] = $patientId;
                    $_SESSION['firstname'] = $patient['firstname'];
                    $_SESSION['lastname'] = $patient['lastname'];
                    $_SESSION['yearOfBirth'] = $patient['yearofbirth'];
                    $_SESSION['gender'] = $patient['gender'];
                    $_SESSION['emailAddress'] = $patient['emailaddress'];
                    header('location: patient.php');
                    exit();
                 }else{
                    $errors['login_fail'] = "Wrong email or password";
                }
            }
            else{
                $errors['login_fail'] = "Wrong email or password";
            }
        }

    }//end of log in 

    //end of delete account


    //logout
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['patientId']);
        unset($_SESSION['firstname']);
        unset($_SESSION['lastname']);
        unset($_SESSION['gender']);
        unset($_SESSION['yearOfBirth']);
        unset($_SESSION['emailAddress']);
        header('location: login.php');
        exit();
    }//end of log out
?>
