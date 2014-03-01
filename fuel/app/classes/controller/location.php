<?php
class Controller_Location extends Fuel\Core\Controller_Rest {
    public function get_country() {
        return $this->response(Model_Country::find('all'));
    }
    
    public function get_region($id = null) {
        if(isset($id) and $country = Model_Country::find($id)) {
            return $this->response($country->regions);
        }
        return $this->response(array());
    }
    
    public function get_sity($id = null) {
        if(isset($id) and $region = Model_Region::find($id)) {
            return $this->response($region->cities);
        }
        return $this->response(array());
    }
    
    public function get_organisationtypes() {
        $types = Model_Organisation::$organisation_types; //Model_Post::$post_types;
        return $this->response($types);
    }
    
    public function get_organisationsferes($type = null) {
        if(isset($type)) {
            if(isset(Model_Organisation::$organisation_sferes_types[$type])) {
                return $this->response(Model_Organisation::$organisation_sferes_types[$type]);
            }
        }
        return $this->response(array());
    }
}
