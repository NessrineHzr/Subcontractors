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

// PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function envoyer_mail($destinataire, $nom_complet, $login, $mdp){
    require_once __DIR__ . '/../vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        // Config SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nessrinehazzar000@gmail.com'; 
        $mail->Password   = 'inuu wlky ditu btar';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Expéditeur et destinataire
        $mail->setFrom('nessrinehazzar000@gmail.com', 'Subcontractors');
        $mail->addAddress($destinataire, $nom_complet);

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Bienvenue sur notre site web !';
        $mail->Body    = "<p>Bonjour $nom_complet,</p>
                          <p>Votre compte a été créé avec succès.<br>
                          Login : <strong>$login</strong><br>
                          Mot de passe : <strong>$mdp</strong></p>";
        $mail->AltBody = "Bonjour $nom_complet, Votre compte a été créé avec succès. Login : $login, Mot de passe : $mdp";

        $mail->send();
        // echo 'Mail envoyé'; // facultatif
    } catch (Exception $e) {
        error_log("Erreur d'envoi de mail: {$mail->ErrorInfo}");
    }
}
function envoyer_mail_contact($email, $nom, $objet, $message){
    require_once __DIR__ . '/../vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        // Config SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nessrinehazzar000@gmail.com'; 
        $mail->Password   = 'inuu wlky ditu btar';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Expéditeur et destinataire
        $mail->setFrom($email, $nom);
        $mail->addAddress('nessrinehazzar000@gmail.com', "IMG");

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = $objet;
        $mail->Body    = $message;
        $mail->AltBody = $message;

        $mail->send();
        // echo 'Mail envoyé'; // facultatif
    } catch (Exception $e) {
        error_log("Erreur d'envoi de mail: {$mail->ErrorInfo}");
    }
}

function mail_document($destinataire, $nom ,$doc ,$date){
    require_once __DIR__ . '/../vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        // Config SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nessrinehazzar000@gmail.com'; 
        $mail->Password   = 'inuu wlky ditu btar';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Expéditeur et destinataire
        $mail->setFrom('nessrinehazzar000@gmail.com', 'Subcontractors');
        $mail->addAddress($destinataire, $nom );

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Alerte Document !';
        $mail->Body    = "<p>Bonjour $nom,</p>
                          <p>Votre document <strong>$doc</strong> arrive en fin de validité en :<strong>$date</strong>.</p>";
        $mail->AltBody = "Bonjour $nom, Votre document $doc arrive en fin de validité en : $date .";

        $mail->send();
    } catch (Exception $e) {
        error_log("Erreur d'envoi de mail: {$mail->ErrorInfo}");
    }
}

 ////////////////////// Module Login /////////////////
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
       // $_SESSION['ID'] = $row['id_Utilisateur'];
        $_SESSION['Login'] = $row['login_Utilisateur'];
		$_SESSION['Role'] = $row['role_Utilisateur'];
        if($row['role_Utilisateur'] == "1"){
            $_SESSION['ID'] = $row['id_Utilisateur'];
            $_SESSION['Nom'] = $row['nom_Utilisateur']." ".$row['prenom_Utilisateur'];
        }elseif($row['role_Utilisateur'] == "2"){
            $sql = "SELECT id_Entreprise, nom_Entreprise , email_Entreprise FROM entreprise WHERE email_Entreprise = '$row[login_Utilisateur]'";
            $res = mysqli_query($connexion, $sql);
            $row = mysqli_fetch_assoc($res);
            $_SESSION['ID'] = $row['id_Entreprise'];
            $_SESSION['Nom'] = $row['nom_Entreprise'];
            $_SESSION['Email']= $row['email_Entreprise'];
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Méthode incorrecte']);
    }
}

////////////////////// Module Compte /////////////////

function update_etat_compte(){
    global $connexion;
    $id = $_POST['id'];
    $status = $_POST['status'];

   echo $sql = "UPDATE utilisateur SET etat_Utilisateur='$status' WHERE id_Utilisateur='$id'";
    $result = $connexion->query($sql);
    echo message(__FUNCTION__, $result);  
}
 
function ajouter_compte(){
    global $connexion;
    $date_courrant=date('Y-m-d H:i:s');
    $login = ($_POST['login']);
    $mdp = md5($_POST['mdp']);
    $nom = ($_POST['nom']);
    $prenom = ($_POST['prenom']);
    $email = ($_POST['email']);
    $telephone = ($_POST['telephone']);
    $adresse = ($_POST['adresse']);
    $sql_login = "SELECT * FROM utilisateur WHERE etat_Utilisateur = '1'";
    $result_login = $connexion->query($sql_login);
    if ($result_login->num_rows > 0) {
        while($row = $result_login->fetch_assoc()) {
            if ($login == $row['login_Utilisateur']) {
                echo "login_exist";
                exit;
            }else{
                $sql = "INSERT INTO utilisateur (login_Utilisateur , mdp_Utilisateur,nom_Utilisateur, prenom_Utilisateur, email_Utilisateur, telephone_Utilisateur, adresse_Utilisateur, role_Utilisateur, date_created_Utilisateur, etat_Utilisateur) 
                VALUES ('$login','$mdp','$nom', '$prenom', '$email', '$telephone', '$adresse','1', '$date_courrant', '1')";
                $result = $connexion->query($sql);
                if ($result) {
                    envoyer_mail($email, "$prenom $nom", $login, $_POST['mdp']);
                }
                echo message(__FUNCTION__, $result);
            }
        }
        
    }
}

/////////////////////// Module Profile /////////////////////////
function update_profile(){
    global $connexion;
    $date_courrant=date('Y-m-d H:i:s');
    $ID = $_SESSION['ID'];
    $role = $_SESSION['Role'];
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
if ($role == "1") {
    $sql=" UPDATE utilisateur SET nom_Utilisateur='$nom' ,prenom_Utilisateur='$prenom' ,email_Utilisateur='$email' ,telephone_Utilisateur='$telephone' ,adresse_Utilisateur='$adresse' ,mdp_Utilisateur='$ancien_mdp' , date_updated_Utilisateur='$date_courrant' WHERE id_utilisateur='$ID' ";
}elseif ($role == "2") {
    $sql=" UPDATE utilisateur,entreprise SET nom_Utilisateur='$nom',prenom_Utilisateur='$prenom' ,email_Utilisateur='$email' ,telephone_Utilisateur='$telephone' ,adresse_Utilisateur='$adresse' WHERE id_Entreprise='$ID' and login_Utilisateur=email_Entreprise ";
}
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
    $nom= $_SESSION['Nom'];
    $role= $_SESSION['Role'];
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

        $newFileName = $nom . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            if($role == "1"){
            $sql = "UPDATE utilisateur SET image_Utilisateur = '$newFileName' WHERE id_Utilisateur ='$ID'";
            }elseif($role == "2"){
            $sql = "UPDATE entreprise, utilisateur SET image_Utilisateur = '$newFileName' WHERE id_Entreprise ='$ID' and utilisateur.login_Utilisateur = entreprise.email_Entreprise";
            }
    $result = $connexion->query($sql);
        } else {
            echo "<div class='text-echec'>Erreur lors du téléchargement du fichier $fileInput.</div>";
            return null;
        }
    }
}



///////////////////////////// Module Salarie ////////////////////////////

