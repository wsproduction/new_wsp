<div>
    <div class="fl-left">
        <?php echo form::begin('form_login', $action_login, 'post', array('accept-charset' => 'utf-8', 'enctype' => 'multipart/form-data')); ?>
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
                echo url::anchor('Tidak dapat mengakses akun?', '#');
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
                echo asset::image()->load('icon.png', null, array('style' => 'width:32px;'));
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
</div>


<script type="text/javascript">
    $(function() {
        $('#username').focus();
        $('#form_login').live('submit', function() {

            var message = $('.box-login .message');
            var parent = $(this);
            var temp_username = $('#username').val();

            $(parent).ajaxSubmit({
                success: function(o) {
                    var parsing = o.replace('<div id="LCS_336D0C35_8A85_403a_B9D2_65C292C39087_communicationDiv"></div>', '');
                    if (parsing) {
                        var obj = eval('(' + parsing + ')');
                        if (obj[0]) {
                            window.location = obj[2];
                        } else {
                            if (obj[1]) {
                                $(parent)[0].reset();
                            }
                            $('#username').val(temp_username);
                            $(message).html($.base64.decode(obj[2]));
                        }
                    }
                }
            });
            return false;
        });
    });
</script>