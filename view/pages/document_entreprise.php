<?php
include('../header_menu.php');
$login = $_SESSION['Login'];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql="SELECT nom_Entreprise FROM entreprise WHERE id_entreprise='$id'";
$result = mysqli_query($connexion, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    $nom=$row['nom_Entreprise'];
    $nom_Entreprise = str_replace(' ', '', $row['nom_Entreprise']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<body>
<div class="col-sm-12 col-md-6 d-flex align-items-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item" style="font-size: 23px; font-weight: bold;"><a href="document.php">Documents sous-traitants</a></li>
            <li class="breadcrumb-item active" style="font-size: 18px; color:#470EE9; font-weight: bold;" aria-current="page" >Liste des documents de <?php echo $nom; ?></li>
        </ol>
    </nav>
</div>

<button type="button" id="btn_telecharger" class="btn_telecharger" data-demande="<?= $id ?>">Télécharger tous</button>
<?php
$documents = [
    "kbis_DocumentEntreprise" => "KBIS",
    "pieceIdentitieGerant_DocumentEntreprise" => "Pièce d'Identité",
    "attestationRegulariteFiscale_DocumentEntreprise" => "Attestation de Régularité Fiscale",
    "attestationURSSAF_DocumentEntreprise" => "Attestation URSSAF",
    "assuranceRcPro_DocumentEntreprise" => "Assurance RC PRO",
    "assurenceDecennale_DocumentEntreprise" => "Assurance Décennale",
    "siret_DocumentEntreprise" => "SIRET",
    "caisseBTP_DocumentEntreprise" => "Caisse BTP",
    "numeroFiscal_DocumentEntreprise" => "Numéro Fiscal",
    "numeroTVA_DocumentEntreprise" => "Numéro TVA"
];
$styles = array_fill_keys(array_keys($documents), "");
$sql_doc = "SELECT * FROM document_entreprise WHERE idEntreprise_DocumentEntreprise = '$id'";
$result_doc = mysqli_query($connexion, $sql_doc);
$row_doc = mysqli_fetch_assoc($result_doc) ?: [];
?>

<div class="documents">
    <?php foreach ($documents as $key => $title): 
         if (!empty($row_doc[$key])): ?>
            <div class="document">
                <a href="#" id="<?= $key ?>" class="doc">
                    <img src="../img/doc.png">
                </a>
                <button id="telecharger" class="telecharger">
                    <img src="../img/telecharger.png">
                </button>
                <div class="titledoc"><?= $title ?></div>
            </div>
    <?php endif; 
         endforeach; ?>
</div>
</body>
</html>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const idDocument = "<?php echo $id; ?>"; 
    const nomEntreprise = "<?php echo $nom_Entreprise; ?>";

    document.querySelectorAll('.doc').forEach(doc => {
        doc.addEventListener('click', function(event) {
            event.preventDefault(); 
            const docId = this.id;
            const fileName = `${docId}_${nomEntreprise}`; 
            const filePath = `../file/${idDocument}/${fileName}.pdf`; 
            if (filePath) {
                window.open(filePath, "_blank");
            }
        });
    });

    document.querySelectorAll('.telecharger').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const docElement = this.closest('.document').querySelector('.doc');
            const docId = docElement.id;
            const fileName = `${docId}_${nomEntreprise}`;
            const filePath = `../file/${idDocument}/${fileName}.pdf`; 
            const link = document.createElement('a');
            link.href = filePath;
            link.download = `${fileName}.pdf`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });

});
</script>
<?php include('../footer.php'); ?>