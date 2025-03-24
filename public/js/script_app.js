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
    update_salarie_document();
    // Sous-traitant 
    view_soustraitant_record(); 
    ajout_soustraitant(); 
    get_soustraitant_data();
    update_soustraitant();
    supprimer_soustraitant();
    get_soustraitant_chefprojet_data();
    get_soustraitant_chefprojet_demande_data();
    get_soustraitant_document();
    // demande 
    view_demande_record();
    update_status_demande();
    ajout_demande();
    supprimer_demande();
    download_document_demande();

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
function searchpagination(id, title, EnteteDroite, titremodule, titre) {
    $('.dataTables_length').parent().parent().css('align-items', 'center');
    // Création du titre avec breadcrumb
    let headerHTML = `<nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <div class="breadcrumb-item" style="font-size: 23px; font-weight: bold;">${titremodule}</div>
            <div class="breadcrumb-item active" style="font-size: 19px; color:#470EE9; font-weight: bold;" aria-current="page">${titre}</div>
        </ol></nav>`;
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
function searchpagination_withoutbuttom(id, title, EnteteDroite, titremodule) {
    $('.dataTables_length').parent().parent().css('align-items', 'center');
    // Création du titre avec breadcrumb
    let headerHTML = `<nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <div class="breadcrumb-item" style="font-size: 23px; font-weight: bold;">${titremodule}</div>
        </ol></nav>`;
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
          searchpagination("ajout_salarie","Ajouter un salarié",$('#listeSalarie_filter'),"Salariés","Liste des salariés");
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
        $("#ajoutSalarie").scrollTop(0);
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
            $("#message_salarie").addClass("echec-modal").html("Veuillez remplir tous les champs obligatoires !");
        }else if (!pieceIdentite || !dpae || !permit || !certificatA1 || !certificatZoll || !photo) {
            $("#message_salarie").addClass("echec-modal").html("Veuillez sélectionner tous les fichiers requis !");
        }else{
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
        }
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
        if (nom_Salarie === "" || prenom_Salarie === "" || dateNaissance_Salarie === "" || nationalite_Salarie === "" || poste_Salarie === "" || typeMission_Salarie === "") {
            $("#messageup_salarie").addClass("echec-modal").html("Veuillez remplir tous les champs obligatoires !");
        }else{
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
        }
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
            $(".update_document").attr("data-document", data[0]);
            $("#pieceid_Salarie").val(data[1]);
            if (!data[1]) {
                $("#link_pieceid").css("background-color", "#FF4E4E");
                $("#link_pieceid").attr("href", "javascript:void(0)");
            } else {
                $("#link_pieceid").css("border", "#FFF0DB");
                $("#link_pieceid").attr("href", data[1]);
            }
            $("#dpae_Salarie").val(data[2]);
            if (!data[2]) {
                $("#link_dpae").css("background-color", "#FF4E4E");
                $("#link_dpae").attr("href", "javascript:void(0)");
            } else {
                $("#link_dpae").css("border", "#FFF0DB");
                $("#link_dpae").attr("href", data[2]);
            }
            $("#permis_Salarie").val(data[3]);
            if (!data[3]) {
                $("#link_permis").css("background-color", "#FF4E4E");
                $("#link_permis").attr("href", "javascript:void(0)");
            } else {
                $("#link_permis").css("border", "#FFF0DB");
                $("#link_permis").attr("href", data[3]);
            }
            $("#certifa1_Salarie").val(data[4]);
            if (!data[4]) {
                $("#link_certifa1").css("background-color", "#FF4E4E");
                $("#link_certifa1").attr("href", "javascript:void(0)");
            } else {
                $("#link_certifa1").css("border", "#FFF0DB");
                $("#link_certifa1").attr("href", data[4]);
            }
            $("#certifzoll_Salarie").val(data[5]);
            if (!data[5]) {
                $("#link_certifzoll").css("background-color", "#FF4E4E");
                $("#link_certifzoll").attr("href", "javascript:void(0)");
            } else {
                $("#link_certifzoll").css("border", "#FFF0DB");
                $("#link_certifzoll").attr("href", data[5]);
            }
            $("#photo_Salarie").val(data[6]);
            if (!data[6]) {
                $("#link_photo").css("background-color", "#FF4E4E");
                $("#link_photo").attr("href", "javascript:void(0)");
            } else {
                $("#link_photo").css("border", "#FFF0DB");
                $("#link_photo").attr("href", data[6]);
            }
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

// Modifier document salarie
function update_salarie_document() {
    $(".update_document").on("change", function (event) {
        event.preventDefault();
        var ID = $(this).attr("data-document");
        var file_input = $(this).prop("files")[0];
        var type_document = $(this).data("doc"); 
        var form_data = new FormData();
        form_data.append("document", file_input);
        form_data.append("type_document", type_document);
        form_data.append("SalarieID", ID);
        $.ajax({
            url: "../../models/updateDocumentSalarie.php",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            success: function (response) {
                window.location.reload();
            },
            error: function () {
                alert("Une erreur est survenue lors de l'envoi du document.");
            }
        });
    });
}
 /////////////////////// Module Sous-traitant //////////////////

 function view_soustraitant_record() {
    $.ajax({
      url: "../../models/viewSousTraitant.php",
      method: "post",
      success: function (data) {
        try {
          data = $.parseJSON(data);
          if (data.status == "success") {
            $("#table_listeSousTraitant").html(data.html);
            $('#listeSousTraitant').DataTable({ "info": false});
            searchpagination("ajout_soustraitant","Ajouter un sous-traitant",$('#listeSousTraitant_filter'),"Sous-traitants","Liste des sous-traitant");
          }
        } catch (e) { 
          console.error("Invalid Response!" , data);
        }
      },
    });
  }

// Ajouter sous-traitant
function ajout_soustraitant(){
    $(document).on("click", "#ajout_soustraitant", function () {
        $("#ajoutSoustraitant").modal("show");
    });
    $(document).on("click", "#ajouter_soustraitant", function () {
        $("#ajoutSoustraitant").scrollTop(0);
        
        var nom = $("#nom").val();
        var nomGerant = $("#nomGerant").val();
        var adresse = $("#adresse").val();
        var pays = $("#pays").val();
        var siret = $("#siret").val();
        var email = $("#email").val();
        var telephone = $("#telephone").val();
        var iban = $("#iban").val();
        var typesMission = $("#typeMission").val();
        var chefProjet = $("#chefProjet").val();

        if (nom === "" || nomGerant === "" || adresse === "" || pays === "" || siret === "" || email === "" || telephone === "" || iban === "" || typeMission === "" || chefProjet === "") {
            $("#message_soustraitant").addClass("echec-modal").html("Veuillez remplir tous les champs obligatoires !");
        } else {
            var form_data = new FormData();
            form_data.append("nom", nom);
            form_data.append("nomGerant", nomGerant);
            form_data.append("adresse", adresse);
            form_data.append("pays", pays);
            form_data.append("siret", siret);
            form_data.append("email", email);
            form_data.append("telephone", telephone);
            form_data.append("iban", iban);
            form_data.append("typesMission", typesMission);
            form_data.append("chefProjet", chefProjet);
            $.ajax({
                url: "../../models/ajouterSoustraitant.php", 
                type: "POST",
                processData: false,
                contentType: false,
                data: form_data,
                success: function(data) {
                    if (data.includes('text-echec')) {
                        $("#ajoutSoustraitant").modal("hide");
                        $("#addsoustraitant_echec").removeClass("text-checked").addClass("text-echec").html(data);
                        $("#EchecAddSoustraitant").modal("show");
                        setTimeout(function () {
                            if ($("#EchecAddSoustraitant").length > 0) {
                                $("#EchecAddSoustraitant").modal("hide");
                            }
                        }, 4000);
                        view_soustraitant_record();
                    } else {
                        $("#ajoutSoustraitant").modal("hide");
                        $("#addsoustraitant_success").addClass("text-checked").html(data);
                        $("#SuccessAddSoustraitant").modal("show");
                        $("#addsoustraitant_success").removeClass("text-echec").addClass("text-checked");
                        setTimeout(function () {
                            if ($("#SuccessAddSoustraitant").length > 0) {
                                $("#SuccessAddSoustraitant").modal("hide");
                            }
                        }, 4000);
                        view_soustraitant_record();
                    }
                } 
            });
        }
    });
}

// Affichier Soustraitant
function get_soustraitant_data() {
    $(document).on("click", "#btn_modif_soustraitant", function () {
        var ID = $(this).attr("data-id");
        $.ajax({
            url: "../../models/getSoustraitant.php",
            method: "post",
            data: {
              ID: ID
            },
            dataType: "JSON",
            success: function (data) {
              $("#id_Entreprise").val(data[0]);
              $("#nom_Entreprise").val(data[1]);
              $("#nomGerant_Entreprise").val(data[2]);
              $("#adresse_Entreprise").val(data[3]);
              $("#pays_Entreprise").val(data[4]);
              $("#siret_Entreprise").val(data[5]);
              $("#email_Entreprise").val(data[6]);
              $("#telephone_Entreprise").val(data[7]);
              $("#iban_Entreprise").val(data[8]);
              $("#typesMission_Entreprise").val(data[9]);
              $("#chefProjet_Entreprise").val(data[10]);
              $("#modifSoustraitant").modal("show");
            },
        });
    });
}

// Modifier sous-traitant 
function update_soustraitant() {
    $(document).on("click", "#modifier_soustraitant", function () {
        $("#modifSoustraitant").scrollTop(0);
        var id = $("#id_Entreprise").val();
        var nom = $("#nom_Entreprise").val();
        var nomGerant = $("#nomGerant_Entreprise").val();
        var adresse = $("#adresse_Entreprise").val();
        var pays = $("#pays_Entreprise").val();
        var siret = $("#siret_Entreprise").val();
        var email = $("#email_Entreprise").val();
        var telephone = $("#telephone_Entreprise").val();
        var iban = $("#iban_Entreprise").val();
        var typesMission = $("#typesMission_Entreprise").val();
        var chefProjet = $("#chefProjet_Entreprise").val();
        if (nom === "" || nomGerant === "" || adresse === "" || pays === "" || siret === "" || email === "" || telephone === "" || iban === "" || typesMission === "" || chefProjet === "") {
            $("#messageup_soustraitant").addClass("echec-modal").html("Veuillez remplir tous les champs obligatoires !");
        }else{
            var form_data = new FormData();
            form_data.append("id", id);
            form_data.append("nom", nom);
            form_data.append("nomGerant", nomGerant);
            form_data.append("adresse", adresse);
            form_data.append("pays", pays);
            form_data.append("siret", siret);
            form_data.append("email", email);
            form_data.append("telephone", telephone);
            form_data.append("iban", iban);
            form_data.append("typesMission", typesMission);
            form_data.append("chefProjet", chefProjet);
            $.ajax({
                url: "../../models/updateSoustraitant.php",
                type: "POST",
                data: form_data,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.includes('text-echec')) {
                        $("#modifSoustraitant").modal("hide");
                        $("#upsoustraitant_echec").removeClass("text-checked").addClass("text-echec").html(data);
                        $("#EchecUpSoustraitant").modal("show");
                        setTimeout(function () {
                          if ($("#EchecUpSoustraitant").length > 0) {
                            $("#EchecUpSoustraitant").modal("hide");
                          }
                        }, 4000);
                        view_soustraitant_record();
                    } else {
                        $("#modifSoustraitant").modal("hide");
                        $("#upsoustraitant_success").addClass("text-checked").html(data);
                        $("#SuccessUpSoustraitant").modal("show");
                        $("#upsoustraitant_success").removeClass("text-echec").addClass("text-checked");
                        setTimeout(function () {
                          if ($("#SuccessUpSoustraitant").length > 0) {
                            $("#SuccessUpSoustraitant").modal("hide");
                          }
                        }, 4000);
                        view_soustraitant_record();
                    }
                },
            });
        }
    });
} 
$(document).click(function(event) {
    if (!$(event.target).closest('#modifSoustraitant').length) {
        $('#modifSoustraitant').modal('hide');
    }
});

