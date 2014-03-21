<?php

class Model_UserHobby extends Fuel\Core\Model_Crud
{

    protected static $_table_name = 'user_hobby';

    public static function save_item($userId = null, $hobbyId = null)
    {
        $item = Model_UserHobby::forge(array(
                    'user_id' => $userId,
                    'hobby_id' => $hobbyId
        ));
        return $item->save();
    }

    public static function delete_by_field($fieldName = null, $value = null)
    {
        $fields = Model_UserHobby::find_by($fieldName, $value);
        if ($fields) {
            foreach ($fields as $field) {
                if ($field) {
                    $field->delete();
                }
            }
        }
    }

    public static function check_hobby_for_user($userId = null, $hobbyId = null)
    {
        $data = Model_UserHobby::find(array(
                    'where' => array(
                        'user_id' => $userId,
                        'hobby_id' => $hobbyId
                    )
        ));
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_items_for_user($userID = null)
    {
        $data = Fuel\Core\DB::select()
                ->from('user_hobby')
                ->where('user_id', '=', $userID)
                ->join('hobby', 'left')
                ->on('user_hobby.hobby_id', '=', 'hobby.id')
                ->execute()
                ->as_array();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    public static function get_user_for_hobby($hobbyId = null){
        $data = Fuel\Core\DB::select()
                ->from('user_hobby')
                ->where('hobby_id','=',$hobbyId)
                ->join('users','left')
                ->on('user_hobby.user_id','=','users.id')
                ->where('cronmail','=',1)
                ->execute()
                ->as_array();
        if($data){
            return $data;
        }  else {
            return false;
        }
               
    }

}
