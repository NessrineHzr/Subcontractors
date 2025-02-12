<?php
session_start();
session_destroy(); // Détruire la session
session_unset();
header("Location: login.php"); // Rediriger vers la page login
exit();
?>
