<?php

class Controller_Mainpage extends Controller_Myapp
{

    public function before()
    {
        parent::before();
        if (!$this->current_user)
            return \Fuel\Core\Response::redirect('auth/login');
    }

    public function action_index()
    {
        $view = Fuel\Core\View::forge('mainpage/index');
        $select = array('users.id', 'username', 'email', 'gender', 'image', 'comments.id', 'content', 'comments.created');
        $result = Model_Comment::get_comments_for_all_user($select);

        $post = \Fuel\Core\Input::post();
        if ($post && $this->current_user) {
            $val = Fuel\Core\Validation::forge();
            $val->add('comment', 'Your comment')->add_rule('required');
            if ($val->run()) {
                $arr_item = array(
                    'content' => $post['comment'],
                    'user_id' => $this->current_user->id,
                    'created' => Date::forge()->get_timestamp()
                );
                Model_Comment::add_comment($arr_item);
            } else {
                foreach ($val->error_message() as $field => $message) {
                    $errors[] = $message;
                }

                $view->set('errors', $errors);
            }
        }
        if ($result) {
            $enditem = end($result);
            $view->set('end_id', $enditem['id']);
        }
        $this->template->title = 'User &raquo; Comment';

        $view->set('items', $result);
        $this->template->content = $view;
    }

    public function action_more_comment()
    {
        $view = Fuel\Core\View::forge('mainpage/more_comment');
//        if ($post = \Fuel\Core\Input::post()) {
//            $select = array('users.id', 'username', 'email', 'gender', 'image', 'comments.id', 'content', 'comments.created');
//            $result = Model_Comment::get_comments_for_all_user($select, $post['last_id']);
//        }
       
//        if($result)
//            $view->set('items', $result);
        $this->template->content = $view;
    }

}
