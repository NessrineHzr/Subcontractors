<?php
session_start();
include('../../config/base_de_donnee.php');
$ID = $_SESSION['ID'];
$role = $_SESSION['Role'];

if($role == '1'){
    header("Location: dashboard.php");
}else{
    header("Location: demande.php");
}
 
?>