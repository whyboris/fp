<?php

if(!empty($_POST['name'])){
    $userName = $_POST['name'];
    //echo $userName;
    session_start();
    $_SESSION['name'] = $userName;
    header('location: index.php');
    //echo $_SESSION['name'];
} else {
    header('location: login.php');
}
?>
