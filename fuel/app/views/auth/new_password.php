<?php
if (isset($errors)) {
    echo '<pre>';
    print_r($errors);
    echo '</pre>';
}
?>
<?php if($success): ?>
Change password success
<?php else: ?>
<?php echo Form::open(array()); ?>
<p> 
    <label for="password">New Password:</label>
<div class="input"><?php echo Form::password('password'); ?></div>
</p>
<p> 
    <label for="password">Confirm New Password:</label>
    <div class="input">
        <?php echo Form::password('password2'); ?>
    </div>
</p>
<div class="actions">
    <?php echo Form::submit(array('value' => 'Send', 'name' => 'submit')); ?>
</div>
</p>
<?php echo Form::close(); ?>
<?php endif; ?>