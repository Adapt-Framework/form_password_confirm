<?php

namespace adapt\forms\password_confirm{
    
    /*
     * Prevent direct access
     */
    defined('ADAPT_STARTED') or die;
    
    class view_field_password_confirm_indicator extends \adapt\forms\view_form_page_section_group_field{
        
        public function __construct($form_data, $data_type, $user_data){
            parent::__construct($form_data, $data_type, $user_data);
            $this->add_class('field input password-confirm-indicator');
            
            
            $group = new html_div(array('class' => 'form-group'));
            $this->add($group);
            
            /* Create the control */
            $control = new html_input(array('type' => 'password', 'name' => $form_data['name'], 'class' => 'form-control'));
            $control->set_id();
            
            /* Add the label */
            if (isset($form_data['label']) && trim($form_data['label']) != ''){
                $group->add(new html_label($form_data['label'], array('for' => $control->attr('id'), 'class' => 'control-label')));
            }
            
            /* Add the control */
            $group->add($control);
            
            /* Add the decription */
            if (isset($form_data['description']) && trim($form_data['description']) != ''){
                $group->add(new html_p($form_data['description'], array('class' => 'help-block')));
            }
            
            /* Do we have a placeholder label? */
            if (isset($form_data['placeholder_label']) && trim($form_data['placeholder_label']) != ''){
                $control->attr('placeholder', $form_data['placeholder_label']);
            }
            
            /* Load the data type for this field */
            $data_type = $this->data_source->get_data_type($form_data['data_type_id']);
            
            //print new html_pre(print_r($data_type, true));
            
            /* Do we have a validator? */
            if (isset($data_type['validator']) && trim($data_type['validator']) != ''){
                $control->attr('data-validator', $data_type['validator']);
            }
            
            /* Does the field or data type have a max length? */
            if (isset($form_data['max_length']) && trim($form_data['max_length']) != ""){
                $control->attr('data-max-length', $form_data['max_length']);
            }elseif (isset($data_type['max_length']) && trim($data_type['max_length']) != ''){
                $control->attr('data-max-length', $data_type['max_length']);
            }
            
            /* Is the field mandatory? */
            if (isset($form_data['mandatory']) && strtolower($form_data['mandatory']) == "yes"){
                /* Mark the label */
                $group->find('label')->append(
                    new html_sup(
                        array(
                            '*',
                            new html_span(' (This field is required)', array('class' => 'sr-only'))
                        )
                    )
                );
                
                /* Is it a mandatory group? */
                if (isset($form_data['mandatory_group']) && trim($form_data['mandatory_group']) != ""){
                    $control->attr('data-mandatory', 'group');
                    $control->attr('data-mandatory-group', $form_data['mandatory_group']);
                }else{
                    $control->attr('data-mandatory', 'Yes');
                }
            }
            
            
            /* Lets add the password strength indicator */
            $progress_bar = new \bootstrap\views\view_progress_bar(
                0,
                \bootstrap\views\view_progress_bar::DANGER,
                true
            );
            $progress_bar->find('span')->clear()->append('Weak password');
            $this->add($progress_bar);
            
            /* Add a confirm password box */
            $group = new html_div(array('class' => 'form-group'));
            $control = new html_input(array('type' => 'password', 'name' => 'confirm_password', 'class' => 'form-control'));
            $control->set_id();
            $group->add(new html_label('Confirm password', array('for' => $control->attr('id'), 'class' => 'control-label')));
            
            if (isset($form_data['mandatory']) && strtolower($form_data['mandatory']) == "yes"){
                /* Mark the label */
                $group->find('label')->append(
                    new html_sup(
                        array(
                            '*',
                            new html_span(' (This field is required)', array('class' => 'sr-only'))
                        )
                    )
                );
                
                $control->attr('data-mandatory', 'Yes');
            }
            
            //if (isset($data_type['validator']) && trim($data_type['validator']) != ''){
            //    $control->attr('data-validator', $data_type['validator']);
            //}
            
            /* Does the field or data type have a max length? */
            if (isset($form_data['max_length']) && trim($form_data['max_length']) != ""){
                $control->attr('data-max-length', $form_data['max_length']);
            }elseif (isset($data_type['max_length']) && trim($data_type['max_length']) != ''){
                $control->attr('data-max-length', $data_type['max_length']);
            }
            
            $group->add($control);
            $this->add($group);
            
        }
        
    }
    
}

?>