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
      $img= $row['image_Utilisateur'];   
  } else {
      echo (['error' => 'Utilisateur non trouvé']);
  }

?>

<!DOCTYPE html>
<html lang="fr">
<body class="profile">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="../../public/css/app.css">

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
<input type="file" id="file_input">
  <img id="profile_image" src="../img/profil/<?php echo $img; ?>" alt="Image de profil">

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
<div id="modal" class="modal" >
  <div class="modal-content-2">
    <div class="modal-header">
      <h2 id="text"  style="color: #470EE9;"></h2>
      <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
    </div>
    <div class="modal-body">
      <center><p id="message"  style="color: #470EE9;"></p></center>
    </div>
  </div>
</div>

</body>
</html>
<?php
include('../footer.php');
?>
