<?php

include "repository/repository-admin.php";

// Récupération des catégories
$db = openDatabase('blog', 'root', 'troiswa');
$db->exec('SET NAMES UTF8');
$categories = findCategories($db);

include "../templates/index-admin.phtml";

 ?>
