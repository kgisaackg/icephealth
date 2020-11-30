<?php require 'header.php' ?>
<!--Read and Delete Appointment-->
<div class="row d-flex justify-content-center">
    <div class="col-sm-6  mt-5">
        <table class="table table-primary mt-5">
            <a href="appointmentCreate.php" class="btn btn-primary mt-5">Add appointment</a>
            <hr class="bg-primary" />
            <div class="card-title h3">Doctor Appointment</div>
            <tbody>
                <?php require_once 'appointmentController.php'; ?>
                <?php foreach($app as $appointment) : ?>
                <tr>
                    <td><?php echo $appointment['time']; ?></td>
                    <td><?php echo $appointment['visitdate']; ?></td>
                    <!--<td><?php echo $appointment['patientId']; ?></td>
                <td><?php echo $appointment['appointmentId']; ?></td>-->
                    <form method="post" action="patient.php">
                        <td><a href="appointmentUpdate.php?edit=<?php echo $appointment['appointmentId'];?>"
                                class="btn btn-primary btn-sm">Edit</a></td>
                        <td><a href="appointmentController.php?delete=<?php echo $appointment['appointmentId'];?>"
                                class="btn btn-danger btn-sm">Delete</a></td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!--End of Read and Delete Appointemt-->
<?php require 'footer.php' ?>