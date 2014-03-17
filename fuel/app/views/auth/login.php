<?php if (isset($errors)): ?>
<div class="error"><?php echo $errors[0] ?></div>
<?php endif; ?>
<fieldset class="pageForm">
  	 <legend>Login:</legend>
     
     <?php echo Fuel\Core\Html::anchor('auth/login?login_facebook=1', 'Facebook Login', array('class'=>'facebookLogin')) ?>
    <?php echo \Fuel\Core\Form::open(); ?>
     <ul>
     	<li class="clearfix">
        	<span>Email</span>
                <input type="text" name="email" value="" placeholder="your email"/>
        </li>
        <li class="clearfix">
        	<span>Password</span>
            <input type="password" name="password" value=""  placeholder="password" />
        </li>
        <li>
        	<input type="checkbox" name="remember" value="remember" class="cb" /> remember me?
        </li>
        <li>
        	<input type="submit" name="key" value="login" class="pageAction"/>
        </li>
        <li>
                <?php echo \Fuel\Core\Html::anchor('auth/forget_password/', 'forget Password?'); ?>
        </li>
     </ul>
    <?php echo \Fuel\Core\Form::close(); ?>
  </fieldset>
