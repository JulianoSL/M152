<?php
//  Auteur       :   Souza Luz Juliano
//  Description  :   Page de suppression d'un post
//  Date         :   Mars 2021
//  Version      :   1.0
include_once("./assets/fonctions/home.inc.php");
require_once("./assets/fonctions/post.inc.php");
$idPost = filter_input(INPUT_GET, "idPost", FILTER_SANITIZE_STRING);
if ($idPost) {

    $commentaire = getCommentaireFromPost($idPost)[0]["commentaire"];
} else {
    header("Location:home.php");
    exit();
}
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
try {
    $dbh = dbData();
    $dbh->beginTransaction();
    $dir = "./assets/upload";

    $error_msg = "";
    if (isset($_POST["Modifier"]) && isset($_POST["Modifier"]) != null) {
        $commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
        if ($commentaire) {
            modifierPost($idPost, $commentaire);
        }
        //si le tableau de files est vide aucune modification de média n'est nécéssaire 
        if ($_FILES["upload"]["name"][0] != null) {
            deleteAllMediaWhereIdPost($idPost);
            for ($i = 0; $i < count($_FILES["upload"]["name"]); $i++) {
                if ((strpos($_FILES["upload"]["type"][$i], "image") !== false || strpos($_FILES["upload"]["type"][$i], "video") !== false || strpos($_FILES["upload"]["type"][$i], "audio") !== false)  && tailleUpload($_FILES["upload"]["size"]) <= 70 * MB) {
                    if ($_FILES["upload"]["size"][$i] < 5 * MB) {
                        if ($_FILES["upload"]["error"][$i] == UPLOAD_ERR_OK) {
                            $tmp_name = $_FILES["upload"]["tmp_name"][$i];
                            $path_parts = pathinfo($_FILES["upload"]["name"][$i]);
                            $name = getName(20) . "." . $path_parts['extension'];
                            if (move_uploaded_file($tmp_name, "$dir/$name")) //if true -> le fichier a bien été déplacé
                            {
                                if (!ajouterMedia($_FILES["upload"]["type"][$i], $name, $idPost)) {
                                    //si l'ajout a bien marché, redirection
                                    header("Location:home.php");
                                } else {
                                    effacerPost($idPost);
                                    unlink("$dir/$name");
                                }
                            }
                        }
                    } else {
                        $error_msg = "Taille de fichier trop importante !";
                    }
                }
            }
        } else {
            header("Location:home.php");
        }
    }
    $dbh->commit();
} catch (Exception $e) {
    $dbh->rollBack();
    die("Impossible de se connecter : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Modifier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <link href="assets/css/facebook.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">
                <!-- main right col -->
                <div class="column col-sm-10 col-xs-11" id="main">
                    <?php include_once("navbar.php"); ?>
                    <br>
                    <br>
                    <form action="" method="post" id="form" enctype="multipart/form-data">
                        <textarea name="commentaire" placeholder="Write Something..." required><?= $commentaire; ?></textarea>
                        <div id="bottomPost">
                            <label for="input">📸</label>
                            <input type="file" name="upload[]" multiple accept="image/*,video/*,audio/*" id="input">
                            <input type="submit" name="Modifier" value="Modifier" class="envoyer">
                        </div>
                        <p id="error"><?= $error_msg; ?></p>
                    </form>
                </div>
                <!-- /main -->
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle=offcanvas]').click(function() {
                $(this).toggleClass('visible-xs text-center');
                $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
                $('.row-offcanvas').toggleClass('active');
                $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
                $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
                $('#btnShow').toggle();
            });
        });
    </script>
</body>

</html>