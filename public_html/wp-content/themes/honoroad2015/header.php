<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo wp_title('｜', true, 'right') ?></title>
        <meta charset="UTF-8">
        <meta content="IE=9" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description">
        <meta content="" name="author">

        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri() ?>/images/fav/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri() ?>/images/fav/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/images/fav/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri() ?>/images/fav/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/images/fav/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri() ?>/images/fav/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/images/fav/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri() ?>/images/fav/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() ?>/images/fav/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri() ?>/images/fav/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() ?>/images/fav/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri() ?>/images/fav/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() ?>/images/fav/favicon-16x16.png">
        <link rel="manifest" href="<?php echo get_template_directory_uri() ?>/images/fav/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri() ?>/images/fav/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/jquery.sidr.light.css"/>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/fancybox/jquery.fancybox.css"/>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/animate.css"/>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/style.css"/>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src='https://www.google.com/recaptcha/api.js'></script>
        <?php
        global $omw_active_menu;
        global $current_user;
        get_currentuserinfo();
        //
        global $omw_theme_settings;
        $logo = (object) json_decode($omw_theme_settings->ct_company_logo);
        ?>

        <?php if (isset($omw_theme_settings->ct_facebook_script)): ?>
            <meta property="og:url" content="<?php echo home_url() ?>" />
            <meta property="og:type" content="website" />
            <meta property="og:title" content="<?php bloginfo('name') ?>" />
            <meta property="og:description" content="<?php bloginfo('description') ?>" />
            <meta property="og:image" content="<?php echo $logo->url ?>" />
        <?php endif; ?>

        <?php if ($omw_theme_settings->ct_use_css): ?>
            <style type="text/css">
    <?php echo $omw_theme_settings->ct_custom_css; ?>
            </style>
        <?php endif; ?>
    </head>
    <body>
        <?php if (isset($omw_theme_settings->ct_facebook_script)) echo $omw_theme_settings->ct_facebook_script; ?>
        <?php if (isset($omw_theme_settings->ct_google_plus_script)) echo $omw_theme_settings->ct_google_plus_script; ?>
        <?php if (isset($omw_theme_settings->ct_twitter_script)) echo $omw_theme_settings->ct_twitter_script; ?>
        <div class="navbar-wrapper">
            <!-- hotline -->
            <header class="hot-top">
                <div class="container">
                    <ul class="top-menu pull-right nopadding">
                        <li>
                            <i class="fa fa-phone fa-2x"></i><span class="hotline"><?php echo $omw_theme_settings->ct_company_telephone ?></span>
                        </li>
                        <li>
                            <?php if (is_user_logged_in()): ?>
                                <a class="login-menu" href="javascript:void(0)"><i class="fa fa-user"></i></a>
                                <ul class="right" style="padding-left: 0;margin-left: 0;">
                                    <li>
                                        <a href="<?php bloginfo('url') ?>/profile"><h4><?php echo esc_html($current_user->display_name); ?><br/><span>(<?php echo str_replace('_', ' ', $current_user->roles[0]) ?>)</span></h4></a>
                                    </li>
                                    <li>
                                        <a href="<?php bloginfo('url') ?>/change">Change Password</a>
                                    </li>
                                    <?php if (current_user_can('sale_staff')): ?>
                                        <li><a href="">menu 1</a></li>
                                    <?php elseif (current_user_can('distribution_staff')): ?>
                                        <li><a href="">menu 2</a></li>
                                    <?php elseif (current_user_can('b2b_customer')): ?>
                                        <li><a href="">Lịch sử đặt hàng</a></li>
                                    <?php endif; ?>
                                    <li><a href="<?php echo wp_logout_url(home_url()) ?>">logout</a></li>
                                </ul>
                            <?php else: ?>
                                <a class="login-menu" href="<?php bloginfo('url') ?>/login"><i class="fa fa-user"></i></a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </header>
            <!-- hotline end-->
            <!-- navigator -->
            <header id="header" class="header">
                <nav id="nav" class="navbar navbar-defaultx navbar-oil">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div id="logo" class="navbar-header pull-left">
                                    <a id="menu-toggle" href="#sidr">
                                        <button class="navbar-toggle collapsed">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </a>
                                </div>
                                <div class="navbar-collapse collapse nopadding">
                                    <ul class="top-menu">
                                        <li class="no-hover">
                                            <a class="navbar-brand" href="<?php bloginfo('url') ?>">
                                                <img class="img-logo img-responsive" src="<?php echo $logo->url ?>" alt="<?php echo $omw_theme_settings->ct_company_name ?>" />
                                            </a>
                                        </li>
                                        <li><a class="nav-title <?php echo $omw_active_menu['home'] ?>" href="<?php bloginfo('url') ?>"><span>Trang chủ</span></a></li>
                                        <li><a class="nav-title <?php echo $omw_active_menu['about-us'] ?>" href="<?php bloginfo('url') ?>/about-us"><span>Giới thiệu</span></a></li>
                                        <li>
                                            <a class="nav-title <?php echo $omw_active_menu['product'] ?>" href="<?php bloginfo('url') ?>/product"><span>Sản phẩm</span></a>
                                            <ul>
                                                <?php
                                                $args = array(
                                                    'post_type' => 'product',
                                                    'posts_per_page' => -1,
                                                    'orderby' => 'title',
                                                    'order' => 'ASC',
                                                );
                                                $loop = new WP_Query($args);
                                                ?>
                                                <?php if ($loop->have_posts()): ?>
                                                    <?php while ($loop->have_posts()): $loop->the_post(); ?>
                                                        <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                                <?php wp_reset_postdata() ?>
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="nav-title <?php echo $omw_active_menu['news'] ?>" href="javascript:void(0);"><span>Tin tức</span></a>
                                            <ul>
                                                <?php
                                                $args = array(
                                                    'hide_empty' => 0
                                                );
                                                $terms = get_terms('news-type', $args);
                                                ?>
                                                <?php foreach ($terms as $term): ?>
                                                    <li><a class="" href="<?php echo get_term_link($term) ?>"><?php echo $term->name ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <li><a class="nav-title <?php echo $omw_active_menu['health'] ?>" href="<?php bloginfo('url') ?>/health"><span>Sức khỏe và Dinh dưỡng</span></a></li>
                                        <?php if (is_user_logged_in()): ?>
                                            <li>
                                                <a class="nav-title <?php echo $omw_active_menu['order'] ?>" href="<?php bloginfo('url') ?>/order"><span>Đặt hàng</span></a>
                                                <ul>
                                                    <li><a>Quản lý đặt hàng</a></li>
                                                    <li><a>Quản lý đơn hàng</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="nav-title <?php echo $omw_active_menu['policy'] ?>" href="<?php bloginfo('url') ?>/policy"><span>Chính sách</span></a></li>
                                        <?php endif; ?>
                                        <li><a class="nav-title <?php echo $omw_active_menu['contact'] ?>" href="<?php bloginfo('url') ?>/contact"><span>Liên hệ</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!--  wp menu -->
                <!--                <div class="clearfix"></div>
                                <nav id="nav" class="navbar navbar-defaultx navbar-oil">
                <?php
                $defaults = array(
                    'theme_location' => 'header-menu',
                    'menu' => 'Top Menu',
                    'container' => 'div',
                    'container_class' => 'container',
                    'container_id' => '',
                    'menu_class' => 'navbar-collapse collapse nopadding icemegamenu',
                    'menu_id' => 'icemegamenu',
                    'echo' => true,
                    'fallback_cb' => 'wp_page_menu',
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 0,
                    'walker' => ''
                );
