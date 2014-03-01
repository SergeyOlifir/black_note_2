<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author juise_man
 */
class Controller_Api_Auth extends Controller_Api {
    protected $default_format = 'json';
    protected $rest_format = 'application/json';
    public function post_Login() {
        \Fuel\Core\Lang::load('auth', 'auth');
        $status = 'failed';
        $message = 'hui';
        $user = '';
        if ($user = $user = Auth::validate_user(\Input::param('username'), Input::param('password'))) {
            $status = 'success';
            if(\Auth\Auth::get('newuser_created')) {
                \Auth::logout();
                $status = 'failed';
                $message = __('auth.login.error');
            }
        } else {
            $status = 'failed';
            $message = __('auth.login.error');
        }
        
        return $this->response(array('status' => $status, 'message' => $message, 'user' => $user));
    }
}

?>