// Supprimer Sous-traitant
function supprimer_soustraitant() {
    $(document).on("click", "#btn_supprime_soustraitant", function () {
        var ID = $(this).attr("data-id1");
        $("#deleteSoustraitant").modal("show");
        $(document).on("click", "#btn_delete", function () {
            $.ajax({
                url: "../../models/supprimerSoustraitant.php",
                method: "post",
                data: {
                    ID: ID
                },
                success: function (data) {
                    if (data.includes('text-echec')) {
                      $("#deleteSoustraitant").modal("hide");
                      $("#deletesoustraitant_echec").removeClass("text-checked").addClass("text-echec").html(data);
                      $("#EchecDeleteSoustraitant").modal("show");
                      setTimeout(function () {
                        if ($("#EchecDeleteSoustraitant").length > 0) {
                          $("#EchecDeleteSoustraitant").modal("hide");
                        }
                      }, 4000);
                      view_soustraitant_record();
                    } else {
                      $("#deleteSoustraitant").modal("hide");
                      $("#deletesoustraitant_success").addClass("text-checked").html(data);
                      $("#SuccessDeleteSoustraitant").modal("show");
                      $("#deletesoustraitant_success").removeClass("text-echec").addClass("text-checked");
                      setTimeout(function () {
                        if ($("#SuccessDeleteSoustraitant").length > 0) {
                          $("#SuccessDeleteSoustraitant").modal("hide");
                        }
                      }, 4000);
                      view_soustraitant_record();
                    }
                },
            });
        });
    });
}
$(document).click(function(event) {
    if (!$(event.target).closest('#deleteSoustraitant').length) {
        $('#deleteSoustraitant').modal('hide');
    }
});

