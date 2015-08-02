<?php

/*
 * Prevent direct access
 */
defined('ADAPT_STARTED') or die;

/* Lets register the field type in forms */
$field_type = new model_form_field_type();
$field_type->bundle_name = 'form_password_confirm';
$field_type->name = 'Password confirmation with indicator';
$field_type->view = '\\extensions\\form_password_confirm\\view_field_password_confirm_indicator';
$field_type->save();


?>