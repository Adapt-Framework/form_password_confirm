<?php

namespace extensions\form_password_confirm;
use \frameworks\adapt as adapt;

/* Prevent direct access */
defined('ADAPT_STARTED') or die;

$adapt = $GLOBALS['adapt'];

/*
 * Include  css & javascript
 */
//$adapt->dom->head->add(new html_link(array('rel' => 'stylesheet', 'type' => 'text/css', 'href' => '/adapt/extensions/form_password_confirm/static/css/form_password_confirm.css')));
$adapt->dom->head->add(new adapt\html_script(array('type' => 'text/javascript', 'src' => '/adapt/extensions/form_password_confirm/static/js/form_password_confirm.js')));


?>