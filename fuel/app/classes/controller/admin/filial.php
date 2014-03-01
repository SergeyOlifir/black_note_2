<?php

class Controller_Admin_Filial extends Controller_Admin {
    
    public function action_index($organisation_id = null) {
        !isset($organisation_id) and Fuel\Core\Response::redirect_back();
        /*$filials = array();
        if($type === null) {
            $filials = Model_Filial::query()->where('organisation_id', $organisation_id)->get();
        } else {
            $filials = Model_Filial::query()
                    ->where('organisation_id', $organisation_id)
                    ->where('status', $type)
                    ->get();
        }*/
        
        $organisation = Model_Organisation::find($organisation_id);
        
        $this->template->content = Fuel\Core\View::forge('admin/filial/index', array('filials' => $organisation->filials));
        
    }
    
    public function action_view($id = null) {
        !isset($id) and Fuel\Core\Response::redirect_back();
        
        if($model = Model_Filial::find($id)) {
            if(Fuel\Core\Input::post()) {
                $validator = Fuel\Core\Validation::forge('filial_create');
                $validator->add_model('Model_Filial');
                if($validator->run(array('organisation_id' => $model->organisation_id))) {
                    $fields = $validator->validated();
                    $fields['status'] = 2;
                    try {
                        foreach($fields as $key => $value) {
                            $model->set($key, $value);
                        }
                        $model->save();
                        $this->SetNotice('success', 'Филиал одобрен');
                    } catch (Exception $ex) {

                    }
                    Fuel\Core\Response::redirect('/admin/filial/index/' . $model->organisation_id);
                } else {
                    var_dump(e($validator->error())); die();
                    $this->SetNotice('danger', 'Чтото не так(');
                }
            }
            $this->RegisterJs(array('bootstrap-datepicker.js', 'toBlob.js', 'profileedit.js', 'jquery.Jcrop.min.js'));
            $this->RegisterCss(array('datepicker3.css', 'jquery.Jcrop.css'));
            $this->template->content = Fuel\Core\View::forge('admin/filial/view', array('organisation' => $model));
        } else {
            Fuel\Core\Response::redirect('/admin/organisation/');
        }
    }
    
    public function action_delete($id = null) {
        !isset($id) and Fuel\Core\Response::redirect_back();
        if($model = Model_Filial::find($id)) {
            $model->status = 0;
            try {
                $model->save();
                $this->SetNotice('success', 'Филиал успешно отклонен');
            } catch (Exception $exc) {
               $this->SetNotice('dander', 'Чтото не так'); 
            }
        } 
        Fuel\Core\Response::redirect_back();
    }
    
    public function action_uploadlogo($id = null) {
        if(isset($_FILES['file']) and !$_FILES['file']['error']){
            $fname = str_replace('.', '-', uniqid('', TRUE)) . '.jpg';
            move_uploaded_file($_FILES['file']['tmp_name'], DOCROOT . 'files/' . $fname);
            try {
                if(isset($id) and $model = Model_Filial::find($id)) {
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
