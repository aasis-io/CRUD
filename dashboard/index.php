<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="../css/style.css">

    <title>CRUD</title>
</head>

<body>

    <div id="wrapper">
        <div class="container">
            <div class="form-wrapper">
                <?php if (array_key_exists('email', $_SESSION) && array_key_exists('email', $_COOKIE)) { ?>
                    <div class="cta-links">
                        <a href="profile.php?id=<?php echo $_GET['id'] ?>" class="darkBtn">View Details</a>
                    </div>
                <?php } else { ?>
                    <div class="form-title">
                        <h3>Login / Register</h3>
                    </div>
                    <div class="cta-links">
                        <a href="../index.php" class="darkBtn">Login</a>
                        <a href="" class="darkBtn">Register</a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</body>

</html>