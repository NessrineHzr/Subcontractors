<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
?>

<!DOCTYPE html>
<html lang="fr">
<body>
<style>
  /* fenetre 1 */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4); 
}

.modal-content {
  background-color: #fff;
  margin: 8% auto; 
  padding: 20px;
  border: 1px solid #888;
  width: 40%;
  border-radius: 5px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  position: relative;
}

.modal-content h2 {
  color: #612cf3;
  margin-left: 35%;
  font-size: 28px;
}

.close {
  color: #aaa;
  position: absolute;
  top: 20px;
  right: 20px;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color:  #000;
  text-decoration: none;
}

.modal input , select {
  width: 100%;
  padding: 8px;
  margin: 5px 0 7px 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  border-color: #470EE9 ;
}

input[type="button"],
input[type="reset"] {
  border: none;
  padding: 10px 20px;
  margin: 5px;
  border-radius: 4px;
  cursor: pointer;
}

.boutton {
  background-color: #470EE9;
  color: white;
  padding: 10px;
  font-size: 20px;
  position: absolute; 
  right: 50px;
  top: 170px;
}




/* fenetre d'ajout */
.modal_2 {
    display: flex; 
    justify-content: center;
    align-items: center;
    position: fixed; 
    z-index: 2;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4); 
}

.modal-content_2 {
    color: #612cf3;
    background-color: #fff;
    width: 350px;
    height: 350px; 
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
    gap: 20px;
    margin-left: 750px; 
    margin-top:280px
}


#modal_message_2 {
    display: none;
}

.close-message_2 {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close-message_2:hover,
.close-message_2:focus {
    color: #000;
    text-decoration: none;
}

.form-buttons_2 {
    display: flex;
    flex-direction: column; 
    align-items: center;
    gap: 10px;
    width: 100%;
}

#ajouter_autre_salarie, 
#fermer_message_2 {
    width: 80%; 
    padding: 12px;
    border-radius: 4px;
    font-size: 16px;
    text-align: center;
    cursor: pointer;
    font-weight: bold;
}

#ajouter_autre_salarie {
    background-color: #612cf3;
    color: white;
    border: none;
}

#fermer_message_2 {
    background-color: white;
    color: #612cf3;
    border: 2px solid #612cf3;
}

.table h1 {
  font-size: 24px;
  margin-bottom: 15px;
  text-align: left; 
}

.table-salarie {
  background-color: white; 
  width: 100%;
  border-collapse: collapse;
}

.table-salarie thead th {
  font-weight: bold;
  font-size: 14px;
}
.table-salarie thead tr {
  background-color: #f4f4f4;
}

.table-salarie th, .table-salarie td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 5px solid #f4f4f4;
  vertical-align: middle;
}

.table-salarie tbody tr:hover {
  background-color: #f4f4f4;
}

.icon-button {
  background: none;
  border: none;
  cursor: pointer;
  color: #612cf3;
  font-size: 16px;
  padding: 6px;
}

.fa-eye {
  color: #612cf3; 
}
/* fenetre d'update */
.modal3 {
    display: none;
    justify-content: center;
    align-items: center;
    position: fixed;
    z-index: 2;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content3 {
    background-color: #fff;
    width: 600px; 
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    position: relative;
    display: flex;
    flex-direction: column;
    text-align: left;
    gap: 20px;
    margin-left: 700px; 
    margin-top:180px;
}

.modal-content3 h2 {
    color: #612cf3;
    font-size: 25px;
    margin-bottom: 10px;
    text-align: center;
}

.modal3 input,
.modal3 select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    box-sizing: border-box;
    border-color: #470EE9 ;
}

.modal3 button {
    padding: 10px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    font-weight: bold;
    margin-top: 20px;
    margin-right: 20px;
    width: 30%;
}

#update_salarie {
    background-color: #612cf3;
    color: white;
}

#annuler_update {
    background-color: white;
    color: #612cf3;
    border: 1px solid #612cf3;
    margin-left: 31.7%;
}
.modifier, .supprimer {
    padding: 8px 12px;
    font-size: 14px;
    font-weight: bold;
    border: none;
    cursor: pointer;
    transition: 0.3s ease;
}
.modifier {
    background-color:#513ede;
    color: white;
}

.modifier:hover {
    background-color:#7545f9;
}

.supprimer {
    background-color:#513ede;
    color: white;
    margin-left: 10px;
}

.supprimer:hover {
    background-color: #7545f9;
}
.mission-europeenne {
  border-radius: 60px;
  border-color : rgba(241, 136, 220, 0.44);
  background-color:rgba(241, 136, 220, 0.44);
  color:rgb(235, 57, 199) ;
}
.mission:not(.mission-europeenne) {
  border-radius: 60px;
  border-color: rgba(88, 189, 236, 0.32);
  background-color: rgba(88, 189, 236, 0.32);
  color: rgb(37, 185, 243);
}
.close3 {
  color: #aaa;
  position: absolute;
  top: 27px;
  right: 20px;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close3:hover,
.close3:focus {
  color:  #000;
  text-decoration: none;
}

/* fenetre supprimer */
.modal_4 {
    display: none;
    position: fixed;
    z-index: 2;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content_4 {
    color: #612cf3;
    background-color: #fff;
    width: 350px;
    height: auto;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    position: relative;
    padding: 20px;
    margin: 15% auto;
    text-align: center;
}

.close-message_4 {
    color: #aaa;
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 15px;
}
#modal_message_text_4{
  margin-top: 20px;
}
.form-buttons_4 {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 5px;
}

#supprimer_salarie {
    background-color: #612cf3;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
}

