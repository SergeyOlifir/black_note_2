<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of host
 *
 * @author juise_man
 */
class Controller_Gwest extends Controller_Application {
    public $template = 'gwest/template';
    
    public static function GetLogedInUser($post=false) {
        $id = Auth::get_user_id();
        $id = $id[1];
        if ($post) {
            return Model_Event::SortEvents($post,$id);
        } else {
                return Model_User::find($id);
        } 
    }
    
    public static function AuthCheck() {
        if(\Auth\Auth::check()) {
            list(, $group) = Auth::get_groups()[0];
            if($group->id > 3) {
                return true;
            }
        }
        return false;
    }


    public function before() {
        /*$request = Fuel\Core\Request::active();
        if($request->route->action !== 'home' and !\Auth\Auth::check()) {
            \Fuel\Core\Response::redirect('/');
        }*/
        parent::before();
    }

    public function action_home () {
        $data = array();
        $this->template->title = 'Example Page';
        $users = Model_User::count();
        $users = $users *276;
        $users = number_format($users);
        $query = Model_Content::query()->where('type', 0);
        $articles =$query->limit(5)->get();
        $query = Model_Content::query()->where('type', 1);
        $zakon =$query->limit(5)->get();
        $this->template->content = \Fuel\Core\View::forge('gwest/layout/home/content', array('posts' => $articles, 'zakon' => $zakon), FALSE);
        $this->template->footer = \Fuel\Core\View::forge('gwest/layout/home/counter', array('countID'  => $users) );
    }
}

?>
