<?php

include "repository/repository-admin.php";

/*
 * Connexion à la base de données
 */
$db = openDatabase('blog', 'root', 'troiswa');
$db->exec('SET NAMES UTF8');

/*
 * Recherche de la liste des articles pour permettre à l'utilisateur de choisir
 * celui qu'il souhaite modifier.
 */
$articles = findAllArticles($db);

include "../templates/edit.phtml";

 ?>
