<?php require_once 'registerController.php';
    if(!isset($_SESSION['patientId'])){
        header('location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/patient.css">
    <title>HCSC login</title>
</head>

<body>
    <?php require 'header.php' ?>
    <div class="row d-flex justify-content-center">
        <div class="col-sm-6">
            <div class="card card border-light mt-5">
                <div class="card-body">
                    <a class="btn btn-danger btn-sm float-right" data-toggle="collapse" href="#collapseExample"
                        role="button" aria-expanded="false" aria-controls="collapseExample">X</a>

                    <div class="collapse" id="collapseExample">
                        <p>Are you sure you what to delete?
                            <!--form-->
                        <form class="d-inline" action="deletePatient.php" method="post">
                            <input type="text" name="patientId" value="<?php echo $_SESSION['patientId']; ?>" hidden>
                            <button class="btn btn-danger btn-sm" type="submit" name="patientDelete">delete</button>
                        </form>
                        <!--form End-->
                        <button class="btn btn-info btn-sm" data-toggle="collapse"
                            href="#collapseExample">cancel</button>
                    </div>

                    <hr class="bg-primary" />
                    <div class="card-title h3">Patient Profile</div>
                    <p>Fullname: <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></p>
                    <p>Patient Number: <?php echo $_SESSION['patientId']; ?></p>
                    <p>Gender: <?php echo $_SESSION['gender']; ?></p>
                    <p>Year Of Birth: <?php echo $_SESSION['yearOfBirth']; ?></p>
                    <p>Email Address: <?php echo $_SESSION['emailAddress']; ?></p>
                    <a href="patientEdit.php" class="btn btn-primary width w-100">Edit profile</a>
                </div>
            </div>
        </div>
    </div>

    <?php require 'footer.php' ?>
</body>

</html>