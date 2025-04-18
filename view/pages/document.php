<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$sql = "SELECT id_Entreprise , nom_Entreprise FROM entreprise WHERE etat_Entreprise = '1'";
$result = $connexion->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<style>
.container {
    display: grid;
    grid-template-columns: repeat(5, 1fr); 
    gap: 30px;
    justify-items: center;
}

.card {
    position: relative;
    width: 240px;
    height: 150px;
    overflow: hidden;
    border-radius: 5px;
    transition: transform 0.2s ease;
}

.card:hover {
    transform: scale(1.05);
}

.card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 5px;
}

.card button {
    border: none;
}
.card .nom {
    position: absolute;
    top: 20%;
    left: 30%;
    transform: translate(-40%, -40%);
    color: white;
    padding: 8px 12px;
    font-weight: bold;
    font-size: 18px;
}
</style>
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
