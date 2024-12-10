<?php
// Démarrer la session
session_start();

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil ou une autre page après la déconnexion
header("Location:  http://localhost/projet/view/farmfresh-1.0.0/index.html");
exit();
?>
