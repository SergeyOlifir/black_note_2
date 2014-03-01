<?php

class Controller_Admin_Post extends Controller_Admin {
    public function action_index($type = null) {
        $organisations = array();
        if($type === null) {
            $organisations = Model_Post::find('all');
        } else {
            $organisations = Model_Post::query()
                    ->where('status', $type)
                    ->get();
        }
        $this->template->content = Fuel\Core\View::forge('admin/post/index', array('organisations' => $organisations));
        
    }
    
    public function action_view($id = null) {
        !isset($id) and \Fuel\Core\Response::redirect('/admin/post/');
        
        if($model = Model_Post::find($id)) {
            $this->template->content = View::forge('admin/post/view', array('post' => $model), false);
        } else {
            \Fuel\Core\Response::redirect('/admin/post/');
        }
    }
    
    public function action_upruve($id) {
        !isset($id) and \Fuel\Core\Response::redirect('/admin/post/');
        if($model = Model_Post::find($id)) {
            $model->status = 3;
            try {
                $model->save();
                $this->SetNotice('success', 'Пост ' .  $model->title . ' принят');
            } catch (Exception $ex) {
                $this->SetNotice('danger', 'Чтото не так');
            }
        }
        
        \Fuel\Core\Response::redirect('/admin/post/');
        
    }
}

