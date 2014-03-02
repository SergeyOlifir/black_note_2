<?php

class Controller_Admin_Post extends Controller_Admin {
    public function action_index($type = null) {
        $organisations = array();
        if($type === null) {
            $organisations = Model_Post::find('all');
        } else {
            $organisations = Model_Post::query()
                    ->where('status', $type)
                    ->get();
        }
        $this->template->content = Fuel\Core\View::forge('admin/post/index', array('organisations' => $organisations));
        
    }
    
    public function action_view($id = null) {
        !isset($id) and \Fuel\Core\Response::redirect('/admin/post/');
        
        if($model = Model_Post::find($id)) {
            $this->template->content = View::forge('admin/post/view', array('post' => $model), false);
        } else {
            \Fuel\Core\Response::redirect('/admin/post/');
        }
    }
    
    public function action_upruve($id) {
        !isset($id) and \Fuel\Core\Response::redirect('/admin/post/');
        if($model = Model_Post::find($id)) {
            $model->status = 3;
            try {
                $model->save();
                
            } catch (Exception $ex) {
                $this->SetNotice('danger', 'Чтото не так');
            }
            
            $message = Model_Message::forge(array(
                'user_id' => $model->user_id,
                'message' => 'Поздравляем! Пост успешно прошел модерацию. Вы можете его увидить по ссылке: ' . Fuel\Core\Html::anchor('/gwest/posts/view/' . $model->id, $model->title),
                'type' => 'success',
                'title' => 'Пост ' . Fuel\Core\Html::anchor('/user/post/view/' . $model->id, $model->title) . ' успешно прошел модерацию',
            ));
            
            try {
                $message->save();
                $this->SetNotice('success', 'Пост ' .  $model->title . ' принят');
            } catch (Exception $ex) {
                $this->SetNotice('danger', "Чтото не так");
            }
        }
        
        \Fuel\Core\Response::redirect('/admin/post/');
        
    }
    
    public function action_unupruve($id) {
        !isset($id) and \Fuel\Core\Response::redirect('/admin/post/');
        if(\Fuel\Core\Input::post() and Input::post('text') and $model = Model_Post::find($id)) {
            $model->status = 0;
            try {
                $model->save();
            } catch (Exception $ex) {
                $this->SetNotice('danger', "Чтото не так");
            }
            
            $message = Model_Message::forge(array(
                'user_id' => $model->user_id,
                'message' => Input::post('text'),
                'type' => 'danger',
                'title' => 'Пост ' . Fuel\Core\Html::anchor('/user/post/view/' . $model->id, $model->title) . ' не прошел модерацию',
            ));
            
            try {
                $message->save();
                $this->SetNotice('success', "Пост не принят");
            } catch (Exception $ex) {
                $this->SetNotice('danger', "Чтото не так");
            }
        }
        
        \Fuel\Core\Response::redirect('/admin/post/');
    }
}

