<?php
class Controller_User extends Controller{
    public function action_mypage(){
      $data['users'] = DB::query('SELECT * FROM `users`')->execute()->as_array(); 
         return Response::forge(View::forge('user/mypage',$data));
    }
}