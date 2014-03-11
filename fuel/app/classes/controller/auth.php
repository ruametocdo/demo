<?php
class Controller_Auth extends \Fuel\Core\Controller{
    public function action_login(){
       // echo __FILE__;
      if(\Fuel\Core\Input::method()=='POST'){
          if(Auth\Auth::login(\Fuel\Core\Input::post('email'),  \Fuel\Core\Input::post('password'))){
              Fuel\Core\Response::redirect('/');
          }
      }
         return Response::forge(View::forge('auth/login'));
    }
     
}

