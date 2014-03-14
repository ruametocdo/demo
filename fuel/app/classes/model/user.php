<?php

class Model_User extends Fuel\Core\Model_Crud
{

    protected static $_table_name = 'users';

    public static function all_items()
    {
        return Model_User::find_all();
    }

    /**
     * Update User
     *
     * String $field  unique field as id or email ....   
     * Text/number $value value of field update 
     * array $arrItem  arrray of field update

     */
    public static function update_item($field = 'id', $value = 1, $arrItem = array())
    {
        $user = Model_User::find_one_by($field, $value);
        if ($user) {
            $user->set($arrItem);
            try {
                if ($user->save())
                    return true;
            } catch (Exception $ex) {
                return 'Note Update User';
            }
        } else {
            return false;
        }
    }

}
