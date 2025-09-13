<section class="cart-container">
    <?php
    if (isset($_SESSION['produits'])) {
        if (VariablesGlobales::$lesProduitsPaniers != null) {
            $totalPanier = 0; // Initialisation du total du panier

            foreach (VariablesGlobales::$lesProduitsPaniers as $idProduit => $qte) {
                $unProduit = GestionProduit::getLeProduitsByID($idProduit);
                $prixUnitaire = $unProduit->prix;
                $prix = $prixUnitaire * $qte;

                // Ajout du prix total de chaque produit au total du panier
                $totalPanier += $prix;
    ?>

                <div class="cart-items" data-id="<?php echo $unProduit->id; ?>" data-prix-unitaire="<?php echo $prixUnitaire; ?>">
                    <form method="POST" action="index.php?controleur=Panier&action=retirerProduitsPanier">
                        <label for="id" class="hidden">id :</label>
                        <input name="id" id="id" value="<?php echo $unProduit->id; ?>" class="hidden">
                        <div class="cart-item">
                            <img src="<?php echo Chemins::IMAGES . $unProduit->image; ?>" alt="photo" />
                            <div class="item-details">
                                <h2><?php echo htmlspecialchars($unProduit->nom); ?></h2>
                                <p class="item-price"><?php echo $prixUnitaire; ?> €</p>
                                <div>
                                    <label for="quantite">Quantité :</label>
                                    <input type="number" class="quantite" id="quantite_<?php echo $unProduit->id; ?>" name="quantite" min="1" value="<?php echo htmlspecialchars($qte); ?>">
                                </div>
                            </div>
                            <button class="remove-btn">Retirer</button>
                        </div>
                    </form>
                </div>


    <?php
            }
            // Affichage du total du panier après la boucle
            echo "<div class='cart-total'>";
            echo "<h3 id='totalPanier'>Total du panier : " . number_format($totalPanier, 2) . " €</h3>";
            echo "<form method='POST' action='index.php?controleur=Panier&action=validerCommande'>";
            echo "<button type='submit' class='validate-btn'>Valider la commande</button>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "Il n'y a malheureusement aucun produit dans votre panier.";
        }
    } else {
        echo "Il n'y a malheureusement aucun produit dans votre panier.";
    }
    ?>
</section>

<script>
    document.querySelectorAll('.quantite').forEach(function(input) {
        input.addEventListener('input', function() {
            const cartItem = input.closest('.cart-items');
            const idProduit = cartItem.getAttribute('data-id');
            const prixUnitaire = parseFloat(cartItem.getAttribute('data-prix-unitaire'));
            const quantite = parseInt(input.value);

            // Calcul du nouveau prix pour cet article
            const nouveauPrix = prixUnitaire * quantite;
            cartItem.querySelector('.item-price').innerText = nouveauPrix.toFixed(2) + ' €';

            // Mise à jour du total du panier
            let totalPanier = 0;
            document.querySelectorAll('.cart-items').forEach(function(item) {
                const prixArticle = parseFloat(item.querySelector('.item-price').innerText);
                totalPanier += prixArticle;
            });

            document.getElementById('totalPanier').innerText = 'Total du panier : ' + totalPanier.toFixed(2) + ' €';
        });
    });
</script>