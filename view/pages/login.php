<?php
// Démarrer la session
session_start();
include('../../config/base_de_donnee.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUBCONTRACTORS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Lien vers FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body class="login">
    <div class="login-box">
        <img src="../img/Group.svg" alt="Logo" class="login-logo">
        <form method="POST" action="">
            <p1 class="erreur" id="erreur" style="display:block;"></p1>
            <div class="mb-3 text-start">
                <label for="login">Login</label>
                <input type="text" class="form-control" id="login" placeholder="Entrez votre nom d'utilisateur" required autocomplete="username">
            </div>
            <div class="mb-3 text-start password-container">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" required autocomplete="current-password">
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i id="eye-icon" class="fa-solid fa-eye-slash"></i>
                </button>
            </div>
            </br>
            <button type="button" id="connexion_btn" class="btn btn-login">Se connecter</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="../../public/js/script_app.js"></script>
</body>
</html>