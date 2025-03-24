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
        $_SESSION['ID'] = $row['id_Utilisateur'];
        $_SESSION['Login'] = $row['login_Utilisateur'];
		$_SESSION['Role'] = $row['role_Utilisateur'];
        $_SESSION['Nom'] = $row['nom_Utilisateur']." ".$row['prenom_Utilisateur'];
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Méthode incorrecte']);
    }
}
 
/////////////////////// Module Profile /////////////////////////
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

        $newFileName = $prefix . '_' . $nom . '.' . $fileExtension;
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



///////////////////////////// Module Salarie ////////////////////////////

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

    $sql = "SELECT id_Entreprise,nom_Entreprise, nomGerant_Entreprise, adresse_Entreprise, pays_Entreprise, siret_Entreprise, email_Entreprise, telephone_Entreprise, iban_Entreprise, typesMission_Entreprise, chefProjet_Entreprise FROM entreprise WHERE etat_Entreprise = '1'";
    $result = mysqli_query($connexion,$sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $missionClass = ($row['typesMission_Entreprise'] == 'Européenne') ? 'mission mission-europeenne' : 'mission';
            $value .= "<tr>
            <td>" . $row['nom_Entreprise'] . "</td>
            <td>" . $row['nomGerant_Entreprise'] . "</td>
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
    $sql = "INSERT INTO entreprise (nom_Entreprise, nomGerant_Entreprise, adresse_Entreprise, pays_Entreprise, siret_Entreprise, email_Entreprise, telephone_Entreprise, iban_Entreprise, typesMission_Entreprise, chefProjet_Entreprise, etat_Entreprise, date_created_Entreprise) 
    VALUES ('$nom', '$nomGerant', '$adresse', '$pays', '$siret', '$email', '$telephone', '$iban', '$typesMission', '$chefProjet','$etat', '$date_courrant')";
    $result = $connexion->query($sql);
    echo message(__FUNCTION__, $result);   
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
    $soustraitant_data[3] = $row['adresse_Entreprise'];
    $soustraitant_data[4] = $row['pays_Entreprise'];
    $soustraitant_data[5] = $row['siret_Entreprise'];
    $soustraitant_data[6] = $row['email_Entreprise'];
    $soustraitant_data[7] = $row['telephone_Entreprise'];
    $soustraitant_data[8] = $row['iban_Entreprise'];
    $soustraitant_data[9] = $row['typesMission_Entreprise'];
    $soustraitant_data[10] = $chefProjet;
    echo json_encode($soustraitant_data);
}

function update_soustraitant(){
    global $connexion;
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $nomGerant = $_POST['nomGerant'];
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
            SET nom_Entreprise = '$nom', nomGerant_Entreprise = '$nomGerant', adresse_Entreprise = '$adresse', pays_Entreprise = '$pays', 
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
    $sql = "SELECT nom_Salarie , prenom_Salarie , dateNaissance_Salarie , nationalite_Salarie , poste_Salarie FROM entreprise , salarie WHERE id_Salarie  = '$ID_chefProjet'";
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
    $query = "SELECT * FROM document WHERE idEntreprise_Document= '$ID' AND etat_Document='1'";
    $result = mysqli_query($connexion, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $document_data = [];
        $document_data[0] = $row['id_Document'];
        $document_data[1] = $row['idEntreprise_Document'];
        $document_data[2] = $row['kbis_Document'];
        $document_data[3] = $row['dateValiditeKbis_Document'];
        $document_data[4] = $row['pieceIdentitieGerant_Document'];
        $document_data[5] = $row['dateValiditePIGerant_Document'];
        $document_data[6] = $row['attestationRegulariteFiscale_Document'];
        $document_data[7] = $row['dateValiditeAttestRegulariteFiscale_Document'];
        $document_data[8] = $row['attestationURSSAF_Document'];
        $document_data[9] = $row['dateValiditeAttestURSSAF_Document'];
        $document_data[10] = $row['assuranceRcPro_Document'];
        $document_data[11] = $row['dateValiditeAssuranceRcPro_Document'];
        $document_data[12] = $row['siret_Document'];
        $document_data[13] = $row['dateValiditeSiret_Document'];
        $document_data[14] = $row['caisseBTP_Document'];
        $document_data[15] = $row['dateValiditeCaisseBTP_Document'];
        $document_data[16] = $row['numeroFiscal_Document'];
        $document_data[17] = $row['dateValiditeNumFiscal_Document'];
        $document_data[18] = $row['numeroTVA_Document'];
        $document_data[19] = $row['dateValiditeNumTVA_Document'];
        $document_data[20] = $row['assurenceDecennale_Document'];
        $document_data[21] = $row['dateValiditeAssurenceDecennale_Document'];
   
    }
    echo json_encode($document_data);
}

