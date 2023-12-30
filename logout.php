<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    unset($_SESSION['loggedin']);
    unset($_SESSION['KodeLogin']);
    unset($_SESSION['Level']);
    session_destroy();
    header('Location: index.php');
} else {
    header('Location: login.php');
}
?>