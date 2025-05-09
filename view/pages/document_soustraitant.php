<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql="SELECT nom_Entreprise FROM entreprise WHERE id_entreprise='$id'";
$result = mysqli_query($connexion, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    $nom_Entreprise = str_replace(' ', '', $row['nom_Entreprise']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<div class="row d-flex">
    <div class="col-sm-12 col-md-6 d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item" style="font-size: 23px; font-weight: bold;">Sous-traitants</li>
                <li class="breadcrumb-item active" style="font-size: 19px; color:#470EE9; font-weight: bold;" aria-current="page"><a href="sous-traitant.php">Liste des sous-traitant </a></li>
                <li class="breadcrumb-item active" style="font-size: 18px; color:#470EE9; font-weight: bold;" aria-current="page" >Liste des documents de <?php echo $nom_Entreprise; ?></li>
            </ol>
        </nav>
    </div>
    <button style='float: right; margin-left: 10px;' type="button" id="btn_relancer" class="buttonvalidate">Relancer</button><br><br><br>
</div>
<!-- Model ajout document -->
<div class="modal fade bd-example-modal-lg" id="ajoutDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajout documents</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p id="message_demande"></p><br><br>
        <form autocomplete="off" class="form-horizontal">
          <!-- KBIS -->
          <div id="fiche_2row">
            <div class="form-group">
              <label for="kbis_Document">KBIS*</label>
              <input type="file" id="kbis_Document" name="kbis_Document">
            </div>
            <div class="form-group">
              <label for="dateValiditeKbis_Document">Date de validité KBIS*</label>
              <input type="date" id="dateValiditeKbis_Document" name="dateValiditeKbis_Document"><br><br>
            </div>
          </div>
          <!-- Pièce d'identité Gérant -->
          <div id="fiche_2row">
            <div class="form-group">
              <label for="pieceIdentitieGerant_Document">Pièce d'identité Gérant*</label>
              <input type="file" id="pieceIdentitieGerant_Document" name="pieceIdentitieGerant_Document">
            </div>
            <div class="form-group">
              <label for="dateValiditePIGerant_Document">Date de validité Pièce d'identité*</label>
              <input type="date" id="dateValiditePIGerant_Document" name="dateValiditePIGerant_Document"><br><br>
            </div>
          </div>
          <!-- Attestation Régularité Fiscale -->
          <div id="fiche_2row">
            <div class="form-group">
              <label for="attestationRegulariteFiscale_Document">Attestation Régularité Fiscale*</label>
              <input type="file" id="attestationRegulariteFiscale_Document" name="attestationRegulariteFiscale_Document">
            </div>
            <div class="form-group">
              <label for="dateValiditeAttestRegulariteFiscale_Document">Date de validité Attestation Régularité Fiscale*</label>
              <input type="date" id="dateValiditeAttestRegulariteFiscale_Document" name="dateValiditeAttestRegulariteFiscale_Document"><br><br>
            </div>
          </div>
          <!-- Attestation URSSAF -->
          <div id="fiche_2row">
            <div class="form-group">
              <label for="attestationURSSAF_Document">Attestation URSSAF*</label>
              <input type="file" id="attestationURSSAF_Document" name="attestationURSSAF_Document">
            </div>
            <div class="form-group">
              <label for="dateValiditeAttestURSSAF_Document">Date de validité Attestation URSSAF*</label>
              <input type="date" id="dateValiditeAttestURSSAF_Document" name="dateValiditeAttestURSSAF_Document"><br><br>
            </div>
          </div>
          <!-- Assurance RC Pro -->
          <div id="fiche_2row">
            <div class="form-group">
              <label for="assuranceRcPro_Document">Assurance RC Pro*</label>
              <input type="file" id="assuranceRcPro_Document" name="assuranceRcPro_Document">
            </div>
            <div class="form-group">
              <label for="dateValiditeAssuranceRcPro_Document">Date de validité Assurance RC Pro*</label>
              <input type="date" id="dateValiditeAssuranceRcPro_Document" name="dateValiditeAssuranceRcPro_Document"><br><br>
            </div>
          </div>
          <!-- SIRET -->
          <div id="fiche_2row">
            <div class="form-group">
              <label for="siret_Document">SIRET*</label>
              <input type="file" id="siret_Document" name="siret_Document">
            </div>
            <div class="form-group">
              <label for="dateValiditeSiret_Document">Date de validité SIRET*</label>
              <input type="date" id="dateValiditeSiret_Document" name="dateValiditeSiret_Document"><br><br>
            </div>
          </div>
          <!-- Caisse BTP -->
          <div id="fiche_2row">
            <div class="form-group">
              <label for="caisseBTP_Document">Caisse BTP*</label>
              <input type="file" id="caisseBTP_Document" name="caisseBTP_Document">
            </div>
            <div class="form-group">
              <label for="dateValiditeCaisseBTP_Document">Date de validité Caisse BTP*</label>
              <input type="date" id="dateValiditeCaisseBTP_Document" name="dateValiditeCaisseBTP_Document"><br><br>
            </div>
          </div>
          <!-- Numéro Fiscal -->
          <div id="fiche_2row">
            <div class="form-group">
              <label for="numeroFiscal_Document">Numéro Fiscal*</label>
              <input type="file" id="numeroFiscal_Document" name="numeroFiscal_Document">
            </div>
            <div class="form-group">
              <label for="dateValiditeNumFiscal_Document">Date de validité Numéro Fiscal*</label>
              <input type="date" id="dateValiditeNumFiscal_Document" name="dateValiditeNumFiscal_Document"><br><br>
            </div>
          </div>
          <!-- Numéro TVA -->
          <div id="fiche_2row">
            <div class="form-group">
              <label for="numeroTVA_Document">Numéro TVA*</label>
              <input type="file" id="numeroTVA_Document" name="numeroTVA_Document">
            </div>
            <div class="form-group">
              <label for="dateValiditeNumTVA_Document">Date de validité Numéro TVA*</label>
              <input type="date" id="dateValiditeNumTVA_Document" name="dateValiditeNumTVA_Document"><br><br>
            </div>
          </div>
          <!-- Assurance Décennale -->
          <div id="fiche_2row">
            <div class="form-group">
              <label for="assurenceDecennale_Document">Assurance Décennale*</label>
              <input type="file" id="assurenceDecennale_Document" name="assurenceDecennale_Document">
            </div>
            <div class="form-group">
              <label for="dateValiditeAssurenceDecennale_Document">Date de validité Assurance Décennale*</label>
              <input type="date" id="dateValiditeAssurenceDecennale_Document" name="dateValiditeAssurenceDecennale_Document"><br><br>
            </div>
          </div>
        </form>  
      </div>
      <div class="modal-footer">
        <button class="buttonvalidate" id="ajouter_document" data-document="<?= $id ?>">Ajouter</button>
        <button class="buttonannule" id="btn_annule">Annuler</button>
      </div>
    </div>
  </div>
</div>
<!-- end Model ajout document -->
<!-- Model alert ajout succès -->
<div class="modal fade" id="SuccessAddDemande" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajout documents</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px;">          
          <center id="adddemande_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout succès -->
<!-- Model alert ajout echec -->
<div class="modal fade" id="EchecAddDemande" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajout documents</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px;">          
          <center id="adddemande_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout echec -->
<?php
$documents = [
    "kbis_DocumentEntreprise" => "KBIS",
    "pieceIdentitieGerant_DocumentEntreprise" => "Pièce d'Identité",
    "attestationRegulariteFiscale_DocumentEntreprise" => "Attestation de Régularité Fiscale",
    "attestationURSSAF_DocumentEntreprise" => "Attestation URSSAF",
    "assuranceRcPro_DocumentEntreprise" => "Assurance RC PRO",
    "assurenceDecennale_DocumentEntreprise" => "Assurance Décennale",
    "siret_DocumentEntreprise" => "SIRET",
    "caisseBTP_DocumentEntreprise" => "Caisse BTP",
    "numeroFiscal_DocumentEntreprise" => "Numéro Fiscal",
    "numeroTVA_DocumentEntreprise" => "Numéro TVA"
];
$styles = array_fill_keys(array_keys($documents), "");
$sql_doc = "SELECT * FROM document_entreprise WHERE idEntreprise_DocumentEntreprise = '$id'";
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
    const idDocument = "<?php echo $id; ?>"; 
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