<?php
include('../header_menu.php');

  $ID = $_SESSION['ID'];
  $query = "SELECT * FROM utilisateur WHERE id_Utilisateur = '$ID'";
  $result = mysqli_query($connexion, $query);
  if($row = mysqli_fetch_assoc($result)) {
      $nom= $row['nom_Utilisateur'];
      $prenom= $row['prenom_Utilisateur'];
      $email= $row['email_Utilisateur'];
      $telephone= $row['telephone_Utilisateur'];
      $adresse= $row['adresse_Utilisateur'];
      $ancien_mdp= $row['mdp_Utilisateur'];        
  } else {
      echo (['error' => 'Utilisateur non trouvé']);
  }

?>

<!DOCTYPE html>
<html lang="fr">
<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
.titre{
    font-family: 'Poppins', sans-serif;
    color: #470EE9;
    font-size: 25px;
    font-weight: bold;
}
h2 {
    font-family: 'Poppins', sans-serif;
    justify-content:;
    display: flex;
    align-items: center;
    font-size: 25px;
    color: #333;

    
}
.cadre {
    display: flex;
    justify-content: space-between;
    width: 100%;
    height: 90vh;
  }

  .cadre1 {
  background-color: white;
  border-radius: 10px;
  font-weight: bold;
  width: 74.5%;
  padding: 35px;
  box-sizing: border-box; 
}

.cadre1 table {
  width: 100%; 
  border-collapse: collapse; 
}

.cadre1 tr, td {
  font-family: 'Poppins', sans-serif;
  width: 50%; 
  padding: 20px;
  font-size: 17px;
}

.cadre1 input {
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  width: 100%; 
  padding: 20px; 
  box-sizing: border-box;
  background: #F6F6F6 ;
  border: none;
  border-radius: 8px;
  margin-top: 25px;
}

.cadre2{
  background-color:  white;
  border-radius: 10px;
  font-size: 23px;
  width: 24%;
  padding: 40px;
}


#update_profile_btn {
    font-family: 'Poppins', sans-serif;
    width: 50%;
    padding: 15px;
    background-color: #470EE9;
    color: white;
    font-size: 17px;
    border: none;
    border-radius: 8px;    
}

#update_profile_btn:hover {
    background-color: #3a0cb0;
}

.modal {
    display: none;
    position: fixed;
    z-index: 2;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    font-family: 'Poppins', sans-serif;
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

.close-message {
    color: #aaa;
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 15px;
}
#message{
  margin-top: 20px;
}
/* image */
.image_profile {
    font-family: 'Poppins', sans-serif;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    gap: 20px;
    font-size: 18px;
    font-weight: bold;

}
.image_profile img {
    width: 140px; 
    height: 140px; 
    border-radius: 50%;
    object-fit: cover; 
}
.edit-btn {
    position: absolute;
    bottom: 580px;
    right: 150px;
    background-color: #470EE9;
    color: white;
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

.edit-btn:hover {
    background-color: #3a0cb0;
}

/* icons */

.icons_profile {
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 10px;
    font-size: 17px;
    color: #333;
    margin-top: 70px;
}

.icons_profile i {
    font-size: 15px; 
    color: white; 
    background-color: #470EE9; 
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

    
</style>
<form action="" method="post">
  <h1>Dashboard  <span class="titre">  > Mon compte</span> </h1><br><br>
  <div class="cadre">
  <div class="cadre1">     
  <table>
    <tr>  
      <td><h2>Mes informations : </h2><br></td>
    </tr>
  <tr>
    <td>
      <label for="nom">Nom :</label><br>
      <input type="text" name="nom" id="nom" value="<?php echo($nom); ?>">
    </td>
    <td>
      <label for="prenom">Prénom :</label><br>
      <input type="text" name="prenom" id="prenom" value="<?php echo($prenom); ?>">
    </td>
  </tr>
  <tr>
    <td>
      <label for="email">Mail :</label><br>
      <input type="email" name="email" id="email" value="<?php echo($email); ?>">
    </td>
    <td>
      <label for="telephone">Téléphone :</label><br>
      <input type="text" name="telephone" id="telephone" value="<?php echo($telephone); ?>">
    </td>
  </tr>
  <tr>
    <td>
      <label for="adresse">Adresse :</label><br>
      <input type="text" name="adresse" id="adresse" value="<?php echo($adresse); ?>">
    </td>
    <td>
      <label for="ancien_mdp">Ancien mot de passe :</label><br>
      <input type="password" name="ancien_mdp" id="ancien_mdp" value="<?php echo($ancien_mdp); ?>">
    </td>
  </tr>
  <tr>
    <td>
      <label for="nouveau_mdp">Nouveau mot de passe :</label><br>
      <input type="password" name="nouveau_mdp" id="nouveau_mdp">
    </td>
    <td>
      <label for="confirmer_mdp">Confirmation mot de passe :</label><br>
      <input type="password" name="confirmer_mdp" id="confirmer_mdp">
    </td>
  </tr>
  <tr><td></td>
    <td colspan="2" style="text-align: right;">
      <button type="button" id="update_profile_btn">Modifier</button>
    </td>
  </tr>
</table>
</div>

<div class="cadre2">
<div class="image_profile">
  <img src="../img/profil/uml.jpeg" >
  <button class="edit-btn">
    <i class="fa-solid fa-pen"></i>
  </button>
  <?php echo($nom); ?>
  <?php echo($prenom); ?>
</div>

<div class="icons_profile" style="text-align: center;">
    <i class="fa-solid fa-envelope"></i><br>
     <?php echo($email); ?><br><br>
     <i class="fa-solid fa-location-dot"></i><br>
     <?php echo($adresse); ?><br><br>
     <i class="fa-solid fa-phone-volume"></i><br>
     <?php echo($telephone); ?>
</div>


</div>
</form>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close-message">&times;</span>
    <h2 id="text"></h2>
    <p id="message"></p>
  </div>
</div>
</body>
</html>

<?php
include('../footer.php');
?>
