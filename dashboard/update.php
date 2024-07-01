<?php
session_start();

if (!array_key_exists('email', $_SESSION) || !array_key_exists('email', $_COOKIE)) {
    header('location: index.php');
    exit();
}

include('../class/user.class.php');

$user = new User();
if (isset($_GET['id'])) {
    $user->set('id', $_GET['id']);
    $retrieveUser = $user->getById();
}

if (isset($_GET['v'])) {
    $errorMsg = $_GET['v'];
}

if (isset($_POST['submit'])) {
    $user->set('name', $_POST['name']);
    $user->set('email', $_POST['email']);
    $user->set('phone', $_POST['phone']);
    $user->set('address', $_POST['address']);


    $result = $user->edit();
    if ($result) {
        $ErrMs = "";
        $user->set('id', $_GET['id']);
        $retrieveUser = $user->getById();
        header('Location: profile.php?v=Updated Successfully!&id=' . $user->id);
        exit();
    } else {
        $msg = "Update failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <title>Edit Details</title>
</head>

<body>

    <div id="wrapper">
        <div class="container">
            <div class="form-wrapper">
                <div class="form-title">
                    <h3>Edit Details</h3>
                    <p>Update your account!</p>
                </div>
                <form action="" class="registerWrap" method="post" onsubmit="return validateForm()" novalidate>
                    <div class="register">
                        <div class="form-group">
                            <label for="name" class="myLabel">Name</label>
                            <i class='bx bx-user'></i>
                            <input type="text" name="name" id="name" class="inputField" value="<?php echo htmlspecialchars($retrieveUser->name); ?>" required>
                            <small id="nameError" class="errors"></small>
                        </div>
                        <div class="form-group">
                            <label for="email" class="myLabel">Email</label>
                            <i class='bx bx-envelope'></i>
                            <input type="text" name="email" id="email" class="inputField" value="<?php echo htmlspecialchars($retrieveUser->email); ?>" required>
                            <small id="emailError" class="errors"></small>
                        </div>
                        <div class="form-group">
                            <label for="address" class="myLabel">Address</label>
                            <i class='bx bx-target-lock'></i>
                            <input type="text" name="address" id="address" class="inputField" value="<?php echo htmlspecialchars($retrieveUser->address); ?>" required>
                            <small id="addressError" class="errors"></small>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="myLabel">Phone Number</label>
                            <i class='bx bx-phone'></i>
                            <input type="text" name="phone" id="phone" class="inputField" value="<?php echo htmlspecialchars($retrieveUser->phone); ?>" required>
                            <small id="phoneError" class="errors"></small>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn darkBtn">Update</button>
                </form>
                <span>Go to account? <a href="profile.php?id=<?php echo $_GET['id']; ?>">Profile</a></span>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            let isValid = true;

            // Clear previous error messages
            document.getElementById("nameError").innerText = "";
            document.getElementById("emailError").innerText = "";
            document.getElementById("phoneError").innerText = "";
            document.getElementById("addressError").innerText = "";

            // Get form values
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;
            const address = document.getElementById("address").value;

            // Validate name
            if (name.trim() === "") {
                document.getElementById("nameError").innerText = "Name is required.";
                isValid = false;
            }

            // Validate email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                document.getElementById("emailError").innerText = "Invalid email address.";
                isValid = false;
            }

            // Validate phone
            const phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phone)) {
                document.getElementById("phoneError").innerText = "Invalid phone number.";
                isValid = false;
            }

            // Validate address
            if (address.trim() === "") {
                document.getElementById("addressError").innerText = "Address is required.";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>

</html>