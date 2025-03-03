<?php
session_start();
require_once('../config/base_de_donnee.php');

function message($nom_fonction , $result){
    if (strpos($nom_fonction, 'supprimer') === 0) {
        if ($result) {
            $x = "supprission réussie !";
            return $x;
        } else {
            $y = "supprission échouée !";
            return $y;
        }
    }elseif (strpos($nom_fonction, 'update') === 0) {
        if ($result) {
            $x = "modification réussie !";
            return $x;
        } else {
            $y = "modification échouée !";
            return $y;
        }
    } elseif (strpos($nom_fonction, 'ajouter') === 0) {
        if ($result) {
            $x = "ajout réussie !";
            return $x;
        } else {
            $y = "ajout échouée !";
            return $y;
        }
    }
}

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
    $ancien_mdp =($_POST['ancien_mdp']);
    $nouveau_mdp =md5($_POST['nouveau_mdp']);
    $confirmer_mdp =md5($_POST['confirmer_mdp']);

if ((!empty($nouveau_mdp))&&(!empty($confirmer_mdp))){
    if($nouveau_mdp == $confirmer_mdp){
        $ancien_mdp=$nouveau_mdp;
    }
}
    $sql=" UPDATE utilisateur SET nom_Utilisateur='$nom' ,prenom_Utilisateur='$prenom' ,email_Utilisateur='$email' ,telephone_Utilisateur='$telephone' ,adresse_Utilisateur='$adresse' ,mdp_Utilisateur='$ancien_mdp' , date_updated_Utilisateur='$date_courrant' WHERE id_utilisateur=$ID ";
    $result = $connexion->query($sql);
    if ($result == TRUE) {
        echo json_encode(['success' => message(__FUNCTION__, $result)]);
    } else {
        echo json_encode(['error' => message(__FUNCTION__, $result)]);
    }
}
function update_image() {
    global $connexion;
    $ID= $_SESSION['ID'];
    $nom= $_SESSION['Role'];
    $prenom= $_SESSION['Role'];
    $fileInput= 'profile_image';
    $prefix = "user";
    $uploadDir = '../view/img/profil/';
    $allowedTypes= ['jpg', 'jpeg', 'png']; 
    if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] == 0) {
        $fileTmpPath = $_FILES[$fileInput]['tmp_name'];
        $fileName = $_FILES[$fileInput]['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedTypes)) {
            echo "<div class='text-echec'>Type de fichier non autorisé pour $fileInput. </div>";
            return null;
        }

        $newFileName = $prefix . '_' . $nom . '_' . $prenom . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $sql = "UPDATE utilisateur SET image_Utilisateur = '$newFileName' WHERE id_Utilisateur ='$ID'";
    $result = $connexion->query($sql);
        } else {
            echo "<div class='text-echec'>Erreur lors du téléchargement du fichier $fileInput.</div>";
            return null;
        }
    }
    

}



