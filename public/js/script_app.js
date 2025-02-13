
$(document).ready(function() {
    login();
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



    