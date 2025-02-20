$(document).ready(function() {
    login();
    update_profile();
    ajout_salarie();
    update_salarie();
    supprimer_salarie();
    

});

// Fonction pour afficher ou masquer le mot de passe
function togglePassword() {
    var passwordField = document.getElementById("password");
    var eyeIcon = document.getElementById("eye-icon");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye"); // Icône œil barré
    } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash"); // Icône œil ouvert
    }
}

// Fonction pour afficher ou masquer le dropdown de compte
function toggleDropdown() {
    const dropdown = document.querySelector(".user-info .dropdown");
    const arrow = document.querySelector(".user-info .arrow");
    dropdown.classList.toggle("show");
    arrow.classList.toggle("open");
}

// Logout app
$(document).ready(function() {
    $("#logout_btn").on("click", function() {
        window.location.href = "logout.php"; // Redirige vers le fichier PHP
    });
});

//Login app
$(document).ready(function() {
    $("#login, #password").on("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Empêche le comportement par défaut du formulaire
            $("#connexion_btn").click(); // Simule un clic sur le bouton
        }
    });
});

function login() {
    $("#connexion_btn").on("click", function (event) {
        event.preventDefault();  // Empêche la soumission du formulaire
        var username = $("#login").val();
        var password = $("#password").val();
        var form_data = new FormData();
        form_data.append("username", username);
        form_data.append("password", password);
        $.ajax({
            url: "../../models/loginUtilisateur.php",  // Assure-toi que le chemin est correct
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            success: function (data) {
                data = $.parseJSON(data);
                console.log(data); // Vérifie ce qui est retourné par le serveur
                if (data.success) {
                    window.location.href = "file.php";
                } else {
                    // $error = "Login ou mot de passe incorrect";
                    $("#erreur").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'><i class='fas fa-exclamation-circle me-2'></i>Login ou mot de passe incorrect</div>");
                    $(document).on("click", "#reessayer", function () {
                      $("#login").val('');
                      $("#password").val('');
                      $("#erreur").empty();
                    });
                }
            },
        });
    });
}

// update profil
function update_profile(){
    $("#update_profile_btn").on("click", function (event) {
        event.preventDefault();  // Empêche la soumission du formulaire
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var email = $("#email").val();
        var telephone = $("#telephone").val();
        var adresse = $("#adresse").val();
        var ancien_mdp = $("#ancien_mdp").val();
        var nouveau_mdp = $("#nouveau_mdp").val();
        var confirmer_mdp = $("#confirmer_mdp").val();
        if (nouveau_mdp !== "" && confirmer_mdp === "") {
            $("#modal").fadeIn();
            $("#titre").text("Erreur");
            $("#message").text("Veuillez confirmer votre mot de passe !");
            return false;
        } 
        else if (nouveau_mdp === "" && confirmer_mdp !== "") {
            $("#modal").fadeIn();
            $("#titre").text("Erreur");
            $("#message").text("Veuillez saisir votre nouveau mot de passe !");
            return false;
        } 
        else if (nouveau_mdp !== "" && nouveau_mdp !== confirmer_mdp) {
            $("#modal").fadeIn();
            $("#titre").text("Erreur");
            $("#message").text("Le mot de passe confirmé n'est pas identique au nouveau mot de passe !");
            return false;
        }
        var form_data = new FormData();
        form_data.append("nom", nom);
        form_data.append("prenom", prenom);
        form_data.append("email", email);
        form_data.append("telephone", telephone);
        form_data.append("adresse", adresse);
        form_data.append("ancien_mdp", ancien_mdp);
        form_data.append("nouveau_mdp", nouveau_mdp);
        form_data.append("confirmer_mdp", confirmer_mdp);
        $.ajax({
            url: "../../models/updateProfile.php",  // Assure-toi que le chemin est correct
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            success: function (data) {
                data = $.parseJSON(data);
                $("#modal").fadeIn();
        if (data.success) {
          $("#text").text("Succès");
          $("#message").text(data.success);
        } else{
          $("#text").text("Erreur");
          $("#message").text(data.error);
        }
    }
});
});
}
$(".close-message").click(function() {
    $("#modal").fadeOut();
});
$(window).click(function(event) {
    if ($(event.target).is("#modal")) {
        $("#modal").fadeOut();
    }
});
// les fenetre pour l'ajout de salarie 
    // Ouvrir la modale lors du clic sur le bouton "Ajouter un Salarié"
    $("#ajout_salarie").click(function() {
        $("#modal_ajout_salarie").fadeIn();
    });

    // Fermer la modale lorsque l'utilisateur clique sur la croix
    $(".close").click(function() {
        $("#modal_ajout_salarie").fadeOut();
    });
    $("#annuler").click(function() {
        $("#modal_ajout_salarie").fadeOut();
    });

    // Fermer la modale si l'utilisateur clique en dehors du contenu
    $(window).click(function(event) {
        if ($(event.target).is("#modal_ajout_salarie")) {
            $("#modal_ajout_salarie").fadeOut();
        }
    });

    // Ouvrir la modale d'ajout de salarié (première fenêtre) depuis le bouton "Ajouter un autre salarié"
