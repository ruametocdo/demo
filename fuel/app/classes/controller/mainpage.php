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
        $select = array('users.id', 'username', 'email', 'gender', 'image', 'comments.id', 'content', 'comments.created');
        $data['comments'] = Model_Comment::get_comments_for_all_user($select);
        $post = \Fuel\Core\Input::post();
        if ( $data['comments']) {
            $enditem = end($data['comments']);
            $data['end_id'] = $enditem['id'];
        }
        $data['num'] = !empty($data['comments']) ? count($data['comments']) : 0;
        $data['total'] = Model_Comment::total_record();
       
        $this->template->content = View::forge('mainpage/index', $data);
        $this->template->title = 'User &raquo; Comment';
    }

    public function action_add_comment()
    {
        $data = array();
        if ($post = \Fuel\Core\Input::post('comment')) {
            $val = \Fuel\Core\Validation::forge();
            $val->add_field('comment', 'Comment', 'trim|required');
            if ($val->run()) {
                Model_Comment::add_comment($post, $this->current_user->id);
            } else {
                $data['error'] = $val->error_message();
            }
        }
        $select = array('users.id', 'username', 'email', 'gender', 'image', 'comments.id', 'content', 'comments.created');
        $data['comments'] = Model_Comment::get_comments_for_all_user($select);

        if (!empty($data['comments'])) {
            $end_comment = end($data['comments']);
            $data['end_id'] = $end_comment['id'];
        }
        $data['num'] = !empty($data['comments']) ? count($data['comments']) : 0;
        $data['total'] = Model_Comment::total_record();
        return new Response(View::forge('mainpage/comment', $data));
    }

    public function action_more_comment()
    {
        $data = array();
        if ($post = \Fuel\Core\Input::post()) {
            $select = array('users.id', 'username', 'email', 'gender', 'image', 'comments.id', 'content', 'comments.created');
            $data['comments'] = Model_Comment::get_comments_for_all_user($select, $post['last_id']);
            if (!empty($data['comments'])) {
                $end_comment = end($data['comments']);
                $data['end_id'] = $end_comment['id'];
                $num = count($data['comments']);
            }
            $num += $post['num'];
        }
        $data['num'] = !empty($num) ? $num : 0;
        $data['total'] = Model_Comment::total_record();
        return new Response(View::forge('mainpage/comment', $data));
    }

}
