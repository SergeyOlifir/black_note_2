<?php

class Controller_Gwest_Content extends Controller_Gwest {
    public function action_article() {
        $this->render_article_list_by_types(0);
    }
    
    public function action_zakon() {
        $this->render_article_list_by_types(1);
    }
    
    private function render_article_list_by_types($type) {
        $articles = Model_Content::find('all', array(
            'where' => array(
                array('type', $type),
            )
        ));

        $config = array(
            'total_items'    => count($articles),
            'per_page'       => 5,
            'uri_segment'    => 'page',
            'show_first' => true,
            'show_last' => true,
            'num_links' => 3
        );
        
        $pagination = Pagination::forge('articlepafination', $config);
        
        $articles = Model_Content::query()
                            ->where('type', $type)
                            ->rows_offset($pagination->offset)
                            ->rows_limit($pagination->per_page)
                            ->order_by('created_at', 'desc')
                            ->get();
        
        $this->template->content = Fuel\Core\View::forge('gwest/layout/content/article', array('posts' => $articles), false);
    }
    
    public function action_view($id = null) {
        !isset($id) and Fuel\Core\Response::redirect(Router::get('_404_'));
        if($model = Model_Content::find($id)) {
            $this->template->content = Fuel\Core\View::forge('gwest/layout/content/view', array('post' => $model), false);
        } else {
            Fuel\Core\Response::redirect(Router::get('_404_'));
        }
    }
    
    
}

