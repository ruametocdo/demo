<?php

class Controller_Auth extends Controller_Myapp {

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
                $random_number = rand(1000000, 9999999);
                $code = md5($random_number);
                $profile_fields = array(
                    'gender' => $post['gender'],
                    'code' => $code
                );
                $data = $auth->create_user($post['username'], $post['password'], $post['email'], $group = 1, $profile_fields);
                if ($data) {

                    $email = \Email\Email::forge(array('driver' => 'smtp'));
                    $email->from('datht83@gmail.com', 'dat huynh');
                    $email->to($post['email'],$post['username']);
                    $email->subject('Hi ' . $post['username']);
                    $email->body('Please click this link to active your account ' . 'http://' . $_SERVER['HTTP_HOST'] . '/auth/activation_complete/' . $code);
                    $email->send();
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
    public function action_activation_complete(){
        $view = Fuel\Core\View::forge('auth/activation_complete');
        $data = Fuel\Core\Input::get();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        
        $this->template->title = 'User &raquo; Activation';
        $this->template->content = $view;
    }

    public function action_thank_you_sign_up() {
        $view = Fuel\Core\View::forge('auth/thank_you_sign_up');
        $this->template->title = 'User &raquo; Thank you';
        $this->template->content = $view;
    }

}
