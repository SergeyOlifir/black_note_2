<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Controller_Admin_User extends Controller_Admin {
    
    public function action_index() {
        $users = Model_User::find('all');
        $this->template->content = Fuel\Core\View::forge('admin/user/index', array('users' => $users));
    }
    
    public function action_bun($user_id = null) {
        !isset($user_id) and Fuel\Core\Response::redirect('admin/user/index');
        if($user = Model_User::find($user_id)) {
            $user->group_id = 1;
            $user->save();
            $this->SetNotice('success', 'Пользователь ' . $user->username . ' успешно забанен');
        } else {
            $this->SetNotice('danger', "Нет такого пользователя");
        }
        
        Fuel\Core\Response::redirect('admin/user/index');
    }
    
    public function action_unbun($user_id = null) {
        !isset($user_id) and Fuel\Core\Response::redirect('admin/user/index');
        if($user = Model_User::find($user_id)) {
            $user->group_id = 3;
            $user->save();
            $this->SetNotice('success', 'Пользователь ' . $user->username . ' успешно разбанен');
        } else {
            $this->SetNotice('danger', "Нет такого пользователя");
        }
        
        Fuel\Core\Response::redirect('admin/user/index');
    }
    
    public function action_admin($user_id = null) {
        !isset($user_id) and Fuel\Core\Response::redirect('admin/user/index');
        if($user = Model_User::find($user_id)) {
            $user->group_id = 5;
            $user->save();
            $this->SetNotice('success', 'Пользователь ' . $user->username . ' успешно стал админом');
        } else {
            $this->SetNotice('danger', "Нет такого пользователя");
        }
        
        Fuel\Core\Response::redirect('admin/user/index');
    }
    
    public function action_unadmin($user_id = null) {
        !isset($user_id) and Fuel\Core\Response::redirect('admin/user/index');
        if($user = Model_User::find($user_id)) {
            $user->group_id = 3;
            $user->save();
            $this->SetNotice('success', 'Пользователь ' . $user->username . ' теперь не админ');
        } else {
            $this->SetNotice('danger', "Нет такого пользователя");
        }
        
        Fuel\Core\Response::redirect('admin/user/index');
    }
}