// Affichier chefProjet de Soustraitant
function get_soustraitant_chefprojet_data() {
    $(document).on("click", "#btn_chefProjet_soustraitant", function () {
        var ID = $(this).attr("data-id");
        var ID_chefProjet = $(this).attr("data-chefProjet");
        $.ajax({
            url: "../../models/getSoustraitantChefProjet.php",
            method: "post",
            data: {
              ID: ID,
              ID_chefProjet: ID_chefProjet
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                var html = "<p style='text-align: left; color:black'><strong>Nom :</strong> " + data[0] + "</p></br>";
                html += "<p style='text-align: left;color:black'><strong>Prénom :</strong> " + data[1] + "</p></br>";
                html += "<p style='text-align: left;color:black'><strong>Date de naissance :</strong> " + data[2] + "</p></br>";
                html += "<p style='text-align: left;color:black'><strong>Nationalité :</strong> " + data[3] + "</p></br>";
                $("#info_chefProjet").html(html);
                $("#affiche_chefProjet").modal("show");
            },
        });
    });
}

// Ajouter document sous-traitant 

function get_soustraitant_document() {
    $(document).on("click", "#btn_document_soustraitant", function () {
        var ID = $(this).attr("data-document");
        $.ajax({
          url: "../../models/getDocumentSoustraitant.php",
          method: "POST",
          data: {ID: ID},
          dataType: "json",
          success: function (data) {
            $("#id_Document").val(data[0]);
            $("#idEntreprise_Document").val(data[1]);
            $("#kbis_Document").val(data[2]);
            if (!data[2]) {
                $("#kbis_Document").css("background-color", "#FF4E4E");
                $("#kbis_Document").attr("href", "javascript:void(0)");
            } else {
                $("#kbis_Document").css("border", "#FFF0DB");
                $("#kbis_Document").attr("href", data[2]);
            }

            $("#dateValiditeKbis_Document").val(data[3]);
            $("#pieceIdentitieGerant_Document").val(data[4]);
            $("#dateValiditePIGerant_Document").val(data[5]);
            $("#attestationRegulariteFiscale_Document").val(data[6]);
            $("#dateValiditeAttestRegulariteFiscale_Document").val(data[7]);
            $("#attestationURSSAF_Document").val(data[8]);
            $("#dateValiditeAttestURSSAF_Document").val(data[9]);
            $("#assuranceRcPro_Document").val(data[10]);
            $("#dateValiditeAssuranceRcPro_Document").val(data[11]);
            $("#siret_Document").val(data[12]);
            $("#dateValiditeSiret_Document").val(data[13]);
            $("#caisseBTP_Document").val(data[14]);
            $("#dateValiditeCaisseBTP_Document").val(data[15]);
            $("#numeroFiscal_Document").val(data[16]);
            $("#dateValiditeNumFiscal_Document").val(data[17]);
            $("#numeroTVA_Document").val(data[18]);
            $("#dateValiditeNumTVA_Document").val(data[19]);
            $("#assurenceDecennale_Document").val(data[20]);
            $("#dateValiditeAssurenceDecennale_Document").val(data[21]);

          },
        });
    });
}

