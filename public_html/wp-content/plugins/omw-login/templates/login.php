<?php
/**
 * 
 * Template Name: Login
 * 
 */
?>

<?php
$action = !empty($_GET['action']) && ($_GET['action'] == 'register' || $_GET['action'] == 'forgot' || $_GET['action'] == 'resetpass') ? $_GET['action'] : 'login';
$success = !empty($_GET['success']);
$failed = !empty($_GET['failed']) ? $_GET['failed'] : false;
?>

<?php get_header(); ?>

<div class="container user-fe-form margin-top-xl margin-bottom-xl">
    <div class="row">
        <div class="login-holder">
            <header class="entry-header">
                <h1 class="entry-title">Đăng Nhập</h1>
            </header>
            <?php
            $args = array(
                'form_id' => 'login-form',
                'id_submit' => __('submit-login'),
                'label_remember' => __('Nhớ mật khẩu'),
                'label_log_in' => __('Submit'),
            );
            ?>
            <?php wp_login_form($args); ?>
        </div>
    </div>
</div>

<?php get_template_part('part-google-map') ?>

<?php get_footer(); ?>