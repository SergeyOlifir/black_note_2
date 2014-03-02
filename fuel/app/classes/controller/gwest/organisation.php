<?php

class Controller_Gwest_Organisation extends Controller_Gwest {
    public function action_view($id) {
        !isset($id) and \Fuel\Core\Response::redirect('/');
        if($model = Model_Organisation::find($id)) {
            $this->template->content = Fuel\Core\View::forge('gwest/organisation/view', array('organisation' => $model));
        } else {
            \Fuel\Core\Response::redirect('/404.html');
        }
    }
}
