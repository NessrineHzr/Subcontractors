<?php 
if(isset($_SESSION['login'])) {
    header("Location: index.php");
} else {
    header("Location: login.php");
}

?>