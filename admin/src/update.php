<?php

/*
 * Script permettant de modifier un modèle de maquette existant dans la base de données.
 */

/*
 * Import de la bibliothèque de fonctions gérant les requêtes SQL
 */
include "repository/repository-admin.php";

/*
 * Connexion à la base de données
 */
 $db = openDatabase('blog', 'root', 'troiswa');
 $db->exec('SET NAMES UTF8');

/*
 * Le script est destiné à fonctionner par le biais d'une requête GET (cf. 'index.phtml' ligne 51)
 * pour afficher les données à modifier dans un formulaire.
 *
 * Le lien intègre un paramètre permettant d'identifier l'enregistrement à modifier.
 * Exemple : update.php?id=S18_1097
 *
 */
if (!empty($_GET)) {
  /*
   * On recherche le modèle qui correspond à l'id (cf. ligne 22) :
   * Le code produit correspond  la clef 'id' du tableau $_GET.
   */
  $article = findOneArticle($db, $_GET['id']);

  /*
  * Recherche de la liste des catégories pour permettre à l'utilisateur de choisir
  * dans un menu déroulant la valeur qu'il cherche.
   */
  $categories = findCategories($db);
  $authors = findUsers($db);

  $action = "update.php";
  $submitValue = "Modifier";
  include "../templates/articleForm.phtml";
}
/*
* Si le tableau $_POST n'est pas vide, on peut en déduire que le programme a reçu
* des données issues d'un formulaire envoyé par l'utilisateur.
* A ce moment, il reste à enregistrer les données modifiées grâce à une requête SQL UPDATE
 */
else  if (!empty($_POST)) {
  $err = updateArticle($db, $_POST);

  /*
   * Une fois terminé l'enregistrement, on redirige l'utilisateur vers la première page
   * pour faire une  nouvelle recherche. La fonction 'header', qui envoie au navigateur
   * l'entête HTTP 'Location' (dans notre cas), force le navigateur à recharger la page 'index.php'.
   *
   * On prendra comme convention que l'on souhaite afficher à l'utilisateur la liste des
   * maquettes semblables à la nouvelle, à savoir même catégorie et même année.
   *
   * La redirection HTTP envoie donc une requête GET avec les paramètres à la fin de l'URL.
   * Pour avoir la liste des maquettes 'similaires', il faut faire la requête en cherchant
   * les modèles qui ont la même 'productLine' et la même 'year' (4 premiers caractères de 'productName')
   * Exemple : index.php?productLine=Planes&modelYear=1982
   */
  header('Location: index-admin.php');
}

?>
