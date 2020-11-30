<?php require 'header.php'; ?>
<?php 

    require_once("connection.php");

    $appQuery = "SELECT * FROM appointment WHERE patientId = ?";
    $stmt = $db->prepare($appQuery);
    $pId = $_SESSION['patientId'];
    $stmt->bind_param('i', $pId);
    $stmt->execute();
    $app = $stmt->get_result();
    $patientApp = $app->fetch_assoc();
    
    $appId = $patientApp['appointmentId'];
    $time = $patientApp['time'];
    $date = $patientApp['visitdate'];


?>

<?php require_once 'appointmentController.php'; ?>
<div class="row d-flex justify-content-center">   
   <div class="col-sm-6"> <!--Why does this have to be tweelve-->
   <div class="card card border-light mt-5">
       <div class="card-body">
           <hr class="bg-primary"/>
           <div class="card-title h3">Edit An Appointment</div>
           <form action="appointmentUpdate.php?Id=<?php echo $appId; ?>" method="post">
                <span class="text-danger"><?php echo $noSpaceError ?></span>
               <div class="form-group">
                   <label>Date of a visit</label>
                   <input type="text" class="form-control" name="updateId"  value="<?php echo $appId; ?>" hidden>
                   <input type="date" class="form-control" name="date" value="<?php echo $date; ?>" min="<?php echo date('Y-m-d'); ?>" />
               </div>

               <div class="form-group">
                   <label>Choose Time</label>
                   <select class="form-control" name="time">
                        <option  class="text-primary" value="<?php echo $time; ?>"><?php echo $time; ?></option>
                        <option value="Morning">Morning</option>
                        <option value="Afternoon">Afternoon</option>
                   </select>
                 </div>
                <button class="btn btn-primary col-sm-12" type="submit" name="appointmentUpdate">Save changes</button>
           </form>
       </div>
   </div>
   </div>
</div><!--End of edit appointment-->

<?php require 'footer.php' ?>