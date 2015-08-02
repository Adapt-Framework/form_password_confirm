<?php

namespace extensions\form_password_confirm{
    
    /*
     * Prevent direct access
     */
    defined('ADAPT_STARTED') or die;
    
    class view_field_password_confirm_indicator extends \extensions\forms\view_field{
        
        public function __construct($form_data, $user_data){
            parent::__construct($form_data, $user_data);
            $this->add_class('field input password-confirm-indicator');
            $group = new html_div(array('class' => 'form-group'));
            $this->add($group);
            
            /* Create the control */
            $control = new html_input(array('type' => 'password', 'name' => $form_data['form_page_section_group_field']['name'], 'class' => 'form-control'));
            $control->set_id();
            
            /* Add the label */
            if (isset($form_data['form_page_section_group_field']['label']) && trim($form_data['form_page_section_group_field']['label']) != ''){
                $group->add(new html_label($form_data['form_page_section_group_field']['label'], array('for' => $control->attr('id'), 'class' => 'control-label')));
            }
            
            /* Add the control */
            $group->add($control);
            
            /* Add the decription */
            if (isset($form_data['form_page_section_group_field']['description']) && trim($form_data['form_page_section_group_field']['description']) != ''){
                $group->add(new html_p($form_data['form_page_section_group_field']['description'], array('class' => 'help-block')));
            }
            
            /* Do we have a placeholder label? */
            if (isset($form_data['form_page_section_group_field']['placeholder_label']) && trim($form_data['form_page_section_group_field']['placeholder_label']) != ''){
                $control->attr('placeholder', $form_data['form_page_section_group_field']['placeholder_label']);
            }
            
            /* Load the data type for this field */
            $data_type = $this->data_source->get_data_type($form_data['form_page_section_group_field']['data_type_id']);
            
            //print new html_pre(print_r($data_type, true));
            
            /* Do we have a validator? */
            if (isset($data_type['validator']) && trim($data_type['validator']) != ''){
                $control->attr('data-validator', $data_type['validator']);
            }
            
            /* Does the field or data type have a max length? */
            if (isset($form_data['form_page_section_group_field']['max_length']) && trim($form_data['form_page_section_group_field']['max_length']) != ""){
                $control->attr('data-max-length', $form_data['form_page_section_group_field']['max_length']);
            }elseif (isset($data_type['max_length']) && trim($data_type['max_length']) != ''){
                $control->attr('data-max-length', $data_type['max_length']);
            }
            
            /* Is the field mandatory? */
            if (isset($form_data['form_page_section_group_field']['mandatory']) && strtolower($form_data['form_page_section_group_field']['mandatory']) == "yes"){
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
                if (isset($form_data['form_page_section_group_field']['mandatory_group']) && trim($form_data['form_page_section_group_field']['mandatory_group']) != ""){
                    $control->attr('data-mandatory', 'group');
                    $control->attr('data-mandatory-group', $form_data['form_page_section_group_field']['mandatory_group']);
                }else{
                    $control->attr('data-mandatory', 'Yes');
                }
            }
            
            
            /* Lets add the password strength indicator */
            $progress_bar = new \extensions\bootstrap_views\view_progress_bar(
                0,
                \extensions\bootstrap_views\view_progress_bar::DANGER,
                true
            );
            $progress_bar->find('span')->clear()->append('Weak password');
            $this->add($progress_bar);
            
            /* Add a confirm password box */
            $group = new html_div(array('class' => 'form-group'));
            $control = new html_input(array('type' => 'password', 'name' => 'confirm_password', 'class' => 'form-control'));
            $control->set_id();
            $group->add(new html_label('Confirm password', array('for' => $control->attr('id'), 'class' => 'control-label')));
            
            if (isset($form_data['form_page_section_group_field']['mandatory']) && strtolower($form_data['form_page_section_group_field']['mandatory']) == "yes"){
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
            if (isset($form_data['form_page_section_group_field']['max_length']) && trim($form_data['form_page_section_group_field']['max_length']) != ""){
                $control->attr('data-max-length', $form_data['form_page_section_group_field']['max_length']);
            }elseif (isset($data_type['max_length']) && trim($data_type['max_length']) != ''){
                $control->attr('data-max-length', $data_type['max_length']);
            }
            
            $group->add($control);
            $this->add($group);
            
        }
        
    }
    
}

?>