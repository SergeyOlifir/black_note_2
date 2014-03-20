<?php
class Controller_Auth extends Controller_Application {
        
    public function before() {
        \Fuel\Core\Lang::load('auth', 'auth');
        parent::before();
    }

    public function action_register($hash = null) {
        $status = 'failed';
        $error_string = '';
        $validation_errors = array();
        \Lang::load('auth', 'auth', 'en');
        if (\Input::method() == 'POST') {
            $validator = Validation::forge('registr');
            $validator->add_field('username', 'User Name', 'required');
            $validator->add_field('password', 'Password', 'required|min_length[3]|max_length[10]');//match_field
            $validator->add_field('confpass', 'Confirm Password', 'match_field[password]');
            $validator->add_field('emale', 'Emale', 'required|valid_email');
            if ( $validator->run()) {
                try {
                    $created = \Auth::create_user(
                        $validator->validated('username'),
                        $validator->validated('password'),
                        $validator->validated('emale'),
                        \Config::get('application.user.default_group', 3),
                        array(
                            
                        )
                    );
                    if ($created) {
                        //$status = 'success';
                        $user = \Model\Auth_User::find_by_id($created);
                        //$hash = \Auth::instance()->hash_password( \Str::random('sha1')).$user->id;
                        $hash = \Str::random('sha1').$user->id;
                        \Auth::update_user(
                            array(
                                'newuser_hash' => $hash,
                                'newuser_created' => time()
                            ),
                            $user->username
                        );
                        
                        $email = Email::forge();
                        $email->from('info@eventpics.com', 'no-reply');
                        $email->subject('EventPics Email Confirmation');
                        $email->to($user->email);
                        $email->body("EventPics Email Confirmation. \n To finish registration on EventPics please naviagte to the link below \n" . \Uri::create('auth/register/'. urlencode($hash) . " \n The link is valid next 30 minutes"));
                        try {
                            $email->send();
                            $status = 'success';
                            $error_string = 'Check Email fo next instructions';
                        } catch(\EmailValidationFailedException $e) {
                            $status = 'failed';
                            $error_string = 'Validation Error';
                            $validation_errors = array('recipients' => 'Invalid');
                        } catch(\EmailSendingFailedException $e) {
                            $status = 'failed';
                            $error_string = 'Error Sending Mail';
                        }
                        
                    } else {
                        $status = 'failed';
                        $error_string = 'creating a new user failed';
                    }
                }
                catch (\SimpleUserUpdateException $e) {
                    if ($e->getCode() == 2) {
                        $status = 'failed';
                        $error_string = __('auth.email-already-exists');
                    }

                    // duplicate username
                    elseif ($e->getCode() == 3) {
                        $status = 'failed';
                        $error_string = __('auth.username-already-exists');
                    }

                    // this can't happen, but you'll never know...
                    else {
                        $status = 'failed';
                        $error_string = $e->getMessage();
                        echo ($e->getMessage());
                    }
                }
            } else {
                $status = 'failed';
                $error_string = 'Validation Error';
                $validation_errors = e($validator->error());
            }
            return \Fuel\Core\Format::forge(array('status' => $status, 'error-string' => $error_string, 'validation_errors' => $validation_errors))->to_json();
        } elseif ($hash !== null) {
            $user = substr($hash, 40);
            if ($user = \Model\Auth_User::find_by_id($user)) {
                if (isset($user->newuser_hash) and $user->newuser_hash == $hash and time() - $user->newuser_created < 86400) {
                    \Auth::update_user(
                        array(
                            'newuser_hash' => null,
                            'newuser_created' => null
                        ),
                        $user->username
                    );

                    $this->SetNotice("info", "Email successfully confirmed");
                    \Response::redirect('/');
                }
            }

            $this->SetNotice("danger", "This link is invalid");
            \Response::redirect('/');
        } 
    }

    public function action_login() {
        if (\Auth::check()) {

        }
        if (\Input::method() == 'POST') {
            $status = 'failed';
            $message = 'hui';
            if (\Auth::instance()->login(\Input::param('username'), \Input::param('password'))) {
                if (\Input::param('remember', false)) {
                    \Auth::remember_me();
                } else {
                    \Auth::dont_remember_me();
                }
                $status = 'success';
                if(\Auth\Auth::get('newuser_created')) {
                    \Auth::dont_remember_me();
                    \Auth::logout();
                    $status = 'failed';
                    $message = __('auth.login.error');
                }
            } else {
                $status = 'failed';
                $message = __('auth.login.error');
            }
        }

        return \Fuel\Core\Format::forge(array('status' => $status, 'message' => $message))->to_json();
    }

    public function action_logout() {
        \Auth::dont_remember_me();
        \Auth::logout();
        \Response::redirect_back();
    }
    
    public function action_forgotpassword($hash = null) {
        if (\Input::method() == 'POST') {
            $status = 'failed';
            $error_string = 'User not found';
            $validation_errors = array();
            if ($email = \Input::post('email')) {
                if ($user = \Model\Auth_User::find_by_email($email)) {
                    $hash = \Str::random('sha1').$user->id;
                    \Auth::update_user(
                        array(
                            'lostpassword_hash' => $hash,
                            'lostpassword_created' => time()
                        ),
                        $user->username
                    );

                    $email = Email::forge();
                    $email->from('info@eventpics.com', 'no-reply');
                    $email->subject('EventPics Password Recovery');
                    $email->to(\Input::post('email'));
                    $email->body("EventPics Password Recovery. \n To restore your password please naviagte to the link below \n" . \Uri::create('auth/forgotpassword/'. urlencode($hash) . " \n The link is valid next 30 minutes"));
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
                }
            } else {
                \Response::redirect('/');
            }

            return \Fuel\Core\Format::forge(array('status' => $status, 'error-string' => $error_string, 'validation_errors' => $validation_errors))->to_json();
        } elseif ($hash !== null) {
            $user = substr($hash, 40);
            if ($user = \Model\Auth_User::find_by_id($user)) {
                if (isset($user->lostpassword_hash) and $user->lostpassword_hash == $hash and time() - $user->lostpassword_created < 86400) {
                    \Auth::update_user(
                        array(
                            'lostpassword_hash' => null,
                            'lostpassword_created' => null
                        ),
                        $user->username
                    );

                    if (\Auth::instance()->force_login($user->id)) {
                        $this->SetNotice("info", "Enter new password");
                        Fuel\Core\Session::set('recover', 1);
                        \Response::redirect('/host/profile/recover');
                    }
                }
            }

            $this->SetNotice("danger", "This link is invalid");
            \Response::redirect('/');
        } else {
            \Fuel\Core\Response::redirect('/');
        }
    }

}