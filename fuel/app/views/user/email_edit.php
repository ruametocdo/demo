<?php
$name = isset($user->username) ? $user->username : '';
$email = isset($user->email) ? $user->email : '';
$gender = isset($user->gender) ? $user->gender : '';

$hobby = isset($user->hobby) ? $user->hobby : '';
$hobby = explode(',', $hobby);

$image = isset($user->image) ? $user->image : '';
$cronmail = isset($user->cronmail) ? $user->cronmail : 1;
$notshow = isset($user->notshow) ? $user->notshow : 0;
?>
<?php if (isset($errors)): ?>
    <div class="error"><?php echo $errors[0] ?></div>
<?php endif; ?>

<div class="userInfo clearfix">
    <div class="floatL">
        <ul class="userFace">
            <li><?php if ($image != ''): ?>
                    <img src="/files/<?php echo $image; ?>" width="200" height="200" alt="face" />
                <?php else: ?>
                    <img src="/assets/img/ico_face.png" width="200" height="200" alt="face" />
                <?php endif; ?>
            </li>
            <li><?php echo $name ?></li>
        </ul>
        <div class="clearBoth"></div>
        <ul class="userListEdit">
            <li><?php echo \Fuel\Core\Html::anchor('user/mypage/', 'Info') ?></li>
            <li><?php echo \Fuel\Core\Html::anchor('user/user_info_edit/', 'User edit info') ?></li>
            <li><?php echo \Fuel\Core\Html::anchor('#', 'Email edit', array('class' => 'active edit-email-action')) ?></li>
            <li><?php echo \Fuel\Core\Html::anchor('user/password_edit/', 'Password edit') ?></li>
             <li><?php echo \Fuel\Core\Html::anchor('auth/logout/', 'Sign Out') ?></li>
        </ul>
    </div>
    <?php if($pass_success):  ?>
    <div class="floatR">
        <?php echo \Fuel\Core\Form::open(); ?>
        <ul class="userView edit-email">
            <li class="clearfix">
                <span>New Email : </span><input type="text" name="email" value="" placeholder="new email" class="userText" />
            </li>                
            <li class="clearfix">
                <span>Confirm new Email : </span><input type="text" name="confirm_email" value="" placeholder="confirm new email" class="userText" />
            </li> 
            <li class="clearfix">
                <span>&nbsp;</span><input type="submit" name="" value="Send" class="userActions"/>
            </li>
            <input type="hidden" name="option" value="edit_email" />
        </ul>
        <?php echo Form::close(); ?>
    </div>
    <?php endif; ?>
</div>
