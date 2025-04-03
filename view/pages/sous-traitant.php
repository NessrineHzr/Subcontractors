<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<style>
</style>
<div class="table" action="" method="post">
  <div class="table-responsive-xxl" id="table_listeSousTraitant"></div>
</div>
<!-- Model ajout -->
<div class="modal fade bd-example-modal-lg" id="ajoutSoustraitant" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un sous-traitant</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p id="message_soustraitant"></p><br><br>
        <form autocomplete="off" class="form-horizontal">
          <div id="fiche_2row">
            <div class="form-group">
              <label for="nom">Nom*</label>
              <input type="text" id="nom" name="nom"><br><br>
            </div>
            <div class="form-group">
              <label for="nomGerant">Nom Gérant*</label>
              <input type="text" id="nomGerant" name="nomGerant"><br><br>
            </div>
          </div>
          <div id="fiche_2row">
            <div class="form-group">
              <label for="pays">Pays*</label>
              <select id="pays" name="pays">
              <option value="">Sélectionnez une pays</option>
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
            <div class="form-group">
              <label for="adresse">Adresse*</label>
              <input type="text" id="adresse" name="adresse"><br><br>
            </div>
          </div>
          <div id="fiche_2row">
            <div class="form-group">
              <label for="telephone">Téléphone*</label>
              <input type="text" id="telephone" name="telephone"><br><br>
            </div>
            <div class="form-group">
              <label for="email">Email*</label>
              <input type="email" id="email" name="email"><br><br>
            </div>
          </div>
          <div id="fiche_2row">
            <div class="form-group">
              <label for="siret">Siret*</label>
              <input type="text" id="siret" name="siret"><br><br>
            </div>
            <div class="form-group">
              <label for="iban">IBAN*</label>
              <input type="text" id="iban" name="iban"><br><br>
            </div>
          </div>
          <div id="fiche_2row">
            <div class="form-group">
              <label for="typeMission">Type de mission*</label>
              <select id="typeMission" name="typeMission" required>
                <option value="">Sélectionnez une mission</option>
                <option value="Européenne">Européenne</option>
                <option value="Française">Française</option>
              </select><br><br>
            </div>
            <div class="form-group">
              <label for="chefProjet">Chef Projet*</label>
              <select id="chefProjet" name="chefProjet">
                <option value="">Sélectionnez un Chef</option>
                <?php 
                global $connexion;
                $sql = "SELECT id_Salarie ,nom_Salarie ,prenom_Salarie FROM salarie WHERE etat_Salarie='1'";
                $result = mysqli_query($connexion, $sql);
                if ($result) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='". $row['id_Salarie'] ."'>" . $row['nom_Salarie'] . " " . $row['prenom_Salarie'] . "</option>";
                    }
                }
                ?>
              </select><br><br>
            </div>
          </div>
        </form>  
      </div>
      <div class="modal-footer">
        <button class="buttonvalidate" id="ajouter_soustraitant">Ajouter</button>
        <button class="buttonannule" id="btn_annule">Annuler</button>
      </div>
    </div>
  </div>
</div>
<!-- end Model ajout -->
<!-- Model alert ajout succès -->
<div class="modal fade" id="SuccessAddSoustraitant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un sous-traitant</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">          
          <center id="addsoustraitant_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout succès -->
<!-- Model alert ajout echec -->
<div class="modal fade" id="EchecAddSoustraitant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un sous-traitant</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">          
          <center id="addsoustraitant_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout echec -->
 <!-- Modal modification -->