$("#ajouter_autre_salarie").on("click", function() {
    $("#modal_message_2").fadeOut();
    $("#modal_ajout_salarie").fadeIn();
  });
  
  // Fermer la modale de message (deuxième fenêtre) via le bouton "Fermer" ou la croix
  $("#fermer_message_2, .close-message_2").on("click", function() {
    $("#modal_message_2").fadeOut();
    location.reload();
  });
  

// info salarie
function ajout_salarie(){
    $("#ajouter_salarie").on("click", function (event) {
        event.preventDefault();
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var dateNaissance = $("#dateNaissance").val();
        var nationalite = $("#nationalite").val();
        var poste = $("#poste").val();
        var typeMission = $("#typeMission").val();
        if (nom === "" || prenom === "" || dateNaissance === "" || nationalite === "" || poste === "" || typeMission === "") {
            alert("Veuillez remplir tous les champs !");
            return;
        }
        var form_data = new FormData();
        form_data.append("nom", nom);
        form_data.append("prenom", prenom);
        form_data.append("dateNaissance", dateNaissance);
        form_data.append("nationalite", nationalite);
        form_data.append("poste", poste);
        form_data.append("typeMission", typeMission);
        $.ajax({
            url: "../../models/ajouterSalarie.php", 
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            success: function(data) {
                data = $.parseJSON(data);
                console.log(data);
        $("#modal_ajout_salarie").fadeOut();
        if (data.success) {
          $("#modal_message_title_2").text("Succès");
          $("#modal_message_text_2").text(data.success);
        } else {
          $("#modal_message_title_2").text("Erreur");
          $("#modal_message_text_2").text(data.error);
        }
        $("#modal_message_2").fadeIn();
                }
            }
        );
    });
};

