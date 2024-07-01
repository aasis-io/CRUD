<?php
@session_start();
if (array_key_exists('email', $_SESSION) && array_key_exists('email', $_COOKIE)) {
    header('location:dashboard/index.php');
}


include('class/user.class.php');

$user = new User();

if (isset($_POST['submit'])) {
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $status =  $user->login();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>

    <div id="wrapper">
        <div class="container">
            <div class="form-wrapper">
                <div class="form-title">
                    <h3>Login</h3>
                    <p>Sign in to your account!</p>
                </div>
                <form action="" method="post" onsubmit="return validateForm()" novalidate>
                    <div class="form-group">
                        <label for="email" class="myLabel">Email</label>
                        <i class='bx bx-user'></i>
                        <input type="text" name="email" id="email" class="inputField" placeholder=" " required>
                        <small id="emailError" class="errors"></small>
                        <?php
                        if (isset($status)) { ?>
                            <small class="errors"><?php echo $status; ?></small>
                        <?php }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="password" id="label">Password</label>
                        <i class='bx bx-lock'></i>
                        <input type="password" name="password" id="password" class="inputField" required>
                        <small id="passwordError" class="errors"></small>
                        <!-- <button id="passwordToggler" type="button"><i class="fa-solid fa-eye-slash" id="iconToggle"></i></button> -->
                    </div>

                    <div class="form-group passwordShower">
                        <input type="checkbox" id="passwordTog">
                        <label for="passwordTog">Show Password</label>
                    </div>
                    <button type="submit" name="submit" class="darkBtn">Login</button>
                </form>
                <span>New here? <a href="register.php">Register</a></span>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            let isValid = true;

            // Clear previous error messages
            document.getElementById('emailError').style.display = 'none';
            document.getElementById('passwordError').style.display = 'none';

            // Get form values
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Validate email
            if (email.trim() === '') {
                document.getElementById('emailError').innerText = 'Email is required.';
                document.getElementById('emailError').style.display = 'block';
                isValid = false;
            }

            // Validate password
            if (password.trim() === '') {
                document.getElementById('passwordError').innerText = 'Password is required.';
                document.getElementById('passwordError').style.display = 'block';
                isValid = false;
            }

            return isValid;
        }

        // Password visibility toggle

        document.addEventListener("DOMContentLoaded", () => {
            document
                .getElementById("passwordTog")
                .addEventListener("change", function() {
                    const passwordField = document.getElementById("password");
                    if (this.checked) {
                        passwordField.type = "text";
                    } else {
                        passwordField.type = "password";
                    }
                });
        });
    </script>
    <script src="https://kit.fontawesome.com/1f2d50e34f.js" crossorigin="anonymous"></script>

</body>

</html>