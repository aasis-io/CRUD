<?php

include('class/user.class.php');

$user = new User();
if (isset($_GET['v'])) {
    $errorMsg = $_GET['v'];
}

if (isset($_POST['submit'])) {
    $user->set('name', $_POST['name']);
    $user->set('email', $_POST['email']);
    $user->set('phone', $_POST['phone']);
    $user->set('address', $_POST['address']);
    $user->set('password', $_POST['password']);
    $user->save();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>

<body>

    <div id="wrapper">
        <div class="container">
            <div class="form-wrapper">
                <div class="form-title">
                    <h3>Register</h3>
                    <p>Create your account!</p>
                </div>
                <form action="" class="registerWrap" method="post" onsubmit="return validateForm()" novalidate>
                    <div class="register">
                        <div class="form-group">
                            <label for="name" class="myLabel">Name</label>
                            <i class='bx bx-user'></i>
                            <input type="text" name="name" id="name" class="inputField" placeholder=" " required>
                            <small id="nameError" class="errors"></small>
                        </div>
                        <div class="form-group">
                            <label for="email" class="myLabel">Email</label>
                            <i class='bx bx-envelope'></i>
                            <input type="text" name="email" id="email" class="inputField" placeholder=" " required>
                            <small id="emailError" class="errors"></small>

                        </div>
                        <div class="form-group">
                            <label for="address" class="myLabel">Address</label>
                            <i class='bx bx-target-lock'></i>
                            <input type="text" name="address" id="address" class="inputField" placeholder=" " required>
                            <small id="addressError" class="errors"></small>

                        </div>
                        <div class="form-group">
                            <label for="phone" class="myLabel">Phone Number</label>
                            <i class='bx bx-phone'></i>
                            <input type="text" name="phone" id="phone" class="inputField" placeholder=" " required>
                            <small id="phoneError" class="errors"></small>

                        </div>
                        <div class="form-group">
                            <label for="password" id="label">Password</label>
                            <i class='bx bx-lock'></i>
                            <input type="password" name="password" id="password" class="inputField" required>
                            <small id="passwordError" class="errors"></small>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword" id="label">Confirm Password</label>
                            <i class='bx bx-lock'></i>
                            <input type="password" name="confirmPassword" id="confirmPassword" class="inputField" required>
                            <small id="confirmPasswordError" class="errors"></small>
                        </div>

                        <div class="form-group passwordShower">
                            <input type="checkbox" id="passwordTog">
                            <label for="passwordTog">Show Password</label>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn darkBtn">Register</button>

                </form>
                <span>Already registered? <a href="index.php">Login</a></span>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>