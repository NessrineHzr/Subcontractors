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

function display_salarie(){
    global $connexion;
    $value = '<table id="listeSalarie" class="table-salarie">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de naissance</th>
        <th>Nationalité</th>
        <th>Poste</th>
        <th>Mission</th>
        <th>Documents</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';

    $sql = "SELECT id_Salarie,nom_Salarie, prenom_Salarie, dateNaissance_Salarie, nationalite_Salarie, poste_Salarie, typeMission_Salarie FROM salarie WHERE etat_Salarie = '1'";
    $result = mysqli_query($connexion,$sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $missionClass = ($row['typeMission_Salarie'] == 'européenne') ? 'mission mission-europeenne' : 'mission';
            $value .= "<tr>
                <td>" . $row['nom_Salarie'] . "</td>
                <td>" . $row['prenom_Salarie'] . "</td>
                <td>" . $row['dateNaissance_Salarie'] . "</td>
                <td>" . $row['nationalite_Salarie'] . "</td>
                <td>" . $row['poste_Salarie'] . "</td>
                <td><button class='$missionClass'>" . $row['typeMission_Salarie'] . "</button></td>
                <td><button class='icon-button'><i class='fa fa-eye'></i></button></td>
                <td>
                    <button type='button' class='modifier' id='btn_modif_salarie' data-id='" . $row['id_Salarie'] . "'>Modifier</button>
                    <button type='button' class='supprimer' id='btn_supprime_salarie' data-id1='" . $row['id_Salarie'] . "'>Supprimer</button>
                </td>
            </tr>";
        }
    } 
    $value .= "</tbody></table>";
    echo json_encode(['status' => 'success', 'html' => $value]);
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
            echo "<div class='text-checked'>Ajout réussie!</div>";
        } else {
            echo "<div class='text-echec'>Ajout échouée!</div>";
        }
    } catch (PDOException $e) {
        // En cas d'exception, renvoyer l'erreur au format JSON
        echo "<div class='text-echec'>Erreur : " . $e->getMessage()."</div>";
    }
}

function get_salarie(){
    global $connexion;
    $SalarieID = $_POST['SalarieID'];
    $query = "SELECT * FROM salarie WHERE id_Salarie= '$SalarieID'";
    $result = mysqli_query($connexion, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $salarie_data = [];
        $salarie_data[0] = $row['id_Salarie'];
        $salarie_data[1] = $row['nom_Salarie'];
        $salarie_data[2] = $row['prenom_Salarie'];
        $salarie_data[3] = $row['dateNaissance_Salarie'];
        $salarie_data[4] = $row['nationalite_Salarie'];
        $salarie_data[5] = $row['poste_Salarie'];  
        $salarie_data[6] = $row['typeMission_Salarie'];
    }
    echo json_encode($salarie_data);
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
        echo "<div class='text-checked'>Modification réussie!</div>";
    } else {
        echo "<div class='text-echec'>Modification échouée!</div>"; 
    }   
}

function supprimer_salarie(){
    global $connexion;
    $SalarieID = $_POST['SalarieID'];
    $date_courrant=date('Y-m-d H:i:s');
    $etat="0";
    $sql = "UPDATE salarie SET etat_Salarie = '$etat',date_updated_Salarie = '$date_courrant' WHERE id_Salarie = '$SalarieID'";
    if ($connexion->query($sql) === TRUE) {
        echo "<div class='text-checked'>Suppression réussie!</div>";
    } else {
        echo "<div class='text-echec'>Suppression échouée!</div>";
    }
}

?>


