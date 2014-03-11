<?php
//echo "<pre>";
//print_r($users[0]['fullname']);
//echo "</pre>";
$name       = $users[0]['fullname'];
$email      = $users[0]['email'];
$password   = $users[0]['password'];
$gender     = $users[0]['gender'];
$image      = $users[0]['image'];
$hobby      = $users[0]['hobby'];
?>
<div>
    <p><label>Name</label><input type="text" value="<?php echo $name ?>" readonly="true" /></p>
    <p><label>Email</label><input type="text" value="<?php echo $email ?>" readonly="true" /></p>
    <p><label>Gender</label><input type="text" value="<?php echo $gender ?>" readonly="true" /></p>
    <p><label>Hoppy</label><input type="text" value="<?php echo $gender ?>" readonly="true" /></p>
</div>
