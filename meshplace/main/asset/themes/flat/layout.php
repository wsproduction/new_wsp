<?php
$protection = session::get('sess_login');
?>
<!doctype html>
<html>

    <!-- Mirrored from www.eakroko.de/flat/ by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 18 Sep 2013 08:12:05 GMT -->
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

        // Bootstrap
        asset::css()->append('bootstrap.min');
        // Bootstrap responsive 
        asset::css()->append('bootstrap-responsive.min');
        // jQuery UI
        asset::css()->append('plugins/jquery-ui/smoothness/jquery-ui');
        asset::css()->append('plugins/jquery-ui/smoothness/jquery.ui.theme');
        // PageGuide
        asset::css()->append('plugins/pageguide/pageguide');
        // Fullcalendar
        asset::css()->append('plugins/fullcalendar/fullcalendar');
        asset::css()->append('plugins/fullcalendar/fullcalendar.print');
        // chosen
        asset::css()->append('plugins/chosen/chosen');
        // select2
        asset::css()->append('plugins/select2/select2');
        // icheck
        asset::css()->append('plugins/icheck/all');
        // Theme CSS
        asset::css()->append('style');
        // Color CSS
        asset::css()->append('themes');

        // jQuery
        asset::js()->append('jquery.min');

        // Nice Scroll
        asset::js()->append('plugins/nicescroll/jquery.nicescroll.min');
        // jQuery UI
        asset::js()->append('plugins/jquery-ui/jquery.ui.core.min');
        asset::js()->append('plugins/jquery-ui/jquery.ui.widget.min');
        asset::js()->append('plugins/jquery-ui/jquery.ui.mouse.min');
        asset::js()->append('plugins/jquery-ui/jquery.ui.draggable.min');
        asset::js()->append('plugins/jquery-ui/jquery.ui.resizable.min');
        asset::js()->append('plugins/jquery-ui/jquery.ui.sortable.min');
        // Touch enable for jquery UI 
        asset::js()->append('plugins/touch-punch/jquery.touch-punch.min');
        // slimScroll
        asset::js()->append('plugins/slimscroll/jquery.slimscroll.min');
        // Bootstrap
        asset::js()->append('bootstrap.min');
        // vmap
        asset::js()->append('plugins/vmap/jquery.vmap.min');
        asset::js()->append('plugins/vmap/jquery.vmap.world');
        asset::js()->append('plugins/vmap/jquery.vmap.sampledata');
        // Bootbox
        asset::js()->append('plugins/bootbox/jquery.bootbox');
        // Flot
        asset::js()->append('plugins/flot/jquery.flot.min');
        asset::js()->append('plugins/flot/jquery.flot.bar.order.min');
        asset::js()->append('plugins/flot/jquery.flot.pie.min');
        asset::js()->append('plugins/flot/jquery.flot.resize.min');
        // imagesLoaded
        asset::js()->append('plugins/imagesLoaded/jquery.imagesloaded.min');
        // PageGuide
        asset::js()->append('plugins/pageguide/jquery.pageguide');
        // FullCalendar
        asset::js()->append('plugins/fullcalendar/fullcalendar.min');
        // Chosen
        asset::js()->append('plugins/chosen/chosen.jquery.min');
        // select2
        asset::js()->append('plugins/select2/select2.min');
        // icheck
        asset::js()->append('plugins/icheck/jquery.icheck.min');

        // Theme framework
        asset::js()->append('eakroko.min');
        // Theme scripts
        asset::js()->append('application.min');
        // Just for demonstration
        asset::js()->append('demonstration.min');

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
    <?php if (true) : //if ($protection) : /* Jika Sudah Login */ ?>
        <body class="theme-lightred">
            <div id="new-task" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Add new task</h3>
                </div>
                <form action="#" class='new-task-form form-horizontal form-bordered'>
                    <div class="modal-body nopadding">
                        <div class="control-group">
                            <label for="tasktitel" class="control-label">Icon</label>
                            <div class="controls">
                                <select name="icons" id="icons" class='select2-me input-xlarge'>
                                    <option value="icon-adjust">icon-adjust</option>
                                    <option value="icon-asterisk">icon-asterisk</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="task-name" class="control-label">Task</label>
                            <div class="controls">
                                <input type="text" name="task-name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="tasktitel" class="control-label"></label>
                            <div class="controls">
                                <label class="checkbox"><input type="checkbox" name="task-bookmarked" value="yep"> Mark as important</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Add task">
                    </div>
                </form>
            </div>
            <div id="modal-user" class="modal hide">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="user-infos">Warman Suganda</h3>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span2">
                            <?php echo asset::image()->load('demo/user-1.jpg'); ?>
                        </div>
                        <div class="span10">
                            <dl class="dl-horizontal" style="margin-top:0;">
                                <dt>Full name:</dt>
                                <dd>Jane Doe</dd>
                                <dt>Email:</dt>
                                <dd>jane.doe@janedoesemail.com</dd>
                                <dt>Address:</dt>
                                <dd>
                                    <address> <strong>John Doe, Inc.</strong>
                                        <br>
                                        7195 JohnsonDoes Ave, Suite 320
                                        <br>
                                        San Francisco, CA 881234
                                        <br> <abbr title="Phone">P:</abbr>
                                        (123) 456-7890
                                    </address>
                                </dd>
                                <dt>Social:</dt>
                                <dd>
                                    <a href="#" class='btn'><i class="icon-facebook"></i></a>
                                    <a href="#" class='btn'><i class="icon-twitter"></i></a>
                                    <a href="#" class='btn'><i class="icon-linkedin"></i></a>
                                    <a href="#" class='btn'><i class="icon-envelope"></i></a>
                                    <a href="#" class='btn'><i class="icon-rss"></i></a>
                                    <a href="#" class='btn'><i class="icon-github"></i></a>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal">Close</button>
                </div>
            </div>
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
                                    <a href="more-login.html">Sign out</a>
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

                    <div style="border-bottom: 1px dashed #ccc;margin: 4px 7px;"></div>

                    <form action="http://www.eakroko.de/flat/search-results.html" method="GET" class='search-form'>
                        <div class="search-pane">
                            <input type="text" name="search" placeholder="Search here...">
                            <button type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>

                    <div style="padding: 7px; font-style: italic;">
                        Daftar user yang sedang online:
                        <div>
                            <?php $attr = array('style' => 'width:32px;margin-top:4px;'); ?>
                            <?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?>
                            <?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?>
                            <?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?>
                            <?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?>
                            <?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?>

                            <?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?>
                            <?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?>
                            <?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?>
                            <?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?>
                            <?php echo asset::image()->load('demo/user-1.jpg', '', $attr); ?>
                        </div>
                    </div>

                </div>
                <div id="main">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="pull-left">
                                <h1>Beranda</h1>
                            </div>
                            <div class="pull-right">
                                <ul class="minitiles">
                                    <li class='grey'>
                                        <a href="#"><i class="icon-cogs"></i></a>
                                    </li>
                                    <li class='lightgrey'>
                                        <a href="#"><i class="icon-globe"></i></a>
                                    </li>
                                </ul>
                                <ul class="stats">
                                    <li class='satgreen'>
                                        <i class="icon-money"></i>
                                        <div class="details">
                                            <span class="big">$324,12</span>
                                            <span>Balance</span>
                                        </div>
                                    </li>
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
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="box box-color box-bordered">
                                    <div class="box-title">
                                        <h3>
                                            <i class="icon-bar-chart"></i>
                                            Audience Overview
                                        </h3>
                                        <div class="actions">
                                            <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                                            <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                                            <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <div class="statistic-big">
                                            <div class="top">
                                                <div class="left">
                                                    <div class="input-medium">
                                                        <select name="category" class='chosen-select' data-nosearch="true">
                                                            <option value="1">Visits</option>
                                                            <option value="2">New Visits</option>
                                                            <option value="3">Unique Visits</option>
                                                            <option value="4">Pageviews</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    8,195 <span><i class="icon-circle-arrow-up"></i></span>
                                                </div>
                                            </div>
                                            <div class="bottom">
                                                <div class="flot medium" id="flot-audience"></div>
                                            </div>
                                            <div class="bottom">
                                                <ul class="stats-overview">
                                                    <li>
                                                        <span class="name">
                                                            Visits
                                                        </span>
                                                        <span class="value">
                                                            11,251
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="name">
                                                            Pages / Visit
                                                        </span>
                                                        <span class="value">
                                                            8.31
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="name">
                                                            Avg. Duration
                                                        </span>
                                                        <span class="value">
                                                            00:06:41
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="name">
                                                            % New Visits
                                                        </span>
                                                        <span class="value">
                                                            67,35%
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="box box-color lightred box-bordered">
                                    <div class="box-title">
                                        <h3>
                                            <i class="icon-bar-chart"></i>
                                            HDD usage
                                        </h3>
                                        <div class="actions">
                                            <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                                            <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                                            <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <div class="statistic-big">
                                            <div class="top">
                                                <div class="left">
                                                    <div class="input-medium">
                                                        <select name="category" class='chosen-select' data-nosearch="true">
                                                            <option value="1">Today</option>
                                                            <option value="2">Yesterday</option>
                                                            <option value="3">Last week</option>
                                                            <option value="4">Last month</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    50% <span><i class="icon-circle-arrow-right"></i></span>
                                                </div>
                                            </div>
                                            <div class="bottom">
                                                <div class="flot medium" id="flot-hdd"></div>
                                            </div>
                                            <div class="bottom">
                                                <ul class="stats-overview">
                                                    <li>
                                                        <span class="name">
                                                            Usage
                                                        </span>
                                                        <span class="value">
                                                            50%
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="name">
                                                            Usage % / User
                                                        </span>
                                                        <span class="value">
                                                            0.031
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="name">
                                                            Avg. Usage %
                                                        </span>
                                                        <span class="value">
                                                            60%
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="name">
                                                            Idle Usage %
                                                        </span>
                                                        <span class="value">
                                                            12%
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="box box-color box-bordered lightgrey">
                                    <div class="box-title">
                                        <h3><i class="icon-ok"></i> Tasks</h3>
                                        <div class="actions">
                                            <a href="#new-task" data-toggle="modal" class='btn'><i class="icon-plus-sign"></i> Add Task</a>
                                        </div>
                                    </div>
                                    <div class="box-content nopadding">
                                        <ul class="tasklist">
                                            <li class='bookmarked'>
                                                <div class="check">
                                                    <input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
                                                </div>
                                                <span class="task"><i class="icon-ok"></i><span>Approve new users</span></span>
                                                <span class="task-actions">
                                                    <a href="#" class='task-delete' rel="tooltip" title="Delete that task"><i class="icon-remove"></i></a>
                                                    <a href="#" class='task-bookmark' rel="tooltip" title="Mark as important"><i class="icon-bookmark-empty"></i></a>
                                                </span>
                                            </li>
                                            <li>
                                                <div class="check">
                                                    <input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
                                                </div>
                                                <span class="task"><i class="icon-bar-chart"></i><span>Check statistics</span></span>
                                                <span class="task-actions">
                                                    <a href="#" class='task-delete' rel="tooltip" title="Delete that task"><i class="icon-remove"></i></a>
                                                    <a href="#" class='task-bookmark' rel="tooltip" title="Mark as important"><i class="icon-bookmark-empty"></i></a>
                                                </span>
                                            </li>
                                            <li class='done'>
                                                <div class="check">
                                                    <input type="checkbox" class='icheck-me' data-skin="square" data-color="blue" checked>
                                                </div>
                                                <span class="task"><i class="icon-envelope"></i><span>Check for new mails</span></span>
                                                <span class="task-actions">
                                                    <a href="#" class='task-delete' rel="tooltip" title="Delete that task"><i class="icon-remove"></i></a>
                                                    <a href="#" class='task-bookmark' rel="tooltip" title="Mark as important"><i class="icon-bookmark-empty"></i></a>
                                                </span>
                                            </li>
                                            <li>
                                                <div class="check">
                                                    <input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
                                                </div>
                                                <span class="task"><i class="icon-comment"></i><span>Chat with John Doe</span></span>
                                                <span class="task-actions">
                                                    <a href="#" class='task-delete' rel="tooltip" title="Delete that task"><i class="icon-remove"></i></a>
                                                    <a href="#" class='task-bookmark' rel="tooltip" title="Mark as important"><i class="icon-bookmark-empty"></i></a>
                                                </span>
                                            </li>
                                            <li>
                                                <div class="check">
                                                    <input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
                                                </div>
                                                <span class="task"><i class="icon-retweet"></i><span>Go and tweet some stuff</span></span>
                                                <span class="task-actions">
                                                    <a href="#" class='task-delete' rel="tooltip" title="Delete that task"><i class="icon-remove"></i></a>
                                                    <a href="#" class='task-bookmark' rel="tooltip" title="Mark as important"><i class="icon-bookmark-empty"></i></a>
                                                </span>
                                            </li>
                                            <li>
                                                <div class="check">
                                                    <input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
                                                </div>
                                                <span class="task"><i class="icon-edit"></i><span>Write an article</span></span>
                                                <span class="task-actions">
                                                    <a href="#" class='task-delete' rel="tooltip" title="Delete that task"><i class="icon-remove"></i></a>
                                                    <a href="#" class='task-bookmark' rel="tooltip" title="Mark as important"><i class="icon-bookmark-empty"></i></a>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="box">
                                    <div class="box-title">
                                        <h3><i class="icon-bolt"></i>Server load</h3>
                                        <div class="actions">
                                            <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                                            <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                                            <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <div class="flot flot-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="box">
                                    <div class="box-title">
                                        <h3><i class="icon-comment"></i>Chat</h3>
                                        <div class="actions">
                                            <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                                            <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                                            <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content nopadding scrollable" data-height="350" data-visible="true" data-start="bottom">
                                        <ul class="messages">
                                            <li class="left">
                                                <div class="image">
                                                    <?php echo asset::image()->load('demo/user-1.jpg'); ?>
                                                </div>
                                                <div class="message">
                                                    <span class="caret"></span>
                                                    <span class="name">Jane Doe</span>
                                                    <p>Lorem ipsum aute ut ullamco et nisi ad. </p>
                                                    <span class="time">
                                                        12 minutes ago
                                                    </span>
                                                </div>
                                            </li>
                                            <li class="right">
                                                <div class="image">
                                                    <?php echo asset::image()->load('demo/user-1.jpg'); ?>
                                                </div>
                                                <div class="message">
                                                    <span class="caret"></span>
                                                    <span class="name">John Doe</span>
                                                    <p>Lorem ipsum aute ut ullamco et nisi ad. Lorem ipsum adipisicing nisi Excepteur eiusmod ex culpa laboris. Lorem ipsum est ut...</p>
                                                    <span class="time">
                                                        12 minutes ago
                                                    </span>
                                                </div>
                                            </li>
                                            <li class="left">
                                                <div class="image">
                                                    <?php echo asset::image()->load('demo/user-1.jpg'); ?>
                                                </div>
                                                <div class="message">
                                                    <span class="caret"></span>
                                                    <span class="name">Jane Doe</span>
                                                    <p>Lorem ipsum aute ut ullamco et nisi ad. Lorem ipsum adipisicing nisi!</p>
                                                    <span class="time">
                                                        12 minutes ago
                                                    </span>
                                                </div>
                                            </li>
                                            <li class="typing">
                                                <span class="name">John Doe</span> is typing <?php echo asset::image()->load('loading.gif'); ?>
                                            </li>
                                            <li class="insert">
                                                <form id="message-form" method="POST" action="#">
                                                    <div class="text">
                                                        <input type="text" name="text" placeholder="Write here..." class="input-block-level">
                                                    </div>
                                                    <div class="submit">
                                                        <button type="submit"><i class="icon-share-alt"></i></button>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="box">
                                    <div class="box-title">
                                        <h3><i class="icon-globe"></i>User regions</h3>
                                        <div class="actions">
                                            <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                                            <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                                            <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <div id="vmap"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="box box-color box-bordered">
                                    <div class="box-title">
                                        <h3><i class="icon-user"></i>Address Book</h3>
                                        <div class="actions">
                                            <a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
                                            <a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
                                            <a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content nopadding scrollable" data-height="300" data-visible="true">
                                        <table class="table table-user table-nohead">
                                            <tbody>
                                                <tr class="alpha">
                                                    <td class="alpha-val">
                                                        <span>B</span>
                                                    </td>
                                                    <td colspan="2"></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Bi Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Boo Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr class="alpha">
                                                    <td class="alpha-val">
                                                        <span>D</span>
                                                    </td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Dan Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Dane Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr class="alpha">
                                                    <td class="alpha-val">
                                                        <span>H</span>
                                                    </td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Hilda N. Ervin</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr class="alpha">
                                                    <td class="alpha-val">
                                                        <span>J</span>
                                                    </td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>John Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>John Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr class="alpha">
                                                    <td class="alpha-val">
                                                        <span>L</span>
                                                    </td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Laura J. Brown</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Lilly J. Tooley</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr class="alpha">
                                                    <td class="alpha-val">
                                                        <span>M</span>
                                                    </td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Maxi Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Max Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr class="alpha">
                                                    <td class="alpha-val">
                                                        <span>O</span>
                                                    </td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Oxx Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Osam Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr class="alpha">
                                                    <td class="alpha-val">
                                                        <span>P</span>
                                                    </td>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Petra Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class='img'><?php echo asset::image()->load('demo/user-1.jpg'); ?></td>
                                                    <td class='user'>Per Doe</td>
                                                    <td class='icon'><a href="#" class='btn'><i class="icon-search"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="box">
                                    <div class="box-title">
                                        <h3><i class="icon-calendar"></i>My calendar</h3>
                                    </div>
                                    <div class="box-content nopadding">
                                        <div class="calendar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="box box-color box-bordered green">
                                    <div class="box-title">
                                        <h3><i class="icon-bullhorn"></i>Feeds</h3>
                                        <div class="actions">
                                            <a href="#" class="btn btn-mini custom-checkbox checkbox-active">Automatic refresh<i class="icon-check-empty"></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content nopadding scrollable" data-height="400" data-visible="true">
                                        <table class="table table-nohead" id="randomFeed">
                                            <tbody>
                                                <tr>
                                                    <td><span class="label"><i class="icon-plus"></i></span> <a href="#">John Doe</a> added a new photo</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="label label-success"><i class="icon-user"></i></span> New user registered</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="label label-info"><i class="icon-shopping-cart"></i></span> New order received</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="label label-warning"><i class="icon-comment"></i></span> <a href="#">John Doe</a> commented on <a href="#">News #123</a></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="label label-success"><i class="icon-user"></i></span> New user registered</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="label label-info"><i class="icon-shopping-cart"></i></span> New order received</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="label label-warning"><i class="icon-comment"></i></span> <a href="#">John Doe</a> commented on <a href="#">News #123</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div>
            <script type="text/javascript">

    //                var _gaq = _gaq || [];
    //                _gaq.push(['_setAccount', 'UA-38620714-4']);
    //                _gaq.push(['_trackPageview']);
    //
    //                (function() {
    //                    var ga = document.createElement('script');
    //                    ga.type = 'text/javascript';
    //                    ga.async = true;
    //                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    //                    var s = document.getElementsByTagName('script')[0];
    //                    s.parentNode.insertBefore(ga, s);
    //                })();

            </script>
        </body>
    <?php else : /* Jika Belum Login */ ?>
        <body class='login theme-lightred'>
            <div class="wrapper">
                {main_view}
            </div>
            <script type="text/javascript">

    //                var _gaq = _gaq || [];
    //                _gaq.push(['_setAccount', 'UA-38620714-4']);
    //                _gaq.push(['_trackPageview']);
    //
    //                (function() {
    //                    var ga = document.createElement('script');
    //                    ga.type = 'text/javascript';
    //                    ga.async = true;
    //                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    //                    var s = document.getElementsByTagName('script')[0];
    //                    s.parentNode.insertBefore(ga, s);
    //                })();

            </script>
        </body>
    <?php endif; ?>
    <!-- Mirrored from www.eakroko.de/flat/ by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 18 Sep 2013 08:15:45 GMT -->
</html>

