<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<div class="table" action="" method="post">
  <div class="table-responsive-xxl" id="table_listeDemande"></div>
</div>
<!-- Model ajout -->
<div class="modal fade" id="ajoutDemande" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un demande</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p id="message_demande"></p><br><br>
        <div class="form-group">
        <label for="nom">Nom*</label>
        <select id="nom" name="nom">
        <option value="">Sélectionnez votre nom</option>
          <?php 
          global $connexion;
          $sql = "SELECT id_Entreprise ,nom_Entreprise FROM entreprise WHERE etat_Entreprise='1'";
          $result = mysqli_query($connexion, $sql);
          if ($result) {
              while($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='". $row['id_Entreprise'] ."'>" . $row['nom_Entreprise'] . "</option>";
              }
          }
          ?>
        </select><br><br>
        </div>
        <div class="form-group">
        <label for="societe">Société*</label>
        <input type="text" id="societe" name="societe"><br><br>
        </div>
  <!-- KBIS -->
  <div class="form-group">
    <label for="kbis_Document">KBIS*</label>
    <input type="file" id="kbis_Document" name="kbis_Document"><br><br>
    <label for="dateValiditeKbis_Document">Date de validité KBIS*</label>
    <input type="date" id="dateValiditeKbis_Document" name="dateValiditeKbis_Document"><br><br>
  </div>
  <!-- Pièce d'identité Gérant -->
  <div class="form-group">
    <label for="pieceIdentitieGerant_Document">Pièce d'identité Gérant*</label>
    <input type="file" id="pieceIdentitieGerant_Document" name="pieceIdentitieGerant_Document"><br><br>
    <label for="dateValiditePIGerant_Document">Date de validité Pièce d'identité*</label>
    <input type="date" id="dateValiditePIGerant_Document" name="dateValiditePIGerant_Document"><br><br>
  </div>
  <!-- Attestation Régularité Fiscale -->
  <div class="form-group">
    <label for="attestationRegulariteFiscale_Document">Attestation Régularité Fiscale*</label>
    <input type="file" id="attestationRegulariteFiscale_Document" name="attestationRegulariteFiscale_Document"><br><br>
    <label for="dateValiditeAttestRegulariteFiscale_Document">Date de validité Attestation Régularité Fiscale*</label>
    <input type="date" id="dateValiditeAttestRegulariteFiscale_Document" name="dateValiditeAttestRegulariteFiscale_Document"><br><br>
  </div>
  <!-- Attestation URSSAF -->
  <div class="form-group">
    <label for="attestationURSSAF_Document">Attestation URSSAF*</label>
    <input type="file" id="attestationURSSAF_Document" name="attestationURSSAF_Document"><br><br>
    <label for="dateValiditeAttestURSSAF_Document">Date de validité Attestation URSSAF*</label>
    <input type="date" id="dateValiditeAttestURSSAF_Document" name="dateValiditeAttestURSSAF_Document"><br><br>
  </div>
  <!-- Assurance RC Pro -->
  <div class="form-group">
    <label for="assuranceRcPro_Document">Assurance RC Pro*</label>
    <input type="file" id="assuranceRcPro_Document" name="assuranceRcPro_Document"><br><br>
    <label for="dateValiditeAssuranceRcPro_Document">Date de validité Assurance RC Pro*</label>
    <input type="date" id="dateValiditeAssuranceRcPro_Document" name="dateValiditeAssuranceRcPro_Document"><br><br>
  </div>
  <!-- SIRET -->
  <div class="form-group">
    <label for="siret_Document">SIRET*</label>
    <input type="file" id="siret_Document" name="siret_Document"><br><br>
    <label for="dateValiditeSiret_Document">Date de validité SIRET*</label>
    <input type="date" id="dateValiditeSiret_Document" name="dateValiditeSiret_Document"><br><br>
  </div>
  <!-- Caisse BTP -->
  <div class="form-group">
    <label for="caisseBTP_Document">Caisse BTP*</label>
    <input type="file" id="caisseBTP_Document" name="caisseBTP_Document"><br><br>
    <label for="dateValiditeCaisseBTP_Document">Date de validité Caisse BTP*</label>
    <input type="date" id="dateValiditeCaisseBTP_Document" name="dateValiditeCaisseBTP_Document"><br><br>
  </div>
  <!-- Numéro Fiscal -->
  <div class="form-group">
    <label for="numeroFiscal_Document">Numéro Fiscal*</label>
    <input type="file" id="numeroFiscal_Document" name="numeroFiscal_Document"><br><br>
    <label for="dateValiditeNumFiscal_Document">Date de validité Numéro Fiscal*</label>
    <input type="date" id="dateValiditeNumFiscal_Document" name="dateValiditeNumFiscal_Document"><br><br>
  </div>
  <!-- Numéro TVA -->
  <div class="form-group">
    <label for="numeroTVA_Document">Numéro TVA*</label>
    <input type="file" id="numeroTVA_Document" name="numeroTVA_Document"><br><br>
    <label for="dateValiditeNumTVA_Document">Date de validité Numéro TVA*</label>
    <input type="date" id="dateValiditeNumTVA_Document" name="dateValiditeNumTVA_Document"><br><br>
  </div>
  <!-- Assurance Décennale -->
  <div class="form-group">
    <label for="assurenceDecennale_Document">Assurance Décennale*</label>
    <input type="file" id="assurenceDecennale_Document" name="assurenceDecennale_Document"><br><br>
    <label for="dateValiditeAssurenceDecennale_Document">Date de validité Assurance Décennale*</label>
    <input type="date" id="dateValiditeAssurenceDecennale_Document" name="dateValiditeAssurenceDecennale_Document"><br><br>
  </div>
  
  </div>
      <div class="modal-footer">
        <button class="buttonvalidate" id="ajouter_demande">Ajouter</button>
        <button class="buttonannule" id="btn_annule">Annuler</button>
      </div>
    </div>
  </div>
</div>
<!-- end Model ajout -->
<!-- Model alert ajout succès -->
<div class="modal fade" id="SuccessAddDemande" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un demande</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">          
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
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un demande</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">          
          <center id="adddemande_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout echec -->
<!-- Model suppression -->
<div class="modal fade" id="deleteDemande" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer Demande</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p style="color: #470EE9; font-size: 18px;">Voulez-vous supprimer le demande ?</p><br>
      </div>
        <div class="modal-footer">
					<button type="button" id="btn_delete" class="buttonvalidate">Supprimer</button>
          <button type="button" id="btn_annule" class="buttonannule">Annuler</button>
				</div>
      </div>
    </div>
  </div>
</div>
<!-- end Model suppression -->
<!-- Model alert supprimer succès -->
<div class="modal fade" id="SuccessDeleteDemande" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer Demande</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="deletedemande_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert supprimer succès -->
<!-- Model alert supprimer echec -->
<div class="modal fade" id="EchecDeleteDemande" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer Demande</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="deletedemande_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert supprimer echec -->

</body>
</html>
<?php
include('../footer.php');
?>