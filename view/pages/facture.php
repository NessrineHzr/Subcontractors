<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$id = $_SESSION['ID'];
$role = $_SESSION['Role'];
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<div class="table" action="" method="post">
  <div class="table-responsive-xxl" id="table_listeFacture"></div>
</div>

<!-- Model ajout -->
<div class="modal fade bd-example-modal-lg" id="ajoutFacture" tabindex="-1" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter une facture</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p id="message_facture"></p><br><br>
            <div class="form-group">
              <label for="nom">Nom*</label>
              <select id="nom" name="nom">
                <option value="">Sélectionnez un nom</option>
                <?php 
                global $connexion;
                $sql = "SELECT id_Entreprise ,nom_Entreprise FROM entreprise WHERE etat_Entreprise='1' ";
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
              <label for="date">Date*</label>
              <input type="date" id="date" name="date"><br><br>
            </div>
            <div class="form-group">
              <label for="montant">Montant*</label>
              <input type="text" id="montant" name="montant"><br><br>
            </div> 
      </div>
      <div class="modal-footer">
        <button class="buttonvalidate" id="ajouter_facture">Ajouter</button>
        <button class="buttonannule" id="btn_annule">Annuler</button>
      </div>
    </div>
  </div>
</div>
<!-- end Model ajout -->
<!-- Model alert ajout succès -->
<div class="modal fade" id="SuccessAddFacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter une facture</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">          
          <center id="addfacture_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout succès -->
<!-- Model alert ajout echec -->
<div class="modal fade" id="EchecAddFacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter une facture</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">          
          <center id="addfacture_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout echec -->
 <!-- Model ajout reglement -->
<div class="modal fade bd-example-modal-lg" id="ajoutReglement" tabindex="-1" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter une réglement</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p id="message_reglement"></p><br><br>
            <div class="form-group">
              <label for="id">Facture*</label>
              <select id="id" name="id">
                <option value="">Sélectionnez une facture</option>
                <?php 
                global $connexion;
                $sql = "SELECT id_Facture ,nom_Entreprise FROM entreprise,facture WHERE entreprise.id_Entreprise=facture.idEntreprise_Facture AND entreprise.etat_Entreprise='1' ";
                $result = mysqli_query($connexion, $sql);
                if ($result) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='". $row['id_Facture'] ."'>" . $row['nom_Entreprise'] . "</option>";
                    }
                }
                ?>
              </select><br><br>            
            </div>
            <div class="form-group">
              <label for="file">Pièce jointe*</label>
              <input type="file" id="file" name="file"><br><br>
            </div>
            <div class="form-group">
              <label for="mont">Montant*</label>
              <input type="text" id="mont" name="mont"><br><br>
            </div> 
      </div>
      <div class="modal-footer">
        <button class="buttonvalidate" id="ajouter_reglement">Ajouter</button>
        <button class="buttonannule" id="btn_annule">Annuler</button>
      </div>
    </div>
  </div>
</div>
<!-- end Model ajout reglement -->
<!-- Model alert ajout succès reglement -->
<div class="modal fade" id="SuccessAddReglement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter une réglement</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">          
          <center id="addreglement_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout succès reglement -->
<!-- Model alert ajout echec reglement -->
<div class="modal fade" id="EchecAddReglement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter une réglement</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">          
          <center id="addreglement_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert ajout echec reglement -->
 <!-- Modal modification -->
<div class="modal fade" id="modifFacture" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier les informations du facture</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_Facture" name="id_Facture">
        <p id="messageup_facture"></p><br><br>
            <div class="form-group">
              <label for="nom_Facture">Nom*</label>
              <select id="nom_Facture" name="nom_Facture">
                <?php 
                global $connexion;
                $sql = "SELECT id_Entreprise ,nom_Entreprise FROM entreprise WHERE etat_Entreprise='1' ";
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
              <label for="date_Facture">Date*</label>
              <input type="date" id="date_Facture" name="date_Facture"><br><br>
            </div>
            <div class="form-group">
              <label for="montant_Facture">Montant*</label>
              <input type="text" id="montant_Facture" name="montant_Facture"><br><br>
            </div>
      </div>
      <div class="modal-footer">
        <button class="buttonvalidate" id="modifier_facture">Modifier</button>
        <button class="buttonannule" id="btn_annule">Annuler</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal modification -->
<!-- Model alert modification succès -->
<div class="modal fade" id="SuccessUpFacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier les informations du facture</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px;">
          <center id="upfacture_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>  
<!-- end Model alert modification succès -->
<!-- Model alert modification echec -->
<div class="modal fade" id="EchecUpFacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Modifier les informations du facture</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px;">
          <center id="upfacture_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert modification echec -->
<!-- Model suppression -->
<div class="modal fade" id="deleteFacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer facture</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <p style="font-size: 18px;">Voulez-vous supprimer la facture ?</p><br>
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
<div class="modal fade" id="SuccessDeleteFacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer Facture</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px;">
          <center id="deletefacture_success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert supprimer succès -->
<!-- Model alert supprimer echec -->
<div class="modal fade" id="EchecDeleteFacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Supprimer facture</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px;">
          <center id="deletefacture_echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model alert supprimer echec -->
</Body>
<script>
   var role = <?php echo $role ?>;
</script>
</html>
<?php
include('../footer.php');
?>