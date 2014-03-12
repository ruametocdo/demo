<?php echo \Fuel\Core\Form::open(); ?>
<p> 
    <label for="email">Email:</label>
<div class="input"><?php echo Form::input('email', Input::post('email')); ?></div>
</p>   
<p> 
    <label for="password">Password:</label>
<div class="input"><?php echo Form::password('password'); ?></div>
<p><label for="password">Remember me: </label><?php echo \Fuel\Core\Form::checkbox('remember') ?></p>
</p>   
<p>
<div class="actions">
<?php echo Form::submit(array('value' => 'Login', 'name' => 'submit')); ?>
</div>
</p>
</form><?php echo \Fuel\Core\Form::close(); ?>
