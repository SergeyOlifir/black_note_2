<?php

class Controller_Gwest_Abaut extends Controller_Gwest {
    public function action_index() {
        $this->template->content = Fuel\Core\View::forge('gwest/abaut/index');
    }
}