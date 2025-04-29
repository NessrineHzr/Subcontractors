<?php
session_start();
include('../../config/base_de_donnee.php');
$ID = $_SESSION['ID'];
$role = $_SESSION['Role'];

header("Location: dashboard.php");

?>