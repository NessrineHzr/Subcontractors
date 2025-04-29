<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<div class="table" action="" method="post">
  <div class="table-responsive-xxl" id="table_listeSalarie"></div>
</div>
<!-- Model ajout -->
<div class="modal fade bd-example-modal-lg" id="ajoutSalarie" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p id="message_salarie"></p><br><br>
        <form autocomplete="off" class="form-horizontal">
          <div id="fiche_2row">
            <div class="form-group">
              <label for="nom">Nom*</label>
              <input type="text" id="nom" name="nom"><br><br>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom*</label>
              <input type="text" id="prenom" name="prenom"><br><br>
            </div>
          </div>
          <div id="fiche_2row">
            <div class="form-group">
              <label for="dateNaissance">Date de naissance*</label>
              <input type="date" id="dateNaissance" name="dateNaissance"><br><br>
            </div>
            <div class="form-group">
              <label for="nationalite">Nationalité*</label>
              <select id="nationalite" name="nationalite">
              <option value="">Sélectionnez une nationalité</option>
                <?php 
                global $connexion;
                $sql = "SELECT libelle_Nationalite FROM nationalite";
                $result = mysqli_query($connexion, $sql);
                if ($result) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='". $row['libelle_Nationalite'] ."'>" . $row['libelle_Nationalite'] . "</option>";
                    }
                }
                ?>
              </select><br><br>
            </div>
          </div>
          <div id="fiche_2row">
            <div class="form-group">
              <label for="poste">Poste*</label>
              <input type="text" id="poste" name="poste"><br><br>
            </div>
            <div class="form-group">
             <label for="typeMission">Type de mission*</label>
              <select id="typeMission" name="typeMission" required>
                <option value="">Sélectionnez une mission</option>
                <option value="Européenne">Européenne</option>
                <option value="Française">Française</option>
              </select><br><br>
            </div>
          </div>
          <div id="fiche_2row">
            <div class="form-group">
              <label for="piece_identite">Piece d'identité*</label>
              <input type="file" id="piece_identite" name="piece_identite"><br><br>
            </div>
            <div class="form-group">
              <label for="dpae">DPAE*</label>
              <input type="file" id="dpae" name="dpae"><br><br>
            </div>
          </div>
          <div id="fiche_2row">
            <div class="form-group">
              <label for="permit">Permis de conduire</label>
              <input type="file" id="permit" name="permit"><br><br>
            </div>
            <div class="form-group">
              <label for="certificat_a1">Certificat A1*</label>
              <input type="file" id="certificat_a1" name="certificat_a1"><br><br>
            </div>
          </div>
          <div id="fiche_2row">
            <div class="form-group">
              <label for="certificat_zoll">Certificat Zoll*</label>
              <input type="file" id="certificat_zoll" name="certificat_zoll"><br><br>
            </div>
            <div class="form-group">
              <label for="photo">Photo*</label>
              <input type="file" id="photo" name="photo"><br><br>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="buttonvalidate" id="ajouter_salarie">Ajouter</button>
        <button class="buttonannule" id="btn_annule">Annuler</button>
      </div>
    </div>
  </div>
</div>
<!-- end Model ajout -->
<!-- Model alert ajout succès -->
<div class="modal fade" id="SuccessAddSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">          
          <center id="addsalarie_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout succès -->
<!-- Model alert ajout echec -->
<div class="modal fade" id="EchecAddSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">          
          <center id="addsalarie_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout echec -->
<!-- Model modification -->
<div class="modal fade" id="updateSalarie" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9;">Modifier les informations du salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_Salarie" name="id_Salarie">
        <p id="messageup_salarie"></p><br>
        
        <div id="fiche_2row">
          <div class="form-group">
            <label for="nom_Salarie">Nom</label>
            <input type="text" id="nom_Salarie"><br><br>
          </div>
          <div class="form-group">
            <label for="prenom_Salarie">Prénom</label>
            <input type="text" id="prenom_Salarie"><br><br>
          </div>
        </div>

        <div id="fiche_2row">
          <div class="form-group">
            <label for="dateNaissance_Salarie">Date de naissance</label>
            <input type="date" id="dateNaissance_Salarie"><br><br>
          </div>
          <div class="form-group">
            <label for="nationalite_Salarie">Nationalité</label>
            <select id="nationalite_Salarie" name="nationalite_Salarie">
              <option value="">Sélectionnez la nationalité</option>
              <?php 
                global $connexion;
                $sql = "SELECT libelle_Nationalite FROM nationalite";
                $result = mysqli_query($connexion, $sql);
                if ($result) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='". $row['libelle_Nationalite'] ."'>" . $row['libelle_Nationalite'] . "</option>";
                    }
                }
              ?>
            </select><br><br>
          </div>
        </div>
        <div id="fiche_2row">
          <div class="form-group">
            <label for="poste_Salarie">Poste</label>
            <input type="text" id="poste_Salarie"><br><br>
          </div>
          <div class="form-group">
            <label for="typeMission_Salarie">Mission</label>
            <select id="typeMission_Salarie">
              <option value="Européenne">Européenne</option>
              <option value="Française">Française</option>
            </select> 
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="update_salarie" class="buttonvalidate">Enregistrer</button>
        <button class="buttonannule" id="btn_annule">Annuler</button>
      </div>
    </div>
  </div>
