<?php

class Controller_User_Organisation extends \Fuel\Core\Controller_Rest {
    
    public static function GetLogedInUser() {
        $id = Auth::get_user_id();
        $id = $id[1];
        return Model_User::find($id);
    }
    
    public function before() {
        $request = Fuel\Core\Request::active();
        if(!\Auth\Auth::check()) {
            \Fuel\Core\Response::redirect('/');
        }
        parent::before();
    }
    
    public function post_create() {
        $validator = Fuel\Core\Validation::forge('organisation_create');
        $validator->add_model('Model_Organisation');
        if($validator->run()) {
            $fields = $validator->validated();
            $fields['status'] = 1;
            $fields['user_id'] = self::GetLogedInUser()->id;
            $fields['logo'] = 'dd';
            try {
                Model_Organisation::forge($fields)->save();
                return $this->response(array('status' => 'success')); 
            } catch (Exception $ex) {

            }
            
        } else {
            return $this->response(array('status' => 'error', 'errors' => e($validator->error())));
        }
    }
    
    public function post_search() {
        //var_dump(Fuel\Core\Input::post()); die();
        $model = Model_Organisation::query()->select('id', 'title');
        if(Fuel\Core\Input::post('organisation_type') !== '')
            $model->where ('organisation_type', Fuel\Core\Input::post('organisation_type'));
        if(Fuel\Core\Input::post('sfera_type') !== '')
            $model->where ('sfera_type', Fuel\Core\Input::post('sfera_type'));
        if(Fuel\Core\Input::post('country_id') !== '')
            $model->where ('country_id', Fuel\Core\Input::post('country_id'));
        if(Fuel\Core\Input::post('region_id') !== '')
            $model->where ('region_id', Fuel\Core\Input::post('region_id'));
        if(Fuel\Core\Input::post('sity_id') !== '')
            $model->where ('sity_id', Fuel\Core\Input::post('sity_id'));
        
        //$model = $model->get();
        return $this->response($model->get());
    }
}
