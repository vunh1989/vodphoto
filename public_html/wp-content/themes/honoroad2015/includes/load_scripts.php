<?php

class register_assets {

    protected $assets_dir;
    protected $assets_url;

    public function __construct() {

        $this->assets_dir = trailingslashit(dirname(__FILE__)) . 'assets';
        $this->assets_url = esc_url(trailingslashit(plugins_url('assets', __FILE__)));

//         Load frontend JS & CSS
        add_action('wp_enqueue_scripts', array($this, 'register_styles'), 10);
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'), 10);
    }

    /**
     * Load frontend CSS.
     * @access  public
     * @since   1.0.0
     * @return void
     */
    public function register_styles() {
        //
    }

    /**
     * Load frontend Javascript.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function register_scripts() {
        //
    }

}

//$register_assets = new register_assets;

/* ---------------------------------------------------------------------------- */

add_action('wp_enqueue_scripts', 'omw_register_load_scripts');

function omw_register_load_scripts() {
//    wp_register_script('my-js', get_template_directory_uri() . '/js/my-js.js', array('jquery'), '', TRUE);
//    wp_enqueue_script('my-js');
    //
    $dataToBePassed = array(
        'home_url' => home_url(),
        'template_url' => get_template_directory_uri(),
    );
    wp_localize_script('js-omw-vars', 'omw_vars', $dataToBePassed);
}
