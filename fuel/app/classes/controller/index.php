<?php

class Controller_Index extends Controller_Myapp {

    public function action_index() {
        $data['items'] = $result = DB::select('users.id','username','email','gender','image','comments.id','content','comments.created')->from('users')->join('comments', 'LEFT')->on('users.id', '=', 'comments.user_id')->execute()->as_array();
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";die;
        return Response::forge(View::forge('index/index',$data));
    }

}
