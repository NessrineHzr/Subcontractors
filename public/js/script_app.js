$(document).ready(function() {
    ReloadButtonExit();
    ReloadButtonExitX();
    login();
    // Profile
    update_profile();
    update_profile_image();
    // Salarie
    view_salarie_record()
    ajout_salarie();
    get_salarie_data();
    update_salarie();
    supprimer_salarie();
    get_salarie_document();    

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

 // Initialisation de Select2 sur le champ nationalité
 $('#nationalite').select2({
    placeholder: 'Sélectionnez une nationalité', 
    allowClear: true 
});

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

// close button annuler
function ReloadButtonExit() {
    $(document).on("click", "#btn_annule", function () {
      window.location.reload();
    });
}
function ReloadButtonExitX() {
    $(document).on("click", "#btn_close", function () {
      window.location.reload();
    });
}

// Search pagination
function searchpagination(id, title, EnteteDroite, titre) {
    $('.dataTables_length').parent().parent().css('align-items', 'center');
    // Création du titre avec breadcrumb
    let headerHTML = `<nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0 align-items-center d-flex">
                <h2>${titre}</h2>`;
    headerHTML += `</ol></nav>`;
    $('.dataTables_length').html(headerHTML);
    // Appliquer un conteneur flex pour bien aligner les éléments et ajouter un espacement
    EnteteDroite.addClass('d-flex align-items-center');
    // Ajout du champ de recherche stylisé avec une marge à droite
    let searchInput = EnteteDroite.find("input");
    searchInput.addClass('form-control rounded-pill ps-5 border-0 shadow-sm');
    searchInput.css("margin-right", "5px"); // Ajout d'une marge explicite
    // Bouton "Ajouter" avec espacement
    let addButton = `<button class='btn btn-add' id="${id}" title="${title}">${title}</button>`;
    // Ajout des éléments dans l'ordre souhaité
    EnteteDroite.prepend(searchInput); 
    EnteteDroite.append(addButton);
}

$(document).ready(function() {
    let table = $('#listeSalarie').DataTable({
        "info": false,
        "language": {
            "search": "", // Essaie de masquer "Search:"
            "searchPlaceholder": "Rechercher..." // Ajoute un placeholder
        }
    });
    // Supprime le texte "Search:" après le chargement de DataTables
    setTimeout(() => {
        $(".dataTables_filter label").contents().filter(function() {
            return this.nodeType === 3; // Sélectionne uniquement le texte brut (ex: "Search:")
        }).remove();
    }, 100);
});

//////////////////////// Module login //////////////////////

function login() {
    $("#connexion_btn").on("click", function (event) {
        event.preventDefault(); 
        var username = $("#login").val();
        var password = $("#password").val();
        var form_data = new FormData();
        form_data.append("username", username);
        form_data.append("password", password);
        $.ajax({
            url: "../../models/loginUtilisateur.php", 
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            success: function (data) {
                data = $.parseJSON(data);
                console.log(data); 
                if (data.success) {
                    window.location.href = "file.php";
                } else {
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
///////////// Module Profile //////////////////

// Modifier Profil
function update_profile(){
    $("#update_profile_btn").on("click", function (event) {
        event.preventDefault(); 
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var email = $("#email").val();
        var telephone = $("#telephone").val();
        var adresse = $("#adresse").val();
        var ancien_mdp = $("#ancien_mdp").val();
        var nouveau_mdp = $("#nouveau_mdp").val();
        var confirmer_mdp = $("#confirmer_mdp").val();
        {if (nouveau_mdp !== "" && confirmer_mdp === "") {
            $("#modal").fadeIn();
            $("#text").text("Alert mot de passe");
            $("#message").text("Veuillez confirmer votre mot de passe !");
            setTimeout(function () {
                $("#modal").fadeOut();
            }, 4000);
            return false;
        } 
        else if (nouveau_mdp === "" && confirmer_mdp !== "") {
            $("#modal").fadeIn();
            $("#text").text("Alert mot de passe");
            $("#message").text("Veuillez saisir votre nouveau mot de passe !");
            setTimeout(function () {
                $("#modal").fadeOut();
            }, 4000);
            return false;
        } 
        else if (nouveau_mdp !== "" && nouveau_mdp !== confirmer_mdp) {
            $("#modal").fadeIn();
            $("#text").text("Alert mot de passe");
            $("#message").text("Le mot de passe confirmé n'est pas identique au nouveau mot de passe !");
            setTimeout(function () {
                $("#modal").fadeOut();
            }, 4000);
            return false;
        }
        setTimeout(function () {
            $("#modal").fadeOut();
        }, 4000);}
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
            url: "../../models/updateProfile.php", 
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            success: function (data) {
                data = $.parseJSON(data);
                $("#modal").fadeIn();
                if (data.success) {
                  $("#text").text("Modifier mes informations");
                  $("#message").text(data.success);
                } else{
                  $("#text").text("Modifier mes informations");
                  $("#message").text(data.error);
                }
                setTimeout(function () {
                    $("#modal").fadeOut();
                }, 4000);
            }
        });
    });
}

// Modifier image profile 
function update_profile_image() {
    $("#file_input").on("change", function (event) {
        event.preventDefault(); 
        var file_input = $("#file_input").prop("files")[0];
            var form_data = new FormData();
            form_data.append("profile_image", file_input);
            $.ajax({
                url: "../../models/updateImageUtilisateur.php", 
                type: "POST",
                processData: false,
                contentType: false,
                data: form_data,
                success: function (response) {
                    window.location.reload(); 
                },
                error: function () {
                    alert("Une erreur est survenue lors de l'envoi de l'image.");
                }
            });
    });
}

//////////////////////// Module Salarie //////////////////////////

function view_salarie_record() {
  $.ajax({
    url: "../../models/viewSalarie.php",
    method: "post",
    success: function (data) {
      try {
        data = $.parseJSON(data);
        if (data.status == "success") {
          $("#table_listeSalarie").html(data.html);
          $('#listeSalarie').DataTable({ "info": false});
          searchpagination("ajout_salarie","Ajouter un salarié",$('#listeSalarie_filter'),"Liste des salariés");
        }
      } catch (e) { 
        console.error("Invalid Response!");
      }
    },
  });
}

// Ajouter salarie
function ajout_salarie(){
    $(document).on("click", "#ajout_salarie", function () {
        $("#ajoutSalarie").modal("show");
    });
    $(document).on("click", "#ajouter_salarie", function () {
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var dateNaissance = $("#dateNaissance").val();
        var nationalite = $("#nationalite").val();
        var poste = $("#poste").val();
        var typeMission = $("#typeMission").val();
        var pieceIdentite = $("#piece_identite")[0].files[0];
        var dpae = $("#dpae")[0].files[0];
        var permit = $("#permit")[0].files[0];
        var certificatA1 = $("#certificat_a1")[0].files[0];
        var certificatZoll = $("#certificat_zoll")[0].files[0];
        var photo = $("#photo")[0].files[0];

        if (nom === "" || prenom === "" || dateNaissance === "" || nationalite === "" || poste === "" || typeMission === "") {
            alert("Veuillez remplir tous les champs !");
            return;
        }
        if (!pieceIdentite || !dpae || !permit || !certificatA1 || !certificatZoll || !photo) {
          alert("Veuillez sélectionner tous les fichiers requis !");
          return;
      }
        var form_data = new FormData();
        form_data.append("nom", nom);
        form_data.append("prenom", prenom);
        form_data.append("dateNaissance", dateNaissance);
        form_data.append("nationalite", nationalite);
        form_data.append("poste", poste);
        form_data.append("typeMission", typeMission);
        form_data.append("piece_identite", pieceIdentite);
        form_data.append("dpae", dpae);
        form_data.append("permit", permit);
        form_data.append("certificat_a1", certificatA1);
        form_data.append("certificat_zoll", certificatZoll);
        form_data.append("photo", photo);
        $.ajax({
            url: "../../models/ajouterSalarie.php", 
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            success: function(data) {
                if (data.includes('text-echec')) {
                    $("#ajoutSalarie").modal("hide");
                    $("#addsalarie_echec").removeClass("text-checked").addClass("text-echec").html(data);
                    $("#EchecAddSalarie").modal("show");
                    setTimeout(function () {
                      if ($("#EchecAddSalarie").length > 0) {
                        $("#EchecAddSalarie").modal("hide");
                      }
                    }, 4000);
                    view_salarie_record();
                } else {
                    $("#ajoutSalarie").modal("hide");
                    $("#addsalarie_success").addClass("text-checked").html(data);
                    $("#SuccessAddSalarie").modal("show");
                    $("#addsalarie_success").removeClass("text-echec").addClass("text-checked");
                    setTimeout(function () {
                      if ($("#SuccessAddSalarie").length > 0) {
                        $("#SuccessAddSalarie").modal("hide");
                      }
                    }, 4000);
                    view_salarie_record();
                }
            } 
        });
    });
}

// Affichier Salarie
function get_salarie_data() {
    $(document).on("click", "#btn_modif_salarie", function () {
        var ID = $(this).attr("data-id");
        $.ajax({
            url: "../../models/getSalarie.php",
            method: "post",
            data: {
              SalarieID: ID
            },
            dataType: "JSON",
            success: function (data) {
              $("#id_Salarie").val(data[0]);
              $("#nom_Salarie").val(data[1]);
              $("#prenom_Salarie").val(data[2]);
              $("#dateNaissance_Salarie").val(data[3]);
              $("#nationalite_Salarie").val(data[4]);
              $("#poste_Salarie").val(data[5]);
              $("#typeMission_Salarie").val(data[6]);
              $("#updateSalarie").modal("show");
            },
        });
    });
}


// Modifier Salarie
function update_salarie() {
    $(document).on("click", "#update_salarie", function () {
        $("#updateSalarie").scrollTop(0);
        var id_Salarie = $("#id_Salarie").val();
        var nom_Salarie = $("#nom_Salarie").val();
        var prenom_Salarie = $("#prenom_Salarie").val();
        var dateNaissance_Salarie = $("#dateNaissance_Salarie").val();
        var nationalite_Salarie = $("#nationalite_Salarie").val();
        var poste_Salarie = $("#poste_Salarie").val();
        var typeMission_Salarie = $("#typeMission_Salarie").val();
        var form_data = new FormData();
        form_data.append("id_Salarie", id_Salarie);
        form_data.append("nom_Salarie", nom_Salarie);
        form_data.append("prenom_Salarie", prenom_Salarie);
        form_data.append("dateNaissance_Salarie", dateNaissance_Salarie);
        form_data.append("nationalite_Salarie", nationalite_Salarie);
        form_data.append("poste_Salarie", poste_Salarie);
        form_data.append("typeMission_Salarie", typeMission_Salarie);
        $.ajax({
            url: "../../models/updateSalarie.php",
            type: "POST",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.includes('text-echec')) {
                    $("#updateSalarie").modal("hide");
                    $("#upsalarie_echec").removeClass("text-checked").addClass("text-echec").html(data);
                    $("#EchecUpSalarie").modal("show");
                    setTimeout(function () {
                      if ($("#EchecUpSalarie").length > 0) {
                        $("#EchecUpSalarie").modal("hide");
                      }
                    }, 4000);
                    view_salarie_record();
                } else {
                    $("#updateSalarie").modal("hide");
                    $("#upsalarie_success").addClass("text-checked").html(data);
                    $("#SuccessUpSalarie").modal("show");
                    $("#upsalarie_success").removeClass("text-echec").addClass("text-checked");
                    setTimeout(function () {
                      if ($("#SuccessUpSalarie").length > 0) {
                        $("#SuccessUpSalarie").modal("hide");
                      }
                    }, 4000);
                    view_salarie_record();
                }
            },
        });
    });
} 
$(document).click(function(event) {
    if (!$(event.target).closest('#updateSalarie').length) {
        $('#updateSalarie').modal('hide');
    }
});   

// Supprimer Salarie
function supprimer_salarie() {
    $(document).on("click", "#btn_supprime_salarie", function () {
        var Delete_ID = $(this).attr("data-id1");
        $("#deleteSalarie").modal("show");
        $(document).on("click", "#btn_delete", function () {
            $.ajax({
                url: "../../models/supprimerSalarie.php",
                method: "post",
                data: {
                    SalarieID: Delete_ID
                },
                success: function (data) {
                    if (data.includes('text-echec')) {
                      $("#deleteSalarie").modal("hide");
                      $("#deletesalarie_echec").removeClass("text-checked").addClass("text-echec").html(data);
                      $("#EchecDeleteSalarie").modal("show");
                      setTimeout(function () {
                        if ($("#EchecDeleteSalarie").length > 0) {
                          $("#EchecDeleteSalarie").modal("hide");
                        }
                      }, 4000);
                      view_salarie_record();
                    } else {
                      $("#deleteSalarie").modal("hide");
                      $("#deletesalarie_success").addClass("text-checked").html(data);
                      $("#SuccessDeleteSalarie").modal("show");
                      $("#deletesalarie_success").removeClass("text-echec").addClass("text-checked");
                      setTimeout(function () {
                        if ($("#SuccessDeleteSalarie").length > 0) {
                          $("#SuccessDeleteSalarie").modal("hide");
                        }
                      }, 4000);
                      view_salarie_record();
                    }
                },
            });
        });
    });
}
$(document).click(function(event) {
    if (!$(event.target).closest('#deleteSalarie').length) {
        $('#deleteSalarie').modal('hide');
    }
});

// Afficher Document Salarie
function get_salarie_document() {
    $(document).on("click", "#btn_document_salarie", function () {
        var ID = $(this).attr("data-document");
        $.ajax({
          url: "../../models/getDocumentSalarie.php",
          method: "POST",
          data: {SalarieID: ID},
          dataType: "json",
          success: function (data) {
            $("#id_Salarie").val(data[0]);
            $("#pieceid_Salarie").val(data[1]);
            $("#dpae_Salarie").val(data[2]);
            $("#permis_Salarie").val(data[3]);
            $("#certifa1_Salarie").val(data[4]);
            $("#certifzoll_Salarie").val(data[5]);
            $("#photo_Salarie").val(data[6]);
            $("#documentSalarie").modal("show");
          },
        });
    });
}
$(document).click(function(event) {
    if (!$(event.target).closest('#documentSalarie').length) {
        $('#documentSalarie').modal('hide');
    }
});


