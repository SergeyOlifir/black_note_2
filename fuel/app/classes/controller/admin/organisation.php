<?php

class Controller_Admin_Organisation extends Controller_Admin {
    
    public function action_index($type = null) {
        $organisations = array();
        if($type === null) {
            $organisations = Model_Organisation::find('all');
        } else {
            $organisations = Model_Organisation::query()
                    ->where('status', $type)
                    ->get();
        }
        $this->template->content = Fuel\Core\View::forge('admin/organisation/index', array('organisations' => $organisations));
        
    }
    
    public function action_view($id = null) {
        !isset($id) and Fuel\Core\Response::redirect('/admin/organisation/');
        
        if($model = Model_Organisation::find($id)) {
            if(Fuel\Core\Input::post()) {
                $validator = Fuel\Core\Validation::forge('organisation_create');
                $validator->add_model('Model_Organisation');
                if($validator->run()) {
                    $fields = $validator->validated();
                    $fields['status'] = 2;
                    try {
                        /*var_dump($validator->field()); die();
                        foreach($fields as $key => $value) {
                            $model->set($key, $value);
                        }*/
                        $model->organisation_type = $fields['organisation_type'];
                        $model->sfera_type = $fields['sfera_type'];
                        $model->country_id = $fields['country_id'];
                        $model->region_id = $fields['region_id'];
                        $model->sity_id = $fields['sity_id'];
                        $model->title = $fields['title'];
                        $model->adress = $fields['adress'];
                        $model->phone = $fields['phone'];
                        $model->ovner = $fields['ovner'];
                        $model->status = $fields['status'];
                        $model->save();
                        $this->SetNotice('success', 'Организация одобрена');
                    } catch (Exception $ex) {

                    }
                    Fuel\Core\Response::redirect('/admin/organisation/');
                } else {
                    $this->SetNotice('danger', 'Чтото не так(');
                }
            }
            $this->RegisterJs(array('bootstrap-datepicker.js', 'toBlob.js', 'profileedit.js', 'jquery.Jcrop.min.js'));
            $this->RegisterCss(array('datepicker3.css', 'jquery.Jcrop.css'));
            $this->template->content = Fuel\Core\View::forge('admin/organisation/view', array('organisation' => $model));
        } else {
            Fuel\Core\Response::redirect('/admin/organisation/');
        }
    }
    
    public function action_delete($id = null) {
        !isset($id) and Fuel\Core\Response::redirect('/admin/organisation/');
        if($model = Model_Organisation::find($id)) {
            $model->status = 0;
            try {
                $model->save();
                $this->SetNotice('success', 'Организация успешно отклонена');
            } catch (Exception $exc) {
               $this->SetNotice('dander', 'Чтото не так'); 
            }
        } 
        Fuel\Core\Response::redirect('/admin/organisation/');
    }
    
    public function action_uploadlogo($id = null) {
        if(isset($_FILES['file']) and !$_FILES['file']['error']){
            $fname = str_replace('.', '-', uniqid('', TRUE)) . '.jpg';
            move_uploaded_file($_FILES['file']['tmp_name'], DOCROOT . 'files/' . $fname);
            try {
                if(isset($id) and $model = Model_Organisation::find($id)) {
                    $model->logo = '/files/' . $fname;
                    $model->save();
                    $this->SetNotice("success", "Лого успешно обновлено");
                } else {
                    $this->SetNotice("dander", "Организации нет");
                }
                return;
            } catch (Exception $e) {
                var_dump($e); die();
            }
        }
        $this->SetNotice("error", "Аватар обновить не удалось");
        return;
    }
}
