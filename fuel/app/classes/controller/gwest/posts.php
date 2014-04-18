<?php 

class Controller_Gwest_Posts extends Controller_Gwest {
    
    public function action_index($type = null) {
        if(\Fuel\Core\Input::post()) {
            $posts = Model_Post::query()->where('status', 3)->related('organisation');
            if(\Fuel\Core\Input::post('country_id')) {
                $posts->where('organisation.country_id', '=', \Fuel\Core\Input::post('country_id'));
            }
            
            if(\Fuel\Core\Input::post('region_id')) {
                $posts->where('organisation.region_id', '=', \Fuel\Core\Input::post('region_id'));
            }
            
            if(\Fuel\Core\Input::post('sity_id')) {
                $posts->where('organisation.sity_id', '=', \Fuel\Core\Input::post('sity_id'));
            }
            
            if(\Fuel\Core\Input::post('query')) {
                $posts->where('title', 'like', '%' . \Fuel\Core\Input::post('query') . '%');
            }
            
            if(isset($type)) {
                $posts->where('object', $type);
            }
            
            $this->template->content = Fuel\Core\View::forge('gwest/layout/post/index', array('posts' => $posts->get(), 'input' => Input::post()), false);
        } else {
            $drafts = Model_Post::query()
                    ->where('status', 3);
            if(isset($type)) {
                $drafts->where('object', $type);
            }

            $config = array(
                'total_items'    => $drafts->count(),
                'per_page'       => 5,
                'uri_segment'    => 'page',
                'show_first' => true,
                'show_last' => true,
                'num_links' => 3
            );

            $pagination = Pagination::forge('draftspafination', $config);

            $drafts = Model_Post::query()
                                ->where('status', 3);
            if(isset($type)) {
                $drafts->where('object', $type);
            }
            $drafts = $drafts->rows_offset($pagination->offset)
                    ->rows_limit($pagination->per_page)
                    ->order_by('created_at', 'desc')
                    ->get();

            $this->template->content = Fuel\Core\View::forge('gwest/layout/post/index', array('posts' => $drafts), false);
        }
    }
    
    public function action_view($id = null) {
        !isset($id) and Fuel\Core\Response::redirect('/user/post/draft');
        if($model = Model_Post::find($id)) {
            $comments = Model_Comment::find('all', array('where' => array(array('post_id' => $id))));
            $this->template->content = Fuel\Core\View::forge('gwest/layout/post/detailed', array('post' => $model, 'comments' => $comments), false);
        } else {
            Fuel\Core\Response::redirect('/user/post/draft');
        }
    }
    
    public function action_addcomment() {
        /*$model = new Model_Comment();
        $model->comment = Fuel\Core\Input::post()['text'];
        $model->user_id = self::GetLogedInUser()->id;
        $model->post_id = Fuel\Core\Input::post()['post_id'];
        $model->parent_id = 0;
        $model->save();*/
        
        //$fields['comment'] = Fuel\Core\Input::post('text');
        
        
        $validator = Validation::forge('validate_post');
        $validator->add('comment', 'Comment')->add_rule('required');
        if($validator->run()) {
            $fields = $validator->validated();
            $fields['user_id'] = self::GetLogedInUser()->id;
            $fields['post_id'] = Fuel\Core\Input::post('post_id');
            $fields['parent_id'] = Fuel\Core\Input::post('parent_id') != NULL ? Fuel\Core\Input::post('parent_id') : 0;
            $model = Model_Comment::forge($fields)->save();
        } else {
            var_dump(e($validator->error())); die();
        }
        Fuel\Core\Response::redirect('gwest/posts/view/'.Fuel\Core\Input::post('post_id'));
    }
}
