<?php

class Controller_Admin_Content extends Controller_Admin {
    public function action_index() {
        $posts = Model_Content::find('all', array('order_by' => array('created_at' => 'desc')));
        $this->template->content = Fuel\Core\View::forge('admin/content/index', array('posts' => $posts), false);
    }
    
    public function action_create() {
        $errors = array();
        if(Fuel\Core\Input::post()) {
            $validator = $this->get_validator();
            if($validator->run()) {
                $fields = $validator->validated();
                $fields['user_id'] = self::GetLogedInUser()->id;
                try {
                    $model = Model_Content::forge($fields)->save();
                    $this->SetNotice('success', 'Статья успешно добавлена');
                    Fuel\Core\Response::redirect('admin/content/index');
                } catch (Exception $ex) {
                    $this->SetNotice('danger', 'Не удалось добавить статью');
                }
            } else {
                $errors = e($validator->error());
                $this->SetNotice('danger', 'Для успешного сохранения статьи нужно исправить ошибки');
            }
        } 
        
        $this->template->content = Fuel\Core\View::forge('admin/content/form', array('errors' => $errors, 'content' => Fuel\Core\Input::post()), false);
    }
    
    public function action_edit($id = null) {
        !isset($id) and Fuel\Core\Response::redirect('admin/content/index');
        if($model = Model_Content::find($id)) {
            $errors = array();
            $data = $model;
            if(Fuel\Core\Input::post()) {
                $validator = $this->get_validator();
                if($validator->run()) {
                    $fields = $validator->validated();
                    $model->type = $fields['type'];
                    $model->title = $fields['title'];
                    $model->preview = $fields['preview'];
                    $model->body = $fields['body'];
                    try {
                        $model->save();
                        $this->SetNotice('success', 'Статья успешно добавлена');
                    } catch (Exception $ex) {
                        $this->SetNotice('danger', 'Не удалось добавить статью');
                    }
                    Fuel\Core\Response::redirect('admin/content/index');
                } else {
                    $errors = e($validator->error());
                    $this->SetNotice('danger', 'Для успешного сохранения статьи нужно исправить ошибки');
                    $data = Fuel\Core\Input::post();
                }
            }
            $this->template->content = Fuel\Core\View::forge('admin/content/form', array('errors' => $errors, 'content' => $data), false);
        } else {
            $this->SetNotice('danger', 'Нет такой статьи');
            Fuel\Core\Response::redirect('admin/content/index');
        }
    }
    
    public function action_delete($id = null) {
        !isset($id) and Fuel\Core\Response::redirect('admin/content/index');
        if($model = Model_Content::find($id)) {
            try {
                $model->delete();
                $this->SetNotice('success', 'Статья успешно удалена');
            } catch (Exception $ex) {
                $this->SetNotice('danger', 'Неудалось удалить статью');
            }
        } else {
            $this->SetNotice('danger', 'Нет такой статьи');
        }
        
        Fuel\Core\Response::redirect('admin/content/index');
    }

    private function get_validator() {
        $validator = Fuel\Core\Validation::forge('content');
        $validator->add_field('type', 'Тип', 'required');
        $validator->add_field('title', 'Заголовок', 'required|max_length[50]|min_length[5]');
        $validator->add_field('preview', 'Краткое описание', 'required|min_length[5]');
        $validator->add_field('body', 'Краткое описание', 'required|min_length[5]');
        return $validator;
    }
}