function display_salarie(){
    global $connexion;
    $id = $_SESSION['ID'];
    $role = $_SESSION['Role'];
    $value = '<table id="listeSalarie" class="table-salarie">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de naissance</th>
        <th>Nationalité</th>
        <th>Poste</th>
        <th>Type Mission</th>
        <th>Documents</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if($role =="1"){
    $sql = "SELECT id_Salarie,nom_Salarie, prenom_Salarie, dateNaissance_Salarie, nationalite_Salarie, poste_Salarie, typeMission_Salarie FROM salarie WHERE etat_Salarie = '1' and idEntreprise_Salarie='0'";
    }elseif($role =="2"){
    $sql = "SELECT id_Salarie,nom_Salarie, prenom_Salarie, dateNaissance_Salarie, nationalite_Salarie, poste_Salarie, typeMission_Salarie FROM salarie WHERE etat_Salarie = '1' and idEntreprise_Salarie='$id'";
    }
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
    $id = $_SESSION['ID'];
    $role = $_SESSION['Role'];
    $nomS = $_SESSION['Nom'];
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
                    
    $sql_salarie= "SELECT COUNT(*) AS count FROM salarie WHERE nom_Salarie = '$nom' AND prenom_Salarie = '$prenom' AND dateNaissance_Salarie = '$dateNaissance' AND etat_Salarie = '1'";
    $result_salarie = $connexion->query($sql_salarie);
    $row = $result_salarie->fetch_assoc();

    if ($row['count'] > 0) {
        echo "salarie_exist";
        exit;
    } else {
        if($role == "1"){$idEntreprise = 0;} 
        elseif($role == "2") {$idEntreprise = $id;}
        $sql = "INSERT INTO salarie (idEntreprise_Salarie, nom_Salarie, prenom_Salarie, dateNaissance_Salarie, nationalite_Salarie, poste_Salarie, typeMission_Salarie, date_created_Salarie, etat_Salarie, pieceIdentite_Salarie, dpae_Salarie, permit_Salarie, certificatA1_Salarie, certificatZoll_Salarie, photo_Salarie) 
        VALUES ('$idEntreprise', '$nom', '$prenom', '$dateNaissance', '$nationalite', '$poste', '$typeMission', '$date_courrant', '$etat', '$pieceIdentite', '$dpae', '$permit', '$certificatA1', '$certificatZoll', '$photo')";
    }
    // Notification
    $sql_notif="INSERT INTO notifications (idEntreprise_Notification, type_Notification, message_Notification, date_created_Notification, etat_Notification) 
    VALUES ('0', 'Ajout salarie', '$nomS a ajouter un nouveau salarie : $nom $prenom .', '$date_courrant', '0')";
    $result_notif = $connexion->query($sql_notif);

    $result = $connexion->query($sql);
    if ($result) {
        echo message(__FUNCTION__, $result);
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
    $nomS = $_SESSION['Nom'];
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
    // Notification
    $sql_notif="INSERT INTO notifications (idEntreprise_Notification, type_Notification, message_Notification, date_created_Notification, etat_Notification) 
    VALUES ('0', 'Modification information salarie', '$nomS a modifier les informations du $nom $prenom .', '$date_courrant', '0')";
    $result_notif = $connexion->query($sql_notif);
    echo message(__FUNCTION__, $result);  
}

function supprimer_salarie(){
    global $connexion;
    $nom= $_SESSION['Nom'];
    $SalarieID = $_POST['SalarieID'];
    $date_courrant=date('Y-m-d H:i:s');
    $etat="0";
    $sql = "UPDATE salarie SET etat_Salarie = '$etat',date_updated_Salarie = '$date_courrant' WHERE id_Salarie = '$SalarieID'";
    $result = $connexion->query($sql);
    // Notification
    $sql_notif="INSERT INTO notifications (idEntreprise_Notification, type_Notification, message_Notification, date_created_Notification, etat_Notification) 
    VALUES ('0', 'Suppression salarie', '$nom a supprimer un salarie .', '$date_courrant', '0')";
    $result_notif = $connexion->query($sql_notif);
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

function update_document(){
    global $connexion;
    $ID = $_POST['SalarieID'];
    $date_courrant = date('Y-m-d H:i:s');

    $file = $_FILES['document'];
    $type_document = $_POST['type_document'];
    switch ($type_document) {
        case 'pieceIdentite_Salarie':
            $prefix = 'pieceIdentite';
            break;
        case 'dpae_Salarie':
            $prefix = 'dpae';
            break;
        case 'photo_Salarie':
            $prefix = 'photo';
            break;
        case 'permit_Salarie':
            $prefix = 'permit';
            break;
        case 'certificatA1_Salarie':
            $prefix = 'certificatA1';
            break;
        case 'certificatZoll_Salarie':
            $prefix = 'certificatZoll';
            break;
        default:
            echo "<div class='text-echec'>Type de document non valide.</div>";
            return;
    }

    $uploadDir = '../view/file/';
    $allowedPdfTypes = ['pdf'];
    $allowedImageTypes = ['jpg', 'jpeg', 'png'];

    $query = "SELECT nom_Salarie, prenom_Salarie FROM salarie WHERE id_Salarie = '$ID'";
    $result = mysqli_query($connexion, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nom = $row['nom_Salarie'];
        $prenom = $row['prenom_Salarie'];

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
        $allowedTypes = in_array($type_document, ['photo_Salarie']) ? $allowedImageTypes : $allowedPdfTypes;
        $newFileName = uploadFile('document', $prefix, $nom, $prenom, $uploadDir, $allowedTypes);
        if ($newFileName) {
            $sql = "UPDATE salarie 
                    SET $type_document = '$newFileName', date_updated_Salarie = '$date_courrant' 
                    WHERE id_Salarie = '$ID'";
            $result = $connexion->query($sql);
            echo message(__FUNCTION__, $result);
        }
    } else {
        echo "<div class='text-echec'>L'employé avec l'ID '$ID' n'a pas été trouvé.</div>";
    }
}
/////////////// Module Sous-traitant ///////////////
function display_sousTraitant(){
    global $connexion;
    $value = '<table id="listeSousTraitant" class="table-salarie">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Nom Gérant</th>
        <th>Adresse</th>
        <th>Pays</th>
        <th>Siret</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Iban</th>
        <th>Type Mission</th>
        <th>Chef Projet</th>
        <th>Documents</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>';

    $sql = "SELECT id_Entreprise,nom_Entreprise, nomGerant_Entreprise, prenomGerant_Entreprise, adresse_Entreprise, pays_Entreprise, siret_Entreprise, email_Entreprise, telephone_Entreprise, iban_Entreprise, typesMission_Entreprise, chefProjet_Entreprise FROM entreprise WHERE etat_Entreprise = '1'";
    $result = mysqli_query($connexion,$sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nom=$row['nomGerant_Entreprise'] . " " . $row['prenomGerant_Entreprise'];
            $missionClass = ($row['typesMission_Entreprise'] == 'Européenne') ? 'mission mission-europeenne' : 'mission';
            $value .= "<tr>
            <td>" . $row['nom_Entreprise'] . "</td>
            <td>" . $nom . "</td>
            <td>" . $row['adresse_Entreprise'] . "</td>
            <td>" . $row['pays_Entreprise'] . "</td>
            <td>" . $row['siret_Entreprise'] . "</td>
            <td>" . $row['email_Entreprise'] . "</td>
            <td>" . $row['telephone_Entreprise'] . "</td>
            <td>" . $row['iban_Entreprise'] . "</td>
            <td> <div class='$missionClass'>" . $row['typesMission_Entreprise'] . "</div></td>
            <td><button type='button' class='icon-button' id='btn_chefProjet_soustraitant' data-chefProjet='" . $row['chefProjet_Entreprise'] . "' data-id='" . $row['id_Entreprise'] . "'><img src='../img/view.png'/></button></td>
            <td><a href='document_soustraitant.php?id=" . $row['id_Entreprise'] . "'>
                <button type='button' class='icon-button' id='btn_document_soustraitant' data-document='" . $row['id_Entreprise'] . "'><img src='../img/view.png'/></button>
            </a></td>
            <td>
                    <center>
                        <button type='button' class='modifier' id='btn_modif_soustraitant' data-id='" . $row['id_Entreprise'] . "'>Modifier</button>
                        <button type='button' class='supprimer' id='btn_supprime_soustraitant' data-id1='" . $row['id_Entreprise'] . "'>Supprimer</button>
                    </center>
                </td>
            </tr>";            
        }
    } 
    $value .= "</tbody></table>";
    echo json_encode(['status' => 'success', 'html' => $value]);
}

function ajouter_soustraitant(){
    global $connexion;
    $nom = $_POST['nom'];
    $nomGerant = $_POST['nomGerant'];
    $prenomGerant = $_POST['prenomGerant'];
    $adresse = $_POST['adresse'];
    $pays = $_POST['pays'];
    $siret = $_POST['siret'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $iban = $_POST['iban'];
    $typesMission = $_POST['typesMission'];
    $chefProjet = $_POST['chefProjet'];
    $date_courrant = date('Y-m-d H:i:s');
    $etat = '1';
    $sql_soustraitant="SELECT COUNT(*) AS count FROM entreprise WHERE etat_Entreprise = '1' and nom_Entreprise='$nom'";
    $result_soustraitant = $connexion->query($sql_soustraitant);
    $row = $result_soustraitant->fetch_assoc();
    if ($row['count'] > 0) {
        echo "soustraitant_exist";
        exit();
    }else {
        $sql = "INSERT INTO entreprise (nom_Entreprise, nomGerant_Entreprise, prenomGerant_Entreprise, adresse_Entreprise, pays_Entreprise, siret_Entreprise, email_Entreprise, telephone_Entreprise, iban_Entreprise, typesMission_Entreprise, chefProjet_Entreprise, etat_Entreprise, date_created_Entreprise) 
        VALUES ('$nom', '$nomGerant', '$prenomGerant', '$adresse', '$pays', '$siret', '$email', '$telephone', '$iban', '$typesMission', '$chefProjet','$etat', '$date_courrant')";
        $mdp=md5($siret);
        $result = $connexion->query($sql);

        $sql1 = "INSERT INTO utilisateur (login_Utilisateur, mdp_Utilisateur, nom_Utilisateur, prenom_Utilisateur, email_Utilisateur, telephone_Utilisateur, adresse_Utilisateur, image_Utilisateur, role_Utilisateur, etat_Utilisateur, date_created_Utilisateur) 
        VALUES ('$email', '$mdp', '$nomGerant', '$prenomGerant', '$email', '$telephone', '$adresse', 'soustraitant.jpg', '2', '$etat', '$date_courrant')";
        $result1 = $connexion->query($sql1);
            
        echo message(__FUNCTION__, $result); 
    }
}

function get_soustraitant(){
    global $connexion;
    $ID = $_POST['ID'];
    $sql = "SELECT * FROM entreprise WHERE id_Entreprise = '$ID'";
    $result = mysqli_query($connexion,$sql);
    $row = mysqli_fetch_assoc($result);
    $id_chefProjet=$row['chefProjet_Entreprise'];
    $sql2= "SELECT nom_Salarie ,prenom_Salarie FROM salarie WHERE id_Salarie='$id_chefProjet'";
    $result2 = mysqli_query($connexion,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $nom_chef=$row2['nom_Salarie'];
    $prenom_chef=$row2['prenom_Salarie'];
    $chefProjet=  $nom_chef . " " . $prenom_chef ;

    $soustraitant_data = [];
    $soustraitant_data[0] = $row['id_Entreprise'];
    $soustraitant_data[1] = $row['nom_Entreprise'];
    $soustraitant_data[2] = $row['nomGerant_Entreprise'];
    $soustraitant_data[3] = $row['prenomGerant_Entreprise'];
    $soustraitant_data[4] = $row['adresse_Entreprise'];
    $soustraitant_data[5] = $row['pays_Entreprise'];
    $soustraitant_data[6] = $row['siret_Entreprise'];
    $soustraitant_data[7] = $row['email_Entreprise'];
    $soustraitant_data[8] = $row['telephone_Entreprise'];
    $soustraitant_data[9] = $row['iban_Entreprise'];
    $soustraitant_data[10] = $row['typesMission_Entreprise'];
    $soustraitant_data[11] = $chefProjet;
    echo json_encode($soustraitant_data);
}

function update_soustraitant(){
    global $connexion;
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $nomGerant = $_POST['nomGerant'];
    $prenomGerant = $_POST['prenomGerant'];
    $adresse = $_POST['adresse'];
    $pays = $_POST['pays'];
    $siret = $_POST['siret'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $iban = $_POST['iban'];
    $typesMission = $_POST['typesMission'];
    $chefProjet = $_POST['chefProjet'];
    $date_courant = date('Y-m-d H:i:s');

    $sql = "UPDATE entreprise 
            SET nom_Entreprise = '$nom', nomGerant_Entreprise = '$nomGerant', prenomGerant_Entreprise = '$prenomGerant', adresse_Entreprise = '$adresse', pays_Entreprise = '$pays', 
                siret_Entreprise = '$siret', email_Entreprise = '$email', telephone_Entreprise = '$telephone', iban_Entreprise = '$iban', 
                typesMission_Entreprise = '$typesMission', chefProjet_Entreprise = '$chefProjet', date_updated_Entreprise = '$date_courant' 
            WHERE id_Entreprise = '$id'";

    $result = $connexion->query($sql);
    echo message(__FUNCTION__, $result);
}

function supprimer_soustraitant(){
    global $connexion;
    $ID = $_POST['ID'];
    $date_courrant=date('Y-m-d H:i:s');
    $etat = '0';
    $sql = "UPDATE entreprise SET etat_Entreprise = '$etat' ,date_updated_Entreprise='$date_courrant' WHERE id_Entreprise = '$ID'";
    $result = $connexion->query($sql);
    echo message(__FUNCTION__, $result);
}

function get_soustraitant_chefProjet(){
    global $connexion;
    $ID= $_POST['ID'];
    $ID_chefProjet = $_POST['ID_chefProjet'];
    $sql = "SELECT nom_Salarie , prenom_Salarie , dateNaissance_Salarie , nationalite_Salarie , poste_Salarie FROM salarie WHERE id_Salarie  = '$ID_chefProjet'";
    $result = mysqli_query($connexion,$sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $soustraitant_chefProjet_data = [];
        $soustraitant_chefProjet_data[0] = $row['nom_Salarie'];
        $soustraitant_chefProjet_data[1] = $row['prenom_Salarie'];
        $soustraitant_chefProjet_data[2] = $row['dateNaissance_Salarie'];
        $soustraitant_chefProjet_data[3] = $row['nationalite_Salarie'];
    }
    echo json_encode($soustraitant_chefProjet_data); 
}


function get_documentSoustraitant(){
    global $connexion;
    $ID = $_POST['ID'];
    $query = "SELECT * FROM document_entreprise WHERE idEntreprise_DocumentEntreprise= '$ID' AND etat_DocumentEntreprise='1'";
    $result = mysqli_query($connexion, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $document_data = [];
        $document_data[0] = $row['id_DocumentEntreprise'];
        $document_data[1] = $row['idEntreprise_DocumentEntreprise'];
        $document_data[2] = $row['kbis_DocumentEntreprise'];
        $document_data[3] = $row['dateValiditeKbis_DocumentEntreprise'];
        $document_data[4] = $row['pieceIdentitieGerant_DocumentEntreprise'];
        $document_data[5] = $row['dateValiditePIGerant_DocumentEntreprise'];
        $document_data[6] = $row['attestationRegulariteFiscale_DocumentEntreprise'];
        $document_data[7] = $row['dateValiditeAttestRegulariteFiscale_DocumentEntreprise'];
        $document_data[8] = $row['attestationURSSAF_DocumentEntreprise'];
        $document_data[9] = $row['dateValiditeAttestURSSAF_DocumentEntreprise'];
        $document_data[10] = $row['assuranceRcPro_DocumentEntreprise'];
        $document_data[11] = $row['dateValiditeAssuranceRcPro_DocumentEntreprise'];
        $document_data[12] = $row['siret_DocumentEntreprise'];
        $document_data[13] = $row['dateValiditeSiret_DocumentEntreprise'];
        $document_data[14] = $row['caisseBTP_DocumentEntreprise'];
        $document_data[15] = $row['dateValiditeCaisseBTP_DocumentEntreprise'];
        $document_data[16] = $row['numeroFiscal_DocumentEntreprise'];
        $document_data[17] = $row['dateValiditeNumFiscal_DocumentEntreprise'];
        $document_data[18] = $row['numeroTVA_DocumentEntreprise'];
        $document_data[19] = $row['dateValiditeNumTVA_DocumentEntreprise'];
        $document_data[20] = $row['assurenceDecennale_DocumentEntreprise'];
        $document_data[21] = $row['dateValiditeAssurenceDecennale_DocumentEntreprise'];
   
    }
    echo json_encode($document_data);
}

function ajouter_documentSoustraitant(){

    global $connexion;
    $entreprise_id = $_POST['ID'];
    $sql1 = "SELECT nom_Entreprise FROM entreprise WHERE id_Entreprise = '$entreprise_id'";
    $result1 = mysqli_query($connexion,$sql1);
    $row = mysqli_fetch_assoc($result1);
    $nom= $row['nom_Entreprise'];
    $date_courant = date('Y-m-d H:i:s');
    $folderPath = "../view/file/" . $entreprise_id . "/";
    if (!is_dir($folderPath)) {
        mkdir($folderPath, 0777, true);
    }
    function uploadDocument($fieldName, $docType, $folderPath, $nom) {
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == 0) {
            $extension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
            $nomClean = str_replace(' ', '', $nom);
            $newFileName = $docType . "_DocumentEntreprise_" . $nomClean . ($extension ? "." . $extension : "");
            $targetFile = $folderPath . $newFileName;
            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetFile)) {
                return $newFileName;
            }
        }
        return "";
    }
    
    $kbis_Document = uploadDocument('kbis', 'kbis', $folderPath, $nom);
    $pieceIdentitieGerant_Document = uploadDocument('pieceIdentitieGerant', 'pieceIdentitieGerant', $folderPath, $nom);
    $attestationRegulariteFiscale_Document = uploadDocument('attestationRegulariteFiscale', 'attestationRegulariteFiscale', $folderPath, $nom);
    $attestationURSSAF_Document = uploadDocument('attestationURSSAF', 'attestationURSSAF', $folderPath, $nom);
    $assuranceRcPro_Document = uploadDocument('assuranceRcPro', 'assuranceRcPro', $folderPath, $nom);
    $siret_Document = uploadDocument('siret', 'siret', $folderPath, $nom);
    $caisseBTP_Document = uploadDocument('caisseBTP', 'caisseBTP', $folderPath, $nom);
    $numeroFiscal_Document = uploadDocument('numeroFiscal', 'numeroFiscal', $folderPath, $nom);
    $numeroTVA_Document = uploadDocument('numeroTVA', 'numeroTVA', $folderPath, $nom);
    $assurenceDecennale_Document = uploadDocument('assurenceDecennale', 'assurenceDecennale', $folderPath, $nom);

    $dateValiditeKbis = isset($_POST['dateValiditeKbis']) ? $_POST['dateValiditeKbis'] : null;
    $dateValiditePIGerant = isset($_POST['dateValiditePIGerant']) ? $_POST['dateValiditePIGerant'] : null;
    $dateValiditeAttestRegulariteFiscale = isset($_POST['dateValiditeAttestRegulariteFiscale']) ? $_POST['dateValiditeAttestRegulariteFiscale'] : null;
    $dateValiditeAttestURSSAF = isset($_POST['dateValiditeAttestURSSAF']) ? $_POST['dateValiditeAttestURSSAF'] : null;
    $dateValiditeAssuranceRcPro = isset($_POST['dateValiditeAssuranceRcPro']) ? $_POST['dateValiditeAssuranceRcPro'] : null;
    $dateValiditeSiret = isset($_POST['dateValiditeSiret']) ? $_POST['dateValiditeSiret'] : null;
    $dateValiditeCaisseBTP = isset($_POST['dateValiditeCaisseBTP']) ? $_POST['dateValiditeCaisseBTP'] : null;
    $dateValiditeNumFiscal = isset($_POST['dateValiditeNumFiscal']) ? $_POST['dateValiditeNumFiscal'] : null;
    $dateValiditeNumTVA = isset($_POST['dateValiditeNumTVA']) ? $_POST['dateValiditeNumTVA'] : null;
    $dateValiditeAssurenceDecennale = isset($_POST['dateValiditeAssurenceDecennale']) ? $_POST['dateValiditeAssurenceDecennale'] : null;
    
    $sql = "INSERT INTO document_entreprise (
        idEntreprise_DocumentEntreprise,
        kbis_DocumentEntreprise,
        dateValiditeKbis_DocumentEntreprise,
        pieceIdentitieGerant_DocumentEntreprise,
        dateValiditePIGerant_DocumentEntreprise,
        attestationRegulariteFiscale_DocumentEntreprise,
        dateValiditeAttestRegulariteFiscale_DocumentEntreprise,
        attestationURSSAF_DocumentEntreprise,
        dateValiditeAttestURSSAF_DocumentEntreprise,
        assuranceRcPro_DocumentEntreprise,
        dateValiditeAssuranceRcPro_DocumentEntreprise,
        siret_DocumentEntreprise,
        dateValiditeSiret_DocumentEntreprise,
        caisseBTP_DocumentEntreprise,
        dateValiditeCaisseBTP_DocumentEntreprise,
        numeroFiscal_DocumentEntreprise,
        dateValiditeNumFiscal_DocumentEntreprise,
        numeroTVA_DocumentEntreprise,
        dateValiditeNumTVA_DocumentEntreprise,
        assurenceDecennale_DocumentEntreprise,
        dateValiditeAssurenceDecennale_DocumentEntreprise,
        date_created_DocumentEntreprise,
        date_updated_DocumentEntreprise,
        etat_DocumentEntreprise
    ) VALUES (
        '$entreprise_id',
        '$kbis_Document',
        '$dateValiditeKbis',
        '$pieceIdentitieGerant_Document',
        '$dateValiditePIGerant',
        '$attestationRegulariteFiscale_Document',
        '$dateValiditeAttestRegulariteFiscale',
        '$attestationURSSAF_Document',
        '$dateValiditeAttestURSSAF',
        '$assuranceRcPro_Document',
        '$dateValiditeAssuranceRcPro',
        '$siret_Document',
        '$dateValiditeSiret',
        '$caisseBTP_Document',
        '$dateValiditeCaisseBTP',
        '$numeroFiscal_Document',
        '$dateValiditeNumFiscal',
        '$numeroTVA_Document',
        '$dateValiditeNumTVA',
        '$assurenceDecennale_Document',
        '$dateValiditeAssurenceDecennale',
        '$date_courant',
        '$date_courant',
        1
    )";
        
    $result = $connexion->query($sql);
    echo message(__FUNCTION__, $result);
}

