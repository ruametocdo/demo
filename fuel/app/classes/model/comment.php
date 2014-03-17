<?php

class Model_Comment extends \Fuel\Core\Model_Crud
{

    protected static $_table_name = 'comments';

    public static function add_comment($arr_item = array())
    {
        $comment = Model_Comment::forge()->set($arr_item);
        try {
            if ($comment->save())
                return true;
        } catch (Exception $ex) {
            return 'Not save Comment';
        }
    }

    public static function get_comments_for_all_user($select = array(), $where = null, $limit = 4)
    {
        if ($where) {
            $result = \Fuel\Core\DB::select_array($select)
                    ->from('comments')
                    ->join('users', 'Left')
                    ->on('comments.user_id', '=', 'users.id')
                    ->order_by('comments.id', 'desc')
                    ->where('comments.id', '<', $where)
                    ->limit($limit)
                    ->execute()
                    ->as_array();
        } else {
             $result = \Fuel\Core\DB::select_array($select)
                    ->from('comments')
                    ->join('users', 'Left')
                    ->on('comments.user_id', '=', 'users.id')
                    ->order_by('comments.id', 'desc')
                   // ->where('comments.id', '<', $where)
                    ->limit($limit)
                    ->execute()
                    ->as_array();
        }
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

}
