<?php
$protection = session::get('sess_login');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php // echo Web::getTitle(true, '|');   ?></title>
        <meta name="description" content="Welcome to HOTS SPENSA, Heiger Order Thinking Skill for Student SMP Negeri 1 Subang." />
        <meta name="keywords" content="hots, hots spensa, hots smpn 1 subang, smp negeri 1 subang" />

        <?php
        echo asset::image()->fav_icon('icon.png');

        asset::js()->plugin('jquery');
        asset::js()->plugin('jquery.ui');

        asset::css()->append('layout');
        echo asset::jcss();
        ?>

        <script>
            /* jQuery Custom */
            eval(function(p, a, c, k, e, r) {
                e = function(c) {
                    return c.toString(a)
                };
                if (!''.replace(/^/, String)) {
                    while (c--)
                        r[e(c)] = k[c] || e(c);
                    k = [function(e) {
                            return r[e]
                        }];
                    e = function() {
                        return'\\w+'
                    };
                    c = 1
                }
                ;
                while (c--)
                    if (k[c])
                        p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
                return p
            }('c.9.e({b:2(0){6 7.8(2(){1(0==\'a\'){$(\'#3-4\').d(\'5\')}f 1(0==\'g\'){$(\'#3-4\').h(\'5\')}})}});', 18, 18, 'action|if|function|loading|progress|fast|return|this|each|fn|start|loadingProgress|jQuery|slideDown|extend|else|stop|slideUp'.split('|'), 0, {}));
        </script>
    </head>
    <body>
        <div id="outline">

            <!-- BEGIN : Loading -->
            <div id="loading-progress"> Loading...</div>
            <!-- END : Loading -->

            <!-- BEGIN : Header box fixed -->
            <div id="header">
                <div id="logo" class="fl-left">
                    Meshplace
                </div>
                <?php if ($protection) : ?>
                    <div id="m-account" class="fl-right">
                        <a id="m-account-parent" class="slide-of" href="#m-account-child">My Account</a>
                        <div class="cl">&nbsp;</div>
                        <ul id="m-account-child">
                            <li><?php echo url::anchor('Account Settings', 'account', false, array('class' => 'orange16-ic-config')) ?></li>
                            <li><?php echo url::anchor('Privacy Settings', 'privacy', false, array('class' => 'orange16-ic-lock')) ?></li>
                            <li><?php echo url::anchor('Logout', 'login/stop', false, array('class' => 'orange16-ic-signout')) ?></li>
                            <li><div class="hr-solid-grey"></div></li>
                            <li><a href="http://<?php echo $hostname; ?>/login/stop" class="orange16-ic-lightbulb">Bantuan</a></li>
                            <li><a href="http://<?php echo $hostname; ?>/login/stop" class="orange16-ic-collaboration">Tentang SekolahKu</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <!-- END : Header box fixed -->

            <!-- BEGIN : Content box -->
            <div id="content">

                <?php if ($protection) : ?>
                    <!-- BEGIN : Left box fixed -->
                    <div id="fix-left">
                        <div class="left-user-info">
                            <?php $userdata = session::get('sess_userdata'); ?>
                            <div class="left-thumbnail fl-left"> <?php echo asset::image()->load('default-thumbnail.png', url::attachment('images/thumbnail-small/')); ?> </div>
                            <div class="left-title fl-left">
                                <div class="left-welcome">Selamat datang,</div>
                                <div class="left-name"><a id="profile-name-left" href="#"><?php echo $userdata['name']; ?></a></div>
                                <div class="left-box-main-icon">
                                    <?php
                                    echo url::anchor(asset::image()->load('orange16/home.png', null), 'home');
                                    echo url::anchor(asset::image()->load('orange16/email.png', null), '#');
                                    echo url::anchor(asset::image()->load('orange16/my-account.png', null), '#');
                                    echo url::anchor(asset::image()->load('orange16/photography.png', null), '#');
                                    echo url::anchor(asset::image()->load('orange16/customers.png', null), '#');
                                    echo url::anchor(asset::image()->load('orange16/communication.png', null), '#');
                                    ?>
                                </div>

                            </div>
                            <div class="cl">&nbsp;</div>
                        </div>
                        <div>
                            <ul class="m-left">
                                <li type="parent" class="toggle-on">
                                    <a href="#list-m-apps" class="apps border-bottom arrow-grey">Aplikasi</a>
                                    
                                    <ul id="list-m-apps" style="display: block;">
                                        <?php foreach ($app->objects() as $row) : ?>
                                        <li><?php echo url::anchor($row->name, $row->alias); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END : Left box fixed -->

                    <!-- BEGIN : Live view box -->
                    <div id="live-view" class="border-left border-right">

                        <!-- BEGIN : View Page box -->
                        {main_view}
                        <!-- END : View Page box -->

                        <div class="cl">&nbsp;</div>

                    </div>
                    <!-- END : Live view box -->

                    <!-- BEGIN : Right box fixed-->
                    <div id="fix-right" style="width: 235px;padding-top: 10px;">
                        <?php /* echo Src::image('chat-sample.png', null, array('style', 'padding:10px 10px 0 0;')); */ ?>
                    </div>
                    <!-- END : Left box fixed -->
                <?php else : ?>
                    {main_view}
                <?php endif; ?>
                <div class="cl">&nbsp;</div>

            </div>
            <!-- END : Content box -->

            <!-- BEGIN : Footer box -->
            <div id="footer" class="border-top">
                MySchool &copy; 2012 | Develope by : Warman Suganda
            </div>
            <!-- END : Footer box -->

        </div> 

        <script>
            $(function() {
//                var protocol = window.location.protocol;
//                var host = window.location.host;
//        
                $('#live-view').css('min-height', screen.height);

                /* Accordion Top Menu */
                $('#m-account-parent').live('click', function() {
                    var source = $(this);
                    var tempClass = $(source).attr('class');
                    var target = $(source).attr('href');

                    if (tempClass === 'slide-on') {
                        $(source).removeClass('slide-on').addClass('slide-of');
                        $(target).slideUp('fast');
                    } else {
                        $(source).removeClass('slide-of').addClass('slide-on');
                        $(target).slideDown('fast');
                    }

                    return false;
                });

                $('body').live('click', function() {
                    $('#m-account-parent').removeClass('slide-on').addClass('slide-of');
                    $($('#m-account-parent').attr('href')).slideUp('fast');
                });

                /* Accordion Left Menu */
                $('ul.m-left li[type=parent] a').live('click', function() {
                    var source = $(this);
                    var parent = $(this).parent();
                    var tempClass = $(parent).attr('class');
                    var target = $(source).attr('href');

                    if (tempClass === 'toggle-on') {
                        $(parent).removeClass('toggle-on').addClass('toggle-of');
                        $(target).slideUp('fast');
                    } else {
                        $(parent).removeClass('toggle-of').addClass('toggle-on');
                        $(target).slideDown('fast');
                    }
                    return false;
                });

//                /* Load Apps List */
//                $.ajax({
//                    url : protocol + '//' + host + '/menu/apps',
//                    dataType : 'json',
//                    contentType: "application/json; charset=utf-8",
//                    beforeSend : function() {
//                        $('#list-m-apps').html('Loading...');
//                    },
//                    success :function(o){
//                        var m = '';
//                        var t;
//                        for (var i=0; i < o.length;i++) {
//                            t = o[i];
//                            m += '<li><a href="' + t.url + '">' + t.title + '</a></li>';
//                        }
//                        $('#list-m-apps').html(m);
//                    }
//                });
//        
//                $.ajax({
//                    url: protocol + '//' + host + '/profile/me',
//                    dataType : 'json',
//                    success: function(data) {
//                        var thumbnail = data.thumbnail;
//                        var name = data.name;
//                        $('a#profile-name-left').html(name.substr(0,22));
//                        $('img#profile-thumbnail-small').attr('src', thumbnail.small);
//                    }
//                });

            });
        </script>

    </body>
</html>