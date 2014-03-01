<?php
class Controller_User extends Controller_Application {
    public $template = 'user/template';
    
    public static function GetLogedInUser() {
        $id = Auth::get_user_id();
        $id = $id[1];
    
        return Model_User::find($id);
           
    }
    
    public function before() {
        $request = Fuel\Core\Request::active();
        if(!\Auth\Auth::check()) {
            \Fuel\Core\Response::redirect('/');
        }
        parent::before();
    }
}