////////////////// Module demande /////////////////
function display_demande(){
    global $connexion;
    $role  = $_SESSION['Role'];
    $login = $_SESSION['Login'];

    $value = '<table id="listeDemande" class="table-salarie">
    <thead>
      <tr>
        <th>Gérant</th>
        <th>Société</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Status</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>';
    if($role == "2"){
        $sql="SELECT id_Demande, idEntreprise_Demande, nomGerantEntreprise_Demande, societe_Demande, date_Demande, heure_Demande, status_Demande
        FROM demande
        WHERE idEntreprise_Demande IN (SELECT id_Entreprise FROM entreprise WHERE email_Entreprise = '$login') AND etat_Demande = '1'";
}
    elseif($role == "1"){
        $sql = "SELECT id_Demande, idEntreprise_Demande, nomGerantEntreprise_Demande, societe_Demande, date_Demande, heure_Demande, status_Demande 
                FROM demande 
                WHERE etat_Demande = '1'";
    }
    
    $result = mysqli_query($connexion, $sql);
    if($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['status_Demande'] == 'En Attente' || $row['status_Demande'] == 'En Cours') {
                $statusClass = 'status status_attente';
            } elseif ($row['status_Demande'] == 'Acceptée') {
                $statusClass = 'status status_acceptee';
            } elseif ($row['status_Demande'] == 'Refusée') {
                $statusClass = 'status status_refusee';
            } else {
                $statusClass = 'status';
            }
            
            $value .= "<tr>
                <td>" . $row['nomGerantEntreprise_Demande'] . "</td>
                <td>" . $row['societe_Demande'] . "</td>
                <td>" . $row['date_Demande'] . "</td>
                <td>" . $row['heure_Demande'] . "</td>
                <td><div class='$statusClass'>" . $row['status_Demande'] . "</div></td>
                <td>
                    <center>";
    
            if($role == "1" || ($role == "2" && $row['status_Demande'] != "En Attente")) {
                $value .= "<a href='document_demande.php?id=" . $row['id_Demande'] . "'>
                    <button type='button' class='icon-button' id='btn_info_demande' data-demande='" . $row['id_Demande'] . "' data-id='" . $row['idEntreprise_Demande'] . "'>
                        <img src='../img/view.png' />
                    </button>
                </a>";
            }
    
            if($role == "2" && $row['status_Demande'] == "En Attente") {
                $value .= "<button type='button' class='supprimer' id='btn_supprime_demande' data-demande='" . $row['id_Demande'] . "'>
                    Supprimer
                </button>";
            }
    
            $value .= "</center></td></tr>";
        }
    }
    
    $value .= "</tbody></table>";
    echo json_encode(['status' => 'success', 'html' => $value]);
}


