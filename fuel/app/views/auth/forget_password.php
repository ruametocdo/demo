<?php
if (isset($errors)) {
    echo '<pre>';
    print_r($errors);
    echo '</pre>';
}
?>
<?php if($success): ?>
We sent a email to you 
Click the link in the email to change password
<?php else: ?>
<?php echo \Fuel\Core\Form::open(); ?>
<p> 
    <label for="email">Email:</label>
<div class="input"><?php echo Form::input('email', Input::post('email')); ?></div>
</p>   
<p>
<div class="actions">
<?php echo Form::submit(array('value' => 'Send Email', 'name' => 'submit')); ?>
</div>
</p>
</form><?php echo \Fuel\Core\Form::close(); ?>
<?php endif; ?>

