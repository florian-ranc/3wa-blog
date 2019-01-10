<?php

/*
 * Script permettant de suprimer un article dans la base de données.
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
 * Cette fonction n'est accessible qu'au travers d'une requête GET (cf. 'edit.phtml' ligne 41)
 * On n'a pas implémenté une option qui permettrait par exemple de cocher des cases dans une liste
 * et de faire une suppression groupée.
 *
 * (Au passage, on utilise ici une requête GET alors que la sémantique de HTTP voudrait
 * que nous utilisions une requête DELETE mais cette dernière n'est pas implémentée par Apache)
 *
 * Le lien intègre un paramètre permettant d'identifier l'enregistrement à modifier.
 * Exemple : delete.php?id=4

 */
if (!empty($_GET)) {
  /*
   * Effacement de l'enregistrement dont l''id' correspond à l'id transmis dans l'URL
   */
  $err = deleteArticle($db, $_GET['id']);
  /*
   * On redirige l'utilisateur vers la page qui liste tous les articles.
   * La fonction 'header', qui envoie au navigateur l'entête HTTP 'Location' (dans notre cas),
   * force le navigateur à recharger la page 'edit.php'.
   */
  header('Location: edit.php');
}

?>
