<?php

session_start();

@session_start();
if (!array_key_exists('email', $_SESSION) && !array_key_exists('email', $_COOKIE)) {
    header('location:index.php');
}
include('../class/user.class.php');


if (isset($_GET['v'])) {
    $msg = $_GET['v'];
}

$user = new User();
$user->set('id', $_GET['id']);
$retrieveUser = $user->getById();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>CRUD</title>

</head>

<body>

    <div id="wrapper">
        <div class="container">
            <div class="form-wrapper">
                <div class="form-title">
                    <h3>Details</h3>
                </div>
                <table>
                    <tbody>
                        <tr>
                            <td class="tdTitle">Name</td>
                            <td class="midTd">:</td>
                            <td><?php echo $retrieveUser->name; ?></td>
                        </tr>
                        <tr>
                            <td class="tdTitle">Email</td>
                            <td class="midTd">:</td>
                            <td><?php echo $retrieveUser->email; ?></td>
                        </tr>
                        <tr>
                            <td class="tdTitle">Address</td>
                            <td class="midTd">:</td>
                            <td><?php echo $retrieveUser->address; ?></td>
                        </tr>
                        <tr>
                            <td class="tdTitle">Phone</td>
                            <td class="midTd">:</td>
                            <td><?php echo $retrieveUser->phone; ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="cta-links">
                    <a href="update.php?id=<?php echo $_GET['id'] ?>" class="darkBtn"><i class='bx bx-edit-alt'></i> Edit</a>
                    <a href="javascript:void(0)" id="deleteButton" class="darkBtn del"><i class='bx bx-error'></i> Delete</a>
                </div>

                <span>Go to home? <a href="index.php?id=<?php echo $_GET['id']; ?>">Dashboard</a></span>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // This script will be used to handle errors
        function showToast(message) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });
        }

        // Check if there's an error message passed from PHP
        <?php if (isset($msg)) : ?>
            showToast(' <?php echo $msg ?>');
        <?php endif; ?>
    </script>

    <script>
        document.getElementById('deleteButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make an AJAX request to delete the account
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'delete_account.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            Swal.fire(
                                'Deleted!',
                                'Your account has been deleted.',
                                'success'
                            ).then(() => {
                                // Redirect to another page or perform other actions
                                window.location.href = 'index.php';
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting your account.',
                                'error'
                            );
                        }
                    };
                    xhr.send('id=<?php echo $_GET['id']; ?>');
                }
            });
        });
    </script>

</body>

</html>