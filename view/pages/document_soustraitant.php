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
        flex-wrap: wrap;
    }
    p {
        position: absolute;
        top: 100%;  
        left: auto; 
        font-size: 16px; 
    }
    .document {
        width: 18%;
        display: flex;
        align-items: center;
        position: relative;
    }
    .titledoc {
        position: absolute;
        top: 100%;  
        left: auto; 
        font-size: 16px; 
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

<div class="documents">
    <div class="document">
        <a href="#" id="kbis_Document" class="doc"><img src="../img/doc.png"></a>
        <button id="telecharger" class="telecharger"><img src="../img/telecharger.png"></button>
        <div class="titledoc">KBIS</div>
    </div>
    <div class="document">
        <a href="#" id="pieceIdentitieGerant_Document" class="doc"><img src="../img/doc.png"></a>
        <button id="telecharger" class="telecharger"><img src="../img/telecharger.png"></button>
        <div class="titledoc">Pièce d'Identité Gérant</div>
    </div>
    <div class="document">
        <a href="#" id="attestationRegulariteFiscale_Document" class="doc"><img src="../img/doc.png"></a>
        <button id="telecharger" class="telecharger"><img src="../img/telecharger.png"></button>
        <div class="titledoc">Attestation de Régularité Fiscale</div>
    </div>
    <div class="document">
        <a href="#" id="attestationURSSAF_Document" class="doc"><img src="../img/doc.png"></a>
        <button id="telecharger" class="telecharger"><img src="../img/telecharger.png"></button>
        <div class="titledoc">Attestation URSSAF</div>
    </div>
    <div class="document">
        <a href="#" id="assuranceRcPro_Document" class="doc"><img src="../img/doc.png"></a>
        <button id="telecharger" class="telecharger"><img src="../img/telecharger.png"></button>
        <div class="titledoc">Assurance RC PRO</div>
    </div>
    <div class="document">
        <a href="#" id="assurenceDecennale_Document" class="doc"><img src="../img/doc.png"></a>
        <button id="telecharger" class="telecharger"><img src="../img/telecharger.png"></button>
        <div class="titledoc">Assurance Décennale</div>
    </div>
    <div class="document">
        <a href="#" id="siret_Document" class="doc"><img src="../img/doc.png"></a>
        <button id="telecharger" class="telecharger"><img src="../img/telecharger.png"></button>
        <div class="titledoc">SIRET</div>
    </div>
    <div class="document">
        <a href="#" id="caisseBTP_Document" class="doc"><img src="../img/doc.png"></a>
        <button id="telecharger" class="telecharger"><img src="../img/telecharger.png"></button>
        <div class="titledoc">Caisse BTP</div>
    </div>
    <div class="document">
        <a href="#" id="numeroFiscal_Document" class="doc"><img src="../img/doc.png"></a>
        <button id="telecharger" class="telecharger"><img src="../img/telecharger.png"></button>
        <div class="titledoc">Numéro Fiscal</div>
    </div>
    <div class="document">
        <a href="#" id="numeroTVA_Document" class="doc"><img src="../img/doc.png"></a>
        <button id="telecharger" class="telecharger"><img src="../img/telecharger.png"></button>
        <div class="titledoc">Numéro TVA</div>
    </div>
</div>

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
<?php
include('../footer.php');
?>