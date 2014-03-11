<?php
class Controller_Auth extends \Fuel\Core\Controller{
    public function action_login(){
       // echo __FILE__;
      if( Auth::check()){
          echo 'success';
          
      }  else {
          echo 'fail';
      }
         return Response::forge(View::forge('auth/login'));
    }
}

