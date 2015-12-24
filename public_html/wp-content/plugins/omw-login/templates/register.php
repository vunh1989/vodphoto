<?php
/**
 * 
 * Template Name: Register
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
        <div class="message-box message-error">
            <span class="icon-attention"></span>
            <?php if ($failed == 'invalid_character'): ?>
                Username can only contain alphanumerical characters, "_" and "-". Please choose another username.
            <?php elseif ($failed == 'username_exists'): ?>
                Username already in use.
            <?php elseif ($failed == 'email_exists'): ?>
                E-mail already in use. Maybe you are already registered?
            <?php elseif ($failed == 'empty'): ?>
                All fields are required.
            <?php else: ?>
                An error occurred while registering the new user. Please try again.
            <?php endif; ?>
        </div>

        <header class="entry-header">
            <h1 class="entry-title">Register</h1>
        </header>

        <div class="entry-content">
            <p>Sign up for the cool stuff!</p>
        </div>

        <form name="registerform" id="registerform" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
            <p>
                <label for="user_login">Username</label>
                <input type="text" name="user_login" id="user_login" class="input" value="">
            </p>
            <p>
                <label for="user_email">E-mail</label>
                <input type="text" name="user_email" id="user_email" class="input" value="">
            </p>
            <p style="display:none">
                <label for="confirm_email">Please leave this field empty</label>
                <input type="text" name="confirm_email" id="confirm_email" class="input" value="">
            </p>

            <p id="reg_passmail">A password will be e-mailed to you.</p>

            <input type="hidden" name="redirect_to" value="/login/?action=register&amp;success=1" />
            <p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Register" /></p>
        </form>
    </div>
</div>

<?php get_footer(); ?>