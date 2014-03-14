<?php if (count($errors)): ?>
<div class="error"><?php echo $errors[0] ?></div>
<?php endif; ?>
<?php if($success): ?>
<div class="text01">
    <p>We sent a email to you </p>
    <p>Click the link in the email to change password</p>
</div>
<?php else: ?>
<fieldset class="pageForm">	
    <?php echo \Fuel\Core\Form::open(); ?>
     <ul class="noBorder">
     	<li class="clearfix">
        	<span>Email</span>
                <input type="text" name="email" value="" placeholder="your email"/>
        </li>
       
        <li>
        	<input type="submit" name="" value="Send email" class="pageAction"/>
        </li>
       
     </ul>
    </form><?php echo \Fuel\Core\Form::close(); ?>
  </fieldset>
<?php endif; ?>

