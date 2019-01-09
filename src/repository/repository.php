<?php

/**
 * Ouvre une connexion à la base de données
 *
 * @param  string $database [description]
 * @param  string $user     [description]
 * @param  string $password [description]
 * @return PDO              [description]
 */
function openDatabase(string $database, string $user, string $password) : PDO
{
  return new PDO("mysql:host=localhost;dbname=$database", 'root', 'troiswa');
}

/**
 * Liste tous les articles de la base de donnée
 *
 * @param  PDO   $db [description]
 * @return array     [description]
 */
function LastThreeAticles(PDO $db) : array
{
  $statement = $db->prepare("SELECT A.*, U.`pseudo` FROM `articles` as A INNER JOIN `users` as U ON A.`author` = U.`id` ORDER BY `publicationDate` DESC LIMIT 3");
  $err = $statement->execute();

  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Liste un article de la base de donnée
 *
 * @param  PDO   $db [description]
 * @return array     [description]
 */
function SelectedOneArticle(PDO $db , $idNum) : array
{
  $statement = $db->prepare("SELECT A.*, U.`pseudo` FROM `articles` as A INNER JOIN `users` as U ON A.`author` = U.`id` WHERE A.`id` = $idNum");
  $err = $statement->execute();

  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

?>
