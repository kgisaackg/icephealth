<?php require_once 'registerController.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/register.css">
    <title>HCSC register</title>
</head>

<body>
    <div class="container-fluid row d-flex justify-content-center">
        <div class="col-sm-6">
            <hr class="bg-primary w-100" />
            <nav class="navbar text-primary mb-5">
                <p class="h3">Create account</p>
            </nav>
            <form action="register.php" method="post">
                <div class="form-row ">
                    <div class="col-md-6 mb-3">
                        <label>Firstname</label>
                        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname;?>">
                        <span class="text-danger"><?php echo $firstnameError; ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Lastname</label>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                        <span class="text-danger"><?php echo $lastnameError; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Year of birth</label>
                    <input type="number" class="form-control" name="yearOfBirth" value="<?php echo $yearOfBirth; ?>">
                    <span class="text-danger"><?php echo $birthError; ?></span>
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="text" class="form-control" name="emailAddress" value="<?php echo $emailAddress; ?>">
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>

                <div class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Male" checked>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Female">
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="passwordConfirmation">
                    <span class="text-danger"><?php echo $passwordError; ?></span>
                </div>

                <div class="form-row">
                    <button class="btn btn-primary col-sm-12" type="submit" name="registerUser">Sign Up</button>
                </div>
            </form>
            <div class="text-center my-3">
                <span class="">Already have an account? <a href="login.php">Log In</a></span>
            </div>
        </div>
    </div>
</body>

</html>