//                wp_nav_menu($defaults);
                ?>
                                </nav>
                                <nav id="nav" class="navbar navbar-defaultx navbar-oil">
                <?php
                $defaults = array(
                    'theme_location' => 'sales-menu',
                    'menu' => 'Top Menu',
                    'container' => 'div',
                    'container_class' => 'container',
                    'container_id' => '',
                    'menu_class' => 'navbar-collapse collapse nopadding icemegamenu',
                    'menu_id' => 'icemegamenu',
                    'echo' => true,
                    'fallback_cb' => 'wp_page_menu',
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 0,
                    'walker' => ''
                );
//                wp_nav_menu($defaults);
                ?>
                                </nav>-->
                <!--  wp menu //-->

                <!--side-bar-->
                <ul id="sidr" class="m-sidebar">
                    <li><a class="<?php echo $omw_active_menu['home'] ?>" href="<?php bloginfo('url') ?>"><span>Trang chủ</span></a></li>
                    <li><a class="<?php echo $omw_active_menu['about-us'] ?>" href="<?php bloginfo('url') ?>/about-us"><span>Giới thiệu</span></a></li>
                    <li>
                        <a class="<?php echo $omw_active_menu['product'] ?>" href="<?php bloginfo('url') ?>/product"><span>Sản phẩm</span></a>
                        <ul class="sub-menu-sidr">
                            <?php
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
                            );
                            $loop = new WP_Query($args);
                            ?>
                            <?php if ($loop->have_posts()): ?>
                                <?php while ($loop->have_posts()): $loop->the_post(); ?>
                                    <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php wp_reset_postdata() ?>
                        </ul>
                    </li>
                    <li>
                        <a class="<?php echo $omw_active_menu['news'] ?>" href="javascript:void(0);"><span>Tin tức</span></a>
                        <ul class="sub-menu-sidr">
                            <?php
                            $args = array(
                                'hide_empty' => 0
                            );
                            $terms = get_terms('news-type', $args);
                            ?>
                            <?php foreach ($terms as $term): ?>
                                <li><a class="" href="<?php echo get_term_link($term) ?>"><?php echo $term->name ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a class="<?php echo $omw_active_menu['health'] ?>" href="<?php bloginfo('url') ?>/health"><span>Sức khỏe và Dinh dưỡng</span></a></li>
                    <?php if (is_user_logged_in()): ?>
                        <li>
                            <a class="<?php echo $omw_active_menu['order'] ?>" href="<?php bloginfo('url') ?>/order"><span>Đặt hàng</span></a>
                            <ul>
                                <li><a>Quản lý đặt hàng</a></li>
                                <li><a>Quản lý đơn hàng</a></li>
                            </ul>
                        </li>
                        <li><a class="<?php echo $omw_active_menu['policy'] ?>" href="<?php bloginfo('url') ?>/policy"><span>Chính sách</span></a></li>
                    <?php endif; ?>
                    <li><a class="<?php echo $omw_active_menu['contact'] ?>" href="<?php bloginfo('url') ?>/contact"><span>Liên hệ</span></a></li>
                </ul>
                <!--side-bar-->
            </header>
            <!-- navigator -->
        </div>