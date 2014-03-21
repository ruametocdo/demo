<?php
$name = isset($user->username) ? $user->username : '';
$email = isset($user->email) ? $user->email : '';
$gender = isset($user->gender) ? $user->gender : '';
$hobby = '';
if(isset($hobbies)){
    
    foreach ($hobbies as $value){
        $hobby .= $value['title'] . ' ,';
    }
    $hobby = substr($hobby, 0,-1);
}
$image = isset($user->image) ? $user->image : '';
$cronmail = isset($user->cronmail) ? $user->cronmail : 1;
$notshow = isset($user->notshow) ? $user->notshow : 0;
?>
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
            <li><?php echo \Fuel\Core\Html::anchor('user/mypage/', 'Info', array('class' => 'active')) ?></li>
            <li><?php echo \Fuel\Core\Html::anchor('user/user_info_edit/', 'User edit info') ?></li>
            <li><?php echo \Fuel\Core\Html::anchor('#', 'Email edit',array('class' => 'edit-email-action')) ?></li>
            <li><?php echo \Fuel\Core\Html::anchor('user/password_edit/', 'Password edit') ?></li>
             <li><?php echo \Fuel\Core\Html::anchor('auth/logout/', 'Sign Out') ?></li>
        </ul>
    </div>
    <div class="floatR">
        <ul class="userView">
            <li class="clearfix">
                <span>Name : </span><?php echo $user->username; ?>
            </li>
            <li class="clearfix">
                <span>Email : </span><?php echo $user->email; ?>
            </li>
            <li class="clearfix">
                <span>Gender : </span><?php echo $user->gender; ?>
            </li>
            <li class="clearfix">
                <span>Hobby : </span><?php  echo $hobby; ?>
            </li>
            <li class="clearfix">
                <span>Icon : </span><?php if ($image != ''): ?>
                    <img src="/files/<?php echo $image; ?>" width="50" height="50" alt="" />
                <?php else: ?>
                    <img src="/assets/img/ico_face.png" width="50" height="50" alt="" />
                <?php endif; ?>
            </li>
        </ul>
    </div>
</div>
