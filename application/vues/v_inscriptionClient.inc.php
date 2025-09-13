

<script type="text/javascript">
    $(document).ready(function () {
        var formValide = false;

        // Gestion du clic sur le bouton d'inscription
        $("#inscription").click(function () {
            formValide = true;

            // Validation des champs texte et mots de passe
            $("#containerInscriptionClient input[type=text], #containerInscriptionClient input[type=password]").each(function () {
                controleSaisie($(this).prop('id'));
            });

            return formValide; // Bloque la soumission si `formValide` est faux
        });

        // Effacement des messages d'erreur au remplissage des champs
        $("#containerInscriptionClient input[type=text], #containerInscriptionClient input[type=password]").keypress(function () {
            $(this).next().fadeOut();
        });

        // Validation des champs au changement
        $("#containerInscriptionClient input").blur(function () {
            controleSaisie($(this).prop('id'));
        });

        // Fonction de validation des champs
        function controleSaisie(idchamp) {
            if ($("#" + idchamp).val() == "") {
                $("#" + idchamp)
                        .next()
                        .removeClass("message-ok")
                        .addClass("message-erreur")
                        .text("Le champ est vide !")
                        .fadeIn();
                formValide = false;
            } else {
                var regex, messageErreur;
                switch (idchamp) {
                    case 'nom':
                        regex = /^[a-zA-ZÀ-ÿ\- ]{2,50}$/;
                        messageErreur = "Nom non valide !";
                        break;
                    case 'prenom' :
                        regex = /^[a-zA-ZÀ-ÿ\- ]{2,50}$/;
                        messageErreur = " Prenom non valide !";
                        break;
                        
                    case 'login' :
                        loginExistant = false;
                        chercheLoginBD();
                        if (loginExistant)
                            return;
                        regex = /^[a-z]+$/i;
                        messageErreur = "Pseudo non valide !";
                        break;

                    case 'mdp':
                        regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;
                        messageErreur = "Mot de passe non valide !";
                        break;
                    case 'email':
                        regex = /^[\w\-.]+@([\w-]+\.)+[\w-]{2,4}$/;
                        messageErreur = "Email non valide !";
                        break;
                    case 'codePostal':
                        let regex = /^\d{4,5}$/;
                        if (!regex.test(codePostal)) {
                            messageErreur = "Code postal non valide !";
                        }
                        break;
                    case 'ville':
                        regex = /^[a-zA-ZÀ-ÿ\- ]{2,50}$/;
                        messageErreur = "Ville non valide !";
                        break;
                    case 'tel':
                        regex = /^\+?\d{10,15}$/;
                        messageErreur = "Numéro de téléphone non valide !";
                        break;
                    default:
                        regex = "";
                }
                traiterRegex(idchamp, regex, messageErreur);
            }
        }

        // Validation avec regex
        function traiterRegex(idchamp, regex, messageErreur) {
            if (!$("#" + idchamp).val().match(regex)) {
                $("#" + idchamp)
                        .next()
                        .removeClass("message-ok")
                        .addClass("message-erreur")
                        .text(messageErreur)
                        .fadeIn();
                formValide = false;
            } else {
                $("#" + idchamp)
                        .next()
                        .removeClass("message-erreur")
                        .addClass("message-ok")
                        .text("OK")
                        .fadeIn();
            }
        }
        // TRAITEMENT VERIFICATION PSEUDO EXISTANT
//----------------------------------------
        var loginExistant = false;
        function chercheLoginBD() {
            $.ajax({

                type: "POST",
                url: "index.php?controleur=Client&action=cherchepseudo",
                data: {login: $("#login").val()}, // Utilisation d'un objet pour envoyer les données
                success: function (reponse) {
                    if (reponse == 1) {
                        $("#login").next()
                                .removeClass("message-ok")
                                .addClass("message-erreur")
                                .text("Le login existe déjà")
                                .show();
                        formValide = false; // Assurez-vous que cela est défini ailleurs
                        loginExistant = true; // Assurez-vous que cela est défini ailleurs
                    } else {
                        $("#login").next()
                                .removeClass("message-erreur")
                                .addClass("message-ok")
                                .text("Le login est disponible")
                                .show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Une erreur s'est produite : " + error); // Gestion des erreurs
                    $("#login").next()
                            .removeClass("message-ok message-erreur")
                            .text("Une erreur s'est produite, veuillez réessayer.")
                            .show();
                }
            });
        }
        //-------------------------------------

        // TRAITEMENT AUTOCOMPLETE CODEPOSTAL
//-------------------------------------
        $("#codePostal").autocomplete("application/vues/chercherCPVille.php", {
            width: 200,backgroundColor: "Black",selectFirst: false,scroll: true
        }); //D’autres options sont disponibles, voir doc en ligne

        $("#codePostal").result(function (event, data, formatted) {
            if (data)
            {
                $("#codePostal").val(data[1]);
                $("#ville").val(data[2]).prop("disabled", true);
            }
        });
        // Validation du formulaire avant soumission
        $("#nouveauClient").on("submit", function (event) {
            $("#ville").prop("disabled", false); // Réactiver le champ "ville" pour qu'il soit envoyé
        });



    });
</script>

<section class="SectionInscriptionClient">
    <div class="titre">Inscription Client</div>
    <div class="containerInscriptionClient" id="containerInscriptionClient">
        <form id="nouveauClient" method="post" action="index.php?controleur=Client&action=enregistrerClient">
            <div class="input">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required /><span></span><br />
            </div>
            <div class="input">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required /><br /><span></span>
            </div>
            <div class="input">
                <label for="login">Login :</label>
                <input type="text" id="login" name="login" required /><span></span><br />
            </div>
            <div class="input">
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" required /><span></span><br />
            </div>
            <div class="input">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required /><span></span><br />
            </div>
            <div class="input">
                <label for="codePostal">Code Postal :</label>
                <input type="text" id="codePostal" name="codePostal" required /><span></span><br />
            </div>
            <div class="input">
                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" required /><span></span><br />
            </div>
            <div class="input">
                <label for="rue">adresse :</label>
                <input type="text" id="rue" name="rue" required /><span></span><br />
            </div>
            <div class="input">
                <label for="tel">Téléphone :</label>
                <input type="tel" id="tel" name="tel" required /><span></span><br />
            </div>
            <div class="input">
                <input id="inscription" type="submit" value="S'inscrire" />
            </div>
        </form>
    </div>
</section>

<style>
    .SectionInscriptionClient {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 500px;
        text-align: center;
        margin: auto; /* Centrer la section */
    }

    .titre {
        font-size: 24px;
        margin-bottom: 20px;
        color: #512da8;
    }

    .containerInscriptionClient {
        display: flex;
        flex-direction: column;
    }

    .input {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="tel"] {
        width: 50%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }

    input[type="submit"] {
        background-color: #512da8;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #3e1f7d;
    }
    .message-erreur{
        background:url(../images/pasOK.png) 10px center no-repeat;
        padding: 0 0 0 30px;
        display:inline;
        color:#B30202;
    }
    .message-ok{
        background:url(../images/OK.png) 10px center no-repeat;
        padding: 0 0 0 30px;
        display:inline;
        color:#8FCF3C;
        font-weight:bold
    }
</style>
