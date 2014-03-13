<?php

class Controller_User extends Controller_Myapp {

    public function action_mypage() {
        $view = Fuel\Core\View::forge('user/mypage');
        $data = Model_User::find_one_by('id', $this->current_user->id);
        $view->set('users',$data);
        $this->template->title = 'User &raquo; show info';
        $this->template->content = $view;
    }

    public function action_user_info_edit() {
        $view = Fuel\Core\View::forge('user/user_info_edit');
        
        $data = Model_User::find_one_by('id', $this->current_user->id);
        $view->set('users',$data);
        if($post = Fuel\Core\Input::post()){
            unset($post['submit']);
            $data->set($post);
            $data->save();
        }
        
        $this->template->title = 'User &raquo; Edit info';
        $this->template->content = $view;
    }

}
