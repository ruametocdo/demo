<?php
class Controller_Myapp extends Fuel\Core\Controller_Hybrid{
    public function before() {
        parent::before();
        // Assign current_user to the instance so controllers can use it
        $this->current_user = Auth::check() ? Model_User::find_one_by_username(Auth::get_screen_name()) : null;
        // Set a global variable so views can use it
        View::set_global('current_user', $this->current_user);
    }

}
