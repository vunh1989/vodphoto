<?php
/**
 * 
 * Template Name: Profile
 * 
 */
global $current_user;
get_currentuserinfo();

$user_id = $current_user->ID;

if (!empty($_POST) && !empty($_POST['action']) && $_POST['action'] == 'update-user') {
    if (isset($_POST['user_fullname'])) {
        update_user_meta($user_id, 'user_fullname', $_POST['user_fullname']);
    }
    if (isset($_POST['user_phonenumber'])) {
        update_user_meta($user_id, 'user_phonenumber', $_POST['user_phonenumber']);
    }
    if (isset($_POST['user_address'])) {
        update_user_meta($user_id, 'user_address', $_POST['user_address']);
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

                    <h2>Update Profile</h2>

                    <form class="form-horizontal form-profile" method="post" id="adduser" action="">

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="user_fullname">Fullname</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="user_fullname" type="text" id="user_fullname" value="<?php echo esc_attr(get_the_author_meta('user_fullname', $current_user->ID)) ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="user_phonenumber">Phone number</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="user_phonenumber" type="text" id="user_phonenumber" value="<?php echo esc_attr(get_the_author_meta('user_phonenumber', $current_user->ID)) ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="user_address">Address</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="user_address" type="text" id="user_address" value="<?php echo esc_attr(get_the_author_meta('user_address', $current_user->ID)) ?>">
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