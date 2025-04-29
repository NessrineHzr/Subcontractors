<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$sql = "SELECT id_Entreprise , nom_Entreprise FROM entreprise WHERE etat_Entreprise = '1'";
$result = $connexion->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<h2 style="font-size: 23px;">Documents sous-traitants</h2><br><br><br>
<div class="container">
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<a href="document_entreprise.php?id=' . $row["id_Entreprise"] . '">
              <button id="btn_document_soustraitant" data-document="' . $row["id_Entreprise"] . '" data-nom="' . $row["nom_Entreprise"] . '"><img src="../img/s_doc.png" >' . '</button>';
        echo '<div class="nom">' . htmlspecialchars($row["nom_Entreprise"]) . '</div>';
        echo '</div>';
    }
}
?>
</div>
</body>
</html>
<?php include('../footer.php'); ?>
