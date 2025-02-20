<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
echo "<h1>Bonjour, $login !</h1>";
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
#ajouter_salarie {
  background-color: #612cf3;
  color: white;
  font-size: 16px;
  width: 28%;
}

#annuler {
  background-color: white;
  color: #612cf3;
  border: 1px solid #612cf3;
  font-size: 15px;
  width: 28%;
  margin-left: 41.2%;
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

.table {
  padding: 30px;
  margin: 20px 0;
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
<input type="button" class="boutton" id="ajout_salarie" value="+   Ajouter un Salarié"></input>
<p1 class="erreur" id="erreur2" style="display:block;"></p1>
<div id="modal_ajout_salarie" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Ajouter un salarié</h2><br><br>
    <form id="form_ajout_salarie" action="" method="post" >
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" ><br><br>
      <label for="prenom">Prénom :</label>
      <input type="text" id="prenom" name="prenom"><br><br>
      <label for="dateNaissance">Date de naissance :</label>
      <input type="date" id="dateNaissance" name="dateNaissance" ><br><br>
      <label for="nationalite">Nationalité :</label>
      <input type="text" id="nationalite" name="nationalite" ><br><br>
      <label for="poste">Poste :</label>
      <input type="text" id="poste" name="poste" ><br><br>
      <label for="typeMission">Type de mission :</label>
      <select id="typeMission" name="typeMission" required><br><br>
          <option value="">Sélectionnez une mission</option>
          <option value="européenne">Européenne</option>
          <option value="française">Française</option>
      </select><br><br>
      <input type="reset" id="annuler" value="Annuler ">
      <input type="button" id="ajouter_salarie" value="Ajouter ">
    </form>
  </div>
</div>

<div id="modal_message_2" class="modal_2">
  <div class="modal-content_2">
    <span class="close-message_2">&times;</span>
    <h2 id="modal_message_title_2"></h2>
    <p id="modal_message_text_2"></p>
    <div class="form-buttons_2">
      <input type="button" id="ajouter_autre_salarie" value="Ajouter un autre salarié">
      <input type="button" id="fermer_message_2" value="Fermer">
    </div>
  </div>
</div><br><br>

<div class="table" action="" method="post">
  <h1>Tous les salariés</h1>
  <table class="table-salarie" >
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de naissance</th>
        <th>Nationalité</th>
        <th>Poste</th>
        <th>Mission</th>
        <th>Documents</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
<?php $sql = "SELECT id_Salarie,nom_Salarie, prenom_Salarie, dateNaissance_Salarie, nationalite_Salarie, poste_Salarie, typeMission_Salarie FROM salarie WHERE etat_Salarie = '1'";
  $result = mysqli_query($connexion,$sql);
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $missionClass = ($row['typeMission_Salarie'] == 'européenne') ? 'mission mission-europeenne' : 'mission';
          echo "<tr>";
          echo "<td>" . $row['nom_Salarie'] . "</td>";
          echo "<td>" . $row['prenom_Salarie'] . "</td>";
          echo "<td>" . $row['dateNaissance_Salarie'] . "</td>";
          echo "<td>" . $row['nationalite_Salarie'] . "</td>";
          echo "<td>" . $row['poste_Salarie'] . "</td>";
          echo "<td><button class='$missionClass'>" . $row['typeMission_Salarie'] . "</button></td>";
          echo "<td><button class='icon-button'><i class='fa fa-eye'></i></button></td>";
          echo "<td>
                <button type='button' class='modifier' 
                        data-id='" . $row['id_Salarie'] . "'
                        data-nom='" . $row['nom_Salarie'] . "'
                        data-prenom='" . $row['prenom_Salarie'] . "'
                        data-date='" . $row['dateNaissance_Salarie'] . "'
                        data-nationalite='" . $row['nationalite_Salarie'] . "'
                        data-poste='" . $row['poste_Salarie'] . "'
                        data-mission='" . $row['typeMission_Salarie'] . "'>Modifier</button>
                <button type='button' class='supprimer' 
                        data-id='" . $row['id_Salarie'] . "'>Supprimer</button>
                </td>";
          echo "</tr>";
      }
  } 
  ?>
    </tbody>
  </table>
</div>

<div id="updateSalarie" class="modal3">
<div class="modal-content3">
  <h2>Modifier les informations du salarié</h2>
  <span class="close3">&times;</span>
  <form id="updateSalarieForm">
    <input type="hidden" id="id_Salarie" name="id_Salarie">
    <label for="nom_Salarie">Nom</label>
    <input type="text" id="nom_Salarie" name="nom_Salarie">
    <label for="prenom_Salarie">Prénom</label>
    <input type="text" id="prenom_Salarie" name="prenom_Salarie">
    <label for="dateNaissance_Salarie">Date de naissance</label>
    <input type="date" id="dateNaissance_Salarie" name="dateNaissance_Salarie">
    <label for="nationalite_Salarie">Nationalité</label>
    <input type="text" id="nationalite_Salarie" name="nationalite_Salarie">
    <label for="poste_Salarie">Poste</label>
    <input type="text" id="poste_Salarie" name="poste_Salarie">
    <label for="typeMission_Salarie">Mission</label>
    <select id="typeMission_Salarie" name="typeMission_Salarie">
        <option value="européenne">Européenne</option>
        <option value="française">Française</option>
      </select>    
    <button type="button" id="annuler_update">Annuler</button>
    <button type="button" id="update_salarie">Enregistrer</button>
  </form>
</div>
</div>

<div id="message_2" class="modal_4">
  <div class="modal-content_4">
    <span class="close-message_4">&times;</span>
    <h2 id="modal_message_title_4"></h2>
    <p id="modal_message_text_4"></p>
    <div class="form-buttons_4">
      <input type="button" id="supprimer_salarie" value="Supprimer">
      <input type="button" id="annuler_supprimer" value="Annuler">
    </div>
  </div>
  </div>

</body>
</html>

<?php
include('../footer.php');
?>