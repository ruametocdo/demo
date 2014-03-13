
<?php
$name = isset($users->username) ? $users->username : '';
$email = isset($users->email) ? $users->email : '';
$gender = isset($users->gender) ? $users->gender : '';
$hobby = isset($users->hobby) ? $users->hobby : '';
$image = isset($users->image) ? $users->image : '';
?>
<?php echo Form::open(array()); ?>
<p> 
    <label for="username">name:</label>
<div class="input"><?php echo Form::input('username', $name); ?></div>
</p>

<p> 
    <label for="username">Gender:</label>
<div class="input"><?php
    echo Form::select('gender', $gender, array(
        'Female' => 'female',
        'Male' => 'male',
        'None' => 'none'
    ));
    ?></div>
</p>


<p>
<div class="actions">
<?php echo Form::submit(array('value' => 'Signup', 'name' => 'submit')); ?>
</div>
</p>
<?php echo Form::close(); ?>