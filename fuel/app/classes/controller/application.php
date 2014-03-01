<?php
class Controller_Application extends Controller_Template {
    public $template = 'gwest/template';
    
    protected function SetNotice($notiseType, $notiseText) {
        Session::set('notice_type', $notiseType);
        Session::set_flash('notice', $notiseText);
    }
    
    protected function RegisterJs($files) {
        $this->template->scripts = $files;
    }
    
    protected function RegisterCss($files) {
        $this->template->stylesheets = $files;
    }
    
}

?>