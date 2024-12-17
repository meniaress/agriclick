<?php
	include '../CONTROLLER/CategorieC.php';

	$message = "" ; 
	$CategorieC=new CategorieC();
	$CategorieC->supprimerCategorie($_GET["idCategorie"]);
	header('Location:indexCategorie.php?message= Categorie Supprimée avec succés');
?>
