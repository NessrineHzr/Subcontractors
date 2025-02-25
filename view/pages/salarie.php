<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<link rel="stylesheet" href="../../public/css/app.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<style>
    .file-container {
        display: flex;
        flex-direction: row;
    }

    .file-container label {
        font-size: 17px;
        color: #470EE9;
       }

    .file-container a img {
        width: 80%; 
        margin-top:70%;
    }

</style>
<div class="table" action="" method="post">
  <div class="table-responsive-xxl" id="table_listeSalarie"></div>
</div>
<!-- Model ajout -->
<div class="modal fade" id="ajoutSalarie" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <label for="nom">Nom*</label>
        <input type="text" id="nom" name="nom"><br><br>
        <label for="prenom">Prénom*</label>
        <input type="text" id="prenom" name="prenom"><br><br>
        <label for="dateNaissance">Date de naissance*</label>
        <input type="date" id="dateNaissance" name="dateNaissance"><br><br>
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
        <label for="poste">Poste*</label>
        <input type="text" id="poste" name="poste"><br><br>
        <label for="typeMission">Type de mission*</label>
        <select id="typeMission" name="typeMission" required>
          <option value="">Sélectionnez une mission</option>
          <option value="européenne">Européenne</option>
          <option value="française">Française</option>
        </select><br><br>
        <label for="piece_identite">Piece d'identité*</label>
        <input type="file" id="piece_identite" name="piece_identite"><br><br>
        <label for="dpae">DPAE*</label>
        <input type="file" id="dpae" name="dpae"><br><br>
        <label for="permit">Permis de conduire</label>
        <input type="file" id="permit" name="permit"><br><br>
        <label for="certificat_a1">Certificat A1*</label>
        <input type="file" id="certificat_a1" name="certificat_a1"><br><br>
        <label for="certificat_zoll">Certificat Zoll*</label>
        <input type="file" id="certificat_zoll" name="certificat_zoll"><br><br>
        <label for="photo">Photo*</label>
        <input type="file" id="photo" name="photo"><br><br>
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
        <h2 class="modal-title" style="color: #470EE9; ">Modifier les informations du salarié</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="id_Salarie" name="id_Salarie">
          <label for="nom_Salarie">Nom</label>
          <input type="text" id="nom_Salarie"><br><br>
          <label for="prenom_Salarie">Prénom</label>
          <input type="text" id="prenom_Salarie"><br><br>
          <label for="dateNaissance_Salarie">Date de naissance</label>
          <input type="date" id="dateNaissance_Salarie"><br><br>
          <label for="nationalite_Salarie">Nationalité</label>
          <select id="nationalite_Salarie" name="nationalite_Salarie">
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
          <label for="poste_Salarie">Poste</label>
          <input type="text" id="poste_Salarie"><br><br>
          <label for="typeMission_Salarie">Mission</label>
          <select id="typeMission_Salarie">
            <option value="européenne">Européenne</option>
            <option value="française">Française</option>
          </select> 
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
          <label for="pieceid_Salarie">Piece d'identité:</label>
          <input  id="pieceid_Salarie" type="hidden">
          <a href="#" id="link_pieceid"><img src="../img/piece_jointe.png" ></a>

          <label for="dpae_Salarie">DPAE:</label>
          <input id="dpae_Salarie" type="hidden">
          <a href="#" id="link_dpae"><img src="../img/piece_jointe.png" ></a>

          <label for="permis_Salarie">Permis de conduire:</label>
          <input id="permis_Salarie" type="hidden">
          <a href="#" id="link_permis"><img src="../img/piece_jointe.png" ></a>

          <label for="certifa1_Salarie">Certificat A1:</label>
          <input id="certifa1_Salarie" type="hidden">
          <a href="#" id="link_certifa1"><img src="../img/piece_jointe.png" ></a>

          <label for="certifzoll_Salarie">Certificat Zoll:</label>
          <input id="certifzoll_Salarie" type="hidden">
          <a href="#" id="link_certifzoll"><img src="../img/piece_jointe.png" ></a>

          <label for="photo_Salarie">Photo:</label>
          <input id="photo_Salarie" type="hidden">
          <a href="#" id="link_photo"><img src="../img/piece_jointe.png" ></a>
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
                window.location.href = `../file/${inputValue}`;
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