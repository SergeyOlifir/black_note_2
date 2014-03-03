<?php

class Controller_Admin extends Controller_Application {
    public $template = 'admin/template';
    
    public static function GetLogedInUser() {
        $id = Auth::get_user_id();
        $id = $id[1];
    
        return Model_User::find($id);
    }
    
    public function before() {
        $request = Fuel\Core\Request::active();
        if(!($request->route->controller === get_class() and $request->route->action === 'index' and !\Auth\Auth::check())) {
            list(, $group) = Auth::get_groups()[0];
            if($group->id < 4) {
                \Fuel\Core\Response::redirect('/admin/index');
            }
        }
        parent::before();
    }
    
    public function action_index() {
        if(Fuel\Core\Input::post()) {
            if (\Auth::instance()->login(\Input::param('username'), \Input::param('password'))) {
                list(, $group) = Auth::get_groups()[0];
                if($group->id > 4) {
                    Fuel\Core\Response::redirect('admin/user/index');
                }
            }
            
            $this->SetNotice('danger', 'Не угадал!');
            
        }
        
        $this->template->content = Fuel\Core\View::forge('admin/auth/login');
        
    }
    
}

?>
