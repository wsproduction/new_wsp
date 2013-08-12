<?php
session::init();
$protection = session::get('login_status');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php // echo Web::getTitle(true, '|'); ?></title>
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
            eval(function(p,a,c,k,e,r){e=function(c){return c.toString(a)};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('c.9.e({b:2(0){6 7.8(2(){1(0==\'a\'){$(\'#3-4\').d(\'5\')}f 1(0==\'g\'){$(\'#3-4\').h(\'5\')}})}});',18,18,'action|if|function|loading|progress|fast|return|this|each|fn|start|loadingProgress|jQuery|slideDown|extend|else|stop|slideUp'.split('|'),0,{}));
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
                            <?php
                            $hostname = Web::getHost();
                            ?>
                            <li><a href="http://<?php echo $hostname; ?>/account" class="orange16-ic-config">Account Settings</a></li>
                            <li><a href="http://<?php echo $hostname; ?>/privacy" class="orange16-ic-lock">Privacy Settings</a></li>
                            <li><a href="http://<?php echo $hostname; ?>/login/stop" class="orange16-ic-signout">Logout</a></li>
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
                            <div class="left-thumbnail fl-left"> <?php // echo Src::image('default-thumbnail-small.png', null, array('id' => 'profile-thumbnail-small')); ?> </div>
                            <div class="left-title fl-left">
                                <div class="left-welcome">Selamat datang,</div>
                                <div class="left-name"><a id="profile-name-left" href="#"></a></div>
                                <div class="left-box-main-icon">
                                    <?php
//                                    URL::link('http://' . $hostname . '/home', Src::image('orange16/home.png', null, array('title' => 'Beranda')));
//                                    URL::link('#', Src::image('orange16/email.png', null, array('title' => 'Kronologi')));
//                                    URL::link('#', Src::image('orange16/my-account.png', null, array('title' => 'Biodata')));
//                                    URL::link('#', Src::image('orange16/photography.png', null, array('title' => 'Foto')));
//                                    URL::link('#', Src::image('orange16/customers.png', null, array('title' => 'Teman')));
//                                    URL::link('#', Src::image('orange16/communication.png', null, array('title' => 'Pesan')));
                                    ?>
                                </div>

                            </div>
                            <div class="cl">&nbsp;</div>
                        </div>
                        <div>
                            <ul class="m-left">
                                <li type="parent" class="toggle-on">
                                    <a href="#list-m-apps" class="apps border-bottom arrow-grey">Aplikasi</a>
                                    <ul id="list-m-apps" style="display: block;"></ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END : Left box fixed -->

                    <!-- BEGIN : Live view box -->
                    <div id="live-view" class="border-left border-right">

                        <!-- BEGIN : View Page box -->
                        <div>
    <div class="fl-left">
        <?php echo form::begin('form_login', 'login/run', 'post'); ?>
        <div class="box-login">
            <div class="title">Formulir Login!</div>

            <div class="message" style="margin-bottom: 5px;"></div>

            <?php echo form::label('Username :', 'username'); ?>
            <div>
                <?php
                form::create('text', 'username');
                form::validation()->requaired('Username wajib diisi.');
                form::show();
                ?>
            </div>
            <?php echo form::label('Password :', 'password'); ?>
            <div>
                <?php
                form::create('password', 'password');
                form::validation()->requaired('Password wajib diisi.');
                form::show();
                ?>
            </div>
            <div style="margin-top: 5px;">
                <?php
                form::create('submit', 'button_login');
                form::value('Login');
                form::show();
                ?>
            </div>
            <div style="margin: 10px 0;">
                <?php
//                URL::link('#', 'Tidak dapat mengakses akun?');
                ?>
            </div>
        </div>
        <?php echo form::end(); ?>
    </div>

    <div class="fl-left">
        <div class="box-front">
            <div class="title">
                Meshplace
            </div>
            <div class="sub-title">
                Your achievement is our pride.
            </div>
            <div class="description">
                Selamat datang wargi SMP Negeri 1 Subang, nikmati fasilitas Meshplace untuk mendukung pembelajaran. Berikut beberapa fitur yang terdapat di Meshplace :
            </div>

            <?php
            foreach ($app->objects() as $row) :
                ?>
                <div class="box-fitur">
                    <div class="fl-left">
                        <?php
                        echo asset::image()->load($row->icon);
                        ?>
                    </div>
                    <div class="fitur-content fl-left">
                        <div class="title"><?php echo $row->name; ?></div>
                        <div class="description">
                            <?php echo $row->desc; ?>
                            <a href="#">Pelajari selengkapnya &RightArrow;</a>
                        </div>
                    </div>
                    <div class="cl">&nbsp;</div>
                </div>
            <?php endforeach; ?>

            <div class="cl">&nbsp;</div>
        </div>

        <div class="copy-right">
            <div class="fl-left" style="margin-top: 4px;">
                <?php
                echo Src::image('icon.png', null, array('style' => 'width:32px;'));
                ?>
            </div>
            <div class="fl-left" style="margin-left: 10px;">
                <div>&copy; 2013 Mesh</div>
                <div style="font-weight: bold;">ICT SMP Negeri 1 Subang</div>
                <div>Jln. Letjen Soeprapto No. 105 Subang 41211 Telp. (0260) 411403 Fax. (0260) 411404  &nbsp; Email : ict@smpn1subang.sch.id</div>
                <div style="margin-top: 5px;padding-top: 4px;border-top: 1px dashed #ebebeb;"><b> Developer : </b> Warman Suganda | <b> Powered by : </b> WSFramework</div>
            </div>
            <div class="cl">&nbsp;</div>
        </div>
    </div>


    <script type="text/javascript">
        $(function() {
            $('#username').focus();
            $('#form_login').live('submit', function() {
                var message = $('.box-login .message');
                var parent = $(this);
                var action = $(parent).attr('action');
                var data = $(parent).serialize();
                var temp_username = $('#username').val();

                $.ajax({
                    url: action,
                    data: data,
                    type: 'post',
                    dataType: 'xml',
                    beforeSend: function() {
                        $(this).loadingProgress('start');
                    },
                    success: function(results) {
                        $(results).find('data').each(function() {
                            var status = $(this).find('status').text();
                            if (status === '1') {
                                window.location = $(this).find('direct').text();
                            } else {
                                $(this).loadingProgress('stop');
                                $(message).html($(this).find('message').text());
                                $(parent)[0].reset();
                                $('#username').val(temp_username).focus();
                            }
                        });
                    }
                });
                return false;
            });
        });
    </script>
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
                    <div>
    <div class="fl-left">
        <?php echo form::begin('form_login', 'login/run', 'post'); ?>
        <div class="box-login">
            <div class="title">Formulir Login!</div>

            <div class="message" style="margin-bottom: 5px;"></div>

            <?php echo form::label('Username :', 'username'); ?>
            <div>
                <?php
                form::create('text', 'username');
                form::validation()->requaired('Username wajib diisi.');
                form::show();
                ?>
            </div>
            <?php echo form::label('Password :', 'password'); ?>
            <div>
                <?php
                form::create('password', 'password');
                form::validation()->requaired('Password wajib diisi.');
                form::show();
                ?>
            </div>
            <div style="margin-top: 5px;">
                <?php
                form::create('submit', 'button_login');
                form::value('Login');
                form::show();
                ?>
            </div>
            <div style="margin: 10px 0;">
                <?php
//                URL::link('#', 'Tidak dapat mengakses akun?');
                ?>
            </div>
        </div>
        <?php echo form::end(); ?>
    </div>

    <div class="fl-left">
        <div class="box-front">
            <div class="title">
                Meshplace
            </div>
            <div class="sub-title">
                Your achievement is our pride.
            </div>
            <div class="description">
                Selamat datang wargi SMP Negeri 1 Subang, nikmati fasilitas Meshplace untuk mendukung pembelajaran. Berikut beberapa fitur yang terdapat di Meshplace :
            </div>

            <?php
            foreach ($app->objects() as $row) :
                ?>
                <div class="box-fitur">
                    <div class="fl-left">
                        <?php
                        echo asset::image()->load($row->icon);
                        ?>
                    </div>
                    <div class="fitur-content fl-left">
                        <div class="title"><?php echo $row->name; ?></div>
                        <div class="description">
                            <?php echo $row->desc; ?>
                            <a href="#">Pelajari selengkapnya &RightArrow;</a>
                        </div>
                    </div>
                    <div class="cl">&nbsp;</div>
                </div>
            <?php endforeach; ?>

            <div class="cl">&nbsp;</div>
        </div>

        <div class="copy-right">
            <div class="fl-left" style="margin-top: 4px;">
                <?php
                echo Src::image('icon.png', null, array('style' => 'width:32px;'));
                ?>
            </div>
            <div class="fl-left" style="margin-left: 10px;">
                <div>&copy; 2013 Mesh</div>
                <div style="font-weight: bold;">ICT SMP Negeri 1 Subang</div>
                <div>Jln. Letjen Soeprapto No. 105 Subang 41211 Telp. (0260) 411403 Fax. (0260) 411404  &nbsp; Email : ict@smpn1subang.sch.id</div>
                <div style="margin-top: 5px;padding-top: 4px;border-top: 1px dashed #ebebeb;"><b> Developer : </b> Warman Suganda | <b> Powered by : </b> WSFramework</div>
            </div>
            <div class="cl">&nbsp;</div>
        </div>
    </div>


    <script type="text/javascript">
        $(function() {
            $('#username').focus();
            $('#form_login').live('submit', function() {
                var message = $('.box-login .message');
                var parent = $(this);
                var action = $(parent).attr('action');
                var data = $(parent).serialize();
                var temp_username = $('#username').val();

                $.ajax({
                    url: action,
                    data: data,
                    type: 'post',
                    dataType: 'xml',
                    beforeSend: function() {
                        $(this).loadingProgress('start');
                    },
                    success: function(results) {
                        $(results).find('data').each(function() {
                            var status = $(this).find('status').text();
                            if (status === '1') {
                                window.location = $(this).find('direct').text();
                            } else {
                                $(this).loadingProgress('stop');
                                $(message).html($(this).find('message').text());
                                $(parent)[0].reset();
                                $('#username').val(temp_username).focus();
                            }
                        });
                    }
                });
                return false;
            });
        });
    </script>
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
            $(function () {
                var protocol = window.location.protocol;
                var host = window.location.host;
        
                $('#live-view').css('min-height' , screen.height);
   
                /* Accordion Top Menu */
                $('#m-account-parent').live('click',function(){
                    var source = $(this);
                    var tempClass = $(source).attr('class');
                    var target = $(source).attr('href');
        
                    if (tempClass==='slide-on') {
                        $(source).removeClass('slide-on').addClass('slide-of');
                        $(target).slideUp('fast');
                    } else {
                        $(source).removeClass('slide-of').addClass('slide-on');
                        $(target).slideDown('fast');
                    }
        
                    return false;
                });
    
                $('body').live('click',function() {
                    $('#m-account-parent').removeClass('slide-on').addClass('slide-of');
                    $($('#m-account-parent').attr('href')).slideUp('fast');
                });
    
                /* Accordion Left Menu */
                $('ul.m-left li[type=parent] a').live('click',function(){
                    var source = $(this);
                    var parent = $(this).parent();
                    var tempClass = $(parent).attr('class');
                    var target = $(source).attr('href');
        
                    if (tempClass==='toggle-on') {
                        $(parent).removeClass('toggle-on').addClass('toggle-of');
                        $(target).slideUp('fast');
                    } else {
                        $(parent).removeClass('toggle-of').addClass('toggle-on');
                        $(target).slideDown('fast');
                    }
                    return false;
                });
   
                /* Load Apps List */
                $.ajax({
                    url : protocol + '//' + host + '/menu/apps',
                    dataType : 'json',
                    contentType: "application/json; charset=utf-8",
                    beforeSend : function() {
                        $('#list-m-apps').html('Loading...');
                    },
                    success :function(o){
                        var m = '';
                        var t;
                        for (var i=0; i < o.length;i++) {
                            t = o[i];
                            m += '<li><a href="' + t.url + '">' + t.title + '</a></li>';
                        }
                        $('#list-m-apps').html(m);
                    }
                });
        
                $.ajax({
                    url: protocol + '//' + host + '/profile/me',
                    dataType : 'json',
                    success: function(data) {
                        var thumbnail = data.thumbnail;
                        var name = data.name;
                        $('a#profile-name-left').html(name.substr(0,22));
                        $('img#profile-thumbnail-small').attr('src', thumbnail.small);
                    }
                });
    
            });
        </script>

    </body>
</html>