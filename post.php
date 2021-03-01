<?php
//  Auteur       :   Souza Luz Juliano
//  Description  :   Page Post, on peut ajouter un post contenant du texte et des fichiers multimédia
//  Date         :   Janvier 2020
//  Version      :   1.0
include_once("./assets/fonctions/post.inc.php");

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

$dir = "./assets/upload";

$error_msg = "";
if (isset($_POST["envoyer"]) && isset($_POST["envoyer"]) != null) {
    $commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
    if ($commentaire) {        
        ajouterPost($commentaire, date("Y-m-d h:i:s"));
    }
    for ($i = 0; $i < count($_FILES["upload"]["name"]); $i++) {
        if (strpos($_FILES["upload"]["type"][$i], "image") !== false && tailleUpload($_FILES["upload"]["size"]) <= 70 * MB) {
            if ($_FILES["upload"]["size"][$i] < 3 * MB) {
                if ($_FILES["upload"]["error"][$i] == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["upload"]["tmp_name"][$i];
                    $path_parts = pathinfo($_FILES["upload"]["name"][$i]);
                    $name = getName(10) . "." . $path_parts['extension'];
                    move_uploaded_file($tmp_name, "$dir/$name");
                    $lastId = getLastPostId();
                    ajouterMedia($_FILES["upload"]["type"][$i], $name, $lastId);
                }
            } else {
                $error_msg = "Taille de fichier trop importante !";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Post Page</title>
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
                    <form action="post.php" method="post" id="form" enctype="multipart/form-data">
                        <textarea name="commentaire" placeholder="Write Something..." required></textarea>
                        <div id="bottomPost">
                            <label for="input">📸</label>
                            <input type="file" name="upload[]" multiple accept="image/*" id="input">
                            <input type="submit" name="envoyer" value="envoyer" class="envoyer">
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