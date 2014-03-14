<fieldset class="pageForm">
  	 <legend>Login:</legend>
     <a href="#" class="facebookLogin">Facebook Login</a>
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
        	<a href="" class="forget">forget Password?</a>
        </li>
     </ul>
    <?php echo \Fuel\Core\Form::close(); ?>
  </fieldset>
