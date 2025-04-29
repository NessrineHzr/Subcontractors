<?php
include('../header_menu.php');
$id = $_SESSION['ID'];
$role = $_SESSION['Role'];
$login = $_SESSION['Login'];
$Nom = $_SESSION['Nom'];
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../../public/js/chart.js"></script>

<div class="cadre">
    <div class="cadre1">
        <div class="entete">
            <h2 class="nom">Bonjour <?php echo $Nom; ?> !</h2>
            <?php if($role=="1"){?><button class='btn-add' id="ajout_soustraitant" style='font-size: 15px;'>+ Ajouter un sous-traitant</button> <?php } ?>
            <?php if($role=="2"){?><button class='btn-add' id="ajout_salarie" style='font-size: 15px;'>+ Ajouter un salarie</button> <?php } ?>
          </div>
        <br>
        <div class="entete">
            <h3 style="font-size: 23px;" class="nom">Récentes demandes</h3>
            <button type="button" id="voir_tout" class="btn_voir" onclick="window.location.href='demande.php';">Voir tout</button>
            </div>
        <div class="table" action="" method="post">
            <div class="table-salarie" id="table_listeDemandeDashboard"></div>
        </div>
        <br><br>
        <div class="entete">
            <h3 class="nom">Documents qui arrivent en fin de validité</h3>
            <button type="button" id="btn_selectionner" class="btn_selectionner" >Selectionner tous</button>
        </div>
        <div class="table" action="" method="post">
            <div class="table-salarie" id="table_listeDocumentDashboard"></div>
        </div>
        <input type='file' id='DocInput' hidden>
<!-- Model ajout sous-traitant -->
<div class="modal fade bd-example-modal-lg" id="ajoutSoustraitant" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un sous-traitant</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p id="message_soustraitant"></p><br><br>
            <div class="form-group">
              <label for="nom">Nom*</label>
              <input type="text" id="nom" name="nom"><br><br>
            </div>
        <form autocomplete="off" class="form-horizontal">
          <div id="fiche_2row">
            <div class="form-group">
              <label for="nomGerant">Nom Gérant*</label>
              <input type="text" id="nomGerant" name="nomGerant"><br><br>
            </div>
            <div class="form-group">
              <label for="prenomGerant">Prénom Gérant*</label>
              <input type="text" id="prenomGerant" name="prenomGerant"><br><br>
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
 <!-- Model ajout salarie -->
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
                <option value="européenne">Européenne</option>
                <option value="française">Française</option>
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
<!-- Model affiche document -->
        <div class="modal fade bd-example-modal-lg" id="afficheDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" style="color: #470EE9; margin: 0;">Tous les documents qui arrivent en fin de validité</h2>
                <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
              </div><br>
              <div class="modal-body">
                <div id="table_listeAllDocumentDashboard"></div><br>
              </div>
              <div class="modal-footer">
                <button class="buttonannule" id="btn_annule">Fermer</button>
              </div>
            </div>
          </div>
        </div>
<!-- end Model affiche document -->
 <!-- Model modif validity document -->
<div class="modal fade" id="updateValidityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier la date de validité</h2><br>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
      <form id="validityForm">
            <div class="form-group" >
               <label for="newValidityDate" >Nouvelle date de validité :</label><br>
               <input type="date" class="form-control" id="validityDate" ><br>
            </div>
         </form>
      </div>
      <div class="modal-footer">
         <button class="buttonannule" id="btn_annule">Annuler</button>
         <button type="button" class="buttonvalidate" id="submitValidity">Valider</button>
      </div>
    </div>
  </div>
</div>
<!-- end Model modif validity document -->
<!-- Model alert modification succès -->
<div class="modal fade" id="successUpdateValidity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier les documents qui arrivent en fin de validité</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="Validity_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>  
<!-- end Model alert modification succès -->
<!-- Model alert modification echec -->
<div class="modal fade" id="EchecUpdateValidity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier les documents qui arrivent en fin de validité</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="Validity_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert modification echec -->

    </div>
  <div class="cadre2">
    <div class="selectt">
      <select id="liste" name="liste">
        <option value="1">Aujourd'hui</option>
        <option value="6">Cette semaine</option>
        <option value="29">Ce mois</option>
      </select>
    </div> 
    <div class="stats">
      <div class="stat-item">
        <div class="stat-row">
          <div class="stat-text">
            <span class="stat-nbr" id="stat_nbr1">0</span>
            <?php if($role=="1"){?><span class="stat-label">Nouveaux sous-traitants</span><?php } ?>
            <?php if($role=="2"){?><span class="stat-label">Nouveaux salaries</span><?php } ?>
          </div>
          <img src="../img/stat.png" alt="stat" class="stat-img">
        </div>
        <hr><br>
        <div class="stat-row">
          <div class="stat-text">
            <span class="stat-nbr" id="stat_nbr2">0</span>
            <span class="stat-label">Documents vérifiés</span>
          </div>
          <img src="../img/stat.png" alt="stat" class="stat-img">
        </div>
      </div>
    </div>
    <div class="stats">
        <div class="stat-item">
          <span class="stat-label"><center>Mission Française</center></span><br>
          <center><canvas id="francaiseChart" width="130" height="130"></canvas></center><br>
          <div class="stat-label">
          <?php if($role=="1"){?><span id="nbr_francaise">0</span><span style="font-weight: normal; font-size: 17px" > - Sous-traitants</span><br><?php } ?>
          <?php if($role=="2"){?><span id="nbr_francaise">0</span><span style="font-weight: normal; font-size: 17px" > - Salaries</span><br><?php } ?>
          </div>
        </div>
      </div>
      <div class="stats">
        <div class="stat-item">
          <span class="stat-label"><center>Mission Européenne</center></span><br>
          <center><canvas id="europeenneChart" width="130" height="130"></canvas></center><br>
          <div class="stat-label">
          <?php if($role=="1"){?><span id="nbr_europeenne">0</span><span style="font-weight: normal; font-size: 17px" > - Sous-traitants</span><br><?php } ?>
          <?php if($role=="2"){?><span id="nbr_europeenne">0</span><span style="font-weight: normal; font-size: 17px" > - Salaries</span><br><?php } ?>
          </div>
        </div>
  </div>
</div>
</body>
</html>
<?php
include('../footer.php');
?>