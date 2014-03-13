<?php

class Controller_Auth extends Controller_Myapp {

    private function generate_code($email = null) {
        $random_number = rand(1000000, 9999999);
        return md5($random_number . $email);
    }

    private function send_mail($from, $to, $subject = null, $body = null, $namefrom = null, $nameto = null) {
        $email = \Email\Email::forge(array('driver' => 'smtp'));
        $email->from($from, $namefrom);
        $email->to($to,$nameto);
        $email->subject($subject);
        $email->body($body);
        $email->send();
    }

    public function action_login() {
        $view = Fuel\Core\View::forge('auth/login');
        $auth = Auth\Auth::instance();
        if (Auth\Auth::check()) {
            \Fuel\Core\Response::redirect('/');
        }
        if (\Fuel\Core\Input::post()) {
            if (Auth\Auth::login(\Fuel\Core\Input::post('email'), \Fuel\Core\Input::post('password'))) {
                if (Fuel\Core\Input::param('remember')) {
                    Auth\Auth::remember_me();
                } else {
                    Auth\Auth::dont_remember_me();
                }
                Fuel\Core\Response::redirect('/');
            }
        }
        $this->template->title = 'User &raquo; Login';
        $this->template->content = $view;
    }

    public function action_logout() {
        Auth\Auth::dont_remember_me();
        Auth\Auth::logout();
        Fuel\Core\Response::redirect('auth/login');
    }

    public function action_signup() {
        $auth = Auth\Auth::instance();
        $post = Fuel\Core\Input::post();
        $view = Fuel\Core\View::forge('auth/signup');
        if (count($post)) {
            $val = Fuel\Core\Validation::forge();
            $val->add_callable(new MyRules());
            $val->add('username', 'Your username')->add_rule('required');
            $val->add('email', 'Email')->add_rule('valid_email')->add_rule('unique', 'users.email');
            ;
            $val->add('password', 'Password')->add_rule('match_value', $post['password2'], true);

            if ($val->run()) {
                //generate code
                $code = $this->generate_code($post['email']);
//                $profile_fields = array(
//                    'gender' => $post['gender'],
//                        //'code' => $code
//                );
                $data = $auth->create_user($post['username'], $post['password'], $post['email'], $group = 1);
                //update code for user 
                $user = Model_User::find_one_by_email($post['email']);
                $user->code = $code;
                $user->gender = $post['gender'];
                $user->save();

                if ($data) {
                    //send mail
                    $this->send_mail('datht83@gmail', $post['email'], 'Hi ' . $post['username'], 'Please click this link to active your account ' . 'http://' . $_SERVER['HTTP_HOST'] . '/auth/activation_complete/' . $code, 'dat huynh', $post['username']);
                    \Fuel\Core\Response::redirect('auth/thank_you_sign_up');
                }
            } else {
                foreach ($val->error_message() as $field => $message) {
                    $errors[] = $message;
                }

                $view->set('errors', $errors);
            }
        }
        $this->template->title = 'User &raquo; Register';
        $this->template->content = $view;
    }

    public function action_activation_complete() {
        $view = Fuel\Core\View::forge('auth/activation_complete');
        $data = $this->request->method_params;
        $code = $data[1][0];
        $user = Model_User::find_one_by_code($code);
        if ($user) {
            $user->code = null;
            $user->active = 1;
            $user->save();
        }
        $this->template->title = 'User &raquo; Activation';
        $this->template->content = $view;
    }

    public function action_thank_you_sign_up() {
        $view = Fuel\Core\View::forge('auth/thank_you_sign_up');
        $this->template->title = 'User &raquo; Thank you';
        $this->template->content = $view;
    }

    public function action_forget_password() {
        $view = Fuel\Core\View::forge('auth/forget_password');
        $post = Fuel\Core\Input::post();
        $errors = array();
        $success = false;
        if (count($post) && $post['email']) {
            $code = $this->generate_code($post['email']);
            $val = Fuel\Core\Validation::forge();
            $val->add('email', 'Email')->add_rule('valid_email');
            if ($val->run()) {
                //update code for user 
                $user = Model_User::find_one_by_email($post['email']);
                if ($user) {
                    $user->code = $code;
                    $user->save();
                    //sendmail
                    $this->send_mail('datht83@gmail', $post['email'], 'Hi ' . $user['username'], 'Please click this link to set new password ' . 'http://' . $_SERVER['HTTP_HOST'] . '/auth/new_password/' . $code, 'dat huynh', $user['username']);
                    $success = true;
                } else {
                    $errors[] = 'email not exist';
                }
            } else {
                foreach ($val->error_message() as $field => $message) {
                    $errors[] = $message;
                }

                $view->set('errors', $errors);
            }
            $view->set('errors', $errors);
        }
        $view->set('success', $success);
        $this->template->title = 'User &raquo; Forget password';
        $this->template->content = $view;
    }

    public function action_new_password() {
        $view = Fuel\Core\View::forge('auth/new_password');
        $data = $this->request->method_params;
        $success = false;
        $code = $data[1][0];
        $user = Model_User::find_one_by_code($code);
        if ($user) {
            $user->code = null;
            //$user->save();
            if ($post = Fuel\Core\Input::post()) {
                $val = Fuel\Core\Validation::forge();
                $val->add('password', 'Password')->add_rule('match_value', $post['password2'], true);
                if ($val->run()) {
                    $auth = Auth\Auth::instance();
                    $newpass = $auth->hash_password($post['password']);
                    $user->password = $newpass;
                    $user->save();
                    $success = true;
                } else {
                    foreach ($val->error_message() as $field => $message) {
                        $errors[] = $message;
                    }

                    $view->set('errors', $errors);
                }
            }
        }
        $view->set('success', $success);
        $this->template->title = 'User &raquo; New password';
        $this->template->content = $view;
    }

}
