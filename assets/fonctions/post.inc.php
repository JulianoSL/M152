<?php
/*
Auteur   :  Juliano Souza Luz
Date     :  Février 2021
Desc.    :  fonctions pour la page post
Version  :  1.0
*/
require_once("db.inc.php");
function ajouterPost($commentaire, $modificationDate)
{
    static $ps = null;
    $sql = "INSERT INTO post (commentaire,creationDate,modificationDate) VALUES (:COMMENTAIRE,CURRENT_TIMESTAMP(),:MODIF_DATE);";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':COMMENTAIRE', $commentaire, PDO::PARAM_STR);
        $ps->bindParam(':MODIF_DATE', $modificationDate, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
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
    $sql = "INSERT INTO Media (typeMedia,nomMedia,idPost,creationDate) VALUES (:TYPE_MEDIA,:NOM_MEDIA,:ID_POST,CURRENT_TIMESTAMP());";

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
/**
 * retourne le dernier id inseré dans la table post
 *
 * @return void
 */
function getLastPostId()
{
    static $ps = null;
    $sql = "SELECT idpost FROM post ORDER BY idpost DESC LIMIT 1";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
/**
 * efface le dernier post inséré
 *
 * @param [type] $idPost
 * @return void
 */
function effacerPost($idPost)
{
    static $ps = null;
    $sql = "DELETE FROM post WHERE idPost = :ID_POST;";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':ID_POST', $idPost, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