function update_status_demande(){
    global $connexion;
    $nom = $_SESSION['Nom'];
    $id = $_POST['ID'];
    $action = $_POST['action'];
    $date_courant = date('Y-m-d H:i:s');
    $sql_id = "SELECT idEntreprise_Demande FROM demande WHERE id_Demande = '$id'";
    $result_id = $connexion->query($sql_id);
    $row_id = $result_id->fetch_assoc();
    $idS = $row_id['idEntreprise_Demande'];
    if ($action == "accepter") {
        $sql = "UPDATE demande SET status_Demande='Acceptée',date_updated_Demande='$date_courant' WHERE id_Demande='$id'";
    } elseif ($action == "refuser") {
        $sql = "UPDATE demande SET status_Demande='Refusée',date_updated_Demande='$date_courant' WHERE id_Demande='$id'";
    }
    $result = $connexion->query($sql);
// Notification 
    $sql_notif="INSERT INTO notifications (idEntreprise_Notification, type_Notification, message_Notification, date_created_Notification, etat_Notification) 
    VALUES ('$idS', 'Etat Demande', 'Votre demande a été $action .', '$date_courant', '0')";
    $result_notif = $connexion->query($sql_notif);

    if ($connexion->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $connexion->error]);
    }}

function ajouter_demande(){
    global $connexion;
    $id = $_SESSION['ID'];
    $date_courant = date('Y-m-d H:i:s');
    $sql1 = "SELECT id_Entreprise ,nom_Entreprise ,nomGerant_Entreprise,prenomGerant_Entreprise FROM entreprise WHERE id_Entreprise = '$id'";
    $result1 = mysqli_query($connexion,$sql1);
    $row = mysqli_fetch_assoc($result1);
    $idEntreprise = $row['id_Entreprise'];
    $nomGerant = $row['nomGerant_Entreprise'] . " " . $row['prenomGerant_Entreprise'];
    $nom= $row['nom_Entreprise'];

    $sql = "INSERT INTO demande (idEntreprise_Demande,nomGerantEntreprise_Demande, societe_Demande, date_Demande, heure_Demande, status_Demande, etat_Demande, date_created_Demande ,date_updated_Demande) 
    VALUES ('$idEntreprise','$nomGerant','$nom', CURDATE(), CURTIME(), 'En Attente', 1, '$date_courant' ,'$date_courant')";
    $result = $connexion->query($sql);
    if (!$result) {
        echo message(__FUNCTION__, false);
        exit;
    }
    // Notification
    $sql_notif="INSERT INTO notifications (idEntreprise_Notification, type_Notification, message_Notification, date_created_Notification, etat_Notification) 
    VALUES ('0', 'Neveaulle Demande', 'Vous avez une nouvelle demande de $nom .', '$date_courant', '0')";
    $result_notif = $connexion->query($sql_notif);

    $demande_id = mysqli_insert_id($connexion);
    $folderPath = "../view/file/" . $demande_id . "/";
    if (!is_dir($folderPath)) {
        mkdir($folderPath, 0777, true);
    }
    function uploadDocument($fieldName, $docType, $folderPath, $nom) {
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == 0) {
            $extension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
            $nomClean = str_replace(' ', '', $nom);
            $newFileName = $docType . "_DocumentDemande_" . $nomClean . ($extension ? "." . $extension : "");
            $targetFile = $folderPath . $newFileName;
            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetFile)) {
                return $newFileName;
            }
        }
        return "";
    }
    
    $kbis_Document = uploadDocument('kbis', 'kbis', $folderPath, $nom);
    $pieceIdentitieGerant_Document = uploadDocument('pieceIdentitieGerant', 'pieceIdentitieGerant', $folderPath, $nom);
    $attestationRegulariteFiscale_Document = uploadDocument('attestationRegulariteFiscale', 'attestationRegulariteFiscale', $folderPath, $nom);
    $attestationURSSAF_Document = uploadDocument('attestationURSSAF', 'attestationURSSAF', $folderPath, $nom);
    $assuranceRcPro_Document = uploadDocument('assuranceRcPro', 'assuranceRcPro', $folderPath, $nom);
    $siret_Document = uploadDocument('siret', 'siret', $folderPath, $nom);
    $caisseBTP_Document = uploadDocument('caisseBTP', 'caisseBTP', $folderPath, $nom);
    $numeroFiscal_Document = uploadDocument('numeroFiscal', 'numeroFiscal', $folderPath, $nom);
    $numeroTVA_Document = uploadDocument('numeroTVA', 'numeroTVA', $folderPath, $nom);
    $assurenceDecennale_Document = uploadDocument('assurenceDecennale', 'assurenceDecennale', $folderPath, $nom);

    $dateValiditeKbis = isset($_POST['dateValiditeKbis']) ? $_POST['dateValiditeKbis'] : null;
    $dateValiditePIGerant = isset($_POST['dateValiditePIGerant']) ? $_POST['dateValiditePIGerant'] : null;
    $dateValiditeAttestRegulariteFiscale = isset($_POST['dateValiditeAttestRegulariteFiscale']) ? $_POST['dateValiditeAttestRegulariteFiscale'] : null;
    $dateValiditeAttestURSSAF = isset($_POST['dateValiditeAttestURSSAF']) ? $_POST['dateValiditeAttestURSSAF'] : null;
    $dateValiditeAssuranceRcPro = isset($_POST['dateValiditeAssuranceRcPro']) ? $_POST['dateValiditeAssuranceRcPro'] : null;
    $dateValiditeSiret = isset($_POST['dateValiditeSiret']) ? $_POST['dateValiditeSiret'] : null;
    $dateValiditeCaisseBTP = isset($_POST['dateValiditeCaisseBTP']) ? $_POST['dateValiditeCaisseBTP'] : null;
    $dateValiditeNumFiscal = isset($_POST['dateValiditeNumFiscal']) ? $_POST['dateValiditeNumFiscal'] : null;
    $dateValiditeNumTVA = isset($_POST['dateValiditeNumTVA']) ? $_POST['dateValiditeNumTVA'] : null;
    $dateValiditeAssurenceDecennale = isset($_POST['dateValiditeAssurenceDecennale']) ? $_POST['dateValiditeAssurenceDecennale'] : null;
    
    $sql2 = "INSERT INTO document_demande (
        idDemande_DocumentDemande,
        kbis_DocumentDemande,
        dateValiditeKbis_DocumentDemande,
        pieceIdentitieGerant_DocumentDemande,
        dateValiditePIGerant_DocumentDemande,
        attestationRegulariteFiscale_DocumentDemande,
        dateValiditeAttestRegulariteFiscale_DocumentDemande,
        attestationURSSAF_DocumentDemande,
        dateValiditeAttestURSSAF_DocumentDemande,
        assuranceRcPro_DocumentDemande,
        dateValiditeAssuranceRcPro_DocumentDemande,
        siret_DocumentDemande,
        dateValiditeSiret_DocumentDemande,
        caisseBTP_DocumentDemande,
        dateValiditeCaisseBTP_DocumentDemande,
        numeroFiscal_DocumentDemande,
        dateValiditeNumFiscal_DocumentDemande,
        numeroTVA_DocumentDemande,
        dateValiditeNumTVA_DocumentDemande,
        assurenceDecennale_DocumentDemande,
        dateValiditeAssurenceDecennale_DocumentDemande,
        date_created_DocumentDemande,
        date_updated_DocumentDemande,
        etat_DocumentDemande
    ) VALUES (
        '$demande_id',
        '$kbis_Document',
        '$dateValiditeKbis',
        '$pieceIdentitieGerant_Document',
        '$dateValiditePIGerant',
        '$attestationRegulariteFiscale_Document',
        '$dateValiditeAttestRegulariteFiscale',
        '$attestationURSSAF_Document',
        '$dateValiditeAttestURSSAF',
        '$assuranceRcPro_Document',
        '$dateValiditeAssuranceRcPro',
        '$siret_Document',
        '$dateValiditeSiret',
        '$caisseBTP_Document',
        '$dateValiditeCaisseBTP',
        '$numeroFiscal_Document',
        '$dateValiditeNumFiscal',
        '$numeroTVA_Document',
        '$dateValiditeNumTVA',
        '$assurenceDecennale_Document',
        '$dateValiditeAssurenceDecennale',
        '$date_courant',
        '$date_courant',
        1
    )";
        
    $result2 = $connexion->query($sql2);
    echo message(__FUNCTION__, $result2);
}