///////////////////////////// Module demandes /////////////////////////////

function view_demande_record() {
    $.ajax({
      url: "../../models/viewDemande.php",
      method: "post",
      success: function (data) {
        try {
          data = $.parseJSON(data);
          if (data.status == "success") {
            $("#table_listeDemande").html(data.html);
            $('#listeDemande').DataTable({ "info": false});
            searchpagination_withoutbuttom("ajout_demande","Ajouter un demande",$('#listeDemande_filter'),"Tous les demandes");
          }
        } catch (e) { 
          console.error("Invalid Response!" , data);
        }
      },
    });
  }
 
// Affichier chefProjet demande
  function get_soustraitant_chefprojet_demande_data() {
    $(document).on("click", "#btn_chefProjet_demande", function () {
        var ID = $(this).attr("data-id-demande");
        var ID_chefProjet = $(this).attr("data-chefProjet-demande");
        console.log(ID_chefProjet);
        console.log(ID);
        $.ajax({
            url: "../../models/getSoustraitantChefProjet.php",
            method: "post",
            data: {
              ID: ID,
              ID_chefProjet: ID_chefProjet
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                var html = "<p style='text-align: left; color:black'><strong>Nom :</strong> " + data[0] + "</p></br>";
                html += "<p style='text-align: left;color:black'><strong>Prénom :</strong> " + data[1] + "</p></br>";
                html += "<p style='text-align: left;color:black'><strong>Date de naissance :</strong> " + data[2] + "</p></br>";
                html += "<p style='text-align: left;color:black'><strong>Nationalité :</strong> " + data[3] + "</p></br>";
                $("#info_chefProjet_demande").html(html);
                $("#affiche_chefProjet_demande").modal("show");

            },
        });
    });
}

