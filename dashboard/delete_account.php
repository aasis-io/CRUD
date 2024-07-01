
<?php
$id = $_GET['id'];




session_start();

if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    include('../class/user.class.php');

    $user = new User();
    $user->set('id', $_POST['id']);

    if ($user->delete()) {
        echo 'success';
        session_destroy();
        setcookie('email', '',  Time() - 60 * 60);
    } else {
        echo 'error';
    }
}

?>