<?php require_once('registerController.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/register.css">
    <title>HCSC login</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center text-center">
        <form class="mt-5" style="width: 18rem;" action="login.php" method="post">
            <hr class="bg-primary" />
            <fieldset>
                <?php if(count($errors) > 0): ?>
                <div class="form-group">
                    <?php foreach($errors as $error): ?>
                    <li class="text-danger"><?php echo $error ?></li>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <legend class="h3 text-primary mb-5">Welcome back</i></legend>
                <input type="text" class="form-group form-control" placeholder="Email Address" name="emailAddress"
                    value="<?php echo $emailAddress; ?>">
                <input type="password" class="form-group form-control" placeholder="Password" name="password">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="login-btn">Sign Up</button>
                </div>
                <a href="">Forgot Password</a><br>
                <p>Don't have an account <a href="register.php">Sign Up</a></p>
            </fieldset>
        </form>
    </div>
</body>

</html>