// Modifier status
function update_status_demande() {
    $(document).on("click", "#btn_accepter, #btn_refuser", function () {
        var ID = $(this).attr("data-demande");
        var action = $(this).attr("id") === "btn_accepter" ? "accepter" : "refuser";
        $.ajax({
            url: "../../models/updateStatusDemande.php",
            method: "post",
            data: {
              ID: ID,
              action: action
            },
            dataType: "JSON",
            success: function (data) {
                window.location.reload();
            },    
        });
    });
}

// Ajouter un demande
function ajout_demande(){
    $(document).on("click", "#ajout_demande", function () {
        $("#ajoutDemande").modal("show");
    });
    $(document).on("click", "#ajouter_demande", function () {
        $("#ajoutDemande").scrollTop(0);
        
        var nom = $("#nom").val();
        var societe = $("#societe").val();

        if (nom === "" || societe === "" ) {
            $("#message_demande").addClass("echec-modal").html("Veuillez remplir tous les champs obligatoires !");
        }

        var dateValiditeKbis = $("#dateValiditeKbis_Document").val();
        var dateValiditePIGerant = $("#dateValiditePIGerant_Document").val();
        var dateValiditeAttestRegulariteFiscale = $("#dateValiditeAttestRegulariteFiscale_Document").val();
        var dateValiditeAttestURSSAF = $("#dateValiditeAttestURSSAF_Document").val();
        var dateValiditeAssuranceRcPro = $("#dateValiditeAssuranceRcPro_Document").val();
        var dateValiditeSiret = $("#dateValiditeSiret_Document").val();
        var dateValiditeCaisseBTP = $("#dateValiditeCaisseBTP_Document").val();
        var dateValiditeNumFiscal = $("#dateValiditeNumFiscal_Document").val();
        var dateValiditeNumTVA = $("#dateValiditeNumTVA_Document").val();
        var dateValiditeAssurenceDecennale = $("#dateValiditeAssurenceDecennale_Document").val();
        var kbis = $("#kbis_Document")[0].files[0];
        var pieceIdentitieGerant = $("#pieceIdentitieGerant_Document")[0].files[0];
        var attestationRegulariteFiscale = $("#attestationRegulariteFiscale_Document")[0].files[0];
        var attestationURSSAF = $("#attestationURSSAF_Document")[0].files[0];
        var assuranceRcPro = $("#assuranceRcPro_Document")[0].files[0];
        var siret = $("#siret_Document")[0].files[0];
        var caisseBTP = $("#caisseBTP_Document")[0].files[0];
        var numeroFiscal = $("#numeroFiscal_Document")[0].files[0];
        var numeroTVA = $("#numeroTVA_Document")[0].files[0];
        var assurenceDecennale = $("#assurenceDecennale_Document")[0].files[0];
        var form_data = new FormData();
        form_data.append("nom", nom);
        form_data.append("societe", societe);
        form_data.append("dateValiditeKbis", dateValiditeKbis);
        form_data.append("dateValiditePIGerant", dateValiditePIGerant);
        form_data.append("dateValiditeAttestRegulariteFiscale", dateValiditeAttestRegulariteFiscale);
        form_data.append("dateValiditeAttestURSSAF", dateValiditeAttestURSSAF);
        form_data.append("dateValiditeAssuranceRcPro", dateValiditeAssuranceRcPro);
        form_data.append("dateValiditeSiret", dateValiditeSiret);
        form_data.append("dateValiditeCaisseBTP", dateValiditeCaisseBTP);
        form_data.append("dateValiditeNumFiscal", dateValiditeNumFiscal);
        form_data.append("dateValiditeNumTVA", dateValiditeNumTVA);
        form_data.append("dateValiditeAssurenceDecennale", dateValiditeAssurenceDecennale);
        form_data.append("kbis", kbis);
        form_data.append("pieceIdentitieGerant", pieceIdentitieGerant);
        form_data.append("attestationRegulariteFiscale", attestationRegulariteFiscale);
        form_data.append("attestationURSSAF", attestationURSSAF);
        form_data.append("assuranceRcPro", assuranceRcPro);
        form_data.append("siret", siret);
        form_data.append("caisseBTP", caisseBTP);
        form_data.append("numeroFiscal", numeroFiscal);
        form_data.append("numeroTVA", numeroTVA);
        form_data.append("assurenceDecennale", assurenceDecennale);
        
       
        $.ajax({
            url: "../../models/ajouterDemande.php", 
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            success: function(data) {
                if (data.includes('text-echec')) {
                    $("#ajoutDemande").modal("hide");
                    $("#adddemande_echec").removeClass("text-checked").addClass("text-echec").html(data);
                    $("#EchecAddDemande").modal("show");
                    setTimeout(function () {
                        if ($("#EchecAddDemande").length > 0) {
                            $("#EchecAddDemande").modal("hide");
                        }
                    }, 4000);
                    view_demande_record();
                } else {
                    $("#ajoutDemande").modal("hide");
                    $("#adddemande_success").addClass("text-checked").html(data);
                    $("#SuccessAddDemande").modal("show");
                    $("#adddemande_success").removeClass("text-echec").addClass("text-checked");
                    setTimeout(function () {
                        if ($("#SuccessAddDemande").length > 0) {
                            $("#SuccessAddDemande").modal("hide");
                        }
                    }, 4000);
                    view_demande_record();
                }
            },
        });
    });
}

