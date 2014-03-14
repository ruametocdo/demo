<?php if (count($errors)): ?>
<div class="error"><?php echo $errors[0] ?></div>
<?php endif; ?>
<?php if($success): ?>
<div class="text01">
     <p class="title">Creating new password is complte! </p>
</div>
<?php else: ?>
<fieldset class="pageForm">
   <?php echo Form::open(array()); ?>
      <ul class="noBorder">
        <li class="clearfix"> <span>new password</span>
            <input type="password" name="password" value="" placeholder="new password"/>
        </li>
        <li class="clearfix"> <span>confirm new password</span>
            <input type="password" name="password2" value="" placeholder="confirm new password" />
        </li>
        <li>
          <input type="submit" name="" value="Send" class="pageAction"/>
        </li>
      </ul>
 <?php echo Form::close(); ?>
  </fieldset>
<?php endif; ?>