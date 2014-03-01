<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of events
 *
 * @author juise_man
 */
class Controller_Host_Events extends Controller_Host {
    
    public function before() {
        \Fuel\Core\Lang::load('events', 'events');
        parent::before();
    }
    
    public function action_edit($id = null) {
        
        if(\Fuel\Core\Input::post()) {
            if(isset($id) and $event = Model_Event::find($id)) {
                $status = 'failed';
                $error_string = '';
                $validation_errors = array();
                if(\Fuel\Core\Input::post()) {
                    $validator = \Fuel\Core\Validation::forge('create_event');
                    $validator->add_field('eventname', 'Your eventname', 'required|max_length[200]');
                    $validator->add_field('description', 'Your description', 'required|max_length[1000]');//match_field
                    $validator->add_field('place','Place', 'required');
                    $validator->add_field('date', 'Your date', 'required|valid_date[m-d-Y H:i]');
                    if($validator->run()) {
                        try {
                            $fields = $validator->validated();
                            $event->title = $fields['eventname'];
                            $event->description = $fields['description'];
                            $event->place = $fields['place'];
                            $event->start_date = Date::create_from_string($fields['date'], 'my')->get_timestamp();
                            $event->public = Input::post('public');

                            $event->save();
                            $status = 'success';
                        } catch (Exception $e) {
                            $error_string = $e->getMessage();

                        }
                    } else {
                        $status = 'failed';
                        $error_string = 'Validation Error';
                        $validation_errors = e($validator->error());
                    }
                } else {
                    $status = 'failed';
                    $error_string = 'Event not found';
                }

                return \Fuel\Core\Format::forge(array('status' => $status, 'error-string' => $error_string, 'validation_errors' => $validation_errors))->to_json();
            
            }
        }
        
        if(isset($id) and $event = Model_Event::find($id)) {
            $this->template->content = \Fuel\Core\View::forge('host/layout/events/edit', array('event' => $event));
        } else {
            $this->template->content = \Fuel\Core\View::forge('host/layout/events/edit');
        }
    }
    