// Supprimer Demande
function supprimer_demande() {
    $(document).on("click", "#btn_supprime_demande", function () {
        var ID = $(this).attr("data-demande");
        $("#deleteDemande").modal("show");
        $(document).on("click", "#btn_delete", function () {
            $.ajax({
                url: "../../models/supprimerDemande.php",
                method: "post",
                data: {
                    ID: ID
                },
                success: function (data) {
                    if (data.includes('text-echec')) {
                      $("#deleteDemande").modal("hide");
                      $("#deletedemande_echec").removeClass("text-checked").addClass("text-echec").html(data);
                      $("#EchecDeleteDemande").modal("show");
                      setTimeout(function () {
                        if ($("#EchecDeleteDemande").length > 0) {
                          $("#EchecDeleteDemande").modal("hide");
                        }
                      }, 4000);
                      view_demande_record();
                    } else {
                      $("#deleteDemande").modal("hide");
                      $("#deletedemande_success").addClass("text-checked").html(data);
                      $("#SuccessDeleteDemande").modal("show");
                      $("#deletedemande_success").removeClass("text-echec").addClass("text-checked");
                      setTimeout(function () {
                        if ($("#SuccessDeleteDemande").length > 0) {
                          $("#SuccessDeleteDemande").modal("hide");
                        }
                      }, 4000);
                      view_demande_record();
                    }
                },
            });
        });
    });
}
$(document).click(function(event) {
    if (!$(event.target).closest('#deleteDemande').length) {
        $('#deleteDemande').modal('hide');
    }
});
 
// Telecharger document Demande 

function download_document_demande() {
    $(document).on("click", "#btn_telecharger", function () {
        var id = $(this).attr("data-demande");
        window.location.href = "../../models/downloadDocumentDemande.php?id=" + id;
    });    
}
