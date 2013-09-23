<h1><a href="index-2.html"><?php //echo asset::image()->load('icon.png', '', array('class' => 'retina-ready', 'width' => '59', 'height' => '49')); ?>Meshplace</a></h1>
<div class="login-body">
    <h2>SIGN IN</h2>
    <form action="<?php echo $action_login; ?>" method='get' class='form-validate' id="test">
        <div class="control-group">
            <div class="email controls">
                <input type="text" name='uemail' placeholder="Username" class='input-block-level' data-rule-required="true" data-rule-email="true">
            </div>
        </div>
        <div class="control-group">
            <div class="pw controls">
                <input type="password" name="upw" placeholder="Password" class='input-block-level' data-rule-required="true">
            </div>
        </div>
        <div class="submit">
            <div class="remember">
                <input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember"> <label for="remember">Remember me</label>
            </div>
            <input type="submit" value="Sign me in" class='btn btn-primary'>
        </div>
    </form>
    <div class="forget">
        <a href="#"><span>Forgot password?</span></a>
    </div>
</div>