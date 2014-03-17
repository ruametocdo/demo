<?php
$name = isset($user->username) ? $user->username : '';
$image = isset($user->image) ? $user->image : '';
?>
<?php if (isset($errors)): ?>
    <div class="error"><?php echo $errors[0] ?></div>
<?php endif; ?>
<?php if ($success): ?>
    <div class="text01">
        <p class="title">Edit password is complete!</p>
    </div>
<?php else: ?>
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
                <li><?php echo \Fuel\Core\Html::anchor('#', 'Email edit',array('class' => 'edit-email-action')) ?></li>
                <li><?php echo \Fuel\Core\Html::anchor('user/password_edit/', 'Password edit',array('class'=>'active')) ?></li>
                 <li><?php echo \Fuel\Core\Html::anchor('auth/logout/', 'Sign Out') ?></li>
            </ul>
        </div>
        <div class="floatR">
            <?php echo Form::open(); ?>
            <ul class="userView old-password-field">
                <li class="clearfix old-password">
                    <span>old Password : </span><input type="password" name="password" value="" placeholder="old password" class="userText" />
                </li> 
                <li class="clearfix">
                    <span>New Password : </span><input type="password" name="new_pass" value="" placeholder="new password" class="userText" />
                </li>                
                <li class="clearfix">
                    <span>Confirm new Password : </span><input type="password" name="new_pass2" value="" placeholder="confirm new password" class="userText" />
                </li> 
                <li class="clearfix">
                    <span>&nbsp;</span><input type="submit" name="" value="save" class="userActions"/>
                </li>
            </ul>
            <?php echo Form::close(); ?>
        </div>
    </div>
<?php endif; ?>