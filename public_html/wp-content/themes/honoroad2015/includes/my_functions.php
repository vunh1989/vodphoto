<?php

add_shortcode('omw_list_recent_post', 'omw_list_recent_post');

/**
 * 
 * @param type $atts
 * @return string
 */
function omw_list_recent_post($atts) {


    $para = shortcode_atts(array(
        'post_type' => 'post_type',
        'number' => 'number',
            ), $atts);

    $tmpl = '';
    $limit = isset($para['number']) ? $para['number'] : 5;

    switch ($para['post_type']) {
        case 'news':
            $args = array(
                'post_type' => array($para['post_type']),
                'posts_per_page' => $limit,
                'order' => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'news-type',
                        'field' => 'slug',
                        'terms' => array('recruiting', 'promotion'),
                        'operator' => 'NOT IN',
                    ),
                ),
            );
            $loop = new WP_Query($args);

            $tmpl .= '<ul class="recent_short">';
            if ($loop->have_posts()) {
                while ($loop->have_posts()) {
                    $loop->the_post();
                    $image = get_field('image');
                    $tmpl .= '<li>';
                    $tmpl .= '<a href="' . get_permalink() . '">';
                    $tmpl .= '<figure><img width="50" src="' . $image['sizes']['thumbnail'] . '" class="img-responsive center-block" /></figure>';
                    $tmpl .= '<span class="p-title">' . get_the_title() . '</span>';
                    $tmpl .= '</a>';
                    $tmpl .= '</li>';
                }
            }
            $tmpl .= '</ul>';
            wp_reset_postdata();
            break;
        case 'promotion':
            $args = array(
                'post_type' => array($para['post_type']),
                'posts_per_page' => $limit,
                'order' => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'news-type',
                        'field' => 'slug',
                        'terms' => array('recruiting', 'event'),
                        'operator' => 'NOT IN',
                    ),
                ),
            );
            $loop = new WP_Query($args);

            $tmpl .= '<ul class="recent_short">';
            if ($loop->have_posts()) {
                while ($loop->have_posts()) {
                    $loop->the_post();
                    $image = get_field('image');
                    $tmpl .= '<li>';
                    $tmpl .= '<a href="' . get_permalink() . '">';
                    $tmpl .= '<figure><img width="50" src="' . $image['sizes']['thumbnail'] . '" class="img-responsive center-block" /></figure>';
                    $tmpl .= '<span class="p-title">' . get_the_title() . '</span>';
                    $tmpl .= '</a>';
                    $tmpl .= '</li>';
                }
            }
            $tmpl .= '</ul>';
            wp_reset_postdata();
            break;
    }

    return $tmpl;
}

/* -------------------------------------------------------------------------- */
add_action('wp_ajax_update_view', 'update_view');

/**
 * call response ajax
 */
function update_view() {
    $action = $_POST['action'];
    $id = $_POST['id'];
    switch ($action) {
        case 'update_view':
            setPostViews($id, 'view-news');
            break;
    }
    exit;
}

/* -------------------------------------------------------------------------- */

/**
 * 
 * @global type $post
 * @param type $post_type
 * @param type $term_name
 * @return type
 */
function get_most_recent_permalink($post_type, $term_name) {
    global $post;
    $tmp_post = $post;
    $args = array(
        'post_type' => $post_type,
        'numberposts' => 1,
        'offset' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'news-type',
                'field' => 'slug',
                'terms' => array($term_name),
            ),
        ),
    );
    $myposts = get_posts($args);
    $permalink = get_permalink($myposts[0]->ID);
    $post = $tmp_post;
    return $permalink;
}

/* -------------------------------------------------------------------------- */

/**
 * 
 * @global type $wp_query
 * @global type $wp
 */
function redirect_post_type_taxonomy() {
    global $wp_query;
    global $wp;

    $post_type = get_query_var('post_type');
    $name = get_query_var('name');

    switch ($post_type) {
        case 'news':
            switch ($name) {
                case 'event':
                case 'promotion':
                case 'recruiting':
                    wp_redirect(get_most_recent_permalink($post_type, $name));
                    exit;
                    break;
            }
            break;
    }
}

//add_action('template_redirect', 'redirect_post_type_taxonomy');

/**
 * 
 * @global array $custom_post_types
 * @param type $q
 * @return type
 */
function add_custom_posts_per_page(&$q) {
    if (!is_admin()) {
        global $custom_post_types;

        $custom_post_types = array('health');

        if ($q->is_archive) { // any archive
            if (isset($q->query_vars['post_type'])) {
                if (in_array($q->query_vars['post_type'], $custom_post_types)) {
                    $q->set('posts_per_page', 12);
                }
            }
        }
        //
        return $q;
    }
}

//add_filter('parse_query', 'add_custom_posts_per_page');

/**
 * 
 * @global type $wp_query
 * @return type
 * 
 * Function from Genesis Framework
 * 
 */
function wpbeginner_numeric_posts_nav() {

    if (is_singular())
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** 	Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;

    /** 	Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (( $paged + 2 ) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="navigation"><ul class="pagination">' . "\n";

    /** 	Previous Post Link */
    if (get_previous_posts_link())
        printf('<li>%s</li>' . "\n", get_previous_posts_link('Prev'));

    /** 	Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links))
            echo '<li>…</li>';
    }

    /** 	Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** 	Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /** 	Next Post Link */
    if (get_next_posts_link())
        printf('<li>%s</li>' . "\n", get_next_posts_link('Next'));

    echo '</ul></nav>' . "\n";
}

/* -------------------------------------------------------------------------- */

/**
 * 
 * @param type $post_ID
 * @return string
 * 
 * Reference http://wpsnipp.com/index.php/functions-php/track-post-views-without-a-plugin-using-post-meta/#
 * 
 */
function getPostViews($post_ID, $count_key = '') {
    if ($count_key == '') {
        $count_key = 'post_views_count';
    }
    //
    $count = get_post_meta($post_ID, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '0');
        return "0";
    }
    return $count;
}

/**
 * 
 * @param type $post_ID
 * 
 * Reference http://wpsnipp.com/index.php/functions-php/track-post-views-without-a-plugin-using-post-meta/#
 * 
 */
function setPostViews($post_ID, $count_key = '') {
    if ($count_key == '') {
        $count_key = 'post_views_count';
    }
    //
    $current_date = date('Y-m-d H:i:s');
    //
    $count = get_post_meta($post_ID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '1');
        add_post_meta($post_ID, $count_key . '_date', $current_date);
    } else {
        $current = strtotime($current_date);
        $timestamp = strtotime(get_post_meta($post_ID, $count_key . '_date', true));
        if (($current - $timestamp) < 10) {
            // do nothing
        } else {
            $count++;
            update_post_meta($post_ID, $count_key, $count);
            update_post_meta($post_ID, $count_key . '_date', $current_date);
        }
    }
}

// Remove issues with prefetching adding extra views
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
