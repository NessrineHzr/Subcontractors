<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql="SELECT nom_Entreprise FROM entreprise WHERE id_entreprise='$id'";
$result = mysqli_query($connexion, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    $nom_Entreprise = str_replace(' ', '', $row['nom_Entreprise']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<style>
    .documents {
        display: flex; 
        gap: 10px;
    }
    p {
        position: absolute;
        top: 100%;  
        left: auto; 
        font-size: 16px; 
    }
    .document {
        display: flex;
        align-items: center;
        position: relative;
    }
    .doc {
        background-color: #FFF0DB; 
        padding: 50px;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .doc img {
        width: 40px;
        height: 50px;
    }

    .telecharger {
        border: none;
        background-color: transparent;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .telecharger img {
        width: 60px;
        height: 60px;
        transform: translateX(-60px);
        margin-top: 150px;
    }


</style>
<div class="row d-flex">
    <div class="col-sm-12 col-md-6 d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item" style="font-size: 23px; font-weight: bold;">Sous-traitants</li>
                <li class="breadcrumb-item active" style="font-size: 19px; color:#470EE9; font-weight: bold;" aria-current="page"><a href="sous-traitant.php">Liste des sous-traitant </a></li>
                <li class="breadcrumb-item active" style="font-size: 18px; color:#470EE9; font-weight: bold;" aria-current="page" >Liste des documents</li>
            </ol>
        </nav>
    </div>
    <button style='float: right; margin-left: 10px;' type="button" id="btn_relancer" class="buttonvalidate">Relancer</button><br><br><br>
</div>

<?php
$documents = [
    "kbis_Document" => "KBIS",
    "pieceIdentitieGerant_Document" => "Pièce d'Identité",
    "attestationRegulariteFiscale_Document" => "Attestation de Régularité Fiscale",
    "attestationURSSAF_Document" => "Attestation URSSAF",
    "assuranceRcPro_Document" => "Assurance RC PRO",
    "assurenceDecennale_Document" => "Assurance Décennale"
];

$styles = array_fill_keys(array_keys($documents), "");

$sql_doc = "SELECT * FROM document_entreprise WHERE idEntreprise_Document = '$id'";
$result_doc = mysqli_query($connexion, $sql_doc);
$row_doc = mysqli_fetch_assoc($result_doc) ?: [];

foreach ($documents as $key => $title) {
    if (empty($row_doc[$key])) {
        $styles[$key] = "background-color: rgb(255, 78, 78);";
    }
}
?>

<div class="documents">
    <?php foreach ($documents as $id => $title): ?>
        <div class="document">
            <a href="#" id="<?= $id ?>" class="doc"><img src="../img/doc.png"></a>
            <button class="telecharger"><img src="../img/telecharger.png"></button>
            <p><?= $title ?></p>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
<script>
document.querySelectorAll('.doc').forEach(doc => {
    doc.addEventListener('click', function(event) {
        event.preventDefault(); 
        const nomEntreprise = "<?php echo $nom_Entreprise; ?>";
        const docId = this.id;
        const fileName = `${docId}_${nomEntreprise}`; 
        const filePath = `../file/${fileName}.pdf`;
        if (filePath) {
            window.location.href = filePath;
        }
    });
});
</script>
<?php
include('../footer.php');
?>