</div>
<!-- end Model modification -->
<!-- Model alert modification succès -->
<div class="modal fade" id="SuccessUpSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier les informations du salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="upsalarie_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>  
<!-- end Model alert modification succès -->
<!-- Model alert modification echec -->
<div class="modal fade" id="EchecUpSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier les informations du salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="upsalarie_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert modification echec -->
<!-- Model suppression -->
<div class="modal fade" id="deleteSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer Salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p style="color: #470EE9; font-size: 18px;">Voulez-vous supprimer le client ?</p><br>
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
<div class="modal fade" id="SuccessDeleteSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer Salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="deletesalarie_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert supprimer succès -->
<!-- Model alert supprimer echec -->
<div class="modal fade" id="EchecDeleteSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer Salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="deletesalarie_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert supprimer echec -->
<!-- model affiche document salaries -->
<div class="modal fade" id="documentSalarie" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content-2" style="max-width: 60%;" >
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; ">Documents du salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body" >
        <div class="file-container">
          <input type="hidden" id="id_Salarie" name="id_Salarie">
          <div class="documents_s">

          <div class="document_s">
            <label for="pieceid_Salarie" class="titre">Pièce d'identité :</label>
            <input id="pieceid_Salarie" type="hidden">
            <div class="image-container">
              <a href="#" id="link_pieceid" class="doc"><img src="../img/doc.png" alt="Document"></a>
              <label for="file_pieceid" class="telecharger"><img src="../img/edit.png" alt="Modifier"></label>
              <input type="file" id="file_pieceid" class="update_document" data-doc="pieceIdentite_Salarie" hidden>
            </div>
          </div>

          <div class="document_s">
            <label for="dpae_Salarie" class="titre">DPAE :</label>
            <input id="dpae_Salarie" type="hidden">
            <div class="image-container">
              <a href="#" id="link_dpae" class="doc"><img src="../img/doc.png" alt="Document"></a>
              <label for="file_dpae" class="telecharger"><img src="../img/edit.png" alt="Modifier"></label>
              <input type="file" id="file_dpae" class="update_document" data-doc="dpae_Salarie" hidden>
            </div>
          </div>

          <div class="document_s">
            <label for="permis_Salarie" class="titre">Permis de conduire :</label>
            <input id="permis_Salarie" type="hidden">
            <div class="image-container">
              <a href="#" id="link_permis" class="doc"><img src="../img/doc.png" alt="Document"></a>
              <label for="file_permis" class="telecharger"><img src="../img/edit.png" alt="Modifier"></label>
              <input type="file" id="file_permis" class="update_document" data-doc="permit_Salarie" hidden>
            </div>
          </div>

          <div class="document_s">
            <label for="certifa1_Salarie" class="titre">Certificat A1 :</label>
            <input id="certifa1_Salarie" type="hidden">
            <div class="image-container">
              <a href="#" id="link_certifa1" class="doc"><img src="../img/doc.png" alt="Document"></a>
              <label for="file_certifa1" class="telecharger"><img src="../img/edit.png" alt="Modifier"></label>
              <input type="file" id="file_certifa1" class="update_document" data-doc="certificatA1_Salarie" hidden>
            </div>
          </div>

          <div class="document_s">
            <label for="certifzoll_Salarie" class="titre">Certificat Zoll :</label>
            <input id="certifzoll_Salarie" type="hidden">
            <div class="image-container">
              <a href="#" id="link_certifzoll" class="doc"><img src="../img/doc.png" alt="Document"></a>
              <label for="file_certifzoll" class="telecharger"><img src="../img/edit.png" alt="Modifier"></label>
              <input type="file" id="file_certifzoll" class="update_document" data-doc="certificatZoll_Salarie" hidden>
            </div>
          </div>

          <div class="document_s">
            <label for="photo_Salarie" class="titre">Photo :</label>
            <input id="photo_Salarie" type="hidden">
            <div class="image-container">
              <a href="#" id="link_photo" class="doc"><img src="../img/doc.png" alt="Photo"></a>
              <label for="file_photo" class="telecharger"><img src="../img/edit.png" alt="Modifier"></label>
              <input type="file" id="file_photo" class="update_document" data-doc="photo_Salarie" hidden>
            </div>
          </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
</div>
</body>
</html>
<script>
    function handleLinkClick(inputId) {
        return function(event) {
            event.preventDefault(); // Empêcher la navigation immédiate
            const inputValue = document.getElementById(inputId).value.trim();
            if (inputValue) {
                window.open(`../file/${inputValue}`, "_blank");
            }
        };
    }
    document.getElementById('link_pieceid').addEventListener('click', handleLinkClick('pieceid_Salarie'));
    document.getElementById('link_dpae').addEventListener('click', handleLinkClick('dpae_Salarie'));
    document.getElementById('link_permis').addEventListener('click', handleLinkClick('permis_Salarie'));
    document.getElementById('link_certifa1').addEventListener('click', handleLinkClick('certifa1_Salarie'));
    document.getElementById('link_certifzoll').addEventListener('click', handleLinkClick('certifzoll_Salarie'));
    document.getElementById('link_photo').addEventListener('click', handleLinkClick('photo_Salarie'));
</script>
<?php
include('../footer.php');
?>