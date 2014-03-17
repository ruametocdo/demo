<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <?php echo Asset::css('import.css'); ?>
    </head>

    <body>
        <div id="headerWrap" class="clearfix">
            <h1>My Page</h1>
            <p class="goBackApp">
                <a href="/">Go Back App</a>
            </p>
            <!-- ./headerWrap--> 
        </div>
        <div id="container" class="clearfix"> 
            <?php echo $content; ?>
        </div>
        <div id="footerWrap"></div>
        <div class="loginFormWrap"></div>
        <div class="logoutForm">
            <h3>confirm Password</h3>
            <?php echo \Fuel\Core\Form::open(array('action'=>'user/email_edit')); ?>
            <div class="boxLogoutForm">    
                <input type="text" name="password" value="" class="passPopup" />
                <input type="hidden" name="option" value="confirm_pass" />
                <input type="submit" name="" value="send" class="sendPopup"/>
            </div>
            <?php echo Form::close(); ?>
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
        <script type="text/javascript">
            $(document).ready(function() {
                $('.loginFormWrap').hide();
                $('.logoutForm').hide();
                $('.edit-email-action').click(function() {
                    var form = $('.loginFormWrap');
                    var logForm = $('.logoutForm');
                    form.show();
                    logForm.show();
                });
                $('.loginFormWrap').click(function() {
                    $('.loginFormWrap').hide();
                    $('.logoutForm').hide();
                });
                

            });

            var mHeight = window.outerHeight;
            $(document).ready(function() {
                $('.loginFormWrap').css('height', mHeight);
            });

        </script>
    </body>
</html>