function supprimer_demande() {
    global $connexion;
    $id = $_POST['ID'];
    $date_courant = date('Y-m-d H:i:s');
    $sql2="SELECT status_Demande FROM demande  WHERE id_Demande = '$id'";
    $result2 = mysqli_query($connexion,$sql2);
    $row = mysqli_fetch_assoc($result2);
    if ($row['status_Demande'] != 'En Attente') {
        echo message(__FUNCTION__, false);
    }else {
        $sql = "UPDATE demande SET etat_Demande='0' , date_updated_Demande='$date_courant' WHERE id_Demande='$id'";
        $result = $connexion->query($sql);
        echo message(__FUNCTION__, $result);
    }
}

////////////////// Module dashboard //////////////////
function display_demande_dashboard(){
    global $connexion;
    $role = $_SESSION['Role']; 
    $id   = $_SESSION['ID']; 
    if($role == "1"){
        $value = '<table id="listeDemandeDashboard" class="table-salarie">
            <thead>
              <tr>
                <th>Gérant</th>
                <th>Société</th>
                <th>Date</th>
                <th>Heure</th>
                <th><center>View</center></th>
              </tr>
            </thead>
            <tbody>';
    
        $sql = "SELECT id_Demande, idEntreprise_Demande, nomGerantEntreprise_Demande, societe_Demande, date_Demande, heure_Demande, status_Demande 
                FROM demande WHERE etat_Demande = '1' ORDER BY date_Demande DESC, heure_Demande DESC LIMIT 3";
        $result = mysqli_query($connexion, $sql);
        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $value .= "<tr style='font-weight: normal;'>
                    <td>" . $row['nomGerantEntreprise_Demande'] . "</td>
                    <td>" . $row['societe_Demande'] . "</td>
                    <td>" . $row['date_Demande'] . "</td>
                    <td>" . $row['heure_Demande'] . "</td>
                    <td>
                        <a href='document_demande.php?id=" . $row['id_Demande'] . "'>
                            <button type='button' class='icon-button' id='btn_info_demande' data-demande='" . $row['id_Demande'] . "' data-id='" . $row['idEntreprise_Demande'] . "'>
                                <img src='../img/view.png'/>
                            </button>
                        </a>
                    </td>
                </tr>";
            }
            $value .= "</tbody></table>";
        }else {
            $value .= "<tr><td colspan='5'><center>Aucun drmande pour le moment</center></td></tr>";
        }
    } elseif($role == "2"){
        $value = '<table id="listeDemandeDashboard" class="table-salarie">
            <thead>
              <tr>
                <th>Gérant</th>
                <th>Société</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>';
        
        $sql = "SELECT id_Demande, idEntreprise_Demande, nomGerantEntreprise_Demande, societe_Demande, date_Demande, heure_Demande, status_Demande 
                FROM demande WHERE etat_Demande = '1' AND idEntreprise_Demande = '$id' ORDER BY date_Demande DESC, heure_Demande DESC LIMIT 3";
        $result = mysqli_query($connexion, $sql);
        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if ($row['status_Demande'] == 'En Attente' || $row['status_Demande'] == 'En Cours') {
                    $statusClass = 'status status_attente';
                } elseif ($row['status_Demande'] == 'Acceptée') {
                    $statusClass = 'status status_acceptee';
                } elseif ($row['status_Demande'] == 'Refusée') {
                    $statusClass = 'status status_refusee';
                } else {
                    $statusClass = 'status';
                }
                $value .= "<tr style='font-weight: normal;'>
                    <td>" . $row['nomGerantEntreprise_Demande'] . "</td>
                    <td>" . $row['societe_Demande'] . "</td>
                    <td>" . $row['date_Demande'] . "</td>
                    <td>" . $row['heure_Demande'] . "</td>
                    <td><div class='$statusClass'>" . $row['status_Demande'] . "</div></td>
                </tr>";
            }
            $value .= "</tbody></table>";
        }else {
            $value .= "<tr><td colspan='5'><center>Aucun drmande pour le moment</center></td></tr>";
        }
    }
    echo json_encode(['status' => 'success', 'html' => $value]);
}


