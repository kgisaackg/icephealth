<?php require_once 'adminController.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/patient.css">
    <link rel="stylesheet" href="assets/css/register.css">
    <title>HCSC Dashboard</title>
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">HCSC</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="login.html">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#patient">
                                Patient
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#appointment">
                                Appointment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#manageappointment">
                                Manage Appointment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#attendence">
                                Attendence
                            </a>
                        </li>
                    </ul>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <!--My Dash Board-->
                <h1>Dashboard</h1>
                <div class="min-vh-100  mt-5">
                    <!--Cards Container-->
                    <div class="row">
                        <div class="card col-6 col-md-4 text-white bg-primary mb-3">
                            <div class="card-body">
                                <p class="card-title">Patients</p>
                                <p class="card-text h2"><?php echo $numOfPatient; ?></p>
                            </div>
                        </div>
                        <div class="card col-6 col-md-4 table-primary mb-3">
                            <div class="card-body table-primary">
                                <p class="card-title">Appointments</p>
                                <p class="card-text h2"><?php echo $numOfAppointment; ?></p>
                            </div>
                        </div>

                    </div>

                </div>
                <!--End of Cards Container-->

                <div class="min-vh-100 mt-5 pt-5" id="patient">
                    <div class="card">
                        <div class="card-body table-primary">
                            <table class="table table-sm pt-5">
                                <thead>
                                    <tr>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Year Of Birth</th>
                                        <th scope="col">Email Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($patients as $patient) : ?>
                                    <tr>
                                        <td><?php echo $patient['firstname']; ?></td>
                                        <td><?php echo $patient['lastname']; ?></td>
                                        <td><?php echo $patient['gender']; ?></td>
                                        <td><?php echo $patient['yearofbirth']; ?></td>
                                        <td><?php echo $patient['emailaddress']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="min-vh-100 mt-5 pt-5" id="appointment">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-sm table-striped pt-5">
                                <thead>
                                    <tr>
                                        <th scope="col">Appointment Id</th>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Visit Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Attended</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($appointments as $appointment) : ?>
                                    <tr>
                                        <td><?php echo $appointment['appointmentId']; ?></td>
                                        <td><?php echo $appointment['firstname']; ?></td>
                                        <td><?php echo $appointment['visitdate']; ?></td>
                                        <td><?php echo $appointment['time']; ?></td>
                                        <form method="post" action="adminController.php">
                                            <td>
                                                <input type="text" value="<?php echo $appointment['appointmentId']; ?>"
                                                    name="apId" hidden>
                                                <input type="text" value="<?php echo $appointment['firstname']; ?>"
                                                    name="firstname" hidden>
                                                <input type="text" value="<?php echo $appointment['visitdate']; ?>"
                                                    name="vdate" hidden>
                                                <input type="text" value="<?php echo $appointment['time']; ?>"
                                                    name="time" hidden>
                                                <button class="btn btn-success btn-sm"
                                                    value="<?php echo $appointment['appointmentId']; ?>"
                                                    name="deleteAppointmentYes">Yes</button>
                                                <button class="btn btn-danger btn-sm"
                                                    value="<?php echo $appointment['appointmentId']; ?>"
                                                    name="deleteAppointmentNo">No</button>
                                            </td>
                                        </form>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class=" min-vh-100 row d-flex justify-content-center mt-5" id="manageappointment">
                    <div class="col-sm-6">
                        <div class="card card border-light mt-5">
                            <div class="card-body mt-5">
                                <hr class="bg-primary" />
                                <div class="card-title h3">Manage Appointment</div>
                                <form action="adminController.php" method="post">
                                    <div class="form-group">
                                        <label>Number of patients expected during the morning</label>
                                        <input type="number" min="0" name="morningPatients" class="form-control"
                                            value="<?php echo $morningNum; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Number of patients expected during the afternoon</label>
                                        <input type="number" min="0" name="afternoonPatients" class="form-control"
                                            value="<?php echo $afternoonNum; ?>">
                                    </div>
                                    <div class="form-row">
                                        <button class="btn btn-primary col-sm-12" type="submit"
                                            name="manageAppointment">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="min-vh-100 mt-5 pt-5" id="attendence">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-sm table-striped pt-5">
                                <thead>
                                    <tr>
                                        <th scope="col">Appointment Id</th>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Visit Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Attended</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($attendences as $attendence) : ?>
                                    <tr>
                                        <td><?php echo $attendence['appid']; ?></td>
                                        <td><?php echo $attendence['name']; ?></td>
                                        <td><?php echo $attendence['vdate']; ?></td>
                                        <td><?php echo $attendence['time']; ?></td>
                                        <td><?php echo $attendence['attend'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>