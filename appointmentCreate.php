<?php require 'header.php' ?>
<?php require_once 'appointmentController.php'; ?>
<!--Make Appointment-->
<div class="row d-flex justify-content-center">
    <div class="col-sm-6">
        <div class="card card border-light  mt-5">
            <div class="card-body mt-5">
                <hr class="bg-primary" />
                <div class="card-title h3">Make An Appointment</div>
                <form action="appointmentCreate.php" method="post">
                    <span class="text-danger"><?php echo  $appoimentError; ?></span>
                    <span class="text-danger"><?php echo $noSpaceError; ?></span>
                    <div class="form-group">
                        <label>Date of a visit</label>
                        <input type="date" class="form-control" name="visitDate" min="<?php echo date('Y-m-d'); ?>">
                        <span class="text-danger"><?php echo $dateError; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Choose Time</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="time">
                            <option value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                        </select>
                    </div>
                    <input type="text" name="pI" value="<?php echo $_SESSION['patientId'] ?>" hidden></p>
                    <button class="btn btn-primary col-sm-12" type="submit" name="dateSent">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End of Make Appointment-->
<?php require 'footer.php' ?>