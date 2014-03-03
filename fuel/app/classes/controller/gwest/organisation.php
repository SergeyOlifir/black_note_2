<?php

class Controller_Gwest_Organisation extends Controller_Gwest {
    public function action_view($id) {
        !isset($id) and \Fuel\Core\Response::redirect('/');
        if($model = Model_Organisation::find($id) and $model->status == 2) {
            $this->template->content = Fuel\Core\View::forge('gwest/organisation/view', array('organisation' => $model));
        } else {
            \Fuel\Core\Response::redirect('/404.html');
        }
    }
    
    public function action_voteup($id) {
        !isset($id) and \Fuel\Core\Response::redirect_back();
        if($this->AuthCheck() and $model = Model_Organisation::find($id) and Model_Vote::query()->where('user_id', self::GetLogedInUser()->id)->where('organisation_id', $model->id)->count() < 1) {
            try {
                $model->raiting++;
                $model->save();
                Model_Vote::forge(array(
                    'user_id' => self::GetLogedInUser()->id,
                    'organisation_id' => $model->id
                ))->save();
            } catch (Exception $ex) {
                
            }
        }
        
        \Fuel\Core\Response::redirect_back();
    }
    
    public function action_votedown($id) {
        !isset($id) and \Fuel\Core\Response::redirect_back();
        if($this->AuthCheck() and $model = Model_Organisation::find($id) and Model_Vote::query()->where('user_id', self::GetLogedInUser()->id)->where('organisation_id', $model->id)->count() < 1) {
            //var_dump ((Model_Vote::query()->where('user_id', self::GetLogedInUser()->id)->where('organisation_id', $model->id)->count())); die();
            try {
                $model->raiting--;
                $model->save();
                Model_Vote::forge(array(
                    'user_id' => self::GetLogedInUser()->id,
                    'organisation_id' => $model->id
                ))->save();
            } catch (Exception $ex) {
                
            }
        }
        
        \Fuel\Core\Response::redirect_back();
    }
    
    public function action_index() {
        $organisations = Model_Organisation::query()->where('status', 2)->order_by('raiting', 'desc')->get();
        $this->template->content = Fuel\Core\View::forge('gwest/organisation/index', array('organisations' => $organisations));
    }
}
