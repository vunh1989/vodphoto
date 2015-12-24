<?php

/**
 * Plugin Name: Mini Cart
 * Plugin URI: mailto:leduongkhang@gmail.com
 * Description: Mini Shoping Cart
 * Version:     1.1.0
 * Author:      Le Duong Khang
 * Author URI:  mailto:leduongkhang@gmail.com
 * Text Domain: omw-mini-cart
 * 
 * @package   omw-mini-cart
 * @version   1.1.0
 * @author    Le Duong Khang <leduongkhang@gmail.com>
 * @copyright Copyright (c) 2015, Le Duong Khang
 * @link      http://onmyway.vn
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}


define('OMW_MINI_CART_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once 'includes/class-pw-template-loader.php';

class omw_mini_cart {

    /**
     * A Unique Identifier
     */
    protected $roles;
    protected $plugin_dir;
    protected $plugin_url;
    protected $assets_dir;
    protected $assets_url;
    //
    protected $theme_template_directory = 'templates';

    /**
     * A reference to an instance of this class.
     */
    private static $instance;

    /**
     * The array of templates that this plugin tracks.
     */
    protected $templates = array();

    /**
     *
     */
    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new omw_mini_cart();
        }
        return self::$instance;
    }

    public function __construct() {

        $this->plugin_dir = plugin_dir_path(__FILE__);
        $this->plugin_url = esc_url(trailingslashit(plugins_url(dirname(__FILE__))));
        $this->assets_dir = trailingslashit(dirname(__FILE__)) . 'assets';
        $this->assets_url = esc_url(trailingslashit(plugins_url('assets', __FILE__)));
        //
        // define custom roles - member plugin
        $this->roles = array('sale_staff', 'distribution_staff', 'b2b_customer');

        // Register pages
        add_action('init', array($this, 'register_table'));
        // Load frontend JS & CSS
        add_action('wp_enqueue_scripts', array($this, 'register_styles'), 10);
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'), 10);

        // Add short code
        add_shortcode('omw-mini-cart', array($this, 'print_shortcode'), 10, 1);
        //
    }

    /**
     * Add Short Code
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    public function print_shortcode($type) {
        extract(shortcode_atts(array(
            'type' => 'type',
                        ), $type));
        //
        ob_start();
        $template = new mini_cart_PW_Template_Loader();

        switch ($type) {
            case 'order-list':
                $template->get_template_part('product-order');
                break;
        }

        return ob_get_clean();
    }

    /**
     * Load frontend CSS.
     * @access  public
     * @since   1.0.0
     * @return void
     */
    public function register_styles() {
        wp_register_style('css-omw-frontend', $this->assets_url . 'css/style.css', array(), '1.0');
        wp_enqueue_style('css-omw-frontend');
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
        wp_register_script('js-own-plugin-frontend-cookie', $this->assets_url . 'js/jquery.cookie.js', array('jquery'), '1.4.1', TRUE);
        wp_enqueue_script('js-own-plugin-frontend-cookie');
        wp_register_script('js-own-plugin-frontend', $this->assets_url . 'js/minicart.js', array('cookie'), '1.0', TRUE);
        wp_enqueue_script('js-own-plugin-frontend');
        //
        $dataToBePassed = array(
            'plugin_url' => $this->plugin_url,
        );
        wp_localize_script('js-owm-frontend', 'omw_vars', $dataToBePassed);
    }

    /**
     * 
     * order_status: incomplete,pending,process,partially_shipped,shipping,shiped,partially_returned,returned,canceled
     * @global type $wpdb
     */
    public function register_table() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'mini_cart';

        $sql_1 = "CREATE TABLE $table_name (
            id int(12) NOT NULL AUTO_INCREMENT,
            id_user int(12) NOT NULL,
            username varchar(32) NOT NULL,
            email varchar(255) NOT NULL,
            order_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            id_product int(12) NOT NULL,
            id_product_type varchar(32) NOT NULL,
            product_image varchar (255) NULL,
            quantity int(12) DEFAULT '0' NOT NULL,
            price int(12) DEFAULT '0' NOT NULL,
            price_total int(12) DEFAULT '0' NOT NULL,
            order_status varchar(32) DEFAULT '' NOT NULL,
            order_status_last_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            UNIQUE KEY id (id)
            ) $charset_collate;";
        
        $table_minicart_history = $wpdb->prefix . 'mini_cart_history';
        
        $sql_2 = "CREATE TABLE $table_minicart_history (
            id int(12) NOT NULL AUTO_INCREMENT,
            id_product int(12) NOT NULL,
            order_status varchar(32) DEFAULT '' NOT NULL,
            order_status_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            UNIQUE KEY id (id)
                ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql_1);
        dbDelta($sql_2);
    }

    /**
     * 
     */
    public function add_to_cart() {
        global $wp_query;
        global $wpdb;
        //
        if (isset($wp_query->query['pagename'])) {
            if ($wp_query->query['pagename'] == 'download') {
                if (current_user_can('manage_options')) {
                    
                }
            }
        }
    }

    public function remove_from_cart() {
        
    }

}

$omw_mini_cart = new omw_mini_cart();