function display_document_dashboard(){
    global $connexion;
    $role = $_SESSION['Role'];
    $id = $_SESSION['ID'];
    $value = '<table id="listeDocumentDashboard" class="table-salarie">
    <thead>
      <tr>
        <th>Nom de Document</th>
        <th>Société</th>
        <th>Date de validité</th>
        <th><center>Action</center></th>
      </tr>
    </thead>
    <tbody>';
    
    $unionQuery = "(
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'KBIS' AS document_type, kbis_DocumentEntreprise AS document_name, dateValiditeKbis_DocumentEntreprise AS validite, 'dateValiditeKbis_DocumentEntreprise' AS validity_field, 'notifKbis_DocumentEntreprise' AS nomchampNotif, notifKbis_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1' 
        AND dateValiditeKbis_DocumentEntreprise != '0000-00-00' 
        AND dateValiditeKbis_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'PI Gérant' AS document_type, pieceIdentitieGerant_DocumentEntreprise AS document_name, dateValiditePIGerant_DocumentEntreprise AS validite, 'dateValiditePIGerant_DocumentEntreprise' AS validity_field, 'notifPIGerant_DocumentEntreprise' AS nomchampNotif, notifPIGerant_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1' 
        AND dateValiditePIGerant_DocumentEntreprise != '0000-00-00' 
        AND dateValiditePIGerant_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Attestation Fiscale' AS document_type, attestationRegulariteFiscale_DocumentEntreprise AS document_name, dateValiditeAttestRegulariteFiscale_DocumentEntreprise AS validite, 'dateValiditeAttestRegulariteFiscale_DocumentEntreprise' AS validity_field, 'notifPIGerant_DocumentEntreprise' AS nomchampNotif, notifPIGerant_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1' 
        AND dateValiditeAttestRegulariteFiscale_DocumentEntreprise != '0000-00-00' 
        AND dateValiditeAttestRegulariteFiscale_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Attestation URSSAF' AS document_type, attestationURSSAF_DocumentEntreprise AS document_name, dateValiditeAttestURSSAF_DocumentEntreprise AS validite, 'dateValiditeAttestURSSAF_DocumentEntreprise' AS validity_field, 'notifAttestURSSAF_DocumentEntreprise' AS nomchampNotif, notifAttestURSSAF_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeAttestURSSAF_DocumentEntreprise != '0000-00-00' 
        AND dateValiditeAttestURSSAF_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Assurance RC Pro' AS document_type, assuranceRcPro_DocumentEntreprise AS document_name, dateValiditeAssuranceRcPro_DocumentEntreprise AS validite, 'dateValiditeAssuranceRcPro_DocumentEntreprise' AS validity_field, 'notifAssuranceRcPro_DocumentEntreprise' AS nomchampNotif, notifAssuranceRcPro_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeAssuranceRcPro_DocumentEntreprise != '0000-00-00' 
        AND dateValiditeAssuranceRcPro_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'SIRET' AS document_type, siret_DocumentEntreprise AS document_name, dateValiditeSiret_DocumentEntreprise AS validite, 'dateValiditeSiret_DocumentEntreprise' AS validity_field, 'notifSiret_DocumentEntreprise' AS nomchampNotif, notifSiret_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeSiret_DocumentEntreprise != '0000-00-00' 
        AND dateValiditeSiret_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Caisse BTP' AS document_type, caisseBTP_DocumentEntreprise AS document_name, dateValiditeCaisseBTP_DocumentEntreprise AS validite, 'dateValiditeCaisseBTP_DocumentEntreprise' AS validity_field, 'notifCaisseBTP_DocumentEntreprise' AS nomchampNotif, notifCaisseBTP_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeCaisseBTP_DocumentEntreprise != '0000-00-00'
        AND dateValiditeCaisseBTP_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Numéro Fiscal' AS document_type, numeroFiscal_DocumentEntreprise AS document_name, dateValiditeNumFiscal_DocumentEntreprise AS validite, 'dateValiditeNumFiscal_DocumentEntreprise' AS validity_field, 'notifNumFiscal_DocumentEntreprise' AS nomchampNotif, notifNumFiscal_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeNumFiscal_DocumentEntreprise != '0000-00-00'
        AND dateValiditeNumFiscal_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Numéro TVA' AS document_type, numeroTVA_DocumentEntreprise AS document_name, dateValiditeNumTVA_DocumentEntreprise AS validite, 'dateValiditeNumTVA_DocumentEntreprise' AS validity_field, 'notifNumTVA_DocumentEntreprise' AS nomchampNotif, notifNumTVA_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeNumTVA_DocumentEntreprise != '0000-00-00'
        AND dateValiditeNumTVA_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Assurence Décennale' AS document_type, assurenceDecennale_DocumentEntreprise AS document_name, dateValiditeAssurenceDecennale_DocumentEntreprise AS validite, 'dateValiditeAssurenceDecennale_DocumentEntreprise' AS validity_field, notifAssurenceDecennale_DocumentEntreprise AS notif, 'notifAssurenceDecennale_DocumentEntreprise' AS nomchampNotif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeAssurenceDecennale_DocumentEntreprise != '0000-00-00'
        AND dateValiditeAssurenceDecennale_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )";
    if($role == "2" && !empty($id)){
        $sql = "SELECT docs.*, e.nom_Entreprise
                FROM ( $unionQuery ) docs 
                JOIN entreprise e ON docs.idEntreprise_DocumentEntreprise = e.id_Entreprise
                WHERE docs.idEntreprise_DocumentEntreprise = '$id'
                ORDER BY docs.validite ASC
                LIMIT 6";
    } else {
        $sql = "SELECT docs.*, e.nom_Entreprise
                FROM ( $unionQuery ) docs 
                JOIN entreprise e ON docs.idEntreprise_DocumentEntreprise = e.id_Entreprise
                ORDER BY docs.validite ASC
                LIMIT 6";
    }
    
    $result = mysqli_query($connexion, $sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nomChampDate = $row['validity_field'];
            $notif        = $row['notif'];
            $nomChampNotif= $row['nomchampNotif'];
            
            $sql_email = "SELECT email_Entreprise FROM entreprise WHERE id_Entreprise = '".$row['idEntreprise_DocumentEntreprise']."'";
            $result_email = mysqli_query($connexion, $sql_email);
            $row_email = $result_email ? $result_email->fetch_assoc() : [];
            $email = isset($row_email['email_Entreprise']) ? $row_email['email_Entreprise'] : '';
            
            if ($notif == '0'){
                mail_document('nessrinehazzar000@gmail.com', $row['nom_Entreprise'], $row['document_type'], $row['validite']);
                $sql_notif = "UPDATE document_entreprise SET $nomChampNotif = '1' WHERE id_DocumentEntreprise = '".$row['id_DocumentEntreprise']."'";
                mysqli_query($connexion, $sql_notif);
            }
            
            $value .= "<tr style='font-weight: normal;'>
            <td>" . $row['document_name'] . "</td>
            <td>" . $row['nom_Entreprise'] . "</td>
            <td>" . $row['validite'] . "</td>
            <td>
                <center>
                    <button style='margin-left: 10px; height: 40px; width: 120px;' type='button' class='btn_relancer buttonvalidate' data-doc='" . $row['document_name'] . "' data-id='" . $row['id_DocumentEntreprise'] . "' data-champdate='" . $nomChampDate . "' data-notif='" . $nomChampNotif . "'>Relancer</button>
                </center>
            </td>
            </tr>";            
        }
    } else {
        $value .= "<tr><td colspan='4'><center>Aucun document à relancer</center></td></tr>";
    }
    $value .= "</tbody></table>";
    echo json_encode(['status' => 'success', 'html' => $value]);
}

