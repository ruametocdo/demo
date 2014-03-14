<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <?php echo Asset::css('import.css'); ?>
    </head>

    <body>
        <?php if(isset($title2)): ?>
        <div id="headerWrap" class="clearfix">
            <h1><?php echo $title2; ?></h1>
        </div>
        <?php endif; ?>
        <div id="container">
            <?php echo $content; ?>

            <!-- ./headerWrap--> 
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
        <script type="text/javascript">
            /*$( document ).ready(function() {
             $('.loginFormWrap').hide();
             $('.logoutForm').hide();
             $('.logout').click(function(){
             var form = $('.loginFormWrap');		
             var logForm = $('.logoutForm');
             form.show();
             logForm.show();
             });
             $('.loginFormWrap').click(function(){
             $('.loginFormWrap').hide();
             $('.logoutForm').hide(); 
             });
             });
             
             var mHeight = window.outerHeight;
             $( document ).ready(function() {
             $('.loginFormWrap').css('height', mHeight  );	
             }); */

        </script>
    </body>
</html>
