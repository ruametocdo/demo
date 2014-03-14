<fieldset class="pageForm">
    <legend>Sinup:</legend>
    <a href="#" class="facebookLogin">Facebook Login</a>
<?php echo Form::open(array()); ?>
    <ul>
        <li class="clearfix">
            <span>UserName</span>
            <input type="text" name="username" value="" placeholder="username"/>
        </li>
        <li class="clearfix">
            <span>Email</span>
            <input type="text" name="email" value="" placeholder="email"/>
        </li>
        <li class="clearfix">
            <span>Password</span>
            <input type="password" name="password" value="" placeholder="password"/>
        </li>
        <li class="clearfix">
            <span>Confirm Password</span>
            <input type="password" name="password2" value="" placeholder="confirm password"/>
        </li>
        <li>
            <span>gender</span>
            <input type="radio"  name="gender" value="male" class="radio"/> male  
            <input type="radio"  name="gender" value="female" class="radio"/> female  
            <input type="radio"  name="gender" value="none" class="radio"/> none
        </li>       
        <li class="p20b0">
            <input type="submit" name="" value="login" class="pageAction"/>
        </li>        
    </ul>
<?php echo Form::close(); ?>
</fieldset>