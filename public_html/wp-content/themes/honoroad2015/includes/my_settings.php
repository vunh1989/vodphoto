<?php

/**
 * 
 * Author: Le Duong Khang
 * Tabbed Settings Page
 * 
 */
class omw_theme_settings {

    private $page_slug = 'honoroad-theme-settings';
    private $option_name = 'my_theme_option';
    private $settings;
    private $setting_fields;
    private $assets_url;
    private $tabs;
    private $theme_data;

    public function __construct() {
        add_action('admin_menu', array($this, 'omw_settings_page_init'));
        //
        $this->assets_url = get_template_directory_uri() . '/includes/assets/';
        //
        $this->setting_fields = $this->omw_init_setting_fields();
        $this->theme_data = wp_get_theme();
    }

    public function get_theme_settings() {
        $meta_data = get_option($this->option_name);
        $data = array();
        foreach ($meta_data as $key => $value) {
            $data[$key] = stripcslashes($value);
        }
        return (object) $data;
    }

    public function omw_settings_assets() {
        wp_register_style('omw-admin-style', $this->assets_url . 'css/style.css');
        wp_enqueue_style('omw-admin-style');
        //
        wp_enqueue_style('farbtastic');
        wp_enqueue_script('farbtastic');
        //
        wp_enqueue_media();
        wp_register_script('wpt-admin-js', $this->assets_url . 'js/settings.js', array('farbtastic', 'jquery'), '1.0.0');
        wp_enqueue_script('wpt-admin-js');
    }

    public function omw_get_tab() {
        global $pagenow;
        $tab = 'company-info';  // default
        //
        if ($pagenow == 'themes.php' && $_GET['page'] == $this->page_slug) {
            if (isset($_GET['tab'])) {
                $tab = $_GET['tab'];
            }
        }
        return $tab;
    }

