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
            $fields['logo'] = '/files/avatars/no_foto.jpg';
            $fields['raiting'] = 0;
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
        
        $organizationType = Fuel\Core\Input::post('organisation_type') != '' ?
                Fuel\Core\Input::post('organisation_type') : 'null';
        $actionType = Fuel\Core\Input::post('sfera_type') != '' ?
                Fuel\Core\Input::post('sfera_type') : 'null';
        $countryID = Fuel\Core\Input::post('country_id') != '' ?
                Fuel\Core\Input::post('country_id') : 'null';
        $regionID = Fuel\Core\Input::post('region_id') != '' ?
                Fuel\Core\Input::post('region_id') : 'null';
        $cityID = Fuel\Core\Input::post('sity_id') != '' ?
                Fuel\Core\Input::post('sity_id') : 'null';
        
        $sql = 'SELECT DISTINCT org.id as \'id\', org.title as \'title\'
                FROM organisations as org
                LEFT JOIN filials as fil
                ON fil.organisation_id = org.id
                WHERE 
                    ('.$organizationType.' IS NULL OR org.organisation_type = '.$organizationType.') 
                AND 
                    ('.$actionType.' IS NULL OR org.sfera_type = '.$actionType.')
                AND (
                    (
                        ('.$countryID.' IS NULL OR org.country_id = '.$countryID.') 
                                AND 
                        ('.$regionID.' IS NULL OR org.region_id = '.$regionID.') 
                                AND 
                        ('.$cityID.' IS NULL OR org.sity_id = '.$cityID.')
                    ) 
                    OR
                    (
                        ('.$countryID.' IS NULL OR fil.country_id = '.$countryID.') 
                                AND 
                        ('.$regionID.' IS NULL OR fil.region_id = '.$regionID.') 
                                AND 
                        ('.$cityID.' IS NULL OR fil.sity_id = '.$cityID.')
                    )  
                )';
        
        $result = Fuel\Core\DB::query($sql, Fuel\Core\DB::SELECT);
        //$result->
        //echo '<pre>';
        //var_dump($result->execute()); echo '</pre>'; die('hui');
        return $this->response($result->execute());
        
        /*
        $model = Model_Organisation::query()->select('id', 'title');
        $filials = Model_Filial::query()->select('id', 'title');
        if(Fuel\Core\Input::post('organisation_type') !== '')
            $model->where ('organisation_type', Fuel\Core\Input::post('organisation_type'));
        if(Fuel\Core\Input::post('sfera_type') !== '')
            $model->where ('sfera_type', Fuel\Core\Input::post('sfera_type'));
        if(Fuel\Core\Input::post('country_id') !== '')
            $model->where ('country_id',  Fuel\Core\Input::post('country_id'));
        if(Fuel\Core\Input::post('region_id') !== '')
            $model->where ('region_id', Fuel\Core\Input::post('region_id'));
        if(Fuel\Core\Input::post('sity_id') !== '')
            $model->where ('sity_id', Fuel\Core\Input::post('sity_id'));
        
        //$model = $model->get();
        return $this->response($model->get());
        */
    }
}
