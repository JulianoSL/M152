<?php
//  Auteur       :   Souza Luz Juliano
//  Description  :   Page Post, on peut ajouter un post contenant du texte et des fichiers multimédia
//  Date         :   Janvier 2020
//  Version      :   1.0

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
                    <form action="post.php" method="post" id="form">
                        <textarea name="texte" placeholder="Write Something..."></textarea>
                        <div id="bottomPost">
                            <label for="input">📸</label>
                            <input type="file" name="upload[]" multiple accept="image/*" id="input">
                            <input type="submit" name="envoyer" value="envoyer" class="envoyer">
                        </div>
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