////////////////////////////////////////////////////////////////

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
            $missionClass = ($row['typeMission_Salarie'] == 'Européenne') ? 'mission mission-europeenne' : 'mission';
            $value .= "<tr>
                <td>" . $row['nom_Salarie'] . "</td>
                <td>" . $row['prenom_Salarie'] . "</td>
                <td>" . $row['dateNaissance_Salarie'] . "</td>
                <td>" . $row['nationalite_Salarie'] . "</td>
                <td>" . $row['poste_Salarie'] . "</td>
                <td> <div class='$missionClass'>" . $row['typeMission_Salarie'] . "</div></td>
                <td><button type='button' class='icon-button' id='btn_document_salarie' data-document='" . $row['id_Salarie'] . "'><img src='../img/view.png'/></button></td>
                <td>
                    <center>
                        <button type='button' class='modifier' id='btn_modif_salarie' data-id='" . $row['id_Salarie'] . "'>Modifier</button>
                        <button type='button' class='supprimer' id='btn_supprime_salarie' data-id1='" . $row['id_Salarie'] . "'>Supprimer</button>
                    </center>
                </td>
            </tr>";
        }
    } 
    $value .= "</tbody></table>";
    echo json_encode(['status' => 'success', 'html' => $value]);
}

    function ajouter_salarie() {
        global $connexion;
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaissance = $_POST['dateNaissance'];
        $nationalite = $_POST['nationalite'];
        $poste = $_POST['poste'];
        $typeMission = $_POST['typeMission'];
        $date_courrant = date('Y-m-d H:i:s');
        $etat = "1";
    
        $uploadDir = '../view/file/';
        $allowedPdfTypes = ['pdf']; 
        $allowedImageTypes = ['jpg', 'jpeg', 'png']; 
        // Fonction pour gérer l'upload des fichiers
        function uploadFile($fileInput, $prefix, $nom, $prenom, $uploadDir, $allowedTypes) {
            if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] == 0) {
                $fileTmpPath = $_FILES[$fileInput]['tmp_name'];
                $fileName = $_FILES[$fileInput]['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                if (!in_array($fileExtension, $allowedTypes)) {
                    echo "<div class='text-echec'>Type de fichier non autorisé pour $fileInput. </div>";
                    return null;
                }
    
                $newFileName = $prefix . '_' . $nom . '_' . $prenom . '.' . $fileExtension;
                $destPath = $uploadDir . $newFileName;
    
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    return $newFileName;
                } else {
                    echo "<div class='text-echec'>Erreur lors du téléchargement du fichier $fileInput.</div>";
                    return null;
                }
            }
            return null;
        }
    
        // Upload de tous les fichiers (avec les extensions appropriées)
        $pieceIdentite = uploadFile('piece_identite', 'pieceIdentite', $nom, $prenom, $uploadDir, $allowedPdfTypes);
        $dpae = uploadFile('dpae', 'DPAE', $nom, $prenom, $uploadDir, $allowedPdfTypes);
        $permit = uploadFile('permit', 'Permis', $nom, $prenom, $uploadDir, $allowedPdfTypes);
        $certificatA1 = uploadFile('certificat_a1', 'CertificatA1', $nom, $prenom, $uploadDir, $allowedPdfTypes);
        $certificatZoll = uploadFile('certificat_zoll', 'CertificatZoll', $nom, $prenom, $uploadDir, $allowedPdfTypes);
        $photo = uploadFile('photo', 'Photo', $nom, $prenom, $uploadDir, $allowedImageTypes); // La photo peut être JPG, JPEG, ou PNG
    
    try {
        $sql = "INSERT INTO salarie (nom_Salarie, prenom_Salarie, dateNaissance_Salarie, nationalite_Salarie, poste_Salarie, typeMission_Salarie, date_created_Salarie, etat_Salarie, pieceIdentite_Salarie, dpae_Salarie, permit_Salarie, certificatA1_Salarie, certificatZoll_Salarie, photo_Salarie) 
                VALUES ('$nom', '$prenom', '$dateNaissance', '$nationalite', '$poste', '$typeMission', '$date_courrant', '$etat', '$pieceIdentite', '$dpae', '$permit', '$certificatA1', '$certificatZoll', '$photo')";

        $result = $connexion->prepare($sql);
        if ($result->execute() === true) {
            echo message(__FUNCTION__, $result);
        } else {
            echo message(__FUNCTION__, $result);
        }
    } catch (PDOException $e) {
        echo "<div class='text-echec'>Erreur : " . $e->getMessage() . "</div>";
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
    $result = $connexion->query($sql);
    echo message(__FUNCTION__, $result);  
}

function supprimer_salarie(){
    global $connexion;
    $SalarieID = $_POST['SalarieID'];
    $date_courrant=date('Y-m-d H:i:s');
    $etat="0";
    $sql = "UPDATE salarie SET etat_Salarie = '$etat',date_updated_Salarie = '$date_courrant' WHERE id_Salarie = '$SalarieID'";
    $result = $connexion->query($sql);
    echo message(__FUNCTION__, $result);
}

function get_documentSalarie(){
    global $connexion;
    $SalarieID = $_POST['SalarieID'];
    $query = "SELECT * FROM salarie WHERE id_Salarie= '$SalarieID'";
    $result = mysqli_query($connexion, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $document_data = [];
        $document_data[0] = $row['id_Salarie'];
        $document_data[1] = $row['pieceIdentite_Salarie'];
        $document_data[2] = $row['dpae_Salarie'];
        $document_data[3] = $row['permit_Salarie'];
        $document_data[4] = $row['certificatA1_Salarie'];
        $document_data[5] = $row['certificatZoll_Salarie'];
        $document_data[6] = $row['photo_Salarie'];
    }
    echo json_encode($document_data);

}



?>


