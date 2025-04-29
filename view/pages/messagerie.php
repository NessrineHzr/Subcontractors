<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$id = $_SESSION['ID'];
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<div class="cadre_m">
    <div class="cadre1_m"> 
        <h3>Messages</h3><br>
        <div class="search-bar"  style="margin-top: 15px;">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher...">
        </div><hr style="margin-top: 15px;border-top: 2px solid rgba(72, 14, 233, 0.5);"><br><br>
        <div id="liste_message"></div>
    </div>
    <div class="cadre2_m">
      <div id="message"></div>
    </div>
</div>
</Body>
</html>
<?php
include('../footer.php');
?>