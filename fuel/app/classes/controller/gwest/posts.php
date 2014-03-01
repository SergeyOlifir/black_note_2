<?php 

class Controller_Gwest_Posts extends Controller_Gwest {
    
    public function action_index() {
        $drafts = Model_Post::find('all', array(
            'where' => array(
                array('status', 3)
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
                            ->rows_offset($pagination->offset)
                            ->rows_limit($pagination->per_page)
                            ->order_by('created_at', 'desc')
                            ->get();
        
        $this->template->content = Fuel\Core\View::forge('gwest/layout/post/index', array('posts' => $drafts), false);
    }
    
    public function action_view($id = null) {
        !isset($id) and Fuel\Core\Response::redirect('/user/post/draft');
        if($model = Model_Post::find($id)) {
            $this->template->content = Fuel\Core\View::forge('gwest/layout/post/detailed', array('post' => $model), false);
        } else {
            Fuel\Core\Response::redirect('/user/post/draft');
        }
    }
}