function display_all_document_dashboard(){
    global $connexion;
    $role = $_SESSION['Role'];
    $id = $_SESSION['ID'];
    $value = '<table id="listeAllDocumentDashboard" class="table-salarie">
    <thead>
      <tr>
        <th>Nom de Document</th>
        <th>Société</th>
        <th>Date de validité</th>
        <th><center>Action</center></th>
      </tr>
    </thead>
    <tbody>';
    
    $unionQuery = "(
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'KBIS' AS document_type, kbis_DocumentEntreprise AS document_name, dateValiditeKbis_DocumentEntreprise AS validite, 'dateValiditeKbis_DocumentEntreprise' AS validity_field, 'notifKbis_DocumentEntreprise' AS nomchampNotif, notifKbis_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeKbis_DocumentEntreprise != '0000-00-00'
        AND dateValiditeKbis_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'PI Gérant' AS document_type, pieceIdentitieGerant_DocumentEntreprise AS document_name, dateValiditePIGerant_DocumentEntreprise AS validite, 'dateValiditePIGerant_DocumentEntreprise' AS validity_field, 'notifPIGerant_DocumentEntreprise' AS nomchampNotif, notifPIGerant_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditePIGerant_DocumentEntreprise != '0000-00-00'
        AND dateValiditePIGerant_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Attestation Fiscale' AS document_type, attestationRegulariteFiscale_DocumentEntreprise AS document_name, dateValiditeAttestRegulariteFiscale_DocumentEntreprise AS validite, 'dateValiditeAttestRegulariteFiscale_DocumentEntreprise' AS validity_field, 'notifPIGerant_DocumentEntreprise' AS nomchampNotif, notifPIGerant_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeAttestRegulariteFiscale_DocumentEntreprise != '0000-00-00'
        AND dateValiditeAttestRegulariteFiscale_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Attestation URSSAF' AS document_type, attestationURSSAF_DocumentEntreprise AS document_name, dateValiditeAttestURSSAF_DocumentEntreprise AS validite, 'dateValiditeAttestURSSAF_DocumentEntreprise' AS validity_field, 'notifAttestURSSAF_DocumentEntreprise' AS nomchampNotif, notifAttestURSSAF_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeAttestURSSAF_DocumentEntreprise != '0000-00-00'
        AND dateValiditeAttestURSSAF_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Assurance RC Pro' AS document_type, assuranceRcPro_DocumentEntreprise AS document_name, dateValiditeAssuranceRcPro_DocumentEntreprise AS validite, 'dateValiditeAssuranceRcPro_DocumentEntreprise' AS validity_field, 'notifAssuranceRcPro_DocumentEntreprise' AS nomchampNotif, notifAssuranceRcPro_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeAssuranceRcPro_DocumentEntreprise != '0000-00-00'
        AND dateValiditeAssuranceRcPro_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'SIRET' AS document_type, siret_DocumentEntreprise AS document_name, dateValiditeSiret_DocumentEntreprise AS validite, 'dateValiditeSiret_DocumentEntreprise' AS validity_field, 'notifSiret_DocumentEntreprise' AS nomchampNotif, notifSiret_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeSiret_DocumentEntreprise != '0000-00-00'
        AND dateValiditeSiret_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Caisse BTP' AS document_type, caisseBTP_DocumentEntreprise AS document_name, dateValiditeCaisseBTP_DocumentEntreprise AS validite, 'dateValiditeCaisseBTP_DocumentEntreprise' AS validity_field, 'notifCaisseBTP_DocumentEntreprise' AS nomchampNotif, notifCaisseBTP_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeCaisseBTP_DocumentEntreprise != '0000-00-00'
        AND dateValiditeCaisseBTP_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Numéro Fiscal' AS document_type, numeroFiscal_DocumentEntreprise AS document_name, dateValiditeNumFiscal_DocumentEntreprise AS validite, 'dateValiditeNumFiscal_DocumentEntreprise' AS validity_field, 'notifNumFiscal_DocumentEntreprise' AS nomchampNotif, notifNumFiscal_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeNumFiscal_DocumentEntreprise != '0000-00-00'
        AND dateValiditeNumFiscal_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Numéro TVA' AS document_type, numeroTVA_DocumentEntreprise AS document_name, dateValiditeNumTVA_DocumentEntreprise AS validite, 'dateValiditeNumTVA_DocumentEntreprise' AS validity_field, 'notifNumTVA_DocumentEntreprise' AS nomchampNotif, notifNumTVA_DocumentEntreprise AS notif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeNumTVA_DocumentEntreprise != '0000-00-00'
        AND dateValiditeNumTVA_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )
    UNION
    (
      SELECT id_DocumentEntreprise, idEntreprise_DocumentEntreprise, 'Assurence Décennale' AS document_type, assurenceDecennale_DocumentEntreprise AS document_name, dateValiditeAssurenceDecennale_DocumentEntreprise AS validite, 'dateValiditeAssurenceDecennale_DocumentEntreprise' AS validity_field, notifAssurenceDecennale_DocumentEntreprise AS notif, 'notifAssurenceDecennale_DocumentEntreprise' AS nomchampNotif
      FROM document_entreprise 
      WHERE etat_DocumentEntreprise = '1'
        AND dateValiditeAssurenceDecennale_DocumentEntreprise != '0000-00-00'
        AND dateValiditeAssurenceDecennale_DocumentEntreprise <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    )";
    
    if($role == "2" && !empty($id)){
        $sql = "SELECT docs.*, e.nom_Entreprise
                FROM ( $unionQuery ) docs 
                JOIN entreprise e ON docs.idEntreprise_DocumentEntreprise = e.id_Entreprise
                WHERE docs.idEntreprise_DocumentEntreprise = '$id'
                ORDER BY docs.validite ASC";
    } else {
        $sql = "SELECT docs.*, e.nom_Entreprise
                FROM ( $unionQuery ) docs 
                JOIN entreprise e ON docs.idEntreprise_DocumentEntreprise = e.id_Entreprise
                ORDER BY docs.validite ASC";
    }
    
    $result = mysqli_query($connexion, $sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nomChampDate   = $row['validity_field'];
            $notif          = $row['notif'];
            $nomChampNotif  = $row['nomchampNotif'];
            $sql_email = "SELECT email_Entreprise FROM entreprise WHERE id_Entreprise = '".$row['idEntreprise_DocumentEntreprise']."'";
            $result_email = mysqli_query($connexion, $sql_email);
            $row_email = $result_email ? $result_email->fetch_assoc() : [];
            $email = isset($row_email['email_Entreprise']) ? $row_email['email_Entreprise'] : '';
            
            if ($notif == '0'){
                mail_document('nessrinehazzar000@gmail.com', $row['nom_Entreprise'], $row['document_type'], $row['validite']);
                $sql_notif = "UPDATE document_entreprise SET $nomChampNotif = '1' WHERE id_DocumentEntreprise = '".$row['id_DocumentEntreprise']."'";
                mysqli_query($connexion, $sql_notif);
            }
            
            $value .= "<tr style='font-weight: normal;'>
            <td>" . $row['document_name'] . "</td>
            <td>" . $row['nom_Entreprise'] . "</td>
            <td>" . $row['validite'] . "</td>
            <td>
                <center>
                    <button style='margin-left: 10px; height: 40px; width: 120px;' type='button' class='btn_relancer buttonvalidate' data-doc='" . $row['document_name'] . "' data-id='" . $row['id_DocumentEntreprise'] . "' data-champdate='" . $nomChampDate . "' data-notif='" . $nomChampNotif . "'>Relancer</button>
                </center>
            </td>
            </tr>";            
        }
    } else {
        $value .= "<tr><td colspan='4'><center>Aucun document à relancer</center></td></tr>";
    }
    $value .= "</tbody></table>";
    echo json_encode(['status' => 'success', 'html' => $value]);
}
    

function update_document_dashboard(){
    $DocInput= 'document';
    $entreprise_id = $_POST['id'];
    $documentName = $_POST['documentName'];
    $destPath = "../view/file/" . $entreprise_id . "/";

    $newFile = $_FILES[$DocInput];
    if (file_exists($destPath . $documentName)) {
        unlink($destPath . $documentName);
    }
    $success = move_uploaded_file($newFile['tmp_name'], $destPath . $documentName);
    echo message(__FUNCTION__, $success);
}

function update_Validity_Date(){
    global $connexion;
    $date_courrant=date('Y-m-d H:i:s');
    $validityDate = $_POST['validityDate'];
    $id = $_POST['id'];
    $champdate = $_POST['champdate'];
    $notif = $_POST['notif'];

    $sql = "UPDATE document_entreprise SET $champdate = '$validityDate' ,date_updated_DocumentEntreprise = '$date_courrant' , $notif = '0'
            WHERE id_DocumentEntreprise = '$id'";
    $result = mysqli_query($connexion, $sql);

    echo message(__FUNCTION__, $result);
    }

    function calcul_stat_dashboard(){
        global $connexion;
        $role = $_SESSION['Role']; 
        $id = $_SESSION['ID'];
        $period = $_POST['period'];

        switch ($period) {
            case 1:  
                $dateCondEntE = "DATE(date_created_Entreprise) = CURDATE()";
                $dateCondEntS = "DATE(date_created_Salarie) = CURDATE()";
                $dateCondDem = "DATE(date_updated_Demande) = CURDATE()";
                break;
            case 6:  
                $dateCondEntE = "date_created_Entreprise >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                $dateCondEntS = "date_created_Salarie >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                $dateCondDem = "date_updated_Demande >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                break;
            case 29: 
                $dateCondEntE = "date_created_Entreprise >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                $dateCondEntS = "date_created_Salarie >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                $dateCondDem = "date_updated_Demande >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
                break;
        }
        if ($role == "1") {
            $sql_ent = " SELECT COUNT(*) AS total FROM entreprise WHERE etat_Entreprise = '1' AND {$dateCondEntE}";
            $sql_dem = "SELECT COUNT(*) AS total FROM demande WHERE (status_Demande = 'Acceptée' OR status_Demande = 'Refusée') AND {$dateCondDem}";
        } elseif ($role == "2") {
            $sql_ent = "SELECT COUNT(*) AS total FROM salarie WHERE etat_Salarie = '1' AND idEntreprise_Salarie = {$id} AND {$dateCondEntS}";
            $sql_dem = "SELECT COUNT(*) AS total FROM demande WHERE (status_Demande = 'Acceptée' OR status_Demande = 'Refusée') AND {$dateCondDem} AND idEntreprise_Demande = {$id}";
        }
        $result_ent = mysqli_query($connexion, $sql_ent);
        $row_ent = mysqli_fetch_assoc($result_ent);
        $total_ent = $row_ent['total'];
    
        $result_dem = mysqli_query($connexion, $sql_dem);
        $row_dem = mysqli_fetch_assoc($result_dem);
        $total_dem = $row_dem['total'];
    
        echo json_encode(['status' => 'success', 'html' => $total_ent, 'demande' => $total_dem]);
    }
    
