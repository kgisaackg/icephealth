<?php require 'header.php' ?>
<?php require_once 'appointmentController.php'; ?>
<?php require_once 'registerController.php'; ?>
<!--Edit Patient Profile-->
<div class="row d-flex justify-content-center">
    <div class="col-sm-6">
        <div class="card card border-light mt-5">
            <div class="card-body">
                <hr class="bg-primary" />
                <div class="card-title h3">Edit Patient Profile</div>
                <form action="patientEdit.php" method="post">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label>Firstname</label>
                            <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                            <span class="text-danger"><?php echo $fNameError; ?></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Lastname</label>
                            <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                            <span class="text-danger"><?php echo $lNameError; ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" name="emailAddress"
                            value="<?php echo $_SESSION['emailAddress']; ?>" disabled>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-primary col-sm-12" type="submit" name="updatePatient">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Edit Patient Profile-->
<?php require 'footer.php' ?>