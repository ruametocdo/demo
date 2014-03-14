<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <?php echo Asset::css('import.css'); ?>
    </head>

    <body>
        <div id="headerWrap" class="clearfix">
            <h1>Fuel Auth App</h1>
            <ul class="userInfo clearfix">
                <li class="userName"> <img src="img/ico_face.png" width="40" height="40" alt="" />
                    <h2>
                        <?php if($current_user){
                                    echo $current_user->username;
                             }               
                        ?>
                    </h2>
                </li>
                <li class="anchorLink"> <a href="#"><span>My Page</span></a> </li>
                <li class="anchorLink"> <a href="#" class="logout"><span>Logout</span></a> </li>
            </ul>
            <!-- ./headerWrap--> 
        </div>
        <div id="container">
            <?php echo $content; ?>
            <!-- ./headerWrap--> 
        </div>
        <div id="footerWrap"></div>
        <div class="loginFormWrap"></div>
        <div class="logoutForm">
            <h3>Logout ?</h3>
            <div class="boxLogoutForm">    
                <input type="button" name="key" value="Yes" class="logoutInput"/>
                <input type="button" name="key" value="No" class="no"/>   
            </div>
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
        <script type="text/javascript">
            $(document).ready(function() {
                $('.loginFormWrap').hide();
                $('.logoutForm').hide();
                $('.logout').click(function() {
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
