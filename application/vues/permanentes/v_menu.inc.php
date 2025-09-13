<nav id="menu">
    <div class="TitreMenuCategorie" id="TitreMenuCategorie">
        <img src="<?php echo Chemins::IMAGES . 'flecheVersLeBas.png'; ?>" class="imgCategorie">
        <h1 id="menu-toggle">Catégories </h1>
        <img src="<?php echo Chemins::IMAGES . 'flecheVersLeBas.png'; ?>" class="imgCategorie">
    </div>
    <ul id="menu-list">
        <?php
        foreach (VariablesGlobales::$lesCategories as $uneCategorie) {
            $dossierAvecEspace = $uneCategorie->libelle;
            $dossierAvec20 = str_replace(" ", "%20", $dossierAvecEspace);
            ?>
            <li>
                <a href="index.php?controleur=Produits&action=afficher&categorie=<?php echo $dossierAvec20 ?>"><?php echo $dossierAvecEspace ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>

<!-- JavaScript code to handle menu toggle and hover sounds -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.getElementById("TitreMenuCategorie");
        const menuList = document.getElementById("menu-list");
        const menu = document.getElementById("menu");

        // Initialisation de l'état du menu
        menuList.style.display = "none"; // Masque le menu au départ

//        menuToggle.addEventListener("click", function() {
//            // Vérifie l'état actuel du menu
//            if (menuList.style.display === "none" || menuList.style.display === "") {
//                menuList.style.display = "flex"; // Affiche le menu
//                menu.classList.remove("retracte"); // Retire la classe 'retracte'
//            } else {
//                menuList.style.display = "none"; // Masque le menu
//                menu.classList.add("retracte"); // Ajoute la classe 'retracte'
//            }
//        });
        menuToggle.addEventListener("click", function () {
            // Basculer l'affichage du menu et la classe 'retracte'
            menuList.style.display = (menuList.style.display === "none" || menuList.style.display === "") ? "flex" : "none";
            menu.classList.toggle("retracte"); // Active ou désactive la classe 'retracte'
        });

    });
</script>



