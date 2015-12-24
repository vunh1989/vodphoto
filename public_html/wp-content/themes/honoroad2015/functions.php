<?php

/*
 * Author: KhangLe
 * 
 * 
 */

include_once (dirname(__FILE__) . '/includes/cpt_acf_definitions.php');
include_once (dirname(__FILE__) . '/includes/my_settings.php');
include_once (dirname(__FILE__) . '/includes/my_functions.php');
include_once (dirname(__FILE__) . '/includes/options_page.php');
include_once (dirname(__FILE__) . '/includes/load_scripts.php');

/* -------------------------------------------------------------------------- */
add_action('init', 'myStartSession', 1);

// init session id
function myStartSession() {
    if (!session_id()) {
        session_start();
    }
}

/* ---------------------------------------------------------------------------- */