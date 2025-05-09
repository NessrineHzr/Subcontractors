<?php
require_once __DIR__ . '/../../vendor/autoload.php';
include('../../config/base_de_donnee.php');

$idFacture = (int) $_GET['id'];
$idEentreprise = (int) $_GET['entreprise'];

$sql = "SELECT * FROM facture WHERE id_Facture = '$idFacture'";
$result = mysqli_query($connexion, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $date = $row['date_Facture'];
    $montant = $row['montant_Facture'];
}
$sql2 = "SELECT * FROM entreprise WHERE id_Entreprise = '$idEentreprise'";
$result2 = mysqli_query($connexion, $sql2);
while ($row2 = mysqli_fetch_assoc($result2)) {
    $nomE = $row2['nom_Entreprise'];
    $adresse = $row2['adresse_Entreprise'];
    $pays = $row2['pays_Entreprise'];
}

$pdf = new TCPDF();  
$pdf->AddPage();
$logoFile = __DIR__ . '/logo.jpg'; 

$html = '
<table border="0" style="width: 100%; border-collapse: collapse;">
  <tr>
    <td style="width: 65%; vertical-align: top; border: none; font-size: 10px;"><br><br><br>
    <img src="'.$logoFile.'"  style="width: 150px; height: 50px;" /><br>
      2 rue de la source <br>
      93470 Coubron <br>
      01.43.32.65.70 <br>
    </td>
    <td  style="font-weight: bold; font-size: 10px;background-color: #470EE9; color: white;" style="width: 35%; vertical-align: top;"><br><br>
      <div style="background-color: #470EE9; color: white; font-weight: bold; text-align: center; height: 80px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
        Facture
      </div>
    <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr><br>
          <td style="width: 40%; font-weight: bold; font-size: 10px;">N° Facture</td>
          <td style="width: 60%; font-size: 9px; text-align: right;">'.$idFacture.'</td>
        </tr>
        <tr>
          <td style="font-weight: bold; font-size: 10px;">Date</td>
          <td  style="font-size: 9px; text-align: right;">'.$date.'</td>
        </tr>
      </table>
    </td>
  </tr>
</table><br><br>


<table border="0" style="width: 100%; border-collapse: collapse;  border: 0.5px solid #470EE9;">
  <tr>
    <th style="background-color: #470EE9; color: white; font-weight: bold; text-align: center; padding: 10px 0; width: 33%; border-right: 2px solid white;">Facturé à :</th>
    <th style="background-color: #470EE9; color: white; font-weight: bold; text-align: center; padding: 10px 0; width: 33%; border-right: 2px solid white;">Travaux</th>
    <th style="background-color: #470EE9; color: white; font-weight: bold; text-align: center; padding: 10px 0; width: 33%;">Attachement</th>
  </tr>
  <tr><br>
    <td style="padding: 20px; text-align: center; border: none; font-size: 9px;"><br>...<br><br></td>
    <td style="padding: 20px; text-align: center; border: none;font-size: 9px;">...<br></td>
    <td style="padding: 20px; text-align: center; border: none;font-size: 9px;">...</td>
  </tr>
</table><br><br>

<table border="0" style="width: 100%; border-collapse: collapse;">
  <tr>
    <th colspan="2" style="background-color: #470EE9; color: white; font-weight: bold; text-align: center; padding: 8px; border-right: 1px solid white;">Référence</th>
    <th colspan="3" style="background-color: #470EE9; color: white; font-weight: bold; text-align: center; padding: 8px; border-right: 1px solid white;">Désignation</th>
    <th style="background-color: #470EE9; color: white; font-weight: bold; text-align: center; padding: 8px; border-right: 1px solid white;">Qte</th>
    <th colspan="2" style="background-color: #470EE9; color: white; font-weight: bold; text-align: center; padding: 8px; border-right: 1px solid white;">Pu H.T</th>
    <th colspan="2" style="background-color: #470EE9; color: white; font-weight: bold; text-align: center; padding: 8px;">Total H.T</th>
  </tr>
  <tr><br>
    <td colspan="2" style="padding: 20px; border: none;text-align:center;font-size: 9px;">...</td>
    <td colspan="3" style="padding: 20px; border: none;text-align:center;font-size: 9px;">...</td>
    <td style="padding: 20px; border: none;text-align:center;font-size: 9px;">...</td>
    <td colspan="2" style="padding: 20px; border: none;text-align:center;font-size: 9px;">'.$montant.' dt</td>
    <td colspan="2" style="padding: 20px; border: none;text-align:center;font-size: 9px; font-weight: bold;">'.$montant.' dt</td>
  </tr>
</table>
';

$html2 = '
<table border="0" style="width:100%; border-collapse: collapse; ">
  <tr>
    <td style="width:50%; border:0.5px solid #470EE9;">
      <div style="font-weight:bold; font-size:10px; margin:0; padding:0;">
        Conditions de Règlement <br>

        <font style="font-weight: normal;">Date : </font>'.$date.' <br>

        <font style="font-weight: normal; font-size: 8px;">
        Pour être libératoire, votre règlement doit être effectue  <br>
        directement à l\'ordre de Crédit Mutuel Factoring Traitement des <br>
        Encaissements - TSA 90002 - 93328 AUBERVILLIERS CEDEX -  <br>
        Tél : 01.49.74.56.00. Paiement Par virement à Crédit Mutuel  <br>
        Factoring BIC CMCIFRPPXXX - IBAN : FR76 1197 8000 0100 0357  <br>
        2111 012, qui le reçoit par subrogation et devra être avisé de toute <br>
        réclamation relative à cette créance.   
        </font> 
      </div><br>
    </td>
    <td style="width:2%; border:none;"></td>

    <td style=" width:45%; border:0.5px solid #470EE9;">
      <table style="width: 100%; padding: 5px; font-size: 9px;">
        <tr><br>
          <td style="width: 60%;">SOUS - TOTAL HT</td>
          <td style="width: 40%; text-align: right;">'.$montant.' dt</td>
        </tr><br>
        <tr>
          <td >TOTAL H.T</td>
          <td style="text-align: right;">'.$montant.' dt</td>
        </tr>
        <tr>
          <td >Autoliquidation TVA</td>
          <td style="text-align: right;"> 0.00 dt</td>
        </tr>
        <tr style="font-weight: bold; font-size: 11px;background-color: #470EE9; color: white;"><br>
          <td >Net à payer</td>
          <td style="text-align: right;">'.$montant.' dt</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br><br>
<div style="text-align: center; font-size: 9px;">
<strong>SARL IMG</strong> SARL IMG au capital de 5000 Euros <strong> Siret </strong>: 798 130 258 00022 - <strong> SIREN </strong> : FR 09 798 130 258 APE 4321 MMA BTP <br>
<strong> ASSURANCE </strong> N° 000000143808342 - <strong> N° </strong> TVA FR 097 98 130 258
</div>
 ';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->SetY(-85);
$pdf->writeHTML($html2, true, false, true, false, '');

$pdf->Output('facture_'.$nomE.'.pdf', 'I'); 
 
?>
