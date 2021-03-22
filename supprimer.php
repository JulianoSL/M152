<?php
//  Auteur       :   Souza Luz Juliano
//  Description  :   Page de suppression d'un post
//  Date         :   Mars 2021
//  Version      :   1.0
include_once("./assets/fonctions/home.inc.php");
require_once("./assets/fonctions/post.inc.php");
$idPost = filter_input(INPUT_GET, "idPost", FILTER_SANITIZE_STRING);
if (!$idPost) {
    header("Location:home.php");
    exit();
}
if ($_POST["Supprimer"] && $idPost) {
    effacerPost($idPost);
    //ici pas besoin d'effacer les médias puisque dans tout les cas une vérification est effectuée sur la page home (ligne 12 de la page home)
    header("Location:home.php");
}
if ($_POST["Annuler"]) {
    header("Location:home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Supprimer</title>
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
                    <h1>Voulez vous vraiment effacer ce post ?</h1>
                    <?php if ($idPost) {
                        postHtml(getMediaFromPost($idPost), getCommentaireFromPost($idPost), $idPost);
                    } ?>
                    <form action="" method="post">
                        <input type="submit" value="Supprimer" name="Supprimer">
                        <input type="submit" value="Annuler" name="Annuler">
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