    /**
     * 
     * @return type'tab name' => array('fields name' => array());
     */
    public function omw_init_setting_fields() {
        $this->tabs = array(
            'company-info' => 'Compnay Infomation',
//            'headquaters-info' => 'Headequaters',
            'general' => 'General',
            'footer' => 'Footer',
            'mail-setting' => 'Mail Setting',
            'recaptcha' => 'reCaptcha',
        );
        //
        $tab_data = array();
        foreach ($this->tabs as $tab_id => $tab) {
            switch ($tab_id) {
                case 'general':
                    $tab_data[$tab_id] = array(
                        'ct_use_css' => array(
                            'id' => 'ct_use_css',
                            'label' => 'Use Custom CSS',
                            'description' => 'Enable/Disable custom CSS',
                            'type' => 'checkbox',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_custom_css' => array(
                            'id' => 'ct_custom_css',
                            'label' => 'CSS Code',
                            'description' => '',
                            'type' => 'textarea',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_use_script' => array(
                            'id' => 'ct_use_script',
                            'label' => 'Use Custom Script',
                            'description' => 'Enable/Disable custom SCRIPT',
                            'type' => 'checkbox',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_custom_script' => array(
                            'id' => 'ct_custom_script',
                            'label' => 'Javascript Code',
                            'description' => '',
                            'type' => 'textarea',
                            'default' => '',
                            'placeholder' => '',
                        ),
                    );
                    break;
                case 'company-info':
                    $tab_data[$tab_id] = array(
                        'ct_company_logo' => array(
                            'id' => 'ct_company_logo',
                            'label' => 'Company Logo',
                            'description' => '',
                            'type' => 'image',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_company_image' => array(
                            'id' => 'ct_company_image',
                            'label' => 'Company Image',
                            'description' => '',
                            'type' => 'image',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_company_name' => array(
                            'id' => 'ct_company_name',
                            'label' => 'Company Name',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_company_address' => array(
                            'id' => 'ct_company_address',
                            'label' => 'Address',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_company_telephone' => array(
                            'id' => 'ct_company_telephone',
                            'label' => 'Phone Number',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_company_fax' => array(
                            'id' => 'ct_company_fax',
                            'label' => 'Fax',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_company_email' => array(
                            'id' => 'ct_company_email',
                            'label' => 'Email',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_company_google_map' => array(
                            'id' => 'ct_company_google_map',
                            'label' => 'Google Map Embed',
                            'description' => '',
                            'type' => 'textarea',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_copyright' => array(
                            'id' => 'ct_copyright',
                            'label' => 'Copyright by',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                    );
                    break;
//                case 'headquaters-info':
//                    $tab_data[$tab_id] = array(
//                        'ct_head_com_image' => array(
//                            'id' => 'ct_head_com_image',
//                            'label' => 'Company Image',
//                            'description' => '',
//                            'type' => 'image',
//                            'default' => '',
//                            'placeholder' => '',
//                        ),
//                        'ct_head_com_name' => array(
//                            'id' => 'ct_head_com_name',
//                            'label' => 'Company Name',
//                            'description' => '',
//                            'type' => 'text',
//                            'default' => '',
//                            'placeholder' => '',
//                        ),
//                        'ct_head_com_address' => array(
//                            'id' => 'ct_head_com_address',
//                            'label' => 'Address',
//                            'description' => '',
//                            'type' => 'text',
//                            'default' => '',
//                            'placeholder' => '',
//                        ),
//                        'ct_head_com_telephone' => array(
//                            'id' => 'ct_head_com_telephone',
//                            'label' => 'Phone Number',
//                            'description' => '',
//                            'type' => 'text',
//                            'default' => '',
//                            'placeholder' => '',
//                        ),
//                        'ct_head_com_fax' => array(
//                            'id' => 'ct_head_com_fax',
//                            'label' => 'Fax',
//                            'description' => '',
//                            'type' => 'text',
//                            'default' => '',
//                            'placeholder' => '',
//                        ),
//                        'ct_head_com_email' => array(
//                            'id' => 'ct_head_com_email',
//                            'label' => 'Email',
//                            'description' => '',
//                            'type' => 'text',
//                            'default' => '',
//                            'placeholder' => '',
//                        ),
//                        'ct_head_com_website' => array(
//                            'id' => 'ct_head_com_website',
//                            'label' => 'Website',
//                            'description' => '',
//                            'type' => 'text',
//                            'default' => '',
//                            'placeholder' => '',
//                        ),
//                    );
//                    break;
                case 'footer':
                    $tab_data[$tab_id] = array(
                        'ct_google_analytics' => array(
                            'id' => 'ct_google_analytics',
                            'label' => 'Google Analytics Code',
                            'description' => 'Enter your Google Analytics tracking code',
                            'type' => 'textarea',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_google_tag_manager' => array(
                            'id' => 'ct_google_tag_manager',
                            'label' => 'Google Tag Manager Code',
                            'description' => '',
                            'type' => 'textarea',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_facebook_script' => array(
                            'id' => 'ct_facebook_script',
                            'label' => 'Facebook Script',
                            'description' => '',
                            'type' => 'textarea',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_google_plus_script' => array(
                            'id' => 'ct_google_plus_script',
                            'label' => 'Google Plus Script',
                            'description' => '',
                            'type' => 'textarea',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_twitter_script' => array(
                            'id' => 'ct_twitter_script',
                            'label' => 'Twitter Script',
                            'description' => '',
                            'type' => 'textarea',
                            'default' => '',
                            'placeholder' => '',
                        ),
                    );
                    break;
                case 'mail-setting':
                    $tab_data[$tab_id] = array(
                        'ct_from_email' => array(
                            'id' => 'ct_from_email',
                            'label' => 'From Email',
                            'description' => '',
                            'type' => 'text',
                            'default' => 'no-reply',
                            'placeholder' => '',
                        ),
                        'ct_from_name' => array(
                            'id' => 'ct_from_name',
                            'label' => 'From Name',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_mail_subject_client' => array(
                            'id' => 'ct_mail_subject_client',
                            'label' => 'Mail Subject to Client',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_mail_content_client' => array(
                            'id' => 'ct_mail_content_client',
                            'label' => 'Mail Content to Client',
                            'description' => '',
                            'type' => 'wysiwyg',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_mail_list_admin' => array(
                            'id' => 'ct_mail_list_admin',
                            'label' => 'Mail list to Admin',
                            'description' => 'List email to Admin, add new line for each email address',
                            'type' => 'textarea',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_mail_subject_admin' => array(
                            'id' => 'ct_mail_subject_admin',
                            'label' => 'Mail Subject to Admin',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_mail_content_admin' => array(
                            'id' => 'ct_mail_content_admin',
                            'label' => 'Mail Content to Admin',
                            'description' => '',
                            'type' => 'wysiwyg',
                            'default' => '',
                            'placeholder' => '',
                        ),
                    );
                    break;
                case 'recaptcha':
                    $tab_data[$tab_id] = array(
                        'ct_recaptcha_public_key' => array(
                            'id' => 'ct_recaptcha_public_key',
                            'label' => 'Site Key',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                        'ct_recaptcha_private_key' => array(
                            'id' => 'ct_recaptcha_private_key',
                            'label' => 'Security Key',
                            'description' => '',
                            'type' => 'text',
                            'default' => '',
                            'placeholder' => '',
                        ),
                    );
                    break;
            }
        }
        //
        return array_merge($tab_data);
    }

    public function omw_settings_page_init() {
        $theme_data = $this->theme_data;
        $settings_page = add_theme_page($theme_data->get('Name') . ' Theme Settings', $theme_data->get('Name') . ' Theme Settings', 'edit_theme_options', $this->page_slug, array($this, 'omw_settings_page'));
        add_action("load-{$settings_page}", array($this, 'omw_settings_assets'));
        add_action("load-{$settings_page}", array($this, 'omw_load_settings_page'));
    }

    public function omw_load_settings_page() {
        if (isset($_POST["omw-settings-submit"]) && $_POST["omw-settings-submit"] == 'Y') {
            check_admin_referer("omw-settings-page");
            $this->omw_save_theme_settings();
            $url_parameters = isset($_GET['tab']) ? 'updated=true&tab=' . $_GET['tab'] : 'updated=true';
            wp_redirect(admin_url('themes.php?page=' . $this->page_slug . '&' . $url_parameters));
            exit;
        }
    }

    public function omw_save_theme_settings() {
        $this->settings = get_option($this->option_name);
        //
        $tab = $this->omw_get_tab();
        //
        foreach ($this->setting_fields as $s_tab => $tab_data) {
            if ($tab == $s_tab) {
                foreach ($tab_data as $field => $data) {
                    $id = $data['id'];
                    switch ($data['type']) {
                        case 'image':
                            $image_data = array(
                                'url' => $_POST[$id],
                                'sizes' => array(
                                    'thumbnail' => $_POST[$id . '_thumbnail'],
                                    'medium' => $_POST[$id . '_medium'],
                                    'large' => $_POST[$id . '_large'],
                                    'full' => $_POST[$id . '_full'],
                                ),
                            );
                            $this->settings[$id] = json_encode($image_data);
                            break;
                        case 'checkbox':
                            $d_checkbox = (isset($_POST[$id]) || $_POST[$id] == 'on') ? TRUE : FALSE;
                            $this->settings[$id] = $d_checkbox;
                            break;
                        default:
                            $this->settings[$id] = isset($_POST[$id]) ? $_POST[$id] : '';
                            break;
                    }
                }
            }
        }
//    if (!current_user_can('unfiltered_html')) {
//        if ($this->settings['ct_google_analytics'])
//            $this->settings['ct_google_analytics'] = stripslashes(esc_textarea(wp_filter_post_kses($this->settings['ct_google_analytics'])));
//        if ($this->settings['ct_google_tag_manager'])
//            $this->settings['ct_google_tag_manager'] = stripslashes(esc_textarea(wp_filter_post_kses($this->settings['ct_google_tag_manager'])));
        $updated = update_option($this->option_name, $this->settings);
    }

    public function omw_admin_tabs($current = 'company-info') {
        $links = array();
        echo '<div id="icon-themes" class="icon32"><br></div>';
        echo '<h2 class="nav-tab-wrapper">';
        foreach ($this->tabs as $tab => $name) {
            $class = ( $tab == $current ) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='?page={$this->page_slug}&tab=$tab'>$name</a>";
        }
        echo '</h2>';
    }

    public function omw_settings_page() {
        $settings = get_option($this->option_name);
        $theme_data = wp_get_theme();
        ?>
        <div class="wrap">
            <h2><?php echo $theme_data->get('Name') ?> Theme Settings</h2>

            <?php
            if (isset($_GET['updated']) && true == esc_attr($_GET['updated']))
                echo '<div class="updated" ><p>Theme Settings updated.</p></div>';
            if (isset($_GET['tab']))
                $this->omw_admin_tabs($_GET['tab']);
            else
                $this->omw_admin_tabs('company-info');
            ?>

            <div id="poststuff">
                <form method="post" action="<?php admin_url('themes.php?page=' . $this->page_slug); ?>">
                    <?php
                    wp_nonce_field("omw-settings-page");
                    //
                    $tab = $this->omw_get_tab();
                    echo '<table class="form-table">';
                    //
                    foreach ($this->setting_fields as $s_tab => $tab_data) {
                        foreach ($tab_data as $field => $data) {
                            $id = $data['id'];
                            switch ($tab) {
                                case $s_tab:
                                    switch ($data['type']) {
                                        case 'text':
                                        case 'password':
                                        case 'number':
                                            ?>
                                            <tr>
                                                <th><label for="<?php echo $id ?>"><?php echo $data['label'] ?></label></th>
                                                <td>
                                                    <input class="form-control" id="<?php echo $id ?>" name="<?php echo $id ?>" type="text" value="<?php echo isset($settings[$id]) ? esc_html(stripslashes($settings[$id])) : $data['default'] ?>" /><br/>
                                                    <span class="description"><?php echo $data['description'] ?></span>
                                                </td>
                                            </tr>
                                            <?php
                                            break;
                                        case 'textarea':
                                            ?>
                                            <tr>
                                                <th><label for="<?php echo $id ?>"><?php echo $data['label'] ?></label></th>
                                                <td>
                                                    <textarea class="form-control" id="<?php echo $id ?>" name="<?php echo $id ?>" cols="60" rows="5"><?php echo isset($settings[$id]) ? esc_html(stripslashes($settings[$id])) : $data['default'] ?></textarea><br/>
                                                    <span class="description"><?php echo $data['description'] ?></span>
                                                </td>
                                            </tr>
                                            <?php
                                            break;
                                        case 'wysiwyg':
                                            ?>
                                            <tr>
                                                <th><label for="<?php echo $id ?>"><?php echo $data['label'] ?></label></th>
                                                <td>
                                <?php wp_editor(isset($settings[$id]) ? esc_html(stripslashes($settings[$id])) : '', $id, array('wpautop' => false, 'tinymce' => true)); ?>
                                                </td>
                                            </tr>
                                            <?php
                                            break;
                                        case 'checkbox':
                                            ?>
                                            <tr>
                                                <th><label for="<?php echo $id ?>"><?php echo $data['label'] ?></label></th>
                                                <td>
                                                    <label for="<?php echo $id ?>"><input id="<?php echo $id ?>" name="<?php echo $id ?>" type="checkbox" value="<?php echo (isset($settings[$id]) && $settings[$id] == TRUE) ? 1 : 0 ?>" <?php if ($settings[$id]) echo 'checked="checked"'; ?> />
                                                        <span class="description"><?php echo $data['description'] ?></span>
                                                    </label>
                                                </td>
                                            </tr>
                                            <?php
                                            break;
                                        case 'multi_checkbox':
                                            ?>
                                            <tr>
                                                <th><label for="<?php echo $id ?>"><?php echo $data['label'] ?></label></th>
                                                <td>
                                                </td>
                                            </tr>
                                            <?php
                                            break;
                                        case 'radio':
                                            ?>
                                            <tr>
                                                <th><label for="<?php echo $id ?>"><?php echo $data['label'] ?></label></th>
                                                <td>
                                                </td>
                                            </tr>
                                            <?php
                                            break;
                                        case 'image':
                                            $media_meta = json_decode($settings[$id]);
                                            //
                                            if (isset($media_meta->sizes->thumbnail) && $media_meta->sizes->thumbnail != '') {
                                                $image_thumb = $media_meta->sizes->thumbnail;
                                            } else {
                                                if ($media_meta->url != '') {
                                                    $image_thumb = $media_meta->url;
                                                } else {
                                                    $image_thumb = 'images/media-button-image.gif';
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <th><label for="<?php echo $id ?>"><?php echo $data['label'] ?></label></th>
                                                <td>
                                                    <img id="<?php echo $id ?>_preview" class="image_preview" src="<?php echo $image_thumb ?>" /><br/>
                                                    <input id="<?php echo $id ?>_button" type="button" data-uploader_title="Upload an image" data-uploader_button_text="Use image" class="image_upload_button button" value="Upload new image" />
                                                    <input id="<?php echo $id ?>_delete" type="button" class="image_delete_button button" value="Remove image" />
                                                    <input id="<?php echo $id ?>" class="image_data_field" type="hidden" name="<?php echo $id ?>" value="<?php echo isset($media_meta->url) ? $media_meta->url : '' ?>"/>
                                                    <input id="<?php echo $id ?>_full" class="image_data_field" type="hidden" name="<?php echo $id ?>_full" value="<?php echo isset($media_meta->sizes->full) ? $media_meta->sizes->full : '' ?>"/>
                                                    <input id="<?php echo $id ?>_thumbnail" class="image_data_field" type="hidden" name="<?php echo $id ?>_thumbnail" value="<?php echo isset($media_meta->sizes->thumbnail) ? $media_meta->sizes->thumbnail : '' ?>"/>
                                                    <input id="<?php echo $id ?>_medium" class="image_data_field" type="hidden" name="<?php echo $id ?>_medium" value="<?php echo isset($media_meta->sizes->medium) ? $media_meta->sizes->medium : '' ?>"/>
                                                    <input id="<?php echo $id ?>_large" class="image_data_field" type="hidden" name="<?php echo $id ?>_large" value="<?php echo isset($media_meta->sizes->large) ? $media_meta->sizes->large : '' ?>"/>
                                                    <span class="description"><?php echo $data['description'] ?></span>
                                                </td>
                                            </tr>
                                            <?php
                                            break;
                                        case 'color':
                                            ?>
                                            <tr>
                                                <th><label for="<?php echo $id ?>"><?php echo $data['label'] ?></label></th>
                                                <td>
                                                    <div class="color-picker" style="position:relative;">
                                                        <input type="text" name="<?php echo $id ?>" class="color" value="<?php echo $settings[$id] ?>" />
                                                        <div style="position:absolute;background:#FFF;z-index:99;border-radius:100%;" class="colorpicker"></div>
                                                        <span class="description"><?php echo $data['description'] ?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            break;
                                        default:
                                            break;
                                    }
                                    break;
                            }
                        }
                    }
                    echo '</table>';
                    ?>
                    <p class="submit" style="clear: both;">
                        <input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
                        <input type="hidden" name="omw-settings-submit" value="Y" />
                    </p>
                </form>

                <p><?php echo $theme_data->get('Name') ?> theme by <?php echo $theme_data->get('Author') ?> (<?php echo $theme_data->get('Version') ?>)</p>
            </div>

        </div>
        <?php
    }

}

global $omw_theme_settings;
$new_omw_theme_settings = new omw_theme_settings();
$omw_theme_settings = $new_omw_theme_settings->get_theme_settings();
