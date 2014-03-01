<?php

class Controller_Api_image extends Controller_Api {

    function post_Images() {
        $status = 'failed';
        $message = '';
        if(\Fuel\Core\Input::file()){
            if(\Fuel\Core\Input::post('event_id')) $event_id = \Fuel\Core\Input::post('event_id');
            if(\Fuel\Core\Input::post('comment')) $comment = \Fuel\Core\Input::post('comment');
            if(\Fuel\Core\Input::post('user_id')) $user_id = \Fuel\Core\Input::post('user_id');
            try {
                if(\Fuel\Core\Upload::is_valid()){
                    \Fuel\Core\Upload::save('files/events/event_'.$event_id);
                    $model = \Model_Images::forge(array(
                        'event_id' => $event_id,
                        'user_id' => $user_id,
                        'comment' => $comment,
                        ));
                    $model->save();
                    $status = 'success';
                }
            } catch (Exception $e){
                    $status = 'failed';
                    $message = $e->getMessage();
            }
        }      
        return $this->response(array('status' => $status, 'message' => $message));
    }

}

?>
