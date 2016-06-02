<?php

namespace adapt\forms\password_confirm{
    
    /* Prevent Direct Access */
    defined('ADAPT_STARTED') or die;
    
    class bundle_form_password_confirm extends \adapt\bundle{
        
        public function __construct($data){
            parent::__construct('form_password_confirm', $data);
        }
        
        public function boot(){
            if (parent::boot()){
                
                $this->dom->head->add(new html_script(array('type' => 'text/javascript', 'src' => "/adapt/form_password_confirm/form_password_confirm-{$this->version}/static/js/form_password_confirm.js")));
                return true;
            }
            
            return false;
        }
        
    }
    
    
}

?>