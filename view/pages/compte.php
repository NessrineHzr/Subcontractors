<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$sql= "SELECT id_Utilisateur, nom_Utilisateur, prenom_Utilisateur, email_Utilisateur, telephone_Utilisateur, adresse_Utilisateur, role_Utilisateur, etat_Utilisateur FROM utilisateur";
$result = mysqli_query($connexion, $sql);
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<div class="entete">
  <h2 style="font-size: 23px;" class="nom">Tous les comptes</h2><br><br>
  <button class='btn-add' id="ajout_compte" style='font-size: 15px;'>Ajouter un compte</button>
</div><br>

<!-- Model ajout -->
<div class="modal fade bd-example-modal-lg" id="ajoutCompte" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un compte</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p id="message_soustraitant"></p><br><br>
        <form autocomplete="off" class="form-horizontal">
          <div id="fiche_2row">
            <div class="form-group">
              <label for="login">Login*</label>
              <input type="text" id="login" name="login"><br><br>
            </div>
            <div class="form-group">
              <label for="mdp">Mot de passe*</label>
              <input type="password" id="mdp" name="mdp"><br><br>
            </div>
          </div>
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
              <label for="email">Email*</label>
              <input type="email" id="email" name="email"><br><br>
            </div>
            <div class="form-group">
              <label for="telephone">Téléphone*</label>
              <input type="text" id="telephone" name="telephone"><br><br>
            </div>
          </div>
          <div id="fiche_2row">
            <div class="form-group">
              <label for="adresse">Adresse*</label>
              <input type="text" id="adresse" name="adresse"><br><br>
            </div>
            <div class="form-group">
            </div>
          </div>
        </form>  
      </div>
      <div class="modal-footer">
        <button class="buttonvalidate" id="ajouter_compte">Ajouter</button>
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
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un compte</h2>
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
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un compte</h2>
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

<table id="table_listeCompte" class="table-salarie">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Email</th>
      <th>Téléphone</th>
      <th>Adresse</th>
      <th>Rôle</th>
      <th style="text-align: center;">Statut</th>
      <th style="text-align: center;">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id_Utilisateur'];
      $nom = $row['nom_Utilisateur'];
      $prenom = $row['prenom_Utilisateur'];
      $mail = $row['email_Utilisateur'];
      $telephone = $row['telephone_Utilisateur'];
      $adresse = $row['adresse_Utilisateur'];
      $role = $row['role_Utilisateur'];
      $status = $row['etat_Utilisateur'];
      if ($role == '1'){
        $role_log="Administrateur"; 
      }else {
        $role_log="Sous-traitant";
      }

      $statusClass = ($status == '1') ? 'mission mission-europeenne' : 'mission';
      $typesStatus = ($status == '1') ? 'Actif' : 'Inactif';
      if ($status == '1') {
        $btnLabel = "<i class='fas fa-user-lock'></i>";
        $newStatus = 0;
      } else {
        $btnLabel = "<i class='fa-solid fa-unlock'></i>";
        $newStatus = 1;
      }
    ?>
      <tr>
        <td><?php echo $nom; ?></td>
        <td><?php echo $prenom; ?></td>
        <td><?php echo $mail; ?></td>
        <td><?php echo $telephone; ?></td>
        <td><?php echo $adresse; ?></td>
        <td><?php echo $role_log; ?></td>
        <td>
          <div class="<?php echo $statusClass; ?>">
            <?php echo $typesStatus; ?>
          </div>
        </td>
        <td style="text-align: center;">
          <button type="button"  class="btn_status modifier_icon" data-id="<?php echo $id; ?>" data-status="<?php echo $newStatus; ?>"><?php echo $btnLabel; ?></button>
        </td>
      </tr>
    <?php
    }
  ?>
  </tbody>
</table>
</body>
</html>
<?php
include('../footer.php');
?>