#annuler_supprimer {
    background-color: white;
    color: #612cf3;
    border: 1px solid #612cf3;
    padding: 10px;
    cursor: pointer;
}
.btn-success ,.btn-error{
  background-color: #612cf3;
  color: white;
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
        <h3 class="modal-title" style="color: #470EE9; margin: 0;">Ajouter un salarié</h3>
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
        <input type="text" id="nationalite" name="nationalite"><br><br>
        <label for="poste">Poste*</label>
        <input type="text" id="poste" name="poste"><br><br>
        <label for="typeMission">Type de mission*</label>
        <select id="typeMission" name="typeMission" required>
          <option value="">Sélectionnez une mission</option>
          <option value="européenne">Européenne</option>
          <option value="française">Française</option>
        </select><br><br>
      </div>
      <div class="modal-footer">
        <button class="buttonvalidate" id="ajouter_salarie">Ajouter</button>
        <button class="buttonannule" id="btn_annule">Annuler</button>
      </div>
    </div>
  </div>
</div>

<!-- end Model ajout -->
<!-- Model alert modification succès -->
<div class="modal fade" id="SuccessAddSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content3">
      <h2>Ajouter un salarié</h2>
      <span class="close3">&times;</span>
      <div style="font-size:20px; margin-top:109px;">
          <center id="addsalarie_success"></center>  
      </div>
    </div>
  </div>
</div>
<!-- end Model alert modification succès -->
<!-- Model alert modification echec -->
<div class="modal fade" id="EchecAddSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content3">
      <h2>Ajouter un salarié</h2>
      <span class="close3">&times;</span>
      <div style="font-size:20px; margin-top:109px;">
          <center id="addsalarie_echec"></center>  
      </div>
    </div>
  </div>
</div>
<!-- end Model alert modification echec -->
<!-- Model modification -->
<div class="modal fade bd-example-modal-lg" id="updateSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content3">
      <h2>Modifier les informations du salarié</h2>
      <span class="close3">&times;</span>
      <form id="updateSalarieForm">
        <input type="hidden" id="id_Salarie" name="id_Salarie">

        <label for="nom_Salarie">Nom</label>
        <input type="text" id="nom_Salarie">

        <label for="prenom_Salarie">Prénom</label>
        <input type="text" id="prenom_Salarie">

        <label for="dateNaissance_Salarie">Date de naissance</label>
        <input type="date" id="dateNaissance_Salarie">

        <label for="nationalite_Salarie">Nationalité</label>
        <input type="text" id="nationalite_Salarie">

        <label for="poste_Salarie">Poste</label>
        <input type="text" id="poste_Salarie">

        <label for="typeMission_Salarie">Mission</label>
        <select id="typeMission_Salarie">
          <option value="européenne">Européenne</option>
          <option value="française">Française</option>
        </select> 

        <button type="button" id="update_salarie">Enregistrer</button>
        <button type="button" id="btn_annule">Annuler</button>
      </form>
    </div>
  </div>
</div>
<!-- end Model modification -->
<!-- Model alert modification succès -->
<div class="modal fade" id="SuccessUpSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content3">
      <h2>Modifier les informations du salarié</h2>
      <span class="close3">&times;</span>
      <div style="font-size:20px; margin-top:109px;">
          <center id="upsalarie_success"></center>  
      </div>
    </div>
  </div>
</div>
<!-- end Model alert modification succès -->
<!-- Model alert modification echec -->
<div class="modal fade" id="EchecUpSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content3">
      <h2>Modifier les informations du salarié</h2>
      <span class="close3">&times;</span>
      <div style="font-size:20px; margin-top:109px;">
          <center id="upsalarie_echec"></center>  
      </div>
    </div>
  </div>
</div>
<!-- end Model alert modification echec -->
<!-- Model suppression -->
<div class="modal fade" id="deleteSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content3">
      <h2>Supprimer Salarié</h2>
      <span class="close3">&times;</span>
      <div style="font-size:20px; margin-top:109px;">
        <p>Voulez-vous supprimer le client ?</p>
				<br>
				<div style="float: right;">
					<button type="button" id="btn_delete">Supprimer</button>
          <button type="button" id="btn_annule">Annuler</button>
				</div>
      </div>
    </div>
  </div>
</div>
<!-- end Model suppression -->
<!-- Model alert supprimer succès -->
<div class="modal fade" id="SuccessDeleteSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content3">
      <h2>Supprimer Salarié</h2>
      <span class="close3">&times;</span>
      <div style="font-size:20px; margin-top:109px;">
          <center id="deletesalarie_success"></center>  
      </div>
    </div>
  </div>
</div>
<!-- end Model alert supprimer succès -->
<!-- Model alert supprimer echec -->
<div class="modal fade" id="EchecDeleteSalarie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content3">
      <h2>Supprimer Salarié</h2>
      <span class="close3">&times;</span>
      <div style="font-size:20px; margin-top:109px;">
          <center id="deletesalarie_echec"></center>  
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