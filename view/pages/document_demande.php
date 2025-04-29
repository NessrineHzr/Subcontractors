<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$role =$_SESSION['Role'];
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
$sql = "SELECT id_Entreprise, nomGerant_Entreprise, prenomGerant_Entreprise, adresse_Entreprise, pays_Entreprise, telephone_Entreprise, iban_Entreprise, typesMission_Entreprise, chefProjet_Entreprise FROM entreprise WHERE etat_Entreprise = '1' AND id_Entreprise='$idEntrepriseDemande'";
$result = mysqli_query($connexion, $sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nomGerant = $row['nomGerant_Entreprise'] . " " . $row['prenomGerant_Entreprise'];
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
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item" style="font-size: 23px; font-weight: bold;">Demandes</li>
        <li class="breadcrumb-item active" style="font-size: 19px; color:#470EE9; font-weight: bold;" aria-current="page"><a href="demande.php">Liste des demandes </a></li>
        <li class="breadcrumb-item active" style="font-size: 18px; color:#470EE9; font-weight: bold;" aria-current="page" >Demande de <?php echo $nom; ?></li>
    </ol>
    <?php if ($role == "1" && ($statusDemande == 'En Attente' || $statusDemande == 'En Cours')) { ?>
        <button style='float: right; margin-left: 10px;' type="button" id="btn_accepter" class="buttonvalidate" data-demande="<?= $id ?>">Accepter</button>
        <button style='float: right;' type="button" id="btn_refuser" class="buttonannule" data-demande="<?= $id ?>">Refuser</button>
    <?php } ?>
</nav><br><br>

<!-- partie info -->
<h3>Informations </h3><br><br>
<table id="table_listeDemande" class="table-salarie">
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
            <td><div class="<?php echo $missionClass; ?>"><?php echo $typesMission; ?></div></td>
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
          <div id="info_chefProjet_demande" style="text-align: center;"></div>  
        </div>
        <div class="modal-footer">
          <button type="button" id="btn_annule" class="buttonannule">Fermer</button>
		</div>
      </div>
    </div>
  </div>
</div> 
<!-- end Model affiche info chef projet -->

 <!-- partie documents -->
<div class="titre">
    <h3>Documents envoyés </h3><br>
    <button type="button" id="btn_telecharger" class="btn_telecharger" data-demande="<?= $id ?>">Télécharger tous</button>
</div>
<?php
$documents = [
    "kbis_DocumentDemande" => "KBIS",
    "pieceIdentitieGerant_DocumentDemande" => "Pièce d'Identité",
    "attestationRegulariteFiscale_DocumentDemande" => "Attestation de Régularité Fiscale",
    "attestationURSSAF_DocumentDemande" => "Attestation URSSAF",
    "assuranceRcPro_DocumentDemande" => "Assurance RC PRO",
    "assurenceDecennale_DocumentDemande" => "Assurance Décennale",
    "siret_DocumentDemande" => "SIRET",
    "caisseBTP_DocumentDemande" => "Caisse BTP",
    "numeroFiscal_DocumentDemande" => "Numéro Fiscal",
    "numeroTVA_DocumentDemande" => "Numéro TVA"
];
$styles = array_fill_keys(array_keys($documents), "");
$sql_doc = "SELECT * FROM document_demande WHERE idDemande_DocumentDemande = '$id'";
$result_doc = mysqli_query($connexion, $sql_doc);
$row_doc = mysqli_fetch_assoc($result_doc) ?: [];
foreach ($documents as $key => $title) {
    if (empty($row_doc[$key])) {
        $styles[$key] = "background-color: rgb(255, 78, 78);";
    }
}
?>
<div class="documents">
    <?php foreach ($documents as $key => $title): ?>
        <div class="document">
            <a href="#" id="<?= $key ?>" class="doc" style="<?= $styles[$key] ?>">
                <img src="../img/doc.png">
            </a>
            <button id="telecharger" class="telecharger">
                <img src="../img/telecharger.png">
            </button>
            <div class="titledoc"><?= $title ?></div>
        </div>
    <?php endforeach; ?>
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