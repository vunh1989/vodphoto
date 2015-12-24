<?php
/**
 * 
 * Template Name: Change
 * 
 */
global $current_user;
get_currentuserinfo();

if (!empty($_POST) && !empty($_POST['action']) && $_POST['action'] == 'update-user') {

    /* Update user password */
    if (!empty($_POST['current_pass']) && !empty($_POST['pass1']) && !empty($_POST['pass2'])) {

        if (!wp_check_password($_POST['current_pass'], $current_user->user_pass, $current_user->ID)) {
            $error = 'Your current password does not match. Please retry.';
        } elseif ($_POST['pass1'] != $_POST['pass2']) {
            $error = 'The passwords do not match. Please retry.';
        } elseif (strlen($_POST['pass1']) < 4) {
            $error = 'A bit short as a password, don\'t you thing?';
        } elseif (false !== strpos(wp_unslash($_POST['pass1']), "\\")) {
            $error = 'Password may not contain the character "\\" (backslash).';
        } else {
            $error = wp_update_user(array('ID' => $current_user->ID, 'user_pass' => esc_attr($_POST['pass1'])));

            if (!is_int($error)) {
                $error = 'An error occurred while updating your profile. Please retry.';
            } else {
                $error = false;
            }
        }

        if (empty($error)) {
            do_action('edit_user_profile_update', $current_user->ID);
            wp_redirect(site_url('/change') . '?success=1');
        }
    }
}

get_header();
?>

<div class="container margin-top-xl margin-bottom-xl profile">
    <div class="row">

        <?php while (have_posts()) : the_post(); ?>

            <article id="page-<?php the_ID(); ?>" class="meta-box hentry">
                <div class="col-xs-12 col-md-6">
                    <?php if (!empty($_GET['success'])): ?>
                        <div class="message-box message-success">
                            <span class="icon-thumbs-up"></span>
                            Profile updated successfully!
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($error)): ?>
                        <div class="message-box message-error">
                            <span class="icon-thumbs-up"></span>
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <header class="entry-header">
                        <h1 class="entry-title">Welcome <span class="userColor"><?php echo esc_html($current_user->display_name); ?></span></h1>
                    </header>

                    <h2>Change password</h2>

                    <form class="form-horizontal form-profile" method="post" id="adduser" action="/change">

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="current_pass">Current Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="current_pass" type="password" id="current_pass">
                            </div>
                        </div>

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
                        
                        <?php
                        // action hook for plugin and extra fields
                        do_action('edit_user_profile', $current_user);
                        ?>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button name="updateuser" id="updateuser" type="submit" class="btn btn-success">Update profile</button>
                                <input name="action" type="hidden" id="action" value="update-user" />
                            </div>
                        </div>

                    </form>
                </div>
            </article>

        <?php endwhile; ?>

    </div><!-- .main-column -->

</div>

<?php get_footer(); ?>