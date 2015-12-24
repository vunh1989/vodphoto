<?php
/**
 * 
 * Template Name: Forgot Password
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

    <?php if ($action == 'forgot' && $failed): ?>
        <div class="message-box message-error">
            <span class="icon-attention"></span>
            <?php if ($failed == 'wrongkey'): ?>
                The reset key is wrong or expired. Please check that you used the right reset link or request a new one.
            <?php else: ?>
                Sorry, we couldn't find any user with that username or email.
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <header class="entry-header">
        <h1 class="entry-title">Password recovery</h1>
    </header>

    <div class="entry-content">
        <p>Please enter your username or email address. You will receive a link to create a new password.</p>
    </div>

    <form name="lostpasswordform" id="lostpasswordform" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" method="post" class="form--horizontal">
        <div class="form-group">
            <label for="user_login" class="col-sm-2 control-label">Username or E-mail:</label>
            <div class="col-sm-8">
                <input type="text" name="user_login" id="user_login" class="form-control" value="">
            </div>
            <div class="col-sm-2">
                <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-success" value="Get New Password" />
            </div>
        </div>
        <input type="hidden" name="redirect_to" value="/login/?action=forgot&amp;success=1">
    </form>

</div>

<?php get_footer(); ?>