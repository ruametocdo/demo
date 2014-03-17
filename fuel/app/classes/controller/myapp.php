<?php

class Controller_Myapp extends Fuel\Core\Controller_Hybrid
{

    public function before()
    {
        parent::before();
        $user_id = Auth\Auth::get_user_id();
        // Assign current_user to the instance so controllers can use it
        $this->current_user = Auth::check() ? Model_User::find_one_by_id($user_id[1]) : false;
        // Set a global variable so views can use it
        View::set_global('current_user', $this->current_user);
        View::set_global('base_url',  $_SERVER['HTTP_HOST'] . '/');
    }
    public function generate_code($email = null)
    {
        $random_number = rand(1000000, 9999999);
        return md5($random_number . $email);
    }
    public function send_mail($from, $to, $subject = null, $body = null, $namefrom = null, $nameto = null)
    {
        $email = \Email\Email::forge(array('driver' => 'smtp'));
        $email->from($from, $namefrom);
        $email->to($to, $nameto);
        $email->subject($subject);
        $email->body($body);
        $email->send();
    }

}
