<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author juise_man
 */
class Controller_Api_User extends Controller_Api {
    
    public function post_JoinToEvent() {
        $status = "false";
        $message = "";
        
        if(!\Fuel\Core\Input::post('user_id') or !\Fuel\Core\Input::post('code')) {
            $message = "Event not Found";
            return $this->response(array('status' => $status, 'message' => $message));
        }
        
        $user_id = \Fuel\Core\Input::post('user_id');
        $code = \Fuel\Core\Input::post('code');
        
        if($user = Model_User::find($user_id)) {
            if($event = Model_Event::FindeByKey($code)) {
                if($event->JoinUserToEvent($user)) {
                    $status = "true";
                    $message = "Event Aded";
                } else {
                    $status = "false";
                    $message = "Event is already assigned";
                }
            } else {
                $message .= "Event not Found";
            }
        } else {
           $message .= "User not Found";
        }
        
        return $this->response(array('status' => $status, 'message' => $message));
        
        //5242fdb9015996-37746414
    }
    
    public function get_JoinedEvents($user_id) {
        if(isset($user_id) and $user = Model_User::find($user_id)) {
            $events = '';
            foreach($user->joined_events as $key => $event) {
                $events[] = array(
                    'id' => $event->id,
                    'name' => $event->title,
                    'description' => $event->description,
                    'date' => \Fuel\Core\Date::forge((int)$event->start_date)->format('us_named'),
                    'status' => $event->status,
                    'place' => $event->place
                );
            }
            return $this->response(array('events' => $events));
        }
    }
}

?>
