<?php
// Démarrer la session
session_start();
include('C:\xampp\htdocs\Subcinstractors\app\config\base_de_donnee.php');

// Requête pour récupérer le login et le rôle de l'utilisateur avec un état "1"
$res = "SELECT login_Utilisateur, role_Utilisateur FROM utilisateur WHERE etat_Utilisateur='1'";

// Exécuter la requête
$login_result = $connexion->query($res);

// Vérifier si des résultats ont été retournés
if ($login_result->num_rows > 0) {
    // Récupérer les données de l'utilisateur
    $row = $login_result->fetch_assoc();
    $login = $row['login_Utilisateur'];
    $role = $row['role_Utilisateur']; // Récupérer le rôle
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/header.css">

<script>
function toggleDropdown() {
    const dropdown = document.querySelector(".user-info .dropdown");
    const arrow = document.querySelector(".user-info .arrow");

    dropdown.classList.toggle("show");
    arrow.classList.toggle("open");
}
</script>

</head>
<body>
    <aside class="sidebar">
        <a href="/" class="logo">
        </a>

        <nav class="nav-menu">
            <a href="#" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            <a href="#" class="nav-link"><i class="fas fa-file-alt"></i><span>Demandes</span></a>
            <a href="#" class="nav-link"><i class="fas fa-user-tie"></i><span>Sous-traitants</span></a>
            <a href="#" class="nav-link"><i class="fas fa-users"></i><span>Salariés</span></a>
            <a href="#" class="nav-link"><i class="fas fa-file-contract"></i><span>Contrats</span></a>
            <a href="#" class="nav-link"><i class="fas fa-folder"></i><span>Documents</span></a>
            <a href="#" class="nav-link"><i class="fas fa-envelope"></i><span>Messageries</span></a>
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
            <a href="#">Mes informations</a>
            <a href="logout.php">Déconnexion</a>
        </div>
    </div>
    </div>

        </div>
    </div>
</main>



</body>
</html>