// fenetre update :
function update_salarie() {
        $(".modifier").click(function() {
            var id_Salarie = $(this).data("id");
            var nom_Salarie = $(this).data("nom");
            var prenom_Salarie = $(this).data("prenom");
            var dateNaissance_Salarie = $(this).data("date");
            var nationalite_Salarie = $(this).data("nationalite");
            var poste_Salarie = $(this).data("poste");
            var typeMission_Salarie = $(this).data("mission");
            $("#id_Salarie").val(id_Salarie);
            $("#nom_Salarie").val(nom_Salarie);
            $("#prenom_Salarie").val(prenom_Salarie);
            $("#dateNaissance_Salarie").val(dateNaissance_Salarie);
            $("#nationalite_Salarie").val(nationalite_Salarie);
            $("#poste_Salarie").val(poste_Salarie);
            $("#typeMission_Salarie").val(typeMission_Salarie);

            $("#updateSalarie").fadeIn();});
            $("#annuler_update").click(function() {
            $("#updateSalarie").fadeOut();});
            $("#update_salarie").click(function() {
            var formData = new FormData($("#updateSalarieForm")[0]);
            $.ajax({
                url: "../../models/updateSalarie.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        $("#updateSalarie").fadeOut();
                        $("#message_2").fadeIn();                    
                    if (data.success) {
                        $("#modal_message_title_4").text("Succès");
                        $("#modal_message_text_4").text("Mise à jour réussie !");
                        $(".form-buttons_4").html('<input type="button" id="ok_update" value="OK" class="btn-success">');
                        $(document).on("click", "#ok_update", function() {
                            $("#message_2").fadeOut(function() {
                                location.reload();
                            });
                        });
                    } else {
                        $("#modal_message_title_4").text("Erreur");
                        $("#modal_message_text_4").text(data.error || "Une erreur est survenue lors de la mise à jour");
                        $(".form-buttons_4").html('<input type="button" id="ok_error" value="OK" class="btn-error">');
                        $(document).on("click", "#ok_error", function() {
                            $("#message_2").fadeOut();
                        });
                    }
                } catch (e) {
                    $("#modal_message_title_4").text("Erreur");
                    $("#modal_message_text_4").text("Erreur lors du traitement de la réponse");
                    $(".form-buttons_4").html('<input type="button" id="ok_error" value="OK" class="btn-error">');
                }
            },
            error: function(xhr, status, error) {
                $("#modal_message_title_4").text("Erreur");
                $("#modal_message_text_4").text("Erreur lors de la mise à jour : " + error);
                $(".form-buttons_4").html('<input type="button" id="ok_error" value="OK" class="btn-error">');
            }
            });
        });
    }
$(window).click(function(event) {
    if ($(event.target).is("#updateSalarie")) {
        $("#updateSalarie").fadeOut();
    }
});
$(".close3").click(function() {
    $("#updateSalarie").fadeOut();
});
// supprimer salarie 

function supprimer_salarie() {
    $(".supprimer").click(function() {
        let selectedId = $(this).data("id");
        let selectedRow = $(this).closest("tr");
        $("#message_2").fadeIn();
        $("#modal_message_title_4").text("Confirmation de suppression");
        $("#modal_message_text_4").text("Êtes-vous sûr de vouloir supprimer ce salarié ?");
        $("#message_2").data("selectedId", selectedId);
        $("#message_2").data("selectedRow", selectedRow);
    });
    $(document).on("click", ".close-message_4", function() {
        $("#message_2").fadeOut();
    });
    $(document).on("click", "#annuler_supprimer", function() {
        $("#message_2").fadeOut();
    });
    $(document).on("click", "#supprimer_salarie", function() {
        let selectedId = $("#message_2").data("selectedId");
        let selectedRow = $("#message_2").data("selectedRow");
        if (selectedId) {
            $.ajax({
                url: "../../models/supprimerSalarie.php",
                type: "POST",
                data: { id: selectedId },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        $("#modal_message_title_4").text("Succès");
                        if (data.success) {
                            $("#modal_message_text_4").text(data.success);
                            selectedRow.fadeOut(400, function() {
                                $(this).remove();
                            });
                            $(".form-buttons_4").html('<input type="button" id="ok_suppression" value="OK" class="btn-success">');
                        } else {
                            $("#modal_message_text_4").text(data.error || "Une erreur est survenue lors de la suppression");
                            $(".form-buttons_4").html('<input type="button" id="ok_error" value="OK" class="btn-error">');
                        }
                    } catch(e) {
                        $("#modal_message_text_4").text("Erreur lors du traitement de la réponse");
                        $(".form-buttons_4").html('<input type="button" id="ok_error" value="OK" class="btn-error">');
                    }
                },
                error: function(xhr, status, error) {
                    $("#modal_message_text_4").text("Erreur lors de la suppression : " + error);
                    $(".form-buttons_4").html('<input type="button" id="ok_error" value="OK" class="btn-error">');
                }
            });
        }
    });
    $(document).on("click", "#ok_suppression, #ok_error", function() {
        $("#message_2").fadeOut();
        if ($(this).attr("id") === "ok_suppression") {
            location.reload();
        }
    });
};
 

