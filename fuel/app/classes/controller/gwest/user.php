<?php

class Controller_Gwest_User extends Controller_Gwest {
    public function action_view($id) {
        !isset($id) and \Fuel\Core\Response::redirect('/');
        if($model = Model_User::find($id)) {
            $this->template->content = Fuel\Core\View::forge('gwest/user/view', array('user' => $model));
        } else {
            \Fuel\Core\Response::redirect('/404.html');
        }
    }
}
