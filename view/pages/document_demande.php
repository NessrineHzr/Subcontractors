<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql2="SELECT idEntreprise_Demande ,nom_Entreprise ,status_Demande, id_Demande FROM entreprise ,demande  WHERE id_Entreprise=idEntreprise_Demande AND id_Demande = '$id'";
$result2 = mysqli_query($connexion, $sql2);
if ($row = mysqli_fetch_assoc($result2)) {
    $idDemande = $row['id_Demande'];
    $nom = $row['nom_Entreprise'];
    $nom_Entreprise = str_replace(' ', '', $row['nom_Entreprise']);
    $idEntrepriseDemande = $row['idEntreprise_Demande'];
    $statusDemande = $row['status_Demande'];
}
$sql = "SELECT id_Entreprise, nomGerant_Entreprise, adresse_Entreprise, pays_Entreprise, telephone_Entreprise, iban_Entreprise, typesMission_Entreprise, chefProjet_Entreprise FROM entreprise WHERE etat_Entreprise = '1' AND id_Entreprise='$idEntrepriseDemande'";
$result = mysqli_query($connexion, $sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nomGerant = $row['nomGerant_Entreprise'];
        $adresse = $row['adresse_Entreprise'];
        $pays = $row['pays_Entreprise'];
        $telephone = $row['telephone_Entreprise'];
        $iban = $row['iban_Entreprise'];
        $typesMission = $row['typesMission_Entreprise'];
        $chefProjet = $row['chefProjet_Entreprise'];
        $missionClass = ($typesMission == 'Européenne') ? 'mission mission-europeenne' : 'mission';
    }
}
$date_courant = date('Y-m-d H:i:s');
if ($statusDemande == 'En Attente' ){
    $sql2 = "UPDATE demande SET status_demande='En Cours',date_updated_Demande='$date_courant' WHERE idEntreprise_Demande='$idEntrepriseDemande'";
    $result2 = $connexion->query($sql2);
}

