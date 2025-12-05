<?php
session_start();
if($_POST['pw'] === 'admin123'){
    $_SESSION['admin']=true;
    header('Location: admin.php');
} else {
    header('Location: login.php');
}
