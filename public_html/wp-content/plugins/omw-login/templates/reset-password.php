<?php
/**
 * 
 * Template Name: Reset Password
 * 
 */
get_header();
?>

<?php
$action = !empty($_GET['action']) && ($_GET['action'] == 'register' || $_GET['action'] == 'forgot' || $_GET['action'] == 'resetpass') ? $_GET['action'] : 'login';
$success = !empty($_GET['success']);
$failed = !empty($_GET['failed']) ? $_GET['failed'] : false;
?>

<div class="container user-fe-form margin-top-xl margin-bottom-xl">
    <div class="row">
        <div class="login-holder">
            <?php if ($failed): ?>
                <div class="message-box message-error">
                    <span class="icon-attention"></span>
                    The passwords don't match. Please try again.
                </div>

            <?php endif; ?>

            <header class="entry-header">
                <h1 class="entry-title">Reset password</h1>
            </header>

            <div class="entry-content">
                <p>Create a new password for your account.</p>
            </div>

            <form name="resetpasswordform" id="resetpasswordform" class="form-horizontal" action="<?php echo site_url('wp-login.php?action=resetpass', 'login_post') ?>" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="pass1">New Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="pass1" type="password" id="pass1">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="pass2">Confirm Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="pass2" type="password" id="pass2">
                    </div>
                </div>

                <input type="hidden" name="redirect_to" value="/login/?action=resetpass&amp;success=1">
                <?php
                $rp_key = '';
                $rp_cookie = 'wp-resetpass-' . COOKIEHASH;
                if (isset($_COOKIE[$rp_cookie]) && 0 < strpos($_COOKIE[$rp_cookie], ':')) {
                    list( $rp_login, $rp_key ) = explode(':', wp_unslash($_COOKIE[$rp_cookie]), 2);
                }
                ?>
                <input type="hidden" name="rp_key" value="<?php echo esc_attr($rp_key); ?>">
                <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-success" value="Get New Password" />
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>