?>
<!DOCTYPE html>
<html lang="fr">
<body>
<style>
    .documents {
        display: flex; 
        gap: 10px;
    }
    p {
        position: absolute;
        top: 100%;  
        left: auto; 
        font-size: 16px; 
    }
    .document {
        display: flex;
        align-items: center;
        position: relative;
    }
    .doc {
        background-color: #FFF0DB; 
        padding: 50px;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .doc img {
        width: 40px;
        height: 50px;
    }

    .telecharger {
        border: none;
        background-color: transparent;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .telecharger img {
        width: 60px;
        height: 60px;
        transform: translateX(-60px);
        margin-top: 150px;
    }
    .titre {
    display: flex;
    align-items: center; 
    justify-content: space-between; 
    }
    .titre h3 {
    margin: 0;
    }
    .btn_telecharger {
    font-size: 15px;
    width: 150px;
    height: 19px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: auto;
    border-radius: 60px;
    background-color: #EFEAFF;
    color: #470EE9;
    border : none;
  }
    
</style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0 p-0">
      <div class="breadcrumb-item" style="font-size: 23px; font-weight: bold;"><a href="demande.php">Tous les demandes</a></div>
      <div class="breadcrumb-item active" style="font-size: 19px; color:#470EE9; font-weight: bold;" aria-current="page">Demande de <?php echo $nom; ?> </div>
    </ol>
    <?php if ($statusDemande == 'En attente' || $statusDemande == 'En Cours') { ?>
        <button style='float: right; margin-left: 10px;' type="button" id="btn_accepter" class="buttonvalidate" data-demande="<?= $id ?>">Accepter</button>
        <button style='float: right;' type="button" id="btn_refuser" class="buttonannule" data-demande="<?= $id ?>">Refuser</button>
    <?php } ?>
    </nav><br><br>
<h3>Informations </h3><br><br>

<table id="listeDemandeEntreprise" class="table-salarie">
  <thead>
      <tr>
        <th>Nom Gérant</th>
        <th>Adresse</th>
        <th>Pays</th>
        <th>Téléphone</th>
        <th>Iban</th>
        <th>Type Mission</th>
        <th>Chef Projet</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $nomGerant; ?></td>
            <td><?php echo $adresse; ?></td>
            <td><?php echo $pays; ?></td>
            <td><?php echo $telephone; ?></td>
            <td><?php echo $iban; ?></td>
            <td class="<?php echo $missionClass; ?>"><?php echo $typesMission; ?></td>
            <td><button type='button' class='icon-button' id='btn_chefProjet_demande' data-chefProjet-demande="<?php echo $chefProjet; ?>" data-id-demande="<?php echo $id; ?>"><img src='../img/view.png'/></button></td>
        </tr>
    </tbody>
</table>
<br><br>

<!-- Model affiche info chef projet -->
<div class="modal fade" id="affiche_chefProjet_demande" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Information de chef de projet</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="info_chefProjet_demande"></center>  
        </div>
        <div class="modal-footer">
          <button type="button" id="btn_annule" class="buttonannule">Fermer</button>
		</div>
      </div>
    </div>
  </div>
</div> 
<!-- end Model affiche info chef projet -->
<div class="titre">
    <h3>Documents envoyés </h3><br>
    <button type="button" id="btn_telecharger" class="btn_telecharger" data-demande="<?= $id ?>">Télécharger tous</button>
</div>
<div class="documents">
<div class="document">
    <a href="#" id="kbis_Document" class="doc"><img src="../img/doc.png" ></a>
    <button id="telecharger" class="telecharger"><img src="../img/telecharger.png" ></button>
    <p> KBIS </p>
</div>
<div class="document">
    <a href="#" id="pieceIdentitieGerant_Document" class="doc"><img src="../img/doc.png" ></a>
    <button id="telecharger" class="telecharger"><img src="../img/telecharger.png" ></button>
    <p> Pièce d'Identité   </p>
</div>
<div class="document">
    <a href="#" id="attestationRegulariteFiscale_Document" class="doc"><img src="../img/doc.png" ></a>
    <button id="telecharger" class="telecharger"><img src="../img/telecharger.png" ></button>
    <p> Attestation de Régularité Fiscale </p>
</div>
<div class="document">
    <a href="#" id="attestationURSSAF_Document" class="doc"><img src="../img/doc.png" ></a>
    <button id="telecharger" class="telecharger"><img src="../img/telecharger.png" ></button>
    <p> Attestation URSSAF </p>
</div>
<div class="document">
    <a href="#" id="assuranceRcPro_Document" class="doc"><img src="../img/doc.png" ></a>
    <button id="telecharger" class="telecharger"><img src="../img/telecharger.png" ></button>
    <p>Assurance RC PRO  </p>
</div>
<div class="document">
    <a href="#" id="assurenceDecennale_Document" class="doc"><img src="../img/doc.png" ></a>
    <button id="telecharger" class="telecharger"><img src="../img/telecharger.png" ></button>
    <p>Assurance Décennale </p>
</div>

</div>
</body>
</html>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const idDocument = "<?php echo $idDemande; ?>"; 
    const nomEntreprise = "<?php echo $nom_Entreprise; ?>";

    document.querySelectorAll('.doc').forEach(doc => {
        doc.addEventListener('click', function(event) {
            event.preventDefault(); 
            const docId = this.id;
            const fileName = `${docId}_${nomEntreprise}`; 
            const filePath = `../file/${idDocument}/${fileName}.pdf`; 
            if (filePath) {
                window.open(filePath, "_blank");
            }
        });
    });

    document.querySelectorAll('.telecharger').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const docElement = this.closest('.document').querySelector('.doc');
            const docId = docElement.id;
            const fileName = `${docId}_${nomEntreprise}`;
            const filePath = `../file/${idDocument}/${fileName}.pdf`; 
            const link = document.createElement('a');
            link.href = filePath;
            link.download = `${fileName}.pdf`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });

});

</script>
<?php
include('../footer.php');
?>