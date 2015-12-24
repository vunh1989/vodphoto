<?php

/**
 * Template loader for PW Sample Plugin.
 *
 * Only need to specify class properties here.
 *
 */
require_once 'class-gamajo-template-loader.php';

class mini_cart_PW_Template_Loader extends mini_cart_Gamajo_Template_Loader {

    /**
     * Prefix for filter names.
     *
     * @since 1.0.0
     * @type string
     */
    protected $filter_prefix = 'omw-mini-cart';

    /**
     * Directory name where custom templates for this plugin should be found in the theme.
     *
     * @since 1.0.0
     * @type string
     */
    protected $theme_template_directory = 'templates';

    /**
     * Reference to the root directory path of this plugin.
     *
     * @since 1.0.0
     * @type string
     */
    protected $plugin_directory = OMW_MINI_CART_PLUGIN_DIR;

}
