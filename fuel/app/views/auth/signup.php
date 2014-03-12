<?php if (isset($errors)){ 
     echo '<pre>';
     print_r($errors);
     echo '</pre>';
    } ?>
<?php echo Form::open(array()); ?>
<p> 
    <label for="username">Username:</label>
<div class="input"><?php echo Form::input('username', Input::post('username')); ?></div>
</p>
<p> 
    <label for="email">Email:</label>
<div class="input"><?php echo Form::input('email', Input::post('email')); ?></div>
</p>

<p> 
    <label for="password">Password:</label>
<div class="input"><?php echo Form::password('password'); ?></div>
</p>

<p> 
    <label for="password">Confirm Password:</label>
<div class="input"><?php echo Form::password('password2');
; ?></div>
</p>

<p>
    <?php
    echo Form::label('Male', 'gender');
    echo Form::radio('gender', 'Male', true);
    echo Form::label('Female', 'gender');
    echo Form::radio('gender', 'Female');
    echo Form::label('None', 'gender');
    echo Form::radio('gender', 'None');
    ?>
</p>
<p>
<div class="actions">
<?php echo Form::submit(array('value' => 'Signup', 'name' => 'submit')); ?>
</div>
</p>
<?php echo Form::close(); ?>