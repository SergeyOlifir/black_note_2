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
        $this->template->content = \Fuel\Core\View::forge('gwest/layout/home/content');
    }
}

?>
