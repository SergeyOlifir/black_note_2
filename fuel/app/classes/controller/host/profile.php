<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of profile
 *
 * @author juise_man
 */
class Controller_Host_Profile extends Controller_Host {
    
    public function before() {
        \Fuel\Core\Lang::load('profile', 'profile');
        parent::before();
    }

    public function action_index() {
        $this->template = \Fuel\Core\View::forge('host/layout/profile/index');
    }
    
    public function action_edit() {
        $errors = '';
        if(\Fuel\Core\Input::post()) {
            $validator = Fuel\Core\Validation::forge('edit_profile');
            //$validator->add_field('username', 'Your username', 'required');
            $validator->add_field('old_password', 'Your password', 'required|min_length[3]|max_length[10]');//match_field
            $validator->add_field('email', 'Your Emale', 'required|valid_email');
            if(\Fuel\Core\Input::post('password')) {
                $validator->add_field('password', 'Your password', 'required|min_length[3]|max_length[10]');
            }
            
            if(\Fuel\Core\Input::post('zip')) {
                $validator->add_field('zip', 'Your zip', 'required|min_length[5]|valid_string[numeric]');
            }
            
            if($validator->run()) {
                //var_dump($validator->validated());
                try {
                    Auth::update_user($validator->validated());
                    $this->SetNotice("success", "Personal information was updated successfully");
                } catch (Exception $e) {
                    var_dump($e); die();
                    $errors['old_password'] = 'Old password is invalid';
                }
            } else {
                $errors = e($validator->error());
            }
            
        }
        
        $this->template->content = \Fuel\Core\View::forge('host/layout/profile/edit', array('errors' => $errors), false);
    }
    
    public function action_recover() {
        if(!Fuel\Core\Session::get('recover')) {
            \Fuel\Core\Response::redirect('/');
        }
        
        $errors = '';
        if(\Fuel\Core\Input::post()) {
            $validator = Fuel\Core\Validation::forge('recover_pass');
            $validator->add_field('password', 'Password', 'required|min_length[3]|max_length[10]');//match_field
            $validator->add_field('confpass', 'Confirm Password', 'match_field[password]');
            
            if($validator->run()) {
                try {
                    $new_password = Auth::reset_password(\Auth\Auth::get('username'));
                    Auth::change_password($new_password,\Fuel\Core\Input::post('password'));
                    $this->SetNotice("success", "Password successfully recovered");
                    Fuel\Core\Session::delete('recover');
                    \Fuel\Core\Response::redirect('/host/events/edit');
                } catch (Exception $e) {
                    $this->SetNotice("danger", "Чтото не так");
                }
            } else {
                $errors = e($validator->error());
            }
            
        }
        
        $this->template->content = \Fuel\Core\View::forge('host/layout/profile/recover', array('errors' => $errors), false);
    }
}

?>
