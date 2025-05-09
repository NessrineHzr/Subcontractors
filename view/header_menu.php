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
// message 
$sql_msg="SELECT COUNT(*) FROM messages WHERE etat_Messages = '1' AND vu_recepteur_Messages = '0' AND login_recepteur_Messages = '$login' ";
$res_msg = mysqli_query($connexion, $sql_msg);
$nbr_msg = $res_msg->fetch_row()[0];
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
    <!-- FontAwesome pour l'icône de chat -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>
  <style>
/* Conteneur de la barre de recherche pour servir de référence au positionnement absolu */
.search-bar {
  position: relative; /* Permet à #searchResults de se positionner relativement à .search-bar */
}

/* Liste de résultats */
#searchResults {
  position: absolute;
  top: 95%;        
  left: 2%;          /* Aligne le bord gauche */
  width: 25%;      /* Même largeur que .search-bar */
  margin-top: 4px;  /* Petit espacement facultatif */
  background: #fff; /* Fond blanc */
  border:none;
  border-radius: 1px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  max-height: 140px;         /* Limite la hauteur */
  overflow-y: auto;          /* Scroll si trop de résultats */
  z-index: 1000;             /* Au-dessus des autres éléments */
  display: none;             /* Caché par défaut */
}

/* Style des éléments de la liste */
#searchResults .list-group-item {
  cursor: pointer;
  padding: 8px 12px;
}

/* Effet au survol */
#searchResults .list-group-item:hover {
  background-color: #f5f5f5;
}

</style>
  <!-- BOUTON POUR OUVRIR LE CHAT -->
  <div id="chat-toggle" title="Chatbot">
    <i class="fas fa-comments"></i>
  </div>
  <!-- CONTENEUR DU CHAT -->
  <div id="chat-box">
    <div id="chat-header">
      <span>Assistant</span>
      <button id="chat-close" style="background:none;border:none;color:#fff;font-size:1.5rem;">&times;</button>
    </div>
    <div id="chat-log"></div>
    <div id="chat-input-container">
      <input id="chat-input" type="text" placeholder="Écrire un message…" autocomplete="off"/>
      <button id="chat-send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
    </div>
  </div>
    <aside class="sidebar">
        <img src="../img/logo_projet.jpg" alt="Description de l'image" width="100" height="50">
        <nav class="nav-menu">
            <a href="dashboard.php" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            <?php if($role=="1"){?><a href="compte.php" class="nav-link"><i class="fa-solid fa-circle-user"></i><span>Compte</span></a><?php }?>
            <a href="salarie.php" class="nav-link"><i class="fas fa-users"></i><span>Salariés</span></a>
            <?php if($role=="1"){?><a href="sous-traitant.php" class="nav-link"><i class="fas fa-user-tie"></i><span>Sous-traitants</span></a><?php }?>
            <a href="demande.php" class="nav-link"><i class="fas fa-file-alt"></i><span>Demandes</span></a>
            <a href="facture.php" class="nav-link"><i class="fas fa-file-invoice-dollar"></i><span>Facture</span></a>
            <?php if($role=="1"){?><a href="reglement.php" class="nav-link"><i class="fas fa-file-invoice"></i><span>Réglement</span></a><?php }?>
            <?php if($role=="1"){?><a href="document.php" class="nav-link"><i class="fas fa-folder"></i><span>Documents</span></a><?php }?>
            <?php if($role=="1"){?><a href="messagerie.php" class="nav-link"><i class="fas fa-envelope"></i><span>Messageries</span></a><?php }?>
            <a href="contact.php" class="nav-link"><i class="fa-solid fa-address-book"></i><span>Contact</span></a>
          </nav>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <div class="search-container">

              <!-- barre de recherche  -->
              <div class="search-bar">
                <span  id="search-icon">
                <i class="fas fa-search"></i>
                </span>
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher..."/>
                <ul id="searchResults" class="list-group position-absolute w-100"></ul>
              </div>

              <div class="icons">
                    <!-- messagerie -->
                    <?php if($role=="1"){?><div class="icon message" id="message_icon"> <?php }?>
                    <?php if($role=="2"){?><div class="icon message" id="message_icon_soustraitant"> <?php }?>
                        <i class="far fa-comment-dots"></i>
                        <?php if($nbr_msg != 0){?>
                            <div class="message" id="nbr_msg"><?php echo $nbr_msg ; ?></div>
                        <?php }?>                    
                    </div>
                    <?php if($role=="1"){?><div id="message_list" class="notification-list"></div><?php }?>
                    <div id="model_message_list" class="model_message_list" style="display:none;">
                        <div id="message_list_soustraitant" class="message-box"></div>
                    </div>

                    <!-- notification -->   
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
                        <img id="profile_image" class="user-icon" src="../img/profil/<?php echo $img; ?>">
                        <div class="user-details">
                            <span class="login"><?php echo $Nom; ?></span>
                            <span class="role"><?php echo $role_log; ?></span>
                        </div>
                        <i class="fas fa-chevron-down arrow"></i>
                        <div class="dropdown">
                            <a href="profile.php" id="information">Mes informations</a>
                            <a href="../../controllers/logout.php">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
