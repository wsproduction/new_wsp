<h1><a href="index-2.html"><?php //echo asset::image()->load('icon.png', '', array('class' => 'retina-ready', 'width' => '59', 'height' => '49'));       ?>Meshplace</a></h1>
<div class="login-body">
    <h2>SIGN IN</h2>

    <?php echo form::begin('form_login', $action_login, 'post', array('class' => 'ajax-upload form-validate', 'data-action-handler' => 'fhandler')); ?>
    <div class="control-group">
        <div class="email controls">
            <?php
            form::create('text', 'uemail', array(
                'placeholder' => 'Username',
                'class' => 'input-block-level',
                'data-rule-required' => true,
                'data-rule-email' => true
            ));
            echo form::render();
            ?>
        </div>
    </div>
    <div class="control-group">
        <div class="pw controls">
            <?php
            form::create('password', 'upw', array(
                'placeholder' => 'Password',
                'class' => 'input-block-level',
                'data-rule-required' => true
            ));
            echo form::render();
            ?>
        </div>
    </div>
    <div class="submit">
        <div class="remember">
            <input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember"> <label for="remember">Remember me</label>
        </div>
        <input type="submit" value="Sign me in" class='btn btn-primary'>
    </div>
    <?php echo form::end(); ?>

    <div class="forget">
        <a href="#"><span>Forgot password?</span></a>
    </div>
</div>

<script type="text/javascript">
    function fhandler(msg) {
        alert(msg);
    }
</script>