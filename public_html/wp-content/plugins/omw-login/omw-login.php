<?php

/**
  Plugin Name: Front-End Login
  Plugin URI:
  Description: Login into system from Front-End
  Version:     1.0
  Author:      Le Duong Khang
  Author URI:  mailto:leduongkhang@gmail.com
  License: GPL
  License URI:
  Domain Path:
  Text Domain: omw-login
 */
if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}

define('OMW_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once 'includes/class-pw-template-loader.php';

class omw_login {

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
            self::$instance = new omw_login();
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
        add_action('init', array($this, 'register_pages'));
        // Load frontend JS & CSS
        add_action('wp_enqueue_scripts', array($this, 'register_styles'), 10);
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'), 10);

        // Add a filter to the attributes metabox to inject template into the cache.
        add_filter('page_attributes_dropdown_pages_args', array($this, 'register_project_templates'), 10, 1);

        // Add a filter to the save post to inject out template into the page cache
        add_filter('wp_insert_post_data', array($this, 'register_project_templates'), 10, 1);

        // Add a filter to the template include to determine if the page has our 
        // template assigned and return it's path
        add_filter('template_include', array($this, 'view_project_template'), 10, 1);

        // Add your templates to this array.
        $this->templates = array(
            $this->theme_template_directory . '/login.php' => 'Login',
            $this->theme_template_directory . '/profile.php' => 'Profile',
            $this->theme_template_directory . '/change.php' => 'Change Password',
            $this->theme_template_directory . '/forgot-password.php' => 'Forgot Password',
            $this->theme_template_directory . '/reset-password.php' => 'Reset Password',
            $this->theme_template_directory . '/register.php' => 'Register',
        );

        // Add short code
        add_shortcode('omw-shortcode', array($this, 'print_shortcode'), 10, 1);
        //
        add_filter('user_contactmethods', array($this, 'modify_user_contact_methods'), 10, 1);
        add_action('user_register', array($this, 'register_user_contact_methods'));
        add_filter('login_redirect', array($this, 'omw_login_redirect'), 10, 3);
        add_action('admin_init', array($this, 'omw_admin_login_init'));
        add_action('template_redirect', array($this, 'omw_template_redirect'));
        add_action('lostpassword_post', array($this, 'omw_reset_password'));
        add_action('validate_password_reset', array($this, 'omw_validate_password_reset'), 10, 2);
        add_action('login_init', array($this, 'omw_login_init'));
        add_filter('registration_errors', array($this, 'omw_registration_redirect'), 10, 3);
    }

    /**
     * 
     * @param type $user_contact
     * @return type
     */
    public function modify_user_contact_methods($user_contact) {

        // Add user contact methods
        $user_contact['user_fullname'] = __('Fullname');
        $user_contact['user_phonenumber'] = __('Phonenumber');
        $user_contact['user_address'] = __('Address');

        return $user_contact;
    }
    
    /**
     * 
     * @param type $user_id
     */
    public function register_user_contact_methods($user_id){
        if (isset($_POST['user_fullname'])){
            update_user_meta($user_id, 'user_fullname', $_POST['user_fullname']);
        }
        if (isset($_POST['user_phonenumber'])){
            update_user_meta($user_id, 'user_phonenumber', $_POST['user_phonenumber']);
        }
        if (isset($_POST['user_address'])){
            update_user_meta($user_id, 'user_address', $_POST['user_address']);
        }
    }

    /**
     * Adds our template to the pages cache in order to trick WordPress
     * into thinking the template file exists where it doens't really exist.
     *
     * @param   array    $atts    The attributes for the page attributes dropdown
     * @return  array    $atts    The attributes for the page attributes dropdown
     * @verison	1.0.0
     * @since	1.0.0
     */
    public function register_project_templates($atts) {
        // Create the key used for the themes cache
        $cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());

        // Retrieve the cache list. 
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();
        if (empty($templates)) {
            $templates = array();
        }

        // New cache, therefore remove the old one
        wp_cache_delete($cache_key, 'themes');

        // Now add our template to the list of templates by merging our templates
        // with the existing templates array from the cache.
        $templates = array_merge($templates, $this->templates);

        // Add the modified cache to allow WordPress to pick it up for listing
        // available templates
        wp_cache_add($cache_key, $templates, 'themes', 1800);

        return $atts;
    }

    /**
     * Checks if the template is assigned to the page
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    public function view_project_template($template) {

        global $post;

        // If no posts found, return to
        // avoid "Trying to get property of non-object" error
        if (!isset($post))
            return $template;

        if (!isset($this->templates[get_post_meta($post->ID, '_wp_page_template', true)])) {

            return $template;
        }

        $file = $this->plugin_dir . get_post_meta($post->ID, '_wp_page_template', true);

        // Just to be safe, we check if the file exist first
        if (file_exists($file)) {
            return $file;
        } else {
            echo $file;
        }

        return $template;
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
        $template = new PW_Template_Loader();

        switch ($type) {
            case 'demo':
                $template->get_template_part('demo-template');
                break;
        }

        return ob_get_clean();
    }

    /**
     * Create Page if return NULL
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    public function create_page_if_null($post = NULL) {
        if (get_page_by_title($post['post_name']) == NULL) {
            // create_pages_fly($target);
            // insert page and save the id
            $post_id = wp_insert_post($post, false);

            // save the id in the database
            update_option($post['post_name'], $post_id);

            // set the template
            update_post_meta($post_id, '_wp_page_template', $post['page_template']);

            return $post_id;
        }
    }

    /**
     * Register Pages
     *
     * @version	1.0.0
     * @since	1.0.0
     */
    public function register_pages() {

        // Login
        $login_page = array(
            'post_name' => 'login',
            'post_title' => 'Login',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => $this->theme_template_directory . '/login.php',
        );
        $login_page_id = $this->create_page_if_null($login_page);

        // Profile
        $profile_page = array(
            'post_name' => 'profile',
            'post_title' => 'Profile',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => $this->theme_template_directory . '/profile.php',
        );
        $profile_page_id = $this->create_page_if_null($profile_page);
        
        // Change Password
        $change_page = array(
            'post_name' => 'change',
            'post_title' => 'Change',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => $this->theme_template_directory . '/change.php',
        );
        $change_page_id = $this->create_page_if_null($change_page);

        // Forgot Password
        $forgot_password_page = array(
            'post_name' => 'forgot',
            'post_title' => 'Forgot',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => $this->theme_template_directory . '/forgot-password.php',
        );
        $forgot_password_id = $this->create_page_if_null($forgot_password_page);

        // Reset Password
        $reset_password_page = array(
            'post_name' => 'reset',
            'post_title' => 'Reset',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => $this->theme_template_directory . '/reset-password.php',
        );
        $reset_password_id = $this->create_page_if_null($reset_password_page);

        // Register
        $register_page = array(
            'post_name' => 'register',
            'post_title' => 'Register',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => $this->theme_template_directory . '/register.php',
        );
        $register_page_id = $this->create_page_if_null($register_page);
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
        wp_register_script('js-own-plugin-frontend', $this->assets_url . 'js/settings.js', array('jquery'), '1.0.0', TRUE);
        wp_enqueue_script('js-own-plugin-frontend');
        //
        $dataToBePassed = array(
            'plugin_url' => $this->plugin_url,
        );
        wp_localize_script('js-owm-frontend', 'omw_vars', $dataToBePassed);
    }

    /**
     * Redirect to the custom login page
     * 
     * @return type
     */
    public function omw_login_init() {
        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';

        if (isset($_POST['wp-submit'])) {
            $action = 'post-data';
        } else if (isset($_GET['reauth'])) {
            $action = 'reauth';
        }

        // redirect to change password form
        if ($action == 'rp' || $action == 'resetpass') {
            if (isset($_GET['key']) && isset($_GET['login'])) {
                $rp_path = wp_unslash('/login/');
                $rp_cookie = 'wp-resetpass-' . COOKIEHASH;
                $value = sprintf('%s:%s', wp_unslash($_GET['login']), wp_unslash($_GET['key']));
                setcookie($rp_cookie, $value, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true);
            }

//            wp_redirect(home_url('/login/?action=resetpass'));
            wp_redirect(home_url('/reset'));
            exit;
        }

        // redirect from wrong key when resetting password
        if ($action == 'lostpassword' && isset($_GET['error']) && ( $_GET['error'] == 'expiredkey' || $_GET['error'] == 'invalidkey' )) {
            wp_redirect(home_url('/login/?action=forgot&failed=wrongkey'));
            exit;
        }

        if (
                $action == 'post-data' || // don't mess with POST requests
                $action == 'reauth' || // need to reauthorize
                $action == 'logout'      // user is logging out
        ) {
            return;
        }

        wp_redirect(home_url('/login/'));
        exit;
    }

    /**
     * Login page redirect
     * 
     * @param type $redirect_to
     * @param type $url
     * @param type $user
     */
    public function omw_login_redirect($redirect_to, $url, $user) {
        if (!isset($user->errors)) {
            return $redirect_to;
        }

        wp_redirect(home_url('/login/') . '?action=login&failed=1');
        exit;
    }

    /**
     * Redirect logged in users to the right page
     */
    public function omw_template_redirect() {
        foreach ($this->roles as $role) {
            if (is_page('login') && is_user_logged_in() && !current_user_can($role)) {
                wp_redirect(home_url('/wp-admin'));
                exit();
            }
        }

        foreach ($this->roles as $role) {
            if (is_page('login') && is_user_logged_in() && current_user_can($role)) {
                wp_redirect(home_url('/profile'));
                exit();
            }
        }

        if (is_page('profile') && !is_user_logged_in()) {
            wp_redirect(home_url('/login'));
            exit();
        }
    }

    /**
     * Prevent users to access the admin
     * !defined('DOING_AJAX')
     */
    public function omw_admin_login_init() {
        foreach ($this->roles as $role) {
            if (is_user_logged_in() && current_user_can($role)) {
                wp_redirect(home_url());
                exit;
            }
        }
    }

    /**
     * Password reset redirect
     */
    public function omw_reset_password() {
        $user_data = '';

        if (!empty($_POST['user_login'])) {
            if (strpos($_POST['user_login'], '@')) {
                $user_data = get_user_by('email', trim($_POST['user_login']));
            } else {
                $user_data = get_user_by('login', trim($_POST['user_login']));
            }
        }

        if (empty($user_data)) {
            wp_redirect(home_url('/login/') . '?action=forgot&failed=1');
            exit;
        }
    }

    /**
     * Validate password reset
     * 
     * @param type $errors
     * @param type $user
     */
    public function omw_validate_password_reset($errors, $user) {
        // passwords don't match
        if ($errors->get_error_code()) {
            wp_redirect(home_url('/login/?action=resetpass&failed=nomatch'));
            exit;
        }

        // wp-login already checked if the password is valid, so no further check is needed
        if (!empty($_POST['pass1'])) {
            reset_password($user, $_POST['pass1']);

            wp_redirect(home_url('/login/?action=resetpass&success=1'));
            exit;
        }

        // redirect to change password form
        wp_redirect(home_url('/login/?action=resetpass'));
        exit;
    }

    /**
     * Registration page redirect
     * 
     * @param type $errors
     * @param type $sanitized_user_login
     * @param type $user_email
     * @return type
     */
    public function omw_registration_redirect($errors, $sanitized_user_login, $user_email) {
        // don't lose your time with spammers, redirect them to a success page
        if (!isset($_POST['confirm_email']) || $_POST['confirm_email'] !== '') {

            wp_redirect(home_url('/login/') . '?action=register&success=1');
            exit;
        }

        if (!empty($errors->errors)) {
            if (isset($errors->errors['username_exists'])) {

                wp_redirect(home_url('/login/') . '?action=register&failed=username_exists');
            } else if (isset($errors->errors['email_exists'])) {

                wp_redirect(home_url('/login/') . '?action=register&failed=email_exists');
            } else if (isset($errors->errors['invalid_username'])) {

                wp_redirect(home_url('/login/') . '?action=register&failed=invalid_username');
            } else if (isset($errors->errors['invalid_email'])) {
                +
                        + wp_redirect(home_url('/login/') . '?action=register&failed=invalid_email');
            } else if (isset($errors->errors['empty_username']) || isset($errors->errors['empty_email'])) {

                wp_redirect(home_url('/login/') . '?action=register&failed=empty');
            } else {

                wp_redirect(home_url('/login/') . '?action=register&failed=generic');
            }

            exit;
        }

        return $errors;
    }

    /**
     * 
     */
    function download_cv() {
        global $wp_query;
        global $wpdb;
        //
        if (isset($wp_query->query['pagename'])) {
            if ($wp_query->query['pagename'] == 'download') {
                if (current_user_can('manage_options')) {
                    //
                    if (isset($_GET['attach'])) {
                        if (is_numeric($_GET['attach'])) {
                            $id = $_GET['attach'];
                            //
                            $table_name = $wpdb->prefix . 'jobs_management';
                            $list_candidates = $wpdb->get_results(
                                    ""
                                    . " SELECT * "
                                    . " FROM  $table_name "
                                    . " WHERE id =  $id "
                            );
                            $post = $list_candidates[0];
                            //
                            $attach_file = $post->attach_file;
                            $ext = substr(strrchr($attach_file, '.'), 1);
                            $clean_name = sanitize_title($post->fullname . '-cv') . '.' . $ext;
                            //
                            $parse = parse_url($attach_file);
                            $attach_file_path = WP_CONTENT_DIR . str_replace('/wp-content', '', $parse['path']);
                            //
                            header('Content-Description: File Transfer');
                            header('Content-Type: application/force-download');
                            header("Content-Disposition: attachment; filename=\"" . $clean_name . "\";");
                            header('Content-Transfer-Encoding: binary');
                            header('Expires: 0');
                            header('Cache-Control: must-revalidate');
                            header('Pragma: public');
                            header('Content-Length: ' . filesize($attach_file_path));
                            ob_clean();
                            flush();
                            readfile($attach_file_path);
                            exit();
                        }
                    }
                }
            }
        }
    }

}

$omw_login = new omw_login();