//////////////////// chatbot ////////////////

  $(function() {
    const $toggle = $('#chat-toggle'),
          $box    = $('#chat-box'),
          $close  = $('#chat-close'),
          $log    = $('#chat-log'),
          $input  = $('#chat-input'),
          $send   = $('#chat-send');

    // Démarrage : cacher le chat
    $box.hide();
    // Ouvrir / fermer le chat
    $toggle.on('click', () => {
      $box.toggle();
      $input.focus();
    });
    $close.on('click', () => {
      $box.hide();
    });
    // Fonction pour ajouter une bulle dans le log
    function append(who, text) {
      const cls = who === 'user' ? 'msg-user'
                : who === 'bot'  ? 'msg-bot'
                : 'msg-loading';
      $log.append(`<div class="${cls}">${who === 'user' ? 'Toi: ' : 'Bot: '}${text}</div>`);
      $log.scrollTop($log[0].scrollHeight);
    }
    // Envoi du message
    async function sendMessage() {
      const txt = $input.val().trim();
      if (!txt) return;
      append('user', txt);
      append('loading', '…');
      $input.val('');
      try {
        const res = await fetch('../../view/pages/chat.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ message: txt })
        });
        const data = await res.json();
        $log.find('.msg-loading').last().remove();
        if (data.error) {
          append('bot', 'Erreur : ' + data.error);
        } else {
          append('bot', data.reply);
        }
      } catch (e) {
        $log.find('.msg-loading').last().remove();
        append('bot', 'Erreur réseau');
        console.error(e);
      }
    }
    // Quand on clique sur "envoyer" ou appuie sur Entrée
    $send.on('click', sendMessage);
    $input.on('keypress', function(e) {
      if (e.which === 13) {
        sendMessage();
      }
    });
  });

  /////////////////////////  Recherche  ///////////////////////////////

  $(function(){
  const pages = <?php if ($role == 2): ?>[
      { name: 'Dashboard',    url: 'dashboard.php' },
      { name: 'Salariés',     url: 'salarie.php'   },
      { name: 'Demandes',     url: 'demande.php'   },
      { name: 'Factures',     url: 'facture.php'   },
      { name: 'Contact',      url: 'contact.php'   }
    ]<?php else: ?>[
      { name: 'Dashboard',     url: 'dashboard.php'     },
      { name: 'Demandes',      url: 'demande.php'       },
      { name: 'Salariés',      url: 'salarie.php'       },
      { name: 'Sous-traitants',url: 'sous-traitant.php' },
      { name: 'Factures',      url: 'facture.php'       },
      { name: 'Règlements',    url: 'reglement.php'     },
      { name: 'Documents',     url: 'document.php'      },
      { name: 'Messagerie',    url: 'messagerie.php'    },
      { name: 'Contact',       url: 'contact.php'       },
      { name: 'Compte',        url: 'compte.php'        }
    ]<?php endif; ?>;


  const $input   = $('#searchInput');
  const $results = $('#searchResults');

  // fonction pour afficher les résultats
  function showResults(matches) {
    if (!matches.length) {
      return $results.hide().empty();
    }
    const items = matches.map(p =>
      `<li class="list-group-item list-group-item-action">${p.name}</li>`
    ).join('');
    $results.html(items).show();
  }

  // filtrage à chaque frappe
  $input.on('input', function(){
    const term = this.value.trim().toLowerCase();
    if (!term) return showResults([]);
    const matches = pages.filter(p =>
      p.name.toLowerCase().includes(term)
    );
    showResults(matches);
  });

  // clic sur un résultat
  $results.on('click', 'li', function(){
    const selected = $(this).text();
    const page = pages.find(p => p.name === selected);
    if (page) {
      window.location.href = page.url;
    }
  });

  // fermer la liste si on clique ailleurs
  $(document).on('click', function(e){
    if (!$(e.target).closest('#searchInput, #searchResults').length) {
      $results.hide();
    }
  });
});

</script>





