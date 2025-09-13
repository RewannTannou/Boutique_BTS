<section class="SectionConnexionAdmin"> 
    <div class="titre">
        Se connecter
    </div>
    <div class="containerConnexionAdmin" id="containerConnexionAdmin">
        <div class="form-container sign-in">
            <form method="post" action="index.php?controleur=Admin&action=verifierConnexion">
                <legend>Identification</legend>
                <div class="input">
                    <label for="login">Login :</label> <input type="text" name="login" " /> <br/>
                    <label for="passe">Mot de passe :</label><input type="password" name="passe"  />
                </div>
                <br/>
                <div class="connexion_auto">
                    <label id="lblConnexionAuto" for="connexion_auto"> Connexion automatique : </label><br/>
                    <input type="checkbox" name="connexion_auto" id="connexion_auto" />
                </div>
                <div class="input">
                    <input id="connexion" type="submit" value="Connexion" />
                </div>
                <div class="lienInscription">
                    <p> Vous n'avez pas de compte créer s'en un: </p></br>
                    <a href="index.php?controleur=Client&action=inscriptionClient">Créer un Compte</a>
                </div>
            </form>
        </div>
    </div>
</section>