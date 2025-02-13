<?php
session_start();
require_once('../config/base_de_donnee.php');

function login(){
    global $connexion;
    $username =($_POST['username']);
    $password = md5($_POST['password']); 
    // Requête pour vérifier les identifiants
    $query = "SELECT * FROM utilisateur 
              WHERE login_Utilisateur = '$username' 
              AND mdp_Utilisateur = '$password' 
              AND etat_Utilisateur = '1'";
    $result = mysqli_query($connexion, $query);
    if($row = mysqli_fetch_assoc($result)) {
        $_SESSION['Login'] = $row['login_Utilisateur'];
		$_SESSION['Role'] = $row['role_Utilisateur'];
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Méthode incorrecte']);
    }
}
?>