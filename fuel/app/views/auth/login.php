<?php echo \Fuel\Core\Form::open(); ?>
    <div>
        <p> <label>Email:</label> <input name="email" type="text" id="email" /></p>
        <p> <label>Password:</label> <input name="password" type="password" id="password" /></p>
        <p><input type="checkbox" name="notshow" value="" />remember me</p>
        <p><input type="submit" value="login" /></p>
    </div>
    
</form><?php echo \Fuel\Core\Form::close(); ?>