<div class="modal fade" id="modifSoustraitant" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier les informations du sous-traitant</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_Entreprise" name="id_Entreprise">
        <p id="messageup_soustraitant"></p><br><br>
        <div class="form-group">
        <label for="nom_Entreprise">Nom*</label>
        <input type="text" id="nom_Entreprise" name="nom_Entreprise"><br><br>
        </div>
        <div class="form-group">
        <label for="nomGerant_Entreprise">Nom Gérant*</label>
        <input type="text" id="nomGerant_Entreprise" name="nomGerant_Entreprise"><br><br>
        </div>
        <div class="form-group">
        <label for="adresse_Entreprise">Adresse*</label>
        <input type="text" id="adresse_Entreprise" name="adresse_Entreprise"><br><br>
        </div>
        <div class="form-group">
        <label for="pays_Entreprise">Pays*</label>
        <select id="pays_Entreprise" name="pays_Entreprise">
        <option value="">Sélectionnez un pays</option>
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
        <div class="form-group">
        <label for="siret_Entreprise">Siret*</label>
        <input type="text" id="siret_Entreprise" name="siret_Entreprise"><br><br>
        </div>
        <div class="form-group">
        <label for="email_Entreprise">Email*</label>
        <input type="email" id="email_Entreprise" name="email_Entreprise"><br><br>
        </div>
        <div class="form-group">
        <label for="telephone_Entreprise">Téléphone*</label>
        <input type="text" id="telephone_Entreprise" name="telephone_Entreprise"><br><br>
        </div>
        <div class="form-group">
        <label for="iban_Entreprise">IBAN*</label>
        <input type="text" id="iban_Entreprise" name="iban_Entreprise"><br><br>
        </div>
        <div class="form-group">
        <label for="typesMission_Entreprise">Type de mission*</label>
        <select id="typesMission_Entreprise" name="typesMission_Entreprise" required>
          <option value="">Sélectionnez une mission</option>
          <option value="Européenne">Européenne</option>
          <option value="Française">Française</option>
        </select><br><br>
        </div>
        <div class="form-group">
        <label for="chefProjet">Chef Projet*</label>
        <select id="chefProjet" name="chefProjet">
          <?php 
          global $connexion;
          $sql = "SELECT id_Salarie ,nom_Salarie ,prenom_Salarie FROM salarie WHERE etat_Salarie='1'";
          $result = mysqli_query($connexion, $sql);
          if ($result) {
              while($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='". $row['id_Salarie'] ."'>" . $row['nom_Salarie'] . " " . $row['prenom_Salarie'] . "</option>";
              }
          }
          ?>
        </select><br><br>
        </div>
      </div>
      <div class="modal-footer">
        <button class="buttonvalidate" id="modifier_soustraitant">Modifier</button>
        <button class="buttonannule" id="btn_annule">Annuler</button>
      </div>
    </div>
  </div>
</div>
 <!-- End Modal modification -->
<!-- Model alert modification succès -->
<div class="modal fade" id="SuccessUpSoustraitant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier les informations du sous-traitant</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="upsoustraitant_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>  
<!-- end Model alert modification succès -->
<!-- Model alert modification echec -->
<div class="modal fade" id="EchecUpSoustraitant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier les informations du sous-traitant</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="upsoustraitant_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert modification echec -->
<!-- Model suppression -->
<div class="modal fade" id="deleteSoustraitant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer Sous-traitant</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p style="color: #470EE9; font-size: 18px;">Voulez-vous supprimer le sous-traitant ?</p><br>
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
<div class="modal fade" id="SuccessDeleteSoustraitant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer Sous-traitant</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="deletesoustraitant_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert supprimer succès -->
<!-- Model alert supprimer echec -->
<div class="modal fade" id="EchecDeleteSoustraitant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer Sous-traitant</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="deletesoustraitant_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert supprimer echec -->
<!-- Model affiche info chef projet -->
<div class="modal fade" id="affiche_chefProjet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Information de chef de projet</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="info_chefProjet"></center>  
        </div>
        <div class="modal-footer">
          <button type="button" id="btn_annule" class="buttonannule">Fermer</button>
				</div>
      </div>
    </div>
  </div>
</div> 
<!-- end Model affiche info chef projet -->

</body>
</html>
<?php
include('../footer.php');
?>