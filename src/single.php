<?php

//print_r($_GET["id"]);

include "repository/repository.php";

$idNum = $_GET["id"];

$db = openDatabase('blog', 'root', 'troiswa');
$db -> exec('SET NAMES UTF8');
$SelectedOneArticle = SelectedOneArticle($db , $idNum);

$template = "../templates/single.phtml";

include "../templates/base.phtml";

?>
