<?php
// Démarrer la session
session_start();
include('../../config/base_de_donnee.php');
$login = $_SESSION['Login'];
$role = $_SESSION['Role'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUBCONTRACTORS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>

</script>

</head>
<body>
    <aside class="sidebar">
        <img src="../img/logo_projet.jpg" alt="Description de l'image" width="100" height="50">
        <nav class="nav-menu">
            <a href="file.php" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            <a href="file.php" class="nav-link"><i class="fas fa-file-alt"></i><span>Demandes</span></a>
            <a href="file.php" class="nav-link"><i class="fas fa-user-tie"></i><span>Sous-traitants</span></a>
            <a href="file.php" class="nav-link"><i class="fas fa-users"></i><span>Salariés</span></a>
            <a href="file.php" class="nav-link"><i class="fas fa-file-contract"></i><span>Contrats</span></a>
            <a href="file.php" class="nav-link"><i class="fas fa-folder"></i><span>Documents</span></a>
            <a href="file.php" class="nav-link"><i class="fas fa-envelope"></i><span>Messageries</span></a>
        </nav>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <div class="search-container">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div class="icons">
                    <div class="icon message">
                        <i class="far fa-comment-dots"></i>
                        <div class="notification"></div>
                    </div>
                    <div class="icon notification">
                        <i class="fa-regular fa-bell"></i>
                        <div class="notification"></div>
                    </div>
                    <div class="user-info" onclick="toggleDropdown()">
                        <!-- Icône utilisateur -->
                        <i class="fas fa-user-circle user-icon"></i>
                        <!-- Infos utilisateur -->
                        <div class="user-details">
                            <span class="login"><?php echo $login; ?></span>
                            <span class="role"><?php echo $role; ?></span>
                        </div>
                        <!-- Flèche de la liste déroulante -->
                        <i class="fas fa-chevron-down arrow"></i>
                        <!-- Liste déroulante -->
                        <div class="dropdown">
                            <a href="profile.php">Mes informations</a>
                            <a href="../../controllers/logout.php">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>

        