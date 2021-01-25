<?php 
//  Auteur       :   Souza Luz Juliano
//  Description  :   Page home, page principale du site contenant les post ajoutés depuis la page post
//  Date         :   Janvier 2020
//  Version      :   1.0

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Home Page</title>
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

                    <div class="padding">
                        <div class="full col-sm-9">

                            <!-- content -->
                            <div class="row">

                                <!-- main col left -->
                                <div class="col-sm-5">

                                    <div class="panel panel-default">
                                        <div class="panel-thumbnail"><img src="assets/img/bg_5.jpg" class="img-responsive"></div>
                                        <div class="panel-body">
                                            <p class="lead">Nom de votre post</p>
                                            <p>45 Followers, 13 Posts</p>

                                            <p>
                                                <img src="assets/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px">
                                            </p>
                                        </div>
                                    </div>


                                    <div class="panel panel-default">
                                        <div class="panel-heading"><a href="#" class="pull-right">View all</a>
                                            <h4>Bootstrap Examples</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="list-group">
                                                <a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Modal / Dialog</a>
                                                <a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Datetime Examples</a>
                                                <a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Data Grids</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="well">
                                        <form class="form-horizontal" role="form">
                                            <h4>What's New</h4>
                                            <div class="form-group" style="padding:14px;">
                                                <textarea class="form-control" placeholder="Update your status"></textarea>
                                            </div>
                                            <button class="btn btn-primary pull-right" type="button">Post</button>
                                            <ul class="list-inline">
                                                <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
                                                <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
                                                <li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>

                                <!-- main col right -->
                                <div class="col-sm-7">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h1>Welcome</h1>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-thumbnail"><img src="assets/img/bg_4.jpg" class="img-responsive"></div>
                                        <div class="panel-body">
                                            <p class="lead">Social Good</p>
                                            <p>1,200 Followers, 83 Posts</p>

                                            <p>
                                                <img src="assets/img/photo.jpg" height="28px" width="28px">
                                                <img src="assets/img/photo.png" height="28px" width="28px">
                                                <img src="assets/img/photo_002.jpg" height="28px" width="28px">
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--/row-->

                            <div class="row" id="footer">
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-6">
                                    <p>
                                        <a href="#" class="pull-right">&copy; JSL</a>
                                    </p>
                                </div>
                            </div>
                        </div><!-- /col-9 -->
                    </div><!-- /padding -->
                </div>
                <!-- /main -->

            </div>
        </div>
    </div>


    <!--post modal-->
    <div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                    Update Status
                </div>
                <div class="modal-body">
                    <form class="form center-block">
                        <div class="form-group">
                            <textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div>
                        <button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
                        <ul class="pull-left list-inline">
                            <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
                        </ul>
                    </div>
                </div>
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