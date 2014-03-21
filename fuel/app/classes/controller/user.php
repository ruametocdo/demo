<?php

class Controller_User extends Controller_Myapp
{

    public $template = 'usertemplate';

    public function before()
    {
        parent::before();
        if (!$this->current_user)
            return \Fuel\Core\Response::redirect('auth/login');
    }

    public function action_mypage()
    {
        $view = Fuel\Core\View::forge('user/mypage');
        $data = Model_User::find_one_by('id', $this->current_user->id);
        $view->set('user', $data);
         //hoppy
        $hobbies = Model_UserHobby::get_items_for_user($this->current_user->id);       
        if($hobbies){
             $view->set('hobbies', $hobbies);
        }
        $this->template->title = 'User &raquo; show info';
        $this->template->content = $view;
    }

    public function action_user_info_edit()
    {
        $view = Fuel\Core\View::forge('user/user_info_edit');

        $data = Model_User::find_one_by('id', $this->current_user->id);
        $view->set('user', $data);
       
        if ($post = Fuel\Core\Input::post()) {

            $val = Fuel\Core\Validation::forge();
            $val->add_callable(new MyRules());
            $val->add_field('username', 'Username', 'required');
            $val->add_field('gender', 'Gender', 'required');
            $val->add_field('cronmail', 'Cronmail', 'required');
            $val->add_field('hobby', 'Hobby', 'required');
            if ($val->run()) {
                $config = array(
                    'path' => DOCROOT . 'files',
                    'randomize' => true,
                    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
                    'max_size' => 1024000,
                    'auto_rename' => false,
                    'overwrite' => true
                );
                // process the uploaded files in $_FILES
                $tmp = Upload::process($config);
                // if there are any valid files
                if (Upload::is_valid()) {
                    // save them according to the config
                    Upload::save();
                    $icon_data = Upload::get_files();
                }
                if (isset($icon_data)) {
                    $post['image'] = $this->current_user->id . '-' . time() . '.' . $icon_data[0]['extension'];
                    rename(DOCROOT . 'files/' . $icon_data[0]['saved_as'], DOCROOT . 'files/' . $post['image']);
                }
                if (isset($post['hobby'])) {
                    //update table user_hobby
                    Model_UserHobby::delete_by_field('user_id', $this->current_user->id);
                    foreach ($post['hobby'] as $value) {
                        $user_hobby = Model_UserHobby::save_item($this->current_user->id, $value);
                    }
                }
                unset($post['hobby']);
                $data->set($post);
                try {
                    $data->save();
                } catch (Exception $ex) {
                    $errors[] = array('Not Update User');
                }
            } else {
                foreach ($val->error_message() as $field => $message) {
                    $errors[] = $message;
                }

                $view->set('errors', $errors);
            }
        }
         //hoppy
        $hoppies = Model_Hobby::find_all();
        if($hoppies){
             $view->set('hoppies', $hoppies);
        }

        $this->template->title = 'User &raquo; Edit info';
        $this->template->content = $view;
    }

    public function action_password_edit()
    {
        $view = Fuel\Core\View::forge('user/password_edit');
        $success = false;
        $data = Model_User::find_one_by('id', $this->current_user->id);
        $view->set('user', $data);
        if ($post = \Fuel\Core\Input::post()) {
            $val = Fuel\Core\Validation::forge();
            $val->add_field('password', 'Old password', 'required');
            $val->add('new_pass', 'New password')->add_rule('match_value', $post['new_pass2'], true);
            if ($val->run()) {
                $auth = Auth\Auth::instance();
                $oldpass = $auth->hash_password($post['password']);
                if ($data->password == $oldpass) {
                    $data->password = $auth->hash_password($post['new_pass']);
                    $data->save();
                    $success = true;
                } else {
                    $view->set('errors', array('old password not valid'));
                }
            } else {
                foreach ($val->error_message() as $field => $message) {
                    $errors[] = $message;
                }

                $view->set('errors', $errors);
            }
        }
        $view->set('success', $success);
        $this->template->title = 'User &raquo; Edit password';
        $this->template->content = $view;
    }

    public function action_email_edit()
    {
        $view = Fuel\Core\View::forge('user/email_edit');
        $pass_success = false;
        $edit_email_success = false;
        $data = Model_User::find_one_by('id', $this->current_user->id);
        $view->set('user', $data);
        if ($post = \Fuel\Core\Input::post()) {
            //confirm password
            if ($post['option'] == 'confirm_pass') {
                $val = Fuel\Core\Validation::forge();
                $val->add_field('password', 'password', 'required');

                if ($val->run()) {
                    $auth = Auth\Auth::instance();
                    $oldpass = $auth->hash_password($post['password']);
                    if ($data->password == $oldpass) {
                        $pass_success = true;
                    } else {
                        $view->set('errors', array('old password not valid'));
                    }
                } else {
                    foreach ($val->error_message() as $field => $message) {
                        $errors[] = $message;
                    }

                    $view->set('errors', $errors);
                }
            }
            //edit email
            if ($post['option'] == 'edit_email') {
                $val = Fuel\Core\Validation::forge();
                $val->add_callable(new MyRules());
                $val->add('email', 'Email')->add_rule('match_value', $post['confirm_email'], true)->add_rule('unique', 'users.email');
                if ($val->run()) {
                    $data->email = $post['email'];
                    $data->active = 0;
                    $code = $this->generate_code($post['email']);
                    $data->code = $code;
                    $data->save();
                    $this->send_mail('datht83@gmail', $post['email'], 'Hi user ', 'Please click this link to active your account ' . 'http://' . $_SERVER['HTTP_HOST'] . '/auth/activation_complete/' . $code, 'dat huynh', 'User');
                    $edit_email_success = true;
                } else {
                    foreach ($val->error_message() as $field => $message) {
                        $errors[] = $message;
                    }

                    $view->set('errors', $errors);
                }
            }
        }
        $view->set('pass_success', $pass_success);
        $view->set('edit_email_success', $edit_email_success);
        $this->template->title = 'User &raquo; Edit email';
        $this->template->content = $view;
    }

}
