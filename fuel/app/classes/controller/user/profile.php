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
class Controller_User_Profile extends Controller_User {
    
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
            
            if(\Fuel\Core\Input::post('userage')) {
                $validator->add_field('userage', 'Ваш возрост', 'valid_date[m/d/Y]');
            }
            
            if(\Fuel\Core\Input::post('usersex')) {
                $validator->add_field('usersex', 'Ваш возрост', 'max_length[60]');
            }
            
            if(\Fuel\Core\Input::post('abaut')) {
                $validator->add_field('abaut', 'Ваш возрост', 'max_length[60]|min_length[5]');
            }
            
            if(\Fuel\Core\Input::post('job')) {
                $validator->add_field('job', 'Ваш возрост', 'max_length[30]|min_length[3]');
            }
            
            if(Fuel\Core\Input::post('country_id')) {
                $validator->add_field('country_id', 'Страна', 'required');
            }
            
            if(Fuel\Core\Input::post('region_id')) {
                $validator->add_field('region_id', 'Страна', 'required');
            }
            
            if(Fuel\Core\Input::post('sity_id')) {
                $validator->add_field('sity_id', 'Страна', 'required');
            }
            
            //echo "<pre>"; var_dump(Fuel\Core\Input::post()); die();
            
            if($validator->run()) {
                try {
                    Auth::update_user($validator->validated());
                    $this->SetNotice("success", "Ваша информация спешно изменена…");
                } catch (Exception $e) {
                    var_dump($e); die();
                    $errors['old_password'] = 'Old password is invalid';
                }
            } else {
                $errors = e($validator->error());
                $this->SetNotice("danger", "Пожалуйста, корректно заполните поля Ваших данных…");
            }
            
        }
        
        $this->RegisterJs(array('bootstrap-datepicker.js', 'toBlob.js', 'profileedit.js', 'jquery.Jcrop.min.js'));
        $this->RegisterCss(array('datepicker3.css', 'jquery.Jcrop.css'));
        $this->template->content = \Fuel\Core\View::forge('user/layout/profile/edit', array('errors' => $errors), false);
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
    
    public function action_uploadavatar() {
        if(isset($_FILES['file']) and !$_FILES['file']['error']){
            $fname = str_replace('.', '-', uniqid('', TRUE)) . '.jpg';
            move_uploaded_file($_FILES['file']['tmp_name'], DOCROOT . 'files/' . $fname);
            try {
                Auth::update_user(array('avatar' => '/files/' . $fname));
                $this->SetNotice("success", "Аватар успешно обновлен");
                return;
            } catch (Exception $e) {
                var_dump($e); die();
            }
        }
        $this->SetNotice("error", "Аватар обновить не удалось");
        return;
    }
}

?>
