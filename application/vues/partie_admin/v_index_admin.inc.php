<div class="admin-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <aside>
            <ul>
                <li data-section="categorie">Catégories</li>
                <ul id="submenu-categorie" class="submenu">
                    <li class="submenu-item" data-section="categorie" data-sub="ajouter-categorie">Ajouter Catégorie</li>
                    <li class="submenu-item" data-section="categorie" data-sub="modifier-categorie">Modifier Catégorie</li>
                    <li class="submenu-item" data-section="categorie" data-sub="supprimer-categorie">Supprimer Catégorie</li>
                </ul>
                <li data-section="produit">Produits</li>
                <ul id="submenu-produit" class="submenu">
                    <li class="submenu-item" data-section="produit" data-sub="ajouter-produit">Ajouter Produit</li>
                    <li class="submenu-item" data-section="produit" data-sub="modifier-produit">Modifier Produit</li>
                    <li class="submenu-item" data-section="produit" data-sub="supprimer-produit">Supprimer Produit</li>
                </ul>
                <li class="submenu"><a href="index.php?controleur=Admin&action=seDeconnecter">Déconnexion</a></li>

            </ul>
        </aside>
    </div>


    <section class="admin" id="admin-section">
        <div class="titre">
            Administration du site (Accès réservé)<br>
            - Bonjour <?php echo $_SESSION['login_admin']; ?> -
        </div>

        <!-- Menu Catégorie -->
        <div class="Categorie">


            <div id="section-categorie" class="admin-block">
                
                <div id="ajouter-categorie" class="admin-content">
                <h2 id="toggle-categorie" class="titre_modifier_ajouter_supp">Ajouter une Catégorie ↓</h2>
                    <form method="POST" action="index.php?controleur=Categories&action=ajouterCategorie">
                        <input type="hidden" name="action" value="ajouterCategorie">
                        <label for="nom">Nom de la Catégorie :</label>
                        <input type="text" id="nom" name="nom" placeholder="Entrez la nouvelle Categorie" required>
                        <input class="bouton_form" type="submit" value="Ajouter" />
                    </form>
                </div>

                <div id="modifier-categorie" class="admin-content">
                    <h2 id="toggle-categorie" class="titre_modifier_ajouter_supp"> Modifier une Catégorie ↓</h2>
                    <form action="index.php?controleur=Categories&action=modifierCategorie" method="POST">
                        <label for="categorie_a_modifier">Modifier Catégorie :</label>
                        <select id="categorie_a_modifier" name="categorie_a_modifier" required>
                            <option value="">Sélectionner une catégorie</option>
                            <?php
                            foreach ($lesCategories as $uneCategorie) { ?>
                                <option value="<?php echo $uneCategorie->id_Categorie ?>"><?php echo $uneCategorie->libelle ?></option>
                            <?php } ?>
                        </select>
                        <label for="nouveau_nom_categorie">Nouveau nom de la catégorie :</label>
                        <input type="text" id="nouveau_nom_categorie" name="nouveau_nom_categorie" placeholder="Entrez le nouveau nom" required>
                        <input class="bouton_form" type="submit" value="Modifier" />
                    </form>
                </div>

                <div id="supprimer-categorie" class="admin-content">
                    <h2 id="toggle-categorie" class="titre_modifier_ajouter_supp">Supprimer une Catégorie ↓</h2>
                    <form action="index.php?controleur=Categories&action=supprimer" method="POST">
                        <label for="categorie_a_supprimer">Supprimer une Catégorie :</label>
                        <select id="categorie_a_supprimer" name="categorie_a_supprimer" required>
                            <option value="">Sélectionner une catégorie</option>
                            <?php foreach ($lesCategories as $uneCategorie) { ?>
                                <option value="<?php echo $uneCategorie->id_Categorie ?>"><?php echo $uneCategorie->libelle ?></option>
                            <?php } ?>
                        </select>
                        <input class="bouton_form" type="submit" value="Supprimer" />
                    </form>
                </div>

            </div>
        </div>

        <!-- Gestion des produits -->
        <div class="produit">


            <div id="section-produit" class="admin-block">
                <h2 id="toggle-produit" class="titre_modifier_ajouter_supp">Ajouter / Modifier / Supprimer un produit ↓</h2>
                <div id="ajouter-produit" class="admin-content">
                    <form class="formAjouterProduit" method="POST" action="index.php?controleur=Produits&action=ajouterProduit">
                        <input type="hidden" name="action" value="ajouterProduit">
                        <label for="nom">Nom du produit :</label>
                        <input type="text" id="nom" name="nom" placeholder="Entrez nom du produit" required></br>
                        <label for="nom">Description du Produit :</label>
                        <input type="text" id="description" name="description" placeholder="Entrez la description" required></br>
                        <label for="nom">Prix du produit :</label>
                        <input type="text" id="prix" name="prix" placeholder="Entrez le prix du produit" required></br>
                        <label for="nom">Image du produit :</label>
                        <input type="file" id="image" name="image"></br>
                        <label for="nom">Categorie du produit :</label>
                        <select id="categorie_produit" name="categorie_produit" required>
                            <option value="">Sélectionner une catégorie</option>
                            <?php
                             //remplir $lesCategories avec toute mes catégories
                            foreach ($lesCategories as $uneCategorie) { // Remplir le select avec les catégories
                            ?>
                                <option value="<?php echo $uneCategorie->id_Categorie ?>"><?php echo $uneCategorie->libelle ?></option> //le nom sera afficher et la valeur récupérer sera l'id
                            <?php
                            }
                            ?>
                        </select></br>
                        <label for="nom">Fournisseur du produit :</label>
                        <select id="fournisseur" name="fournisseur" required placeholder="Entrez nom du produit">
                            <option value="">Sélectionner un fournisseur</option>
                            <?php
                            foreach ($lesFournisseur as $unFournisseur) { // Remplir le select avec les fournisseur
                            ?>
                                <option value="<?php echo $unFournisseur->id ?>"><?php echo $unFournisseur->nom ?></option> //le nom sera afficher et la valeur récupérer sera l'id
                            <?php
                            }
                            ?>
                        </select></br>
                        <input class="bouton_form" type="submit" value="Ajouter" />
                    </form>
                </div>

                <div id="modifier-produit" class="admin-content">
                    <form class="formModifierProduit" id="formModifierProduit" action="index.php?controleur=Produits&action=modifierProduit" method="POST">
                        <label for="produit_a_modifier">Modifier Produit :</label>

                        <select id="produit_a_modifier" name="produit_a_modifier" required>
                            <option value="">Sélectionner un produit</option>
                            <?php
                            

                            foreach ($lesProduits as $unProduit) { // Remplir le select avec les catégories
                            ?>
                                <option value="<?php echo $unProduit->id ?>"><?php echo $unProduit->nom ?></option>
                            <?php
                            }
                            ?>

                        </select>
                        <label for="nouveau_nom_produit">Nom du produit :
                            <input type="text" id="nouveau_nom_produit" name="nouveau_nom_produit" placeholder="Nouveau Nom" required></br>
                            <label for="descrption_produit">Description du produit :</label>
                            <input type="text" id="descrption_produit" name="descrption_produit" value="" required></br>
                            <label for="prix_produit">Prix du produit :</label>
                            <input type="text" id="prix_produit" name="prix_produit" value="" required></br>
                            <label for="image_produit">Image du produit :</label>
                            <input type="text" id="image_produit" name="image_produit" value="" required></br>
                            <label for="categorie_produit_a_modifier">Categorie du produit :</label>
                            <select id="categorie_produit_a_modifier" name="categorie_produit_a_modifier" required>
                                <option value="">Sélectionner une catégorie</option>
                                <?php
                                foreach ($lesCategories as $uneCategorie) { // Remplir le select avec les catégories
                                ?>
                                    <option value="<?php echo $uneCategorie->id_Categorie ?>"><?php echo $uneCategorie->libelle ?></option> //le nom sera afficher et la valeur récupérer sera l'id
                                <?php
                                }
                                ?>
                            </select></br>
                            <label for="fournisseur_a_modifier">Fournisseur du produit :</label>
                            <select id="fournisseur_a_modifier" name="fournisseur_a_modifier" required placeholder="Entrez nom du produit">
                                <option value="">Sélectionner un fournisseur</option>
                                <?php
                                foreach ($lesFournisseur as $unFournisseur) { // Remplir le select avec les fournisseur
                                ?>
                                    <option value="<?php echo $unFournisseur->id ?>"><?php echo $unFournisseur->nom ?></option> //le nom sera afficher et la valeur récupérer sera l'id
                                <?php
                                }
                                ?>
                            </select></br>

                            <input class="bouton_form" type="submit" value="Modifier">
                    </form>
                </div>




                <div id="supprimer-produit" class="admin-content">
                    <form class="formSuppProduit" action="index.php?controleur=Produits&action=supprimerProduit" method="POST">
                        <label for="produit_a_supprimer">Supprimer Catégorie :</label>
                        <select id="produit_a_supprimer" name="produit_a_supprimer" required>
                            <option value="">Sélectionner un produit</option>
                            <?php

                            foreach ($lesProduits as $unProduit) { // Remplir le select avec les catégories
                            ?>
                                <option value="<?php echo $unProduit->id ?>"><?php echo $unProduit->nom ?></option>
                            <?php
                            }
                            ?>

                        </select>
                        <input class="bouton_form" type="submit" value="Supprimer">
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>
<!-- JavaScript -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type='text/javascript' src="<?php echo Chemins::JS . 'jquery.autocomplete.js'; ?>"></script>
<script>
    $(document).ready(function() {
        // Ecoute le changement dans la sélection du produit
        $('#produit_a_modifier').change(function() {
            //alert("1");
            var idProduit = $(this).val(); // Récupère l'ID du produit sélectionné
            // if (idProduit) {
            //                                // Redirige vers l'URL
            //    window.location.href = 'index.php?controleur=Produits&action=getProductDetails&id=' + idProduit;
            // }
            // Envoie une requête AJAX pour obtenir les détails du produit
            $.ajax({
                url: 'index.php?controleur=Produits&action=getProductDetails', // URL pour le contrôleur et l'action
                method: 'POST',
                data: {
                    id: idProduit
                }, // Envoie l'ID du produit
                dataType: 'json', // On attend une réponse en JSON
                success: function(response) {
                    console.log(response); // Pour voir ce que tu reçois dans la console

                    // Vérifie si la réponse contient les informations attendues
                    if (typeof response === 'object' && response.nom) {
                        // Remplit les champs du formulaire avec les données retournées
                        $('#nouveau_nom_produit').val(response.nom);
                        $('#descrption_produit').val(response.description);
                        $('#prix_produit').val(response.prix);
                        $('#image_produit').val(response.image);
                        $('#categorie_produit_a_modifier').val(response.idCategorie);
                        $('#fournisseur_a_modifier').val(response.idFournisseur);
                    } else {
                        console.error('Réponse invalide :', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors de la récupération des détails du produit:', error);
                    console.log('Statut:', status);
                    console.log('Réponse brute:', xhr.responseText); // Affiche la réponse brute
                }

            });

        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuItems = document.querySelectorAll(".menu-item");

        menuItems.forEach(item => {
            item.addEventListener("click", function() {
                const target = this.getAttribute("data-target");
                const submenu = document.getElementById(`submenu-${target}`);

                // Ferme tous les autres sous-menus
                document.querySelectorAll(".submenu").forEach(menu => {
                    if (menu !== submenu) {
                        menu.style.display = "none";
                    }
                });

                // Bascule l'affichage du sous-menu cliqué
                if (submenu.style.display === "block") {
                    submenu.style.display = "none";
                } else {
                    submenu.style.display = "block";
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const adminSection = document.getElementById("admin-section");
        const sectionCategorie = document.getElementById("section-categorie");
        const sectionProduit = document.getElementById("section-produit");
        const submenuCategorie = document.getElementById("submenu-categorie");
        const submenuProduit = document.getElementById("submenu-produit");
        const allContent = document.querySelectorAll(".admin-content");

        // Tout cacher au début
        adminSection.style.display = "none";
        sectionCategorie.style.display = "none";
        sectionProduit.style.display = "none";
        submenuCategorie.style.display = "none";
        submenuProduit.style.display = "none";

        // Gérer l'affichage du sous-menu quand on clique dans la sidebar
        document.querySelectorAll(".sidebar li[data-section]").forEach(item => {
            item.addEventListener("click", function() {
                let target = this.getAttribute("data-section");

                if (target === "categorie") {
                    submenuCategorie.style.display = (submenuCategorie.style.display === "block") ? "none" : "block";
                    submenuProduit.style.display = "none";
                } else if (target === "produit") {
                    submenuProduit.style.display = (submenuProduit.style.display === "block") ? "none" : "block";
                    submenuCategorie.style.display = "none";
                }

                // Masquer la section admin tant qu'on n'a pas cliqué sur un sous-menu
                adminSection.style.display = "none";
                sectionCategorie.style.display = "none";
                sectionProduit.style.display = "none";
            });
        });

        // Gérer l'affichage des formulaires spécifiques
        document.querySelectorAll(".submenu-item").forEach(item => {
            item.addEventListener("click", function(event) {
                event.preventDefault();
                let targetSection = this.getAttribute("data-section");
                let targetSub = document.getElementById(this.getAttribute("data-sub"));

                // Afficher l'admin
                adminSection.style.display = "block";

                // Montrer la bonne section et cacher l'autre
                if (targetSection === "categorie") {
                    sectionCategorie.style.display = "block";
                    sectionProduit.style.display = "none";
                } else if (targetSection === "produit") {
                    sectionCategorie.style.display = "none";
                    sectionProduit.style.display = "block";
                }

                // Cacher toutes les parties puis afficher la bonne
                allContent.forEach(content => content.style.display = "none");
                if (targetSub) {
                    targetSub.style.display = "block";
                }
            });
        });
    });
</script>