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


function findCategories(PDO $db) : array
{
  $statement = $db->prepare("SELECT `id` , `categoryName` FROM `categories`");
  $err = $statement->execute();

  return $statement->fetchAll(PDO::FETCH_ASSOC);
}


function findUsers(PDO $db) : array
{
  $statement = $db->prepare("SELECT `id` , `pseudo` FROM `users`");
  $err = $statement->execute();

  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Renvoie un article à modifier
 *
 * @param  PDO    $db Le connecteur à la base de données
 * @param  string $id L'identifiant unique du modèle
 * @return array     Tojutes les données relatives à la maquette
 */
function findOnearticle(PDO $db, string $id) : array
{
  $statement = $db->prepare("SELECT * FROM `articles` WHERE `id` LIKE ?");
  $err = $statement->execute([$id]);

  return $statement->fetch(PDO::FETCH_ASSOC);
}

function findAllArticles(PDO $db) : array
{
  $statement = $db->prepare("SELECT A.*, U.`pseudo`, C.`categoryName` FROM `articles` as A INNER JOIN `users` as U ON A.`author` = U.`id` INNER JOIN `categories` as C ON A.`category` = C.`id` ORDER BY `categoryName` ASC");
  $err = $statement->execute();

  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Insère un nouvel article dans la table 'articles'
 *
 * @param  PDO    $db   Le connecteur à la base de données
 * @param  array  $data Les données issues du formulaire
 * @return int
 */
function insertArticle(PDO $db, array $data)
{
  //var_dump($_POST); die;
  $statement = $db->prepare(
    "INSERT INTO `articles` (`articleTitle`, `articleContent`, `articleImage`, `favorite`, `author`, `category`)
     VALUES (:title, :content, :image, :fav, :user, :cat)");
  $err = $statement->execute([
    'title' => $data['articleTitle'],
    'content' => $data['articleContent'],
    'image' => '',
    'fav' => $data['favorite'],
    'user' => $data['author'],
    'cat' => $data['category']
  ]);

  return $err;
}

/**
 * Met à jour un article dans la table 'articles'
 *
 * @param  PDO    $db   Le connecteur à la base de données
 * @param  array  $data Les données issues du formulaire
 * @return int
 */
function updateArticle(PDO $db, array $data)
{
  $statement = $db->prepare(
    "UPDATE `articles`
     SET `articleTitle` = :title, `articleContent` = :content, `articleImage` = :image, `favorite` = :fav, `author` = :user, `category` = :cat
     WHERE `id` = :id");
  $err = $statement->execute([
    'id' => $data['id'],
    'title' => $data['articleTitle'],
    'content' => $data['articleContent'],
    'image' => '',
    'fav' => $data['favorite'],
    'user' => $data['author'],
    'cat' => $data['category']
  ]);

  return $err;
}

/**
 * Efface un article de la base de données en recherchant sa 'clef primaire'
 *
 * @param  PDO    $db  Le connecteur à la base de données
 * @param  string $key La clef primaire (identifiant unique) du modèle à effacer
 * @return int
 */
function deleteArticle(PDO $db, string $key)
{
  $statement = $db->prepare(
    "DELETE FROM `articles`
     WHERE `id` LIKE :id");

     $err = $statement->execute([
       'id' => $key
     ]);

     return $err;
}

?>
