<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$id = $_SESSION['ID'];
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<style>
.containe {
  display: grid;
  grid-template-columns: 1fr 1fr;
}
/* class contact */
.contact {
  margin-right: 100px;
  margin-left: 40px;
  width: 80%;
}
.contact h2 {
  color: #470EE9;
}
.contact p {
  font-family: 'Poppins', sans-serif;
}

.icon_contact i {
    font-size: 14.5px;
    color: white;
    background-color: #470EE9;
    width: 5%;
    aspect-ratio: 1 / 1;
    display: flex;
    align-items: center;
    justify-content: center;
}
.icon_contact .ligne {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 10px;
}

.icon_contact p {
  margin: 0;
}

 
/* class message */
.info {
  margin-right: 40px;
  margin-top :20px;
  width: 80%;
}

.info .form-group {
  margin-bottom: 20px;
}

.info label {
  display: block;
  font-weight: bold;
  margin-bottom: 8px;
  color: #470EE9;
}

.info input,
.info textarea {
  width: 100%;
  padding: 15px 15px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
}

.info input:focus,
.info textarea:focus {
  outline: none;
  border-color: #470EE9;
}

.info button {
  padding: 12px 25px;
  border: 2px solid #470EE9;
  background: #470EE9;
  color: white;
  font-size: 16px;
  font-weight: bold ;
  border-radius: 6px;
}

.info button:hover {
  background:rgb(88, 41, 220);
}

/* Responsive  */
@media (max-width: 768px) {
  .containe {
    grid-template-columns: 1fr;
    height: auto;
  }
  .contact {
    border-right: none;
    border-bottom: 1px solid #ddd;
  }
}

</style>
<Body>

<div class="containe">
    <div class="contact">
        <h2>Contactez-nous</h2><br>
        <p>Pour toute demande de devis, de renseignement ou alors si 
            vous souhaitez simplement prendre contact avec nos équipes,
            n’hésitez pas à remplir notre formulaire de contacte !
        </p><br>
        <h4>Nos collaborateurs prendront le temps de répondre à chaque demande !</h4><br><br>
        <div class="icon_contact">
          <div class="ligne">
            <i class="fa-solid fa-envelope"></i>
            <p>contact@img-entreprise.com</p>
          </div>
          <div class="ligne">
            <i class="fa-solid fa-location-dot"></i>
            <p>2 rue de la source - 45 rue de Courtry 93470 Coubron France</p>
          </div>
    </div>
    <img src="../img/maps.png" style="width: 100%; height: 65%; margin-top: 50px;">
</div>
<!-- Model message envoyer avec succès -->
<div class="modal fade" id="envoyer_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Contactez-nous</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="success"></center>  
        </div>
      </div>
    </div>
  </div>
</div>  
<!-- end Model message envoyer avec succès -->
<!-- Model echec envoyer message -->
<div class="modal fade" id="envoyer_echec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content-2">
      <div class="modal-header">
        <h2 class="modal-title" style="color: #470EE9; margin: 0;">Contactez-nous</h2>
        <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
      </div>
      <div class="modal-body">
        <div style="font-size:18px; color: #470EE9;">
          <center id="echec"></center>  
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Model echec envoyer message -->
<div class="info">
  <p id="message_contact"></p><br>
    <div id="fiche_2row">
        <div class="form-group">
            <label for="nom">Nom et Prénom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre Nom et Prénom" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Votre numero de téléphone" required>
        </div>
    </div>
    <div id="fiche_2row">
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Votre E-mail" required>
        </div>
        <div class="form-group">
            <label for="objet">Objet</label>
            <input type="text" class="form-control" id="objet" name="objet" placeholder="Objet" required>
        </div>
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" placeholder="Laissez un message ici" id="message" name="message" style="height: 150px" required></textarea>
    </div>
    <button type="button" id="btn_contact">Envoyer</button>
    <div class="maps">
      <iframe 
       src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10995768.775361102!2d9.733834!3d47.713275!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6112300fd7043%3A0x9874a370fc165879!2s45%20Rue%20de%20Courtry%2C%2093470%20Coubron%2C%20France!5e0!3m2!1sfr!2sus!4v1744983698615!5m2!1sfr!2sus" 
       width="100%" height="360" style="border: 1px; margin-top: 50px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</div>
  
</Body>
</html>
<?php
include('../footer.php');
?>