function display_demande(){
    global $connexion;
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

    $sql = "SELECT id_Demande ,idEntreprise_Demande ,nomGerantEntreprise_Demande,societe_Demande, date_Demande, heure_Demande, status_Demande FROM demande WHERE etat_Demande = '1'";
    $result = mysqli_query($connexion,$sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['status_Demande'] == 'En Attente') {
                $statusClass = 'status status_attente';
            } elseif ($row['status_Demande'] == 'En Cours') {
                $statusClass = 'status status_attente';
            }elseif ($row['status_Demande'] == 'Acceptée') {
                $statusClass = 'status status_acceptee';
            } elseif ($row['status_Demande'] == 'Refusée') {
                $statusClass = 'status status_refusee';
            }
            $value .= "<tr>
            <td>" . $row['nomGerantEntreprise_Demande'] . "</td>
            <td>" . $row['societe_Demande'] . "</td>
            <td>" . $row['date_Demande'] . "</td>
            <td>" . $row['heure_Demande'] . "</td>

            <td> <div class='$statusClass'>" . $row['status_Demande'] . "</div></td>
            <td><a href='document_demande.php?id=" . $row['id_Demande'] . "'>
            <center>
                <button type='button' class='icon-button' id='btn_info_demande' data-demande='" . $row['id_Demande'] . "' data-id='" . $row['idEntreprise_Demande'] . "' ><img src='../img/view.png'/></button></a>
                <button type='button' class='supprimer' id='btn_supprime_demande' data-demande='" . $row['id_Demande'] . "'>Supprimer</button>
            </center>
            </td>
            </tr>";            
        }
    } 
    $value .= "</tbody></table>";
    echo json_encode(['status' => 'success', 'html' => $value]);

}

function update_status_demande(){
    global $connexion;
    $id = $_POST['ID'];
    $action = $_POST['action'];
    $date_courant = date('Y-m-d H:i:s');
    if ($action == "accepter") {
        $sql = "UPDATE demande SET status_Demande='Acceptée',date_updated_Demande='$date_courant' WHERE idEntreprise_Demande='$id'";
    } elseif ($action == "refuser") {
        $sql = "UPDATE demande SET status_Demande='Refusée',date_updated_Demande='$date_courant' WHERE idEntreprise_Demande='$id'";
    }
    $result = $connexion->query($sql);
    echo json_encode(message(__FUNCTION__, $result));
}

function ajouter_demande(){
    global $connexion;
    $id_nom = $_POST['nom'];
    $societe = $_POST['societe'];
    $date_courant = date('Y-m-d H:i:s');
    $sql1 = "SELECT id_Entreprise ,nom_Entreprise ,nomGerant_Entreprise FROM entreprise WHERE id_Entreprise = '$id_nom'";
    $result1 = mysqli_query($connexion,$sql1);
    $row = mysqli_fetch_assoc($result1);
    $idEntreprise = $row['id_Entreprise'];
    $nomGerant = $row['nomGerant_Entreprise'];
    $nom= $row['nom_Entreprise'];

    $sql = "INSERT INTO demande (idEntreprise_Demande,nomGerantEntreprise_Demande, societe_Demande, date_Demande, heure_Demande, status_Demande, etat_Demande, date_created_Demande ,date_updated_Demande) VALUES ('$idEntreprise','$nomGerant','$societe', CURDATE(), CURTIME(), 'En Attente', 1, '$date_courant' ,'$date_courant')";
    $result = $connexion->query($sql);
    if (!$result) {
        echo message(__FUNCTION__, false);
        exit;
    }

    $demande_id = mysqli_insert_id($connexion);
    
    $folderPath = "../view/file/" . $demande_id . "/";
    if (!is_dir($folderPath)) {
        mkdir($folderPath, 0777, true);
    }
    function uploadDocument($fieldName, $docType, $folderPath, $nom) {
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == 0) {
            $extension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
            $nomClean = str_replace(' ', '', $nom);
            $newFileName = $docType . "_Document_" . $nomClean . ($extension ? "." . $extension : "");
            $targetFile = $folderPath . $newFileName;
            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetFile)) {
                return $newFileName;
            }
        }
        return "";
    }
    
    $kbis_Document = uploadDocument('kbis', 'kbis', $folderPath, $nom);
    $pieceIdentitieGerant_Document = uploadDocument('pieceid', 'pieceIdentitieGerant', $folderPath, $nom);
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
    
    $sql2 = "INSERT INTO document (
        idDemande_Document,
        kbis_Document,
        dateValiditeKbis_Document,
        pieceIdentitieGerant_Document,
        dateValiditePIGerant_Document,
        attestationRegulariteFiscale_Document,
        dateValiditeAttestRegulariteFiscale_Document,
        attestationURSSAF_Document,
        dateValiditeAttestURSSAF_Document,
        assuranceRcPro_Document,
        dateValiditeAssuranceRcPro_Document,
        siret_Document,
        dateValiditeSiret_Document,
        caisseBTP_Document,
        dateValiditeCaisseBTP_Document,
        numeroFiscal_Document,
        dateValiditeNumFiscal_Document,
        numeroTVA_Document,
        dateValiditeNumTVA_Document,
        assurenceDecennale_Document,
        dateValiditeAssurenceDecennale_Document,
        date_created_Document,
        date_updated_Document,
        etat_Document
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






?>