function calcul_chart_dashboard(){
    global $connexion;
    $role = $_SESSION['Role']; 
    $id = $_SESSION['ID'];
    if($role =="1"){
        $sql1 = "SELECT typesMission_Entreprise, COUNT(*) as count1 FROM entreprise WHERE typesMission_Entreprise='Française'";
        $sql2 = "SELECT typesMission_Entreprise, COUNT(*) as count2 FROM entreprise WHERE typesMission_Entreprise='Européenne'";
    }elseif($role =="2"){
        $sql1 = "SELECT typeMission_Salarie, COUNT(*) as count1 FROM salarie WHERE typeMission_Salarie='Française' AND idEntreprise_Salarie = {$id}";
        $sql2 = "SELECT typeMission_Salarie, COUNT(*) as count2 FROM salarie WHERE typeMission_Salarie='Européenne' AND idEntreprise_Salarie = {$id}";
    }
    $result1 = mysqli_query($connexion, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $count1 = $row1['count1'];

    $result2 = mysqli_query($connexion, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $count2 = $row2['count2'];
    $total = $count1 + $count2;
    $total1 = $total > 0 ? round(($count1 / $total) * 100, 2) : 0;
    $total2 = $total > 0 ? round(($count2 / $total) * 100, 2) : 0;


    echo json_encode(['status' => 'success', 'res1' => $count1, 'res2' => $count2 ,'total1' => $total1,'total2' => $total2 ]);

}

////////////// Module Notification ///////////

function display_notification(){
    global $connexion;
    $role  = $_SESSION['Role'];
    $id=$_SESSION['ID'];

    $header = "<div class='entete'>
                <h3>Notifications</h3>
                <button type='button' id='btn_affiche' class='btn_affiche' >Voir tout</button><br>
                </div>";
    if($role == "1"){
        $sql = "SELECT * FROM notifications WHERE idEntreprise_Notification = '0' ORDER BY date_created_Notification desc limit 5 ";
    }else {
        $sql = "SELECT * FROM notifications WHERE idEntreprise_Notification = '$id' ORDER BY date_created_Notification desc limit 5";
    }
    $result = mysqli_query($connexion, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $id   = $row['id_Notification'];
            $idEntreprise = $row['idEntreprise_Notification'];
            $type = $row['type_Notification'];
            $msg  = $row['message_Notification'];
            $etat = $row['etat_Notification'];
            $date_created = $row['date_created_Notification'];
            
            $now  = new DateTime();
            $then = new DateTime($date_created);
            $diff = $now->diff($then);

            if ($diff->y > 0) {
                $unit = $diff->y > 1 ? 'ans' : 'an';
                $time = $diff->y . ' ' . $unit;

            } elseif ($diff->m > 0) {
                $time = $diff->m . ' mois';

            } elseif ($diff->d > 0) {
                $unit = $diff->d > 1 ? 'jours' : 'jour';
                $time = $diff->d . ' ' . $unit;

            } elseif ($diff->h > 0) {
                $unit = $diff->h > 1 ? 'heures' : 'heure';
                $time = $diff->h . ' ' . $unit;

            } elseif ($diff->i > 0) {
                $unit = $diff->i > 1 ? 'minutes' : 'minute';
                $time = $diff->i . ' ' . $unit;

            } elseif ($diff->s > 0) {
                $unit = $diff->s > 1 ? 'secondes' : 'seconde';
                $time = $diff->s . ' ' . $unit;

            } else {
                $time = 'à l’instant';
            }
            $res[] = "<div  ".($etat == 1 ? "class='notification-item'" : " class='btn_non_lu'")." >
            <button id='msg_notif' class='msg_notif' type='button' data-id='$id' data-time='$date_created'><strong>$type : </strong><br>" . $msg . "<br><br>
            <div class='time'>" .$time ."</div>
            </button></div>";
            
        }
    }    
    $html = array_merge([$header], $res);
    echo json_encode(['status' => 'success', 'html' => $html]);
}

function display_all_notification(){
    global $connexion;
    $role  = $_SESSION['Role'];
    $id=$_SESSION['ID'];

    $html = [];
    if($role == "1"){
        $sql = "SELECT * FROM notifications WHERE idEntreprise_Notification = '0' ORDER BY date_created_Notification desc";
    }else {
        $sql = "SELECT * FROM notifications WHERE idEntreprise_Notification = '$id' ORDER BY date_created_Notification desc";
    }
    $result = mysqli_query($connexion, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $id   = $row['id_Notification'];
            $idEntreprise = $row['idEntreprise_Notification'];
            $type = $row['type_Notification'];
            $msg  = $row['message_Notification'];
            $etat = $row['etat_Notification'];
            $date_created = $row['date_created_Notification'];
            
            $now  = new DateTime();
            $then = new DateTime($date_created);
            $diff = $now->diff($then);

            if ($diff->y > 0) {
                $unit = $diff->y > 1 ? 'ans' : 'an';
                $time = $diff->y . ' ' . $unit;

            } elseif ($diff->m > 0) {
                $time = $diff->m . ' mois';

            } elseif ($diff->d > 0) {
                $unit = $diff->d > 1 ? 'jours' : 'jour';
                $time = $diff->d . ' ' . $unit;

            } elseif ($diff->h > 0) {
                $unit = $diff->h > 1 ? 'heures' : 'heure';
                $time = $diff->h . ' ' . $unit;

            } elseif ($diff->i > 0) {
                $unit = $diff->i > 1 ? 'minutes' : 'minute';
                $time = $diff->i . ' ' . $unit;

            } elseif ($diff->s > 0) {
                $unit = $diff->s > 1 ? 'secondes' : 'seconde';
                $time = $diff->s . ' ' . $unit;

            } else {
                $time = 'à l’instant';
            }
            $html[] = "<div  ".($etat == 1 ? "class='notification-item'" : " class='btn_non_lu'")." >
            <button id='msg_notif' class='msg_notif' type='button' data-id='$id' data-time='$date_created'><strong>$type : </strong><br>" . $msg . "<br><br>
            <div class='time'>" .$time ."</div>
            </button></div>";
            
        }
    }    
    echo json_encode(['status' => 'success', 'html' => $html]);
}

function get_notification(){
    global $connexion;
    $id = $_POST['id'];
    $time = $_POST['time'];
    $date_courrant=date('Y-m-d H:i:s');
    $sql = "UPDATE notifications SET etat_Notification = '1', date_updated_Notification = '$date_courrant' WHERE id_Notification = '$id'";
    $result = mysqli_query($connexion, $sql);

    $sql_affiche = "SELECT * FROM notifications WHERE id_Notification = '$id'";
    $result_affiche = mysqli_query($connexion, $sql_affiche);
    $row_affiche = mysqli_fetch_assoc($result_affiche);
    $type = $row_affiche['type_Notification'];
    $msg  = $row_affiche['message_Notification'];
    $value = "<div class='notification-item'><strong>$type : </strong><br>" . $msg . "<br><br>
    <div class='time'>" .$time ."</div></div>";

    echo json_encode(['status' => 'success', 'html' => $value]);
}

////////////// Module contact //////////////////
function ajouter_message(){
    global $connexion;
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $objet = $_POST['objet'];
    $message = $_POST['message'];
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO contact (nom_Contact, telephone_Contact, email_Contact, objet_Contact, message_Contact, date_created_Contact,etat_Contact) VALUES ('$nom', '$telephone', '$email', '$objet', '$message', '$date', '1')";
    $result = mysqli_query($connexion, $sql);
    if ($result) {
        envoyer_mail_contact($email, $nom, $objet, $message);
        $response = 'Envoi réussie !';
    } else {
        $response = 'Envoi échouée !';
    }
    echo $response;
}





?>


