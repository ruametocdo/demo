<?php

class Model_User extends Fuel\Core\Model_Crud {

    protected static $_table_name = 'users';
    public static function all_items(){
        return Model_User::find_all();
    }
   
    

}