    public function action_pay($id=NULL) {
        $config = array (
            'mode' => 'sandbox' , 
            'acct1.UserName' => 'jb-us-seller_api1.paypal.com',
            'acct1.Password' => 'WX4WTU3S8MY44S7F', 
            'acct1.Signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31A7yDhhsPUU2XhtMoZXsWHFxu-RWy'
        );
        require APPPATH.'classes/libs/paypal/bootstrap.php';
        define("PP_CONFIG_PATH", APPPATH.'classes/libs/paypal');
        $clientId = 'AbXHAhC_51uCLw6_hBC_mj0txuOBOcw6-wtTuauDaO-Hk4diyCn7D4Cg4FVh';
        $clientSecret = 'EKMYshAEd2MiIridIyCIgox7o5cAv_pxZkv-dYoTXTEdpKgE7QpFpwvDcWLk';
        $apiContext = new \PayPal\Rest\ApiContext(new PayPal\Auth\OAuthTokenCredential(
        $clientId, $clientSecret));
        $apiContext->setConfig(array('mode' => 'sandbox',
			'http.ConnectionTimeOut' => 30,
			'log.LogEnabled' => true,
			'log.FileName' => '../PayPal.log',
			'log.LogLevel' => 'FINE'));
        $payer = new \PayPal\Api\Payer;
        $payer->setPaymentMethod('paypal');
        $amount = new PayPal\Api\Amount();
        $amount->setCurrency('USD');
        $amount->setTotal('10');
        $item = new PayPal\Api\Item();
        $item->setName('test')->setCurrency('USD')->setQuantity(1)->setPrice('10');
        $item->setSku('12121212');
        $itemList = new \PayPal\Api\ItemList();
        $itemList->setItems(array($item));
        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('PAYMENT TEST');
        $transaction->setItemList($itemList);
        $payment = new PayPal\Api\Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));
        $payment->setRedirectUrls(array('return_url' => 'http://google.ru', 'cancel_url' => 'http://yandex.ru'));
        $payment->create($apiContext);
        $payment->getId();
        $links = $payment->getLinks();
        foreach ($links as $link) {
            if ($link->getMethod() == 'REDIRECT') {
                Response::redirect($link->getHref(), 'refresh');
                //var_dump($link->getHref()); die();
                //header('location:'.$link->getHref());
                return;
            }
        }
        
        $this->template->content = \Fuel\Core\View::forge('host/layout/events/pay', array('id' => $id));
    }

        public function action_index() {
        $filters=array('status' => array(
                                    'Choose status events'=>'default', 
                                    'draft' => 'draft'), 
                                'public' => array(
                                    'Choose public events' => 'default',
                                    'published' => '1',
                                    'unpublished' => '0',
                                ));
        $sorts=array(
            'start_date' => array(
                'Sort by date' => 'default',
                'ascending' => 'asc',
                'descending' => 'desc',
            )
        );
        if (!Fuel\Core\Input::post()) {
           $user = Controller_Host::GetLogedInUser();
           $events = $user->events;
       } else {
           $events = Controller_Host::GetLogedInUser(Fuel\Core\Input::post());
       }     
      
       $this->template->content = \Fuel\Core\View::forge('host/layout/events/index', array(
           'events' => $events,
           'sorts' => $sorts,
           'filters' => $filters,
           'post' => Fuel\Core\Input::post(),
               ), FALSE);
    }
    
    public function action_create() {
        $status = 'failed';
        $error_string = '';
        $validation_errors = array();
        if(\Fuel\Core\Input::post()) {
            $validator = \Fuel\Core\Validation::forge('create_event');
            $validator->add_field('eventname', 'Your eventname', 'required|max_length[200]');
            $validator->add_field('description', 'Your description', 'required|max_length[1000]');//match_field
            $validator->add_field('place','Place', 'required');
            $validator->add_field('date', 'Your date', 'required|valid_date[m-d-Y H:i]');
            
            if($validator->run()) {
                $event = '';
                try {
                    $fields = $validator->validated();
                    $id = Auth::get_user_id();
                    $id = $id[1];
                    $event = Model_Event::forge(array(
                        'title' => $fields['eventname'],
                        'description' => $fields['description'],
                        'place' => $fields['place'],
                        'start_date' => Date::create_from_string($fields['date'], 'my')->get_timestamp(),
                        'end_date' => Date::create_from_string($fields['date'], 'my')->get_timestamp(),
                        'public' => Input::post('public'),
                        'status' => 'draft',
                        'code' => Model_Event::GenerateKey(),
                        'pakage_id' => 0,
                        'user_id' => $id
                    ));
                    
                    $event->save();
                    $status = 'success';
                } catch (Exception $e) {
                    $error_string = $e->getMessage();
                    
                }
            } else {
                $status = 'failed';
                $error_string = 'Validation Error';
                $validation_errors = e($validator->error());
            }
        }
        
        return \Fuel\Core\Format::forge(array('status' => $status, 'error-string' => $error_string, 'validation_errors' => $validation_errors))->to_json();
            
    }
    
    public function action_invite($id = null) {
        isset($id) ? $event = Model_Event::find($id) : $event = null;
        if(Fuel\Core\Input::post()) {
            $status = 'failed';
            $error_string = '';
            $validation_errors = array();
            $validator = Fuel\Core\Validation::forge('invite_validator');
            $validator->add_field('recipients', 'Your recipients', 'required');
            $validator->add_field('subject', 'Your subject', 'required|max_length[250]');//match_field
            $validator->add_field('message','message', 'required');
            
            if($validator->run()) {
                $fields = $validator->validated();
                $email = Email::forge();
                $email->from('info@eventpics.com', 'no-reply');
                $email->subject($fields['subject']);
                $email->to(explode(';', str_replace(' ', '', $fields['recipients'])));
                $email->body($fields['message']);
                try {
                    $email->send();
                    $status = 'success';
                } catch(\EmailValidationFailedException $e) {
                    $status = 'failed';
                    $error_string = 'Validation Error';
                    $validation_errors = array('recipients' => 'Invalid');
                } catch(\EmailSendingFailedException $e) {
                    $status = 'failed';
                    $error_string = 'Error';
                }
            } else {
                $status = 'failed';
                $error_string = 'Validation Error';
                $validation_errors = e($validator->error());
            }
            
            return \Fuel\Core\Format::forge(array('status' => $status, 'error-string' => $error_string, 'validation_errors' => $validation_errors))->to_json();
       
        } else {
            $this->template->content = View::forge('host/layout/events/invite', array('event' => $event));
        }
    }
    
    public function action_view($id = null, $deleteID = null) {
        isset($id) ? $event = Model_Event::find($id) : $event = null;
        $this->template->content = View::forge('host/layout/events/view', array('event' => $event));
    }
    
    public function action_delete($id = null) {
        is_null($id) and Response::redirect('host/events');
        if ($image = Model_Images::find($id)) {
            $event_id = $image->event_id;
            $image->delete();
            $this->SetNotice('success', 'Deleted image #' . $id);
        } else {
            $this->SetNotice('error', 'Could not delete image #' . $id);
        }
        Response::redirect("host/events/view/{$event_id}");
    }
            
    function action_image() {
        $files ='';
        $user_id = Auth::get_user_id();
        $user_id = $user_id[1];
        if(\Fuel\Core\Input::file()){
            if(\Fuel\Core\Input::post('event_id')) $event_id = \Fuel\Core\Input::post('event_id');
            if(\Fuel\Core\Input::post('comment')) $comment = \Fuel\Core\Input::post('comment');
                if(\Fuel\Core\Upload::is_valid()){
                    \Fuel\Core\Upload::save('files/events/event_'.$event_id);
                    $model = \Model_Images::forge(array(
                        'event_id' => $event_id,
                        'user_id' => $user_id,
                        'comment' => $comment,
                        ));
                    $model->save();
                } else {
                    $files = \Fuel\Core\Upload::get_errors();
                }           
        }     
        $this->template->content = View::forge('host/layout/events/image', array('files'=>$files));
    }
    

}

?>
