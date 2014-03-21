<?php

require 'src/facebook.php';

class Controller_Auth extends Controller_Myapp
{

    public $template = 'authtemplate';
    private function login_facebook()
    {
        $view = Fuel\Core\View::forge('auth/login_facebook');
        $facebook = new Facebook(array(
            'appId' => '610844795667895',
            'secret' => 'd602ef4cdb74089c50883710a553ace0',
        ));

        // Get User ID
        $user = $facebook->getUser();
        if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $user_profile = $facebook->api('/me');
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }

        // Login or logout url will be needed depending on current user state.
        if ($user) {
            $logoutUrl = $facebook->getLogoutUrl();
        } else {
            $statusUrl = $facebook->getLoginStatusUrl();
            $loginUrl = $facebook->getLoginUrl(array(
                'scope' => 'email, read_stream, publish_stream, user_birthday, user_location, user_work_history, user_hometown, user_photos'
            ));
        }
        return array(
            'user' => isset($user) ? $user : null,
            'user_profile' => isset($user_profile) ? $user_profile : null,
            'loginUrl' => isset($loginUrl) ? $loginUrl : null,
            'logoutUrl' => isset($logoutUrl) ? $logoutUrl : null,
            'statusUrl' => isset($statusUrl) ? $statusUrl : null,
        );
    }

    public function action_login()
    {
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
            } else {
                $errors[] = 'Incorrect email or password';
                $view->set('errors', $errors);
            }
        }
        //login facebook
        if ($get = \Fuel\Core\Input::get()) {
            if ($get['login_facebook'] == 1) {
                $data_login = $this->login_facebook();  
            }
            if ($data_login['loginUrl'] != null) {
                \Fuel\Core\Response::redirect($data_login['loginUrl']);
            }
            $user = Model_User::find_one_by('email', $data_login['user_profile']['email']);
            if ($user) {
                if (\Auth\Auth::force_login($user->id)) {
                    Fuel\Core\Response::redirect('/');
                } else {
                    $errors[] = 'Incorrect email or password';
                    $view->set('errors', $errors);
                }
            } else {
                $user_profile = $data_login['user_profile'];
                Fuel\Core\Response::redirect('auth/signup?username=' . $user_profile['username'] . '&email=' . $user_profile['email']);
            }
        }

        $this->template->title = 'User &raquo; Login';
        $this->template->gobackTitle = 'Sign up';
        $this->template->gobackLink = 'auth/signup/';
        $this->template->title2 = 'Fuel Auth App';
        $this->template->content = $view;
    }

    public function action_logout()
    {
        Auth\Auth::dont_remember_me();
        Auth\Auth::logout();
        Fuel\Core\Response::redirect('auth/login');
    }

    public function action_signup()
    {
        $auth = Auth\Auth::instance();
        $post = Fuel\Core\Input::post();
        $view = Fuel\Core\View::forge('auth/signup');
        if ($get = \Fuel\Core\Input::get()) {
            $view->set('username', isset($get['username']) ? $get['username'] : null);
            $view->set('email', isset($get['email']) ? $get['email'] : null);
            //$view->set('errors', array('You have to sign up for for fisrt facebook login'));
            //sign up facebook
            if (isset($get['signup_facebook'])) {
                $data_login = $this->login_facebook();
                if ($data_login['loginUrl'] != null) {
                    \Fuel\Core\Response::redirect($data_login['loginUrl']);
                } else {
                    if ($user = Model_User::find_one_by('email', $data_login['user_profile']['email'])) {
                        $errors[] = 'Email has already been used';
                        $view->set('errors', $errors);
                    } else {
                        $view->set('username', isset($data_login['user_profile']['username']) ? $data_login['user_profile']['username'] : null);
                        $view->set('email', isset($data_login['user_profile']['email']) ? $data_login['user_profile']['email'] : null);
                    }
                }
            }
        }

        if (count($post)) {
            $val = Fuel\Core\Validation::forge();
            $val->add_callable(new MyRules());
            $val->add('username', 'Your username')->add_rule('required')->add_rule('unique', 'users.username');
            $val->add('email', 'Email')->add_rule('valid_email')->add_rule('unique', 'users.email');
            $val->add('password', 'Password')->add_rule('match_value', $post['password2'], true);

            if ($val->run()) {
                //generate code
                $code = $this->generate_code($post['email']);
                if ($auth->create_user($post['username'], $post['password'], $post['email'], $group = 1)) {
                    //update code for user 
                    $arrItem = array(
                        'code' => $code,
                        'gender' => $post['gender']
                    );
                    Model_User::update_item('email', $post['email'], $arrItem);
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
        $this->template->title2 = 'Fuel Auth App';
        $this->template->gobackTitle = 'Go login form';
        $this->template->gobackLink = 'auth/login/';
        $this->template->content = $view;
    }

    public function action_activation_complete()
    {
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

    public function action_thank_you_sign_up()
    {
        $view = Fuel\Core\View::forge('auth/thank_you_sign_up');
        $this->template->title = 'User &raquo; Thank you';
        $this->template->content = $view;
    }

    public function action_forget_password()
    {
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
        }
        $view->set('errors', $errors);
        $view->set('success', $success);
        $this->template->title = 'User &raquo; Forget password';
        $this->template->title2 = 'forget password';
        $this->template->gobackTitle = 'Go login form';
        $this->template->gobackLink = 'auth/login/';
        $this->template->content = $view;
    }

    public function action_new_password()
    {
        $view = Fuel\Core\View::forge('auth/new_password');
        $data = $this->request->method_params;
        $success = false;
        $errors = array();
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
        $view->set('errors', $errors);
        $view->set('success', $success);
        $this->template->title = 'User &raquo; New password';
        $this->template->title2 = 'new password';
        $this->template->gobackTitle = 'Go login form';
        $this->template->gobackLink = 'auth/login/';
        $this->template->content = $view;
    }

}
