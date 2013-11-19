<?php
$protection = session::get('sess_login');
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Apple devices fullscreen -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Apple devices fullscreen -->
        <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

        <title>Meshplace</title>

        <?php
        echo asset::image()->fav_icon('icon.png');

        asset::js()->plugin('jquery');
        asset::js()->plugin('jquery.ui');
        asset::js()->plugin('nicescroll');
        asset::js()->plugin('slimscroll');
        asset::js()->plugin('bootstrap');
        asset::js()->plugin('bootbox');
        asset::js()->plugin('notify');


        // Theme CSS
        asset::css()->append('style');
        // Color CSS
        asset::css()->append('themes');

        // Theme framework
        asset::js()->append('eakroko');
        // Theme scripts
        asset::js()->append('application.min');
        // Just for demonstration
        asset::js()->append('demonstration.min');
        // common
        asset::js()->append('common');

        echo asset::jcss();
        ?>
        <!--[if lte IE 9]>
            <script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('input, textarea').placeholder();
                });
            </script>
        <![endif]-->
    </head>
    <?php if ($protection) : /* Jika Sudah Login if (true) : */ ?>
        <body class="theme-lightred">            
            <div id="navigation">
                <div class="container-fluid">
                    <a href="#" id="brand" style="background: none;padding-left: 0;">Meshplace</a>
                    <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
                    <ul class='main-nav'>
                        <li class='active'>
                            <a href="index-2.html">
                                <span>Beranda</span>
                            </a>
                        </li>
                        <!-- Begin : Aplikasi List -->
                        <li>
                            <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
                                <span>Aplikasi</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach ($app->objects() as $app_row) : ?>
                                    <li>
                                        <a href="forms-basic.html"><?php echo $app_row->app_name; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <!-- End : Aplikasi List -->

                        <!-- Begin : Modul List -->
                        <?php echo mymenu::modul($modul); ?>
                        <!-- Begin : Aplikasi List -->

                    </ul>
                    <div class="user">
                        <ul class="icon-nav">
                            <li class='dropdown'>
                                <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-envelope"></i><span class="label label-lightred">4</span></a>
                                <ul class="dropdown-menu pull-right message-ul">
                                    <li>
                                        <a href="#">
                                            <?php echo asset::image()->load('demo/user-1.jpg'); ?>
                                            <div class="details">
                                                <div class="name">Jane Doe</div>
                                                <div class="message">
                                                    Lorem ipsum Commodo quis nisi ...
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <?php echo asset::image()->load('demo/user-1.jpg'); ?>
                                            <div class="details">
                                                <div class="name">Warman Suganda, S.Kom.</div>
                                                <div class="message">
                                                    Ut ad laboris est anim ut ...
                                                </div>
                                            </div>
                                            <div class="count">
                                                <i class="icon-comment"></i>
                                                <span>3</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <?php echo asset::image()->load('demo/user-1.jpg'); ?>
                                            <div class="details">
                                                <div class="name">Bob Doe</div>
                                                <div class="message">
                                                    Excepteur Duis magna dolor!
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-messages.html" class='more-messages'>Go to Message center <i class="icon-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown sett">
                                <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-cog"></i></a>
                                <ul class="dropdown-menu pull-right theme-settings">
                                    <li>
                                        <span>Layout-width</span>
                                        <div class="version-toggle">
                                            <a href="#" class='set-fixed'>Fixed</a>
                                            <a href="#" class="active set-fluid">Fluid</a>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Topbar</span>
                                        <div class="topbar-toggle">
                                            <a href="#" class='set-topbar-fixed'>Fixed</a>
                                            <a href="#" class="active set-topbar-default">Default</a>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Sidebar</span>
                                        <div class="sidebar-toggle">
                                            <a href="#" class='set-sidebar-fixed'>Fixed</a>
                                            <a href="#" class="active set-sidebar-default">Default</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class='dropdown colo'>
                                <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-tint"></i></a>
                                <ul class="dropdown-menu pull-right theme-colors">
                                    <li class="subtitle">
                                        Predefined colors
                                    </li>
                                    <li>
                                        <span class='red'></span>
                                        <span class='orange'></span>
                                        <span class='green'></span>
                                        <span class="brown"></span>
                                        <span class="blue"></span>
                                        <span class='lime'></span>
                                        <span class="teal"></span>
                                        <span class="purple"></span>
                                        <span class="pink"></span>
                                        <span class="magenta"></span>
                                        <span class="grey"></span>
                                        <span class="darkblue"></span>
                                        <span class="lightred"></span>
                                        <span class="lightgrey"></span>
                                        <span class="satblue"></span>
                                        <span class="satgreen"></span>
                                    </li>
                                </ul>
                            </li>
                            <li class='dropdown language-select' style="display: none;">
                                <a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo asset::image()->load('demo/flags/us.gif'); ?><span>US</span></a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="#"><?php echo asset::image()->load('demo/flags/br.gif'); ?><span>Brasil</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><?php echo asset::image()->load('demo/flags/de.gif'); ?><span>Deutschland</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><?php echo asset::image()->load('demo/flags/es.gif'); ?><span>España</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><?php echo asset::image()->load('demo/flags/fr.gif'); ?><span>France</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <a href="#" class='dropdown-toggle' data-toggle="dropdown">Warman <?php echo asset::image()->load('demo/user-avatar.jpg'); ?></a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="more-userprofile.html">Edit profile</a>
                                </li>
                                <li>
                                    <a href="#">Account settings</a>
                                </li>
                                <li>
                                    <?php echo url::anchor('Sign out', 'login/stop') ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" id="content">
                <div id="left">

                    <div class="subnav">
                        <div class="subnav-title">
                            <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Aplikasi</span></a>
                        </div>
                        <ul class="subnav-menu">
                            <?php foreach ($app->objects() as $app_row) : ?>
                                <li>
                                    <a href="#"><?php echo $app_row->app_name; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="subnav">
                        <div class="subnav-title">
                            <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Userlist</span></a>
                        </div>
                        <div class="subnav-content">
                            <?php $attr = array('style' => 'width:32px;margin-top:4px;'); ?>
                            <ul class="userlist">
                                <li>
                                    <a href="#"><?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?></a>
                                    <div class="user">
                                        <span class="name">
                                            Jane Doe
                                        </span>
                                        <span class="position">
                                            Team manager
                                        </span>
                                    </div>
                                    <div class="status active">
                                        <i class="icon-circle"></i>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><?php echo asset::image()->load('demo/user-2.jpg', '', $attr); ?></a>
                                    <div class="user">
                                        <span class="name">
                                            John Doe
                                        </span>
                                        <span class="position">
                                            Webdesign
                                        </span>
                                    </div>
                                    <div class="status">
                                        <i class="icon-circle"></i>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><?php echo asset::image()->load('demo/user-3.jpg', '', $attr); ?></a>
                                    <div class="user">
                                        <span class="name">
                                            John Doe
                                        </span>
                                        <span class="position">
                                            UI Design
                                        </span>
                                    </div>
                                    <div class="status afk">
                                        <i class="icon-circle"></i>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><?php echo asset::image()->load('demo/user-4.jpg', '', $attr); ?></a>
                                    <div class="user">
                                        <span class="name">
                                            Jane Doe
                                        </span>
                                        <span class="position">
                                            Mobile Design
                                        </span>
                                    </div>
                                    <div class="status active">
                                        <i class="icon-circle"></i>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><?php echo asset::image()->load('demo/user-5.jpg', '', $attr); ?></a>
                                    <div class="user">
                                        <span class="name">
                                            John Doe
                                        </span>
                                        <span class="position">
                                            Webdesign
                                        </span>
                                    </div>
                                    <div class="status">
                                        <i class="icon-circle"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <form action="http://www.eakroko.de/flat/search-results.html" method="GET" class='search-form'>
                        <div class="search-pane">
                            <input type="text" name="search" placeholder="Search user...">
                            <button type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>

                </div>

                <div id="main">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="pull-left">
                                <h1><?php echo $title_page; ?></h1>
                            </div>
                            <div class="pull-right">
                                <ul class="stats">
                                    <li class='lightred'>
                                        <i class="icon-calendar"></i>
                                        <div class="details">
                                            <span class="big">February 22, 2013</span>
                                            <span>Wednesday, 13:56</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="breadcrumbs">
                            <ul>
                                <li>
                                    <a href="more-login.html">Meshplace</a>
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li>
                                    <a href="index-2.html">Beranda</a>
                                </li>
                            </ul>
                            <div class="close-bread">
                                <a href="#"><i class="icon-remove"></i></a>
                            </div>
                        </div>

                        <!-- Begin : Main View -->
                        {main_view}
                        <!-- End : Main View -->

                    </div>
                </div>
            </div>
        </body>
    <?php else : /* Jika Belum Login */ ?>
        <body class='login theme-lightred'>
            <div class="wrapper">
                {main_view}
            </div>
        </body>
    <?php endif; ?>
</html>

