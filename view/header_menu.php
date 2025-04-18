<?php
// Démarrer la session
session_start();
include('../../config/base_de_donnee.php');
$ID = $_SESSION['ID'];
$login = $_SESSION['Login'];
$role = $_SESSION['Role'];
$Nom = $_SESSION['Nom'];
if ($role == '1'){
$query = "SELECT * FROM utilisateur WHERE id_Utilisateur = '$ID'";}
elseif ($role == '2'){
$query = "SELECT * FROM utilisateur ,entreprise WHERE id_Entreprise = '$ID' and login_Utilisateur = email_Entreprise";
}
  $result = mysqli_query($connexion, $query);
  $row = mysqli_fetch_assoc($result);
  $img= $row['image_Utilisateur']; 
if ($role == '1'){
    $role_log="Administrateur"; 
}else {
    $role_log="Sous-traitant";
}
// notification 
if($role == "1"){
    $sql="SELECT COUNT(*) FROM notifications WHERE etat_Notification = '0' and idEntreprise_Notification = '0' ";
}elseif($role == "2"){
    $sql="SELECT COUNT(*) FROM notifications WHERE etat_Notification = '0' and idEntreprise_Notification = '$ID' ";
}
$res = mysqli_query($connexion, $sql);
$nbr = $res->fetch_row()[0];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUBCONTRACTORS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>    
    <!-- SELECT2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- DataTables JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

</head>
<body>
<style>


    /* Style pour le badge (optionnel) */
    .icon.notification .notification {
      position: absolute;
      top: -5px;
      right: -5px;
      background: red;
      color: white;
      border-radius: 50%;
      padding: 2px 5px;
      font-size: 15px;
    }
    .entete {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .notification-list {
      position: absolute;
      top: 110px; 
      width: 330px;
      background: #fff;
      border: 1px solid #ccc;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      display: none; 
      z-index: 100;
      padding: 15px;
    }

    .notification-item {
    padding: 10px;
    border-bottom: 1px solid #eee;
    }

    .notification-item button {
        background: none;
        border: none;
        text-align: left;
        font-size: 15px;
        width: 100%;
    }

    .notification-item button:hover {
        background-color:rgba(243, 243, 243, 0.9);
    }
    .btn_non_lu {
        background-color:rgba(240, 240, 240, 0.8);
        padding: 10px;
        border-bottom: 1px solid #eee;
    }
    .btn_non_lu button {
        background: none;
        border: none;
        text-align: left;
        font-size: 15px;
        width: 100%;
    }
    .btn_non_lu button:hover {
        background-color:rgba(255, 255, 255, 0.9);
    }
    .btn_affiche {
    font-size: 15px;
    width: 100px;
    height: 20px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: auto;
    border-radius: 60px;
    background-color: #EFEAFF;
    color: #470EE9;
    border : none;
    }
    .time{
        color:#470EE9;
        text-align: right;
    }
  </style>
    <aside class="sidebar">
        <img src="../img/logo_projet.jpg" alt="Description de l'image" width="100" height="50">
        <nav class="nav-menu">
            <a href="dashboard.php" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            <?php if($role=="1"){?><a href="compte.php" class="nav-link"><i class="fa-solid fa-circle-user"></i><span>Compte</span></a><?php }?>
            <a href="demande.php" class="nav-link"><i class="fas fa-file-alt"></i><span>Demandes</span></a>
            <?php if($role=="1"){?><a href="sous-traitant.php" class="nav-link"><i class="fas fa-user-tie"></i><span>Sous-traitants</span></a><?php }?>
            <a href="salarie.php" class="nav-link"><i class="fas fa-users"></i><span>Salariés</span></a>
            <?php if($role=="1"){?><a href="contact.php" class="nav-link"><i class="fa-solid fa-address-book"></i><span>Contact</span></a><?php }?>
            <?php if($role=="1"){?><a href="document.php" class="nav-link"><i class="fas fa-folder"></i><span>Documents</span></a><?php }?>
            <?php if($role=="1"){?><a href="" class="nav-link"><i class="fas fa-envelope"></i><span>Messageries</span></a><?php }?>
        </nav>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <div class="search-container">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div class="icons">
                    <div class="icon message">
                        <i class="far fa-comment-dots"></i>
                        <div class="notification"></div>
                    </div>
                    <div class="icon notification" id="notificationIcon">
                        <i class="fa-regular fa-bell"></i>
                        <?php if($nbr != 0){?>
                            <div class="notification" id="nbr_notif"><?php echo $nbr ; ?></div>
                        <?php }?>
                    </div>

                    <div id="notificationList" class="notification-list"></div>
                    <!-- Model affiche notification -->
                    <div class="modal fade" id="afficheNotification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content-2">
                                <div class="modal-header">
                                    <h2 class="modal-title" style="color: #470EE9; margin: 0;">Notifications </h2>
                                    <button id="btn_close"><img src="../img/x.png" alt="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                    <div style="font-size:18px; color:rgb(0, 0, 0);">          
                                    <div id="affiche_notif"></div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Model affiche notification -->

                    <div class="user-info" onclick="toggleDropdown()">
                        <!-- Icône utilisateur -->
                        <img id="profile_image" class="user-icon" src="../img/profil/<?php echo $img; ?>">
                        <!-- <i class="fas fa-user-circle user-icon"></i> -->
                        <!-- Infos utilisateur -->
                        <div class="user-details">
                            <span class="login"><?php echo $Nom; ?></span>
                            <span class="role"><?php echo $role_log; ?></span>
                        </div>
                        <!-- Flèche de la liste déroulante -->
                        <i class="fas fa-chevron-down arrow"></i>
                        <!-- Liste déroulante -->
                        <div class="dropdown">
                            <a href="profile.php" id="information">Mes informations</a>
                            <a href="../../controllers/logout.php">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>


        