<?php

define('ACF_LITE', true);

/*
 * This file is custom post type, custom taxonomy and custom fields
 * definition file.
 * 
 * Exported from CPT UI & Advanced Custom Fields
 */

/* ---------------------------------------------------------------------------- */
/* post type definitions */
/* ---------------------------------------------------------------------------- */
add_action('init', 'cptui_register_my_cpts');

function cptui_register_my_cpts() {
    $labels = array(
        "name" => "Home Slider",
        "singular_name" => "Home Slider",
    );

    $args = array(
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "home-slider", "with_front" => true),
        "query_var" => true,
        "menu_position" => 26,
        "menu_icon" => get_template_directory_uri() . '/images/ad-ico/h1.png',
        "supports" => array("title"),
    );
    register_post_type("home-slider", $args);


    $labels = array(
        "name" => "Product",
        "singular_name" => "Product",
        "menu_name" => "Sản phẩm",
    );

    $args = array(
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "product", "with_front" => true),
        "query_var" => true,
        "menu_position" => 26,
        "menu_icon" => get_template_directory_uri() . '/images/ad-ico/h16.png',
        "supports" => array("title"),
    );
    register_post_type("product", $args);

    $labels = array(
        "name" => "Top Info",
        "singular_name" => "Top Info",
        "menu_name" => "Top Info",
    );

    $args = array(
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "info", "with_front" => true),
        "query_var" => true,
        "menu_position" => 26,
        "menu_icon" => get_template_directory_uri() . '/images/ad-ico/h3.png',
        "supports" => array("title", "editor", "excerpt"),
    );
    register_post_type("info", $args);

    $labels = array(
        "name" => "News",
        "singular_name" => "News",
        "menu_name" => "Tin tức",
    );

    $args = array(
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "topic/%news-type%", "with_front" => true),
        "query_var" => true,
        "menu_position" => 26,
        "menu_icon" => get_template_directory_uri() . '/images/ad-ico/h6.png',
        "supports" => array("title", "editor", "excerpt"),
    );
    register_post_type("news", $args);

    $labels = array(
        "name" => "Health & Nutrition",
        "singular_name" => "Health & Nutrition",
        "menu_name" => "Sức khỏe & Dinh dưỡng",
    );

    $args = array(
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "health", "with_front" => true),
        "query_var" => true,
        "menu_position" => 26,
        "menu_icon" => get_template_directory_uri() . '/images/ad-ico/h7.png',
        "supports" => array("title", "editor", "excerpt"),
    );
    register_post_type("health", $args);

    $labels = array(
        "name" => "Company Info",
        "singular_name" => "Company Info",
    );

    $args = array(
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "company-info", "with_front" => true),
        "query_var" => true,
        "menu_position" => 26,
        "menu_icon" => get_template_directory_uri() . '/images/ad-ico/h8.png',
        "supports" => array("title"),
    );
    register_post_type("company-info", $args);

// End of cptui_register_my_cpts()
}

/* ---------------------------------------------------------------------------- */
/* taxonomy definitions */
/* ---------------------------------------------------------------------------- */
add_action('init', 'cptui_register_my_taxes');

function cptui_register_my_taxes() {

    $labels = array(
        "name" => "Product Line",
        "label" => "Product Line",
    );

    $args = array(
        "labels" => $labels,
        "hierarchical" => true,
        "label" => "Product Line",
        "show_ui" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'product-line', 'with_front' => true),
        "show_admin_column" => false,
    );
    register_taxonomy("product-line", array("product"), $args);


    $labels = array(
        "name" => "News",
        "label" => "News Category",
        "menu_name" => "News Category",
    );

    $args = array(
        "labels" => $labels,
        "hierarchical" => true,
        "label" => "News Type",
        "show_ui" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'news', 'with_front' => true),
        "show_admin_column" => true,
    );
    register_taxonomy("news-type", array("news"), $args);

    $labels = array(
        "name" => "Company Branch",
        "label" => "Company Branch",
    );

    $args = array(
        "labels" => $labels,
        "hierarchical" => true,
        "label" => "Company Branch",
        "show_ui" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'company-branch', 'with_front' => true),
        "show_admin_column" => true,
    );
    register_taxonomy("company-branch", array("company-info"), $args);

// End cptui_register_my_taxes
}

/* ---------------------------------------------------------------------------- */
/* custom fields definitions */
/* ---------------------------------------------------------------------------- */
if (function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_home-slider',
        'title' => 'Home Slider',
        'fields' => array(
            array(
                'key' => 'field_5649e7ebdc0e1',
                'label' => 'Images',
                'name' => 'images',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5649e7f9dc0e2',
                        'label' => 'image',
                        'name' => 'image',
                        'type' => 'image',
                        'column_width' => '',
                        'save_format' => 'object',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'home-slider',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array(
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array(
        'id' => 'acf_product',
        'title' => 'Product',
        'fields' => array(
            array(
                'key' => 'field_5647657ba2f71',
                'label' => 'Description',
                'name' => 'description',
                'type' => 'wysiwyg',
                'instructions' => 'Mô tả',
                'default_value' => '',
                'toolbar' => 'basic',
                'media_upload' => 'yes',
            ),
            /*
              array(
              'key' => 'field_564765d7a2f72',
              'label' => 'Price Plans',
              'name' => 'price_plans',
              'type' => 'repeater',
              'instructions' => 'Giá',
              'sub_fields' => array(
              array(
              'key' => 'field_5647752e4802c',
              'label' => 'Weight',
              'name' => 'weight',
              'type' => 'select',
              'column_width' => '',
              'choices' => array(
              '1L' => '1L',
              '2L' => '2L',
              '5L' => '5L',
              '22L' => '22L',
              '25Kg' => '25Kg',
              ),
              'default_value' => '',
              'allow_null' => 0,
              'multiple' => 0,
              ),
              array(
              'key' => 'field_564775964802d',
              'label' => 'Price',
              'name' => 'price',
              'type' => 'number',
              'column_width' => '',
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'min' => '',
              'max' => '',
              'step' => '',
              ),
              ),
              'row_min' => '',
              'row_limit' => '',
              'layout' => 'table',
              'button_label' => 'Add Row',
              ),
             */
            array(
                'key' => 'field_5642fb481e434',
                'label' => 'Images',
                'name' => 'images',
                'type' => 'repeater',
                'instructions' => 'Hình sản phẩm',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5642fbe53943a',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'column_width' => '',
                        'save_format' => 'object',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
            array(
                'key' => 'field_564451009570f',
                'label' => 'Weight',
                'name' => 'weight',
                'type' => 'checkbox',
                'instructions' => 'Trọng lượng',
                'choices' => array(
                    '1L' => '1L',
                    '2L' => '2L',
                    '5L' => '5L',
                    '22L' => '22L',
                    '25KG' => '25KG',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
            ),
            array(
                'key' => 'field_567a58b5ccc71',
                'label' => '--- Title 1',
                'name' => 'title_1',
                'type' => 'text',
                'instructions' => '(Thành phần)',
                'default_value' => 'Thành phần',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642d49fb732a',
                'label' => 'Ingredients',
                'name' => 'ingredients',
                'type' => 'text',
                'instructions' => 'Thành phần',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_567a593f00ca3',
                'label' => '--- Title 2',
                'name' => 'title_2',
                'type' => 'text',
                'instructions' => '(Đặc điểm)',
                'default_value' => 'Đặc điểm',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642e148b732b',
                'label' => 'Features',
                'name' => 'features',
                'type' => 'text',
                'instructions' => 'Đặc điểm',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_567a5d7db3215',
                'label' => '--- Title 3',
                'name' => 'title_3',
                'type' => 'text',
                'instructions' => '(Tiêu chuẩn chất lượng)',
                'default_value' => 'Tiêu chuẩn chất lượng',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_567a5d8dade10',
                'label' => '--- Title 4',
                'name' => 'title_4',
                'type' => 'text',
                'instructions' => '(Chỉ tiêu cảm quan)',
                'default_value' => 'Chỉ tiêu cảm quan',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642e204b732c',
                'label' => 'Sensory',
                'name' => 'sensory',
                'type' => 'repeater',
                'instructions' => 'Chỉ tiêu cảm quan',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5642e237b732d',
                        'label' => 'Attribute',
                        'name' => 'attribute',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    /*
                      'column_width' => '',
                      'choices' => array(
                      'Trạng thái' => 'Trạng thái',
                      'Màu sắc' => 'Màu sắc',
                      'Mùi' => 'Mùi',
                      ),
                      'default_value' => '',
                      'allow_null' => 0,
                      'multiple' => 0,
                     */
                    ),
                    array(
                        'key' => 'field_5642e3d4b732e',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'none',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
            array(
                'key' => 'field_567a5dd10e233',
                'label' => '--- Title 5',
                'name' => 'title_5',
                'type' => 'text',
                'instructions' => '(Chỉ số lý hóa)',
                'default_value' => 'Chỉ số lý hóa',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642e445b732f',
                'label' => 'Physical and Chemical Indicators',
                'name' => 'physical_and_chemical_indicators',
                'type' => 'repeater',
                'instructions' => 'Chỉ số lý hóa',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5642e5aab7330',
                        'label' => 'Item',
                        'name' => 'item',
                        'type' => 'text',
                        'instructions' => 'Hạng mục',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    /*
                      'column_width' => '',
                      'choices' => array(
                      'Hàm lượng axit béo tự do (axit oleic)' => 'Hàm lượng axit béo tự do (axit oleic)',
                      'Hydro hóa' => 'Hydro hóa',
                      'Iốt' => 'Iốt',
                      'Độ ẩm' => 'Độ ẩm',
                      'Tạp chất' => 'Tạp chất',
                      'Độ nóng chảy' => 'Độ nóng chảy',
                      ),
                      'default_value' => '',
                      'allow_null' => 0,
                      'multiple' => 0,
                     */
                    ),
                    array(
                        'key' => 'field_5642e5b7b7331',
                        'label' => 'Unit',
                        'name' => 'unit',
                        'type' => 'text',
                        'instructions' => 'Đơn vị',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        /*
                        'column_width' => '',
                        'choices' => array(
                            '%' => '%',
                            'Meq/kg' => 'Meq/kg',
                            'g/100g' => 'g/100g',
                        ),
                        'default_value' => '',
                        'allow_null' => 0,
                        'multiple' => 0,
                        */
                    ),
                    array(
                        'key' => 'field_5642e62e6beef',
                        'label' => 'Amount',
                        'name' => 'amount',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'none',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
            array(
                'key' => 'field_567a5eae2f632',
                'label' => '--- Title 6',
                'name' => 'title_6',
                'type' => 'text',
                'instructions' => '(Công dụng)',
                'default_value' => 'Công dụng',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642ed4c28472',
                'label' => 'Usage',
                'name' => 'usage',
                'type' => 'textarea',
                'instructions' => 'Công dụng',
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'br',
            ),
            array(
                'key' => 'field_567a5ef98005b',
                'label' => '--- Title 7',
                'name' => 'title_7',
                'type' => 'text',
                'instructions' => '(Đối tượng sử dụng)',
                'default_value' => 'Đối tượng sử dụng',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642ed5f28473',
                'label' => 'Target User',
                'name' => 'target_user',
                'type' => 'text',
                'instructions' => 'Đối tượng sử dụng',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_567a5f1b42ff6',
                'label' => '--- Title 8',
                'name' => 'title_8',
                'type' => 'text',
                'instructions' => '(Bảo quản)',
                'default_value' => 'Bảo quản',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642edca28474',
                'label' => 'Preservation',
                'name' => 'preservation',
                'type' => 'text',
                'instructions' => 'Bảo quản',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_567a5f3f3ad4c',
                'label' => '--- Title 9',
                'name' => 'title_9',
                'type' => 'text',
                'instructions' => '(Số tiêu chuẩn chất lượng)',
                'default_value' => 'Số tiêu chuẩn chất lượng',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642ee0328475',
                'label' => 'Number of Quality Standard',
                'name' => 'number_of_quality_standard',
                'type' => 'textarea',
                'instructions' => 'Số tiêu chuẩn chất lượng',
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'br',
            ),
            array(
                'key' => 'field_567a5f72d88c9',
                'label' => '--- Title 10',
                'name' => 'title_10',
                'type' => 'text',
                'instructions' => '(Thông tin dinh dưỡng)',
                'default_value' => 'Thông tin dinh dưỡng',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642ee768d0bf',
                'label' => 'Nutritional information',
                'name' => 'nutritional_information',
                'type' => 'repeater',
                'instructions' => 'Thông tin dinh dưỡng',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5642ef578d0c0',
                        'label' => 'Attribute',
                        'name' => 'attribute',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    /*
                      'column_width' => '',
                      'choices' => array(
                      'Năng lượng' => 'Năng lượng',
                      'Chất đạm' => 'Chất đạm',
                      'Chất béo toàn phần' => 'Chất béo toàn phần',
                      'Hydrat cacbon' => 'Hydrat cacbon',
                      'Cholesterol' => 'Cholesterol',
                      ),
                      'default_value' => '',
                      'allow_null' => 0,
                      'multiple' => 0,
                     */
                    ),
                    array(
                        'key' => 'field_5642f6c48d0c1',
                        'label' => 'Average In 14g',
                        'name' => 'average_in_14g',
                        'type' => 'text',
                        'instructions' => 'Hàm lượng trung bình trong mỗi khẩu phần 14g',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'none',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5642f7248d0c2',
                        'label' => 'Average In 100g',
                        'name' => 'average_in_100g',
                        'type' => 'text',
                        'instructions' => 'Hàm lượng trung bình trong 100g',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'none',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
            array(
                'key' => 'field_567a5f9dbacbd',
                'label' => '--- Title 11',
                'name' => 'title_11',
                'type' => 'text',
                'instructions' => '(Dùng trong lĩnh vực)',
                'default_value' => 'Dùng trong lĩnh vực',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642fb0b1e433',
                'label' => 'Usage In Field',
                'name' => 'usage_in_field',
                'type' => 'text',
                'instructions' => 'Dùng trong lĩnh vực',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5642fb9239438',
                'label' => 'Feature Images',
                'name' => 'feature_images',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5642fbbd39439',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'column_width' => '',
                        'save_format' => 'object',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array(
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array(
        'id' => 'acf_top-info',
        'title' => 'Top Info',
        'fields' => array(
            array(
                'key' => 'field_56454336c93fa',
                'label' => 'Show Button',
                'name' => 'show_button',
                'type' => 'radio',
                'choices' => array(
                    1 => 'Show',
                    0 => 'Hide',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
            ),
            array(
                'key' => 'field_564542a9c93f9',
                'label' => 'Link To',
                'name' => 'link_to',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'info',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array(
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array(
        'id' => 'acf_news',
        'title' => 'News',
        'fields' => array(
            array(
                'key' => 'field_5657396f9fdc8',
                'label' => 'Image',
                'name' => 'image',
                'type' => 'image',
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'news',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array(
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array(
        'id' => 'acf_health',
        'title' => 'Health',
        'fields' => array(
            array(
                'key' => 'field_565802f94a54f',
                'label' => 'Image',
                'name' => 'image',
                'type' => 'image',
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'health',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array(
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array(
        'id' => 'acf_company-info',
        'title' => 'Company Info',
        'fields' => array(
            array(
                'key' => 'field_567806fcd7c3b',
                'label' => 'Image',
                'name' => 'image',
                'type' => 'image',
                'instructions' => 'Hình Ảnh',
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
//                'library' => 'uploadedTo',
            ),
            array(
                'key' => 'field_56780724d7c3c',
                'label' => 'Address',
                'name' => 'address',
                'type' => 'text',
                'instructions' => 'Địa Chỉ',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_567807cbd7c3d',
                'label' => 'Tel',
                'name' => 'tel',
                'type' => 'text',
                'instructions' => 'Điện Thoại',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_567807e3d7c3e',
                'label' => 'Fax',
                'name' => 'fax',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_56780837d7c3f',
                'label' => 'Email',
                'name' => 'email',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_56780864d7c40',
                'label' => 'Website',
                'name' => 'website',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'company-info',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array(
            ),
        ),
        'menu_order' => 0,
    ));
}

/* -------------------------------------------------------------------------- */

/* F1iltro per modificare il permalink */
add_filter('post_link', 'news_permalink', 1, 3);
add_filter('post_type_link', 'news_permalink', 1, 3);

function news_permalink($permalink, $post_id, $leavename) {
    //replace %news-type% with custom post type category slug
    if (strpos($permalink, '%news-type%') === FALSE)
        return $permalink;
    // Get post
    $post = get_post($post_id);
    if (!$post)
        return $permalink;

    // Get taxonomy terms
    $terms = wp_get_object_terms($post->ID, 'news-type');
    if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
        $taxonomy_slug = $terms[0]->slug;
    else
        $taxonomy_slug = 'no-type';

    return str_replace('%news-type%', $taxonomy_slug, $permalink);
}

/*
 * Replace Taxonomy slug with Post Type slug in url
 * Version: 1.1
 */
//function taxonomy_slug_rewrite($wp_rewrite) {
//    $rules = array();
//    // get all custom taxonomies
//    $taxonomies = get_taxonomies(array('_builtin' => false), 'objects');
//    // get all custom post types
//    $post_types = get_post_types(array('public' => true, '_builtin' => false), 'objects');
//     
//    foreach ($post_types as $post_type) {
//        foreach ($taxonomies as $taxonomy) {
//         
//            // go through all post types which this taxonomy is assigned to
//            foreach ($taxonomy->object_type as $object_type) {
//                 
//                // check if taxonomy is registered for this custom type
//                if ($object_type == $post_type->rewrite['slug']) {
//             
//                    // get category objects
//                    $terms = get_categories(array('type' => $object_type, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0));
//             
//                    // make rules
//                    foreach ($terms as $term) {
//                        $rules[$object_type . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
//                    }
//                }
//            }
//        }
//    }
//    // merge with global rules
//    $wp_rewrite->rules = $rules + $wp_rewrite->rules;
//}
//add_filter('generate_rewrite_rules', 'taxonomy_slug_rewrite');