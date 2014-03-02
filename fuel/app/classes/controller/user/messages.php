<?php
 
class Controller_User_Messages extends Controller_User {
    public function action_index() {
        $model = $this->GetLogedInUser()->messages;
        $this->template->content = Fuel\Core\View::forge('user/messages/index', array('messages' => $model), false);
    }
}