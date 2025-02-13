<?php
session_start();
session_destroy(); // Détruire la session
session_unset();
header("Location: ../view/pages/login.php");
exit(); // Toujours ajouter exit() après un header location
?>
