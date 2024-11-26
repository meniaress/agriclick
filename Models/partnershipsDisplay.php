<?php
require_once '../connexion.php';

function fetchAndDisplayPartnerships($onlyAccepted = true)
{
    try {
        $con = config::getConnexion();
        // Si seulement les partenariats acceptés doivent être affichés
        $sql = $onlyAccepted
            ? "SELECT `Nom de l'organisation`, `Description`, `image` FROM partenariats WHERE `status` = 'accepté'"
            : "SELECT `Nom de l'organisation`, `Description`, `image` FROM partenariats"; // Afficher tout

        $stmt = $con->prepare($sql);
        $stmt->execute();

        echo '<div class="container-fluid py-5">
                <div class="container">
                    <div class="row g-5">'; // Début de la ligne contenant les partenaires

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $organisationName = htmlspecialchars($row["Nom de l'organisation"]);
            $description = htmlspecialchars($row["Description"]);
            $image = htmlspecialchars($row["image"]);

            // Chaque partenaire dans une colonne
            echo "
            <div class=\"col-lg-4 col-md-6\">
                <div class=\"partner-item bg-light text-center p-5 h-100\">
                    <img class=\"w-100 mb-3\" src=\"img/$image\" alt=\"Logo de $organisationName\">
                    <h4>$organisationName</h4>
                    <p class=\"mb-0\">$description</p>
                </div>
            </div>";
        }

        echo '</div></div></div>'; // Fermeture de la ligne et du conteneur
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
