<?php
$name = isset($user->username) ? $user->username : '';
$email = isset($user->email) ? $user->email : '';
$gender = isset($user->gender) ? $user->gender : '';

//$hobby = isset($user->hobby) ? $user->hobby : '';
//$hobby = explode(',', $hobby);

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
            <li><?php echo \Fuel\Core\Html::anchor('user/user_info_edit/', 'User edit info', array('class' => 'active')) ?></li>
            <li><?php echo \Fuel\Core\Html::anchor('#', 'Email edit', array('class' => 'edit-email-action')) ?></li>
            <li><?php echo \Fuel\Core\Html::anchor('user/password_edit/', 'Password edit') ?></li>
            <li><?php echo \Fuel\Core\Html::anchor('auth/logout/', 'Sign Out') ?></li>
        </ul>
    </div>
    <div class="floatR">
        <?php echo Form::open(array('enctype' => 'multipart/form-data')); ?>
        <ul class="userView">
            <li class="clearfix">
                <span>Name : </span><input type="text" name="username" value="<?php echo $name ?>" class="userText" />
            </li>
            <li class="clearfix">
                <span>Gender : </span>
                <select name="gender" class="userSelect">
                    <option value="none" <?php if ($gender == 'none'): ?> selected="selected" <?php endif; ?> >none</option>
                    <option value="male" <?php if ($gender == 'male'): ?> selected="selected" <?php endif; ?>>male</option>
                    <option value="female" <?php if ($gender == 'female'): ?> selected="selected" <?php endif; ?>>female</option>
                </select>
            </li>
            <li class="clearfix">
                <span>Icon : </span>
                <?php if ($image != ''): ?>
                    <img src="/files/<?php echo $image; ?>" width="50" height="50" alt="" />
                <?php else: ?>
                    <img src="/assets/img/ico_face.png" width="50" height="50" alt="" />
                <?php endif; ?>
                <?php echo Fuel\Core\Form::file('image', array('class' => 'userIcon')) ?>
                <p class="userCb"><input type="checkbox" name="notshow" value="<?php echo $notshow; ?>" <?php if ($notshow): ?>checked="checked" <?php endif; ?>  /><span>Not Show</span></p>
            </li>
            <li class="clearfix">
                <span>Cronmail : </span>
                <input type="radio" name="cronmail" class="userRadio" value="1" <?php if ($cronmail == 1): ?> checked="checked" <?php endif; ?> /> receive     
                <input type="radio" name="cronmail" class="userRadio" value="0" <?php if ($cronmail == 0): ?> checked="checked" <?php endif; ?> /> Not receive
            </li>           
            <li class="clearfix">
                <span>Hobby : </span>
                <?php if(isset($hoppies)): ?>
                <?php foreach ($hoppies as $hobby): ?>
                <input type="checkbox" name="hobby[]" class="userRadio" value="<?php echo $hobby->id; ?>" <?php if(Model_UserHobby::check_hobby_for_user($current_user->id, $hobby->id)) echo 'checked="checked"'; ?>  /> <?php echo $hobby->title; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </li>
            <li class="clearfix">
                <span>&nbsp;</span><input type="submit" name="" value="save" class="userActions"/>
            </li>
        </ul>
        <?php echo Form::close(); ?>
    </div>
</div>