<?php
/*
Auteur   :  Juliano Souza Luz
Date     :  Février 2021
Desc.    :  fonctions pour la page home
Version  :  1.0
*/
require "db.inc.php";

/**
 * récupère tout les post de la table post
 *
 * @return void
 */
function getAllPost()
{
    static $ps = null;
    $sql = "SELECT idPost FROM post ORDER BY idpost DESC";

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
 * récupère le média et le type de média dans la table média en fonction de l'id post
 *
 * @param [int] $idPost
 * @return void
 */
function getMediaFromPost($idPost)
{
    static $ps = null;
    $sql = "SELECT nomMedia,typeMedia FROM Media JOIN post using(idPost) WHERE idPost=:IDPOST";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':IDPOST', $idPost, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
/**
 * récupère le commentaire en fonction de l'idPost
 *
 * @return void
 */
function getCommentaireFromPost($idPost)
{
    static $ps = null;
    $sql = "SELECT commentaire FROM post WHERE idPost = :IDPOST";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':IDPOST', $idPost, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * affiche tout les post
 *
 * @param [int] $nbPost
 * @return void
 */
function afficherPost($nbPost)
{
    foreach ($nbPost as $key => $value) {
        postHtml(getMediaFromPost($value["idPost"]), getCommentaireFromPost($value["idPost"]), $value["idPost"]);
    }
}


/**
 * affiche sous format html un post
 *
 * @param [media] $media -> le média du post
 * @param [string] $commentaire -> le commentaire du post
 * @return void
 */
function postHtml($media, $commentaire, $idPost)
{
    echo '<div class="col-sm-5">';
    echo '<div class="panel panel-default">';
    if ($media) {
        foreach ($media as $key => $value) {
            if (strpos($value["typeMedia"], "video") !== false) {
                echo '<video autoplay loop><source src="./assets/upload/' . $value["nomMedia"] . '" type="' . $value["typeMedia"] . '"></video>';
            }
            if (strpos($value["typeMedia"], "image") !== false) {
                echo '<div class="panel-thumbnail"><img src="./assets/upload/' . $value["nomMedia"] . '" class="img-responsive"></div>';
            }
            if (strpos($value["typeMedia"], "audio") !== false) {
                echo '<audio controls><source src="./assets/upload/' . $value["nomMedia"] . '" type="' . $value["typeMedia"] . '"></audio>';
            }
        }
    }
    echo '<div class="panel-body">';
    echo '<p class="lead">' . $commentaire[0]["commentaire"] . '</p><a href="supprimer.php?idPost=' . $idPost . '">supprimer 🚮</a><a href="modifier.php?idPost=' . $idPost . '">modifier 🖋</a>';
    echo '</div></div></div>';
}

/**
 * cherche un média en fonction de son nom de fichier
 *
 * @param [media] $nomMedia
 * @return void
 */
function chercherMedia($nomMedia)
{
    static $ps = null;
    $sql = "SELECT idPost FROM Media WHERE nomMedia = :NOM_MEDIA";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':NOM_MEDIA', $nomMedia, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
