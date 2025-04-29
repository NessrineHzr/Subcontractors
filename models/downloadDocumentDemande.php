<?php
include('../config/base_de_donnee.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql="SELECT nom_Entreprise FROM entreprise, demande WHERE idEntreprise_Demande=id_Entreprise AND id_Demande='$id'";
$result = mysqli_query($connexion, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    $nom = $row['nom_Entreprise'];
}
$folderPath = "../view/file/" . $id;
$zipName = "demande_" . $nom . ".zip";
$dossier = "demande_" . $nom  ;
// Création de l'archive ZIP
$zip = new ZipArchive();

// Création et ouverture de l'archive ZIP
if ($zip->open($zipName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    exit("Erreur : Impossible de créer l'archive ZIP.");
}
$zip->addEmptyDir($dossier); 
$folder = opendir($folderPath);
if ($folder) {  
    while (false !== ($image = readdir($folder))) {
        if ($image !== "." && $image !== "..") {
            $file_with_path = $folderPath . "/" . $image;
            if (file_exists($file_with_path)) {
                $zip->addFile($file_with_path, $dossier . '/' . $image);
            }
        } 
    }
    closedir($folder);
} else {
    exit("Erreur : Impossible d'ouvrir le dossier.");
}
$zip->close();

// Vérification de la création de l'archive avant l'envoi
if (file_exists($zipName)) {
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . basename($zipName) . '"');
    header('Content-Length: ' . filesize($zipName));
    readfile($zipName);
    
    // Supprimez l'archive temporaire après téléchargement
    unlink($zipName);
    exit;
} else {
    exit("Erreur : Fichier ZIP non trouvé.");
}
?>