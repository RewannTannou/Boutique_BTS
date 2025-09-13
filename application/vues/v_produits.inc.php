<section class="VueProduit">
    <?php
    foreach (VariablesGlobales::$lesProduits as $unProduit) {
        $dossierSansEspace = str_replace(" ", "", VariablesGlobales::$libelleCategorie);
        ?>
        <form method="POST" action="index.php?controleur=Produits&action=ajouterProduitPanier" >
            <article class="ArtileVueProduit">
                <label for="img" class="hidden">img : </label>
                <input name="img" id="img" value="<?php echo $unProduit->image ?>" class="hidden">
                <img class="img_produit" src="<?php echo Chemins::IMAGES_PRODUITS . "/" . $dossierSansEspace ?>/<?php echo $unProduit->image ?> "alt="photo" />
                <aside>
                    <label for="id" class="hidden">id : </label>
                    <input name="id" id="id" value="<?php echo $unProduit->id ?>" class="hidden">

                    <label for="nom" class="hidden">Nom du produit :</label>
                    <input name="nom" id="nom" value="<?php echo $unProduit->nom ?>" class="hidden">
                    <h1 id="nom" ><?php echo "$unProduit->nom" ?></h1>

                    <h3><?php echo "$unProduit->description" ?></h3>
                    <p><?php echo VariablesGlobales::$libelleCategorie ?></p>
                    <label for="prix" class="hidden">Prix : </label>
                    <input name="prix" id="prix" value="<?php echo $unProduit->prix ?>" class="hidden">
                    <h3 id="prix"><?php echo "$unProduit->prix" ?> €</h3>
                    <!-- Champ de sélection de quantité -->
                    <div class="quantiteDiv">
                        <label for="quantite">Quantité :</label>
                        <input type="number" id="quantite" name="quantite" min="1" value="1">
                    </div>
                    <button class="btn_panier">
                        <span>Ajouter au panier</span>
                    </button>
                </aside>
            </article>
        </form>
        <?php
    }
    ?>
</section>




