<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Controller_User_Post extends Controller_User {
    
    public function action_create() {
        if(Fuel\Core\Input::post()) {
            $validator = Fuel\Core\Validation::forge('post_create');
            $validator->add_model('Model_Post');
            if($validator->run()) {
                try {
                    $fields = $validator->validated();
                    $fields['status'] = 1;
                    $fields['user_id'] = self::GetLogedInUser()->id;
                    $model = Model_Post::forge($fields)->save();
                    $this->SetNotice('success', 'Пост Добавлен в черновики');
                } catch (Exception $ex) {
                    var_dump($ex->getMessage()); die();
                }
            } else {
                var_dump(e($validator->error())); die();
            }
        }
        
        $this->RegisterJs('tinymce/tinymce.min.js');
        $this->template->content = Fuel\Core\View::forge('user/layout/post/form');
    }
    
    public function action_draft() {
        $drafts = Model_Post::find('all', array(
            'where' => array(
                array('status', '<', 3),
                array('user_id', self::GetLogedInUser()->id)
            )
        ));

        $config = array(
            'total_items'    => count($drafts),
            'per_page'       => 5,
            'uri_segment'    => 'page',
            'show_first' => true,
            'show_last' => true,
            'num_links' => 3
        );
        
        $pagination = Pagination::forge('draftspafination', $config);
        
        $drafts = Model_Post::query()
                            ->where('status', '<', 3)
                            ->where('user_id', self::GetLogedInUser()->id)
                            ->rows_offset($pagination->offset)
                            ->rows_limit($pagination->per_page)
                            ->order_by('created_at', 'desc')
                            ->get();
        
        $this->template->content = Fuel\Core\View::forge('user/layout/post/index', array('posts' => $drafts), false);
    }
    
    public function action_view($id = null) {
        !isset($id) and Fuel\Core\Response::redirect('/user/post/draft');
        if($model = Model_Post::find($id) and $model->user_id === self::GetLogedInUser()->id) {
            $this->template->content = Fuel\Core\View::forge('user/layout/post/view', array('post' => $model), false);
        }
    }
    
    public function action_edit($id = null) {
        !isset($id) and Fuel\Core\Response::redirect('/user/post/draft');
        if($model = Model_Post::find($id) and $model->user_id === self::GetLogedInUser()->id) {
            
            if(Fuel\Core\Input::post()) {
                $validator = Fuel\Core\Validation::forge('post_create');
                $validator->add_model('Model_Post');
                if($validator->run()) {
                    $fields = $validator->validated();
                    $fields['user_id'] = self::GetLogedInUser()->id;
                    $fields['status'] = 1;
                    try {
                        foreach($fields as $key => $value) {
                            $model->set($key, $value);
                        }
                        $model->save();
                        $this->SetNotice('success', 'Пост обновлен');
                        Fuel\Core\Response::redirect('/user/post/view/' . $model->id);
                    } catch (Exception $ex) {

                    }
                } else {
                    var_dump(e($validator->error())); die();
                }
            }
            
            $this->RegisterJs('tinymce/tinymce.min.js');
            $this->template->content = Fuel\Core\View::forge('user/layout/post/form', array('post' => $model), false);
        }
    }
    
    public function action_publish($id = null) {
        !isset($id) and Fuel\Core\Response::redirect('/user/post/draft');
        if($model = Model_Post::find($id) and $model->user_id === self::GetLogedInUser()->id) {
            $model->status = 2;
            try {
                $model->save();
                $this->SetNotice('success', 'Пост ожидает модерации');
            } catch (Exception $ex) {
                $this->SetNotice('danger', 'Чтото не так');
            }
            
            Fuel\Core\Response::redirect('/user/post/view/' . $model->id);
        } else {
            Fuel\Core\Response::redirect('/user/post/draft');
        }
    }
    
    public function action_published() {
        $drafts = Model_Post::find('all', array(
            'where' => array(
                array('status', 3),
                array('user_id', self::GetLogedInUser()->id)
            )
        ));

        $config = array(
            'total_items'    => count($drafts),
            'per_page'       => 5,
            'uri_segment'    => 'page',
            'show_first' => true,
            'show_last' => true,
            'num_links' => 3
        );
        
        $pagination = Pagination::forge('draftspafination', $config);
        
        $drafts = Model_Post::query()
                            ->where('status', 3)
                            ->where('user_id', self::GetLogedInUser()->id)
                            ->rows_offset($pagination->offset)
                            ->rows_limit($pagination->per_page)
                            ->order_by('created_at', 'desc')
                            ->get();
        
        $this->template->content = Fuel\Core\View::forge('user/layout/post/index', array('posts' => $drafts), false);
    }
}

