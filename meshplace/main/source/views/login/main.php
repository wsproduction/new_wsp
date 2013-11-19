<h1>Meshplace</h1>
<div class="login-body">
    <h2>SIGN IN</h2>

    <?php echo form::begin('form_login', $action_login, 'post', array('class' => 'ajax-submit form-validate', 'enctype' => 'multipart/form-data', 'data-action-handler' => 'fhandler')); ?>
    <div class="control-group">
        <div class="email controls">
            <?php
            echo form::create('text', 'uemail', array(
                'placeholder' => 'Username',
                'class' => 'input-block-level',
                'data-rule-required' => true,
                'data-rule-email' => true
                    ), true);
            ?>
        </div>
    </div>
    <div class="control-group">
        <div class="pw controls">
            <?php
            echo form::create('password', 'upw', array(
                'placeholder' => 'Password',
                'class' => 'input-block-level',
                'data-rule-required' => true
                    ), true);
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
        if (msg[0]) {
            redirect(msg[2]);
        } else {
            alert(msg[2]);
        }
    }
</script>