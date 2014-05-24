<?php

class Controller_User_Filial extends \Fuel\Core\Controller_Rest {
    
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
        $validator = Fuel\Core\Validation::forge('filial_create');
        $validator->add_model('Model_Filial');
        if($validator->run()) {
            $fields = $validator->validated();
            $fields['status'] = 1;
            $fields['user_id'] = self::GetLogedInUser()->id;
            $fields['logo'] = 'dd';
            try {
                $new_filial = Model_Filial::forge($fields);
                $new_filial->save();
                $new_id = $new_filial->id;
                return $this->response(array('status' => 'success', 'id' => $new_id)); 
            } catch (Exception $ex) {

            }
            
        } else {
            return $this->response(array('status' => 'error', 'errors' => e($validator->error())));
        }
    }
    
    public function post_search() {
        //var_dump(Fuel\Core\Input::post()); die();
        $model = Model_Filial::query()->select('id', 'title');
        if(Fuel\Core\Input::post('organisation_id') !== '')
            $model->where ('organisation_id', Fuel\Core\Input::post('organisation_id'));
        else
            return array ();
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
