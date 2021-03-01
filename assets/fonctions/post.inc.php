<?php
/*
Auteur   :  Juliano Souza Luz
Date     :  Février 2021
Desc.    :  fonctions pour la page post
Version  :  1.0
*/
require "constantes.inc.php";

/**
 * Connecteur de la base de données du .
 * Le script meurt (die) si la connexion n'est pas possible.
 * @static var PDO $dbc
 * @return \PDO
 */
function dbData()
{
    static $dbc = null;

    // Première visite de la fonction
    if ($dbc == null) {
        // Essaie le code ci-dessous
        try {
            $dbc = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBUSER, DBPWD, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::ATTR_PERSISTENT => true,
                PDO::ERRMODE_EXCEPTION => PDO::ATTR_ERRMODE
            ));
        }
        // Si une exception est arrivée
        catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            // Quitte le script et meurt
            die('Could not connect to MySQL');
        }
    }
    // Pas d'erreur, retourne un connecteur
    return $dbc;
}

/**
 * ajoute un media dans la bd
 *
 * @param string $type
 * @param string $nomMedia
 * @param string $creationDate
 * @param string $modificationDate
 * @param int $idPost
 * @return void
 */
function ajouterMedia($type, $nomMedia, $idPost)
{
    static $ps = null;
    $sql = "INSERT INTO `post` ('typeMedia','nomMedia','idPost') VALUES (:TYPE_MEDIA,:NOM_MEDIA,:ID_POST);";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':TYPE_MEDIA', $type, PDO::PARAM_STR);
        $ps->bindParam(':NOM_MEDIA', $nomMedia, PDO::PARAM_STR);
        $ps->bindParam(':ID_POST', $idPost, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * Retourne la taille de l'upload
 *
 * @param [int] $upload 
 * @return int $taille -> la taille totale de l'upload
 */
function tailleUpload($upload)
{
    $taille = 0;
    foreach ($upload as $key => $value) {
        $taille += $value;
    }
    return $taille;
}
/**
 * retourne un string aléatoire (fonction prise sur le site https://www.geeksforgeeks.org/generating-random-string-using-php/) 
 *
 * @param [type] $n -> la taille du string voulue
 * @return void
 */
function getName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
