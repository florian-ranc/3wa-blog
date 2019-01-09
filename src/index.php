<?php

include "repository/repository.php";

$db = openDatabase('blog', 'root', 'troiswa');
$db->exec('SET NAMES UTF8');
$LastThreeArticles = LastThreeAticles($db);

$template = "../templates/home.phtml";

include "../templates/base.phtml";

?>
