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
        $_SESSION['ID'] = $row['id_Utilisateur'];
        $_SESSION['Login'] = $row['login_Utilisateur'];
		$_SESSION['Role'] = $row['role_Utilisateur'];
        $_SESSION['Nom'] = $row['nom_Utilisateur']." ".$row['prenom_Utilisateur'];
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Méthode incorrecte']);
    }
}

function update_profile(){
    global $connexion;
    $date_courrant=date('Y-m-d H:i:s');
    $ID = $_SESSION['ID'];
    $nom = ($_POST['nom']);
    $prenom = ($_POST['prenom']);
    $email = ($_POST['email']);
    $telephone = ($_POST['telephone']);
    $adresse = ($_POST['adresse']);
    $ancien_mdp =md5($_POST['ancien_mdp']);
    $nouveau_mdp =md5($_POST['nouveau_mdp']);
    $confirmer_mdp =md5($_POST['confirmer_mdp']);
    $sql_mdp = "SELECT mdp_Utilisateur FROM utilisateur WHERE id_Utilisateur = '$ID'";
    $result_mdp = mysqli_query($connexion, $sql_mdp);
    $row_mdp = mysqli_fetch_assoc($result_mdp);
    $nv_mdp = $row_mdp['mdp_Utilisateur'];

if ((!empty($nouveau_mdp))&&(!empty($confirmer_mdp))){
    if($nouveau_mdp == $confirmer_mdp){
        $nv_mdp=$nouveau_mdp;
    }
}
    $sql=" UPDATE utilisateur SET nom_Utilisateur='$nom' ,prenom_Utilisateur='$prenom' ,email_Utilisateur='$email' ,telephone_Utilisateur='$telephone' ,adresse_Utilisateur='$adresse' ,mdp_Utilisateur='$nv_mdp' , date_updated_Utilisateur='$date_courrant' WHERE id_utilisateur=$ID ";
    if ($connexion->query($sql) == TRUE) {
        echo json_encode(['success' => "Modification réussie !"]);
    } else {
        echo json_encode(['error' => "Modification échouée !"]);
    }
}

    function ajouter_salarie() {
        global $connexion;
        $nom= $_POST['nom'];
        $prenom= $_POST['prenom'];
        $dateNaissance= $_POST['dateNaissance'];
        $nationalite = $_POST['nationalite'];
        $poste = $_POST['poste'];
        $typeMission= $_POST['typeMission'];
        $date_courrant=date('Y-m-d H:i:s');
        $etat="1";
        try {
            $sql = "INSERT INTO salarie (nom_Salarie, prenom_Salarie, dateNaissance_Salarie, nationalite_Salarie, poste_Salarie, typeMission_Salarie, date_created_Salarie, etat_Salarie) 
            VALUES ('$nom', '$prenom', '$dateNaissance', '$nationalite', '$poste', '$typeMission', '$date_courrant', '$etat')";
             $stmt = $connexion->prepare($sql);            
             // Exécution de la requête et test du résultat
        if ($stmt->execute() === true) {
            echo json_encode(['success' => "Ajout réussie !"]);
        } else {
            echo json_encode(['error' => "Ajout échouée !"]);
        }
    } catch (PDOException $e) {
        // En cas d'exception, renvoyer l'erreur au format JSON
        echo json_encode(['error' => "Erreur : " . $e->getMessage()]);
    }
    }

function update_salarie(){
    global $connexion;
    $id = $_POST['id_Salarie'];
    $nom= $_POST['nom_Salarie'];
    $prenom= $_POST['prenom_Salarie'];
    $dateNaissance= $_POST['dateNaissance_Salarie'];
    $nationalite = $_POST['nationalite_Salarie'];
    $poste = $_POST['poste_Salarie'];
    $typeMission= $_POST['typeMission_Salarie'];
    $date_courrant=date('Y-m-d H:i:s');
    $sql = "UPDATE salarie SET nom_Salarie = '$nom', prenom_Salarie = '$prenom', dateNaissance_Salarie = '$dateNaissance', nationalite_Salarie = '$nationalite', poste_Salarie = '$poste', typeMission_Salarie = '$typeMission', date_updated_Salarie = '$date_courrant' WHERE id_Salarie ='$id'";
    if ($connexion->query($sql) === TRUE) {
        echo json_encode(['success' => "Modification réussie!"]);
    } else {
        echo json_encode(['error' => "Modification échouée!"]);
    }
    
}

function supprimer_salarie(){
    global $connexion;
    $id = $_POST['id'];
    $date_courrant=date('Y-m-d H:i:s');
    $etat="0";
    $sql = "UPDATE salarie SET etat_Salarie = '$etat',date_updated_Salarie = '$date_courrant' WHERE id_Salarie = '$id'";
    if ($connexion->query($sql) === TRUE) {
        echo json_encode(['success' => "Suppression réussie!"]);
    } else {
        echo json_encode(['error' => "Suppression échouée!"]);
    }
}

?>


