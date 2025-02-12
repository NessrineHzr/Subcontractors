<?php
// Démarrer la session
session_start();
include('../../app/config/base_de_donnee.php');
//Vérifier si le formulaire est soumis
if(isset($_POST['connexion'])) {
    $login =($_POST['login']);
    $password = md5($_POST['password']); // Hashage du mot de passe en MD5
    
    // Requête pour vérifier les identifiants
    $query = "SELECT * FROM utilisateur 
              WHERE login_Utilisateur = '$login' 
              AND mdp_Utilisateur = '$password' 
              AND etat_Utilisateur = '1'";
    
    $result = mysqli_query($connexion, $query);
    
    if(mysqli_num_rows($result) == 1) {
        header("Location: file.php");
        exit();
    } else {
        $error = "Login ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion des sous-traitants</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Lien vers FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/style.css">



</head>
<body class="login">

    <div class="login-box">
        <img src="../img/Group.svg" alt="Logo" class="login-logo">
        
        <form method="POST" action="" >
            <?php if(isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="mb-3 text-start">
                <label for="login">Login    </label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Entrez votre nom d'utilisateur" required>
            </div>
            <div class="mb-3 text-start password-container">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe    " required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i id="eye-icon" class="fa-solid fa-eye-slash"></i>
                </button>
            </div>
            </br>
            <button type="submit" name="connexion" class="btn btn-login">Se connecter</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye"); // Icône œil barré
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash"); // Icône œil ouvert
            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>