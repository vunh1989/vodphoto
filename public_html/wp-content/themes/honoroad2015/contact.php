<?php
/*
 * Author: KhangLe
 * Template Name: Contact
 *
 */

require_once 'includes/lib/ReCaptcha/src/autoload.php';

global $omw_theme_settings;

$secret = $omw_theme_settings->ct_recaptcha_private_key;

if (isset($_POST['g-recaptcha-response'])) {

    $recaptcha = new \ReCaptcha\ReCaptcha($secret);

    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    if ($resp->isSuccess()) {

        $data = array(
            'title' => isset($_POST['re_title']) ? $_POST['re_title'] : '',
            'name' => isset($_POST['re_name']) ? $_POST['re_name'] : '',
            'email' => isset($_POST['re_email']) ? $_POST['re_email'] : '',
            'company' => isset($_POST['re_company']) ? $_POST['re_company'] : '',
            'phone' => isset($_POST['re_phone']) ? $_POST['re_phone'] : '',
            'fax' => isset($_POST['re_fax']) ? $_POST['re_fax'] : '',
            'content' => isset($_POST['re_content']) ? $_POST['re_content'] : '',
            'entry_time' => gmdate("Y/m/d H:i:s", time() + 9 * 3600),
            'entry_host' => gethostbyaddr(getenv("REMOTE_ADDR")),
            'entry_ua' => getenv("HTTP_USER_AGENT"),
        );
        /* -------------------------------------------------------------- send mail */
        require_once 'includes/lib/Twig/Autoloader.php';
        Twig_Autoloader::register();

        $loader = new Twig_Loader_String;

        $twig = new Twig_Environment($loader);

        $from = $omw_theme_settings->ct_from_email;
        $fromname = $omw_theme_settings->ct_from_name;

        // Mail to Client
        $body_client = $omw_theme_settings->ct_mail_content_client;
        if (isset($body_client) && $body_client != '') {
            $body_client = $twig->render($body_client, $data);
            //
            $subject_client = $twig->render($omw_theme_settings->ct_mail_subject_client, $data);
            //
            $headers = 'From: ' . $fromname . ' <' . $from . '>' . '\r\n';
            //	
            wp_mail($data['email'], stripslashes($subject_client), stripslashes($body_client), $headers);
        }

        // Mail to Admin
        $body_admin = $omw_theme_settings->ct_mail_content_admin;
        if (isset($body_admin) && $body_admin != '') {
            $body_admin = $twig->render($body_admin, $data);
            //
            $subject_admin = $omw_theme_settings->ct_mail_subject_admin;
            //
            $list_email = $omw_theme_settings->ct_mail_list_admin;
            if (isset($list_email) && $list_email != '') {
                $list_email = preg_split('/\r\n|\n|\r/', $list_email);
                //
                $headers = 'From: ' . $fromname . ' <' . $from . '>' . '\r\n';
                //
                wp_mail($list_email, stripslashes($subject_admin), stripslashes($body_admin), $headers);
            }
        }

        wp_redirect(home_url() . '/contact/thankyou');
    } else {
        wp_redirect(home_url());
    }
}
get_header();
?>

<!-- contact info -->
<div class="container contact-info margin-top-xl margin-bottom-xl">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="contact-info-form">
                <h3>Thông tin phản hồi của khách hàng</h3>
                <form id="contact-info-form" name="contact-info-form" method="post" action="<?php bloginfo('url') ?>/contact">
                    <div class="form-group">
                        <input type="text" id="re_title" name="re_title" value="" placeholder="Chủ đề" class="form-control" />
                    </div>
                    <div class="form-group col-xs-12 col-md-6 nopadding-left">
                        <input type="text" id="re_name" name="re_name" value="" placeholder="Tên người liên hệ" class="form-control" />
                    </div>
                    <div class="form-group col-xs-12 col-md-6 nopadding-right">
                        <input type="text" id="re_email" name="re_email" value="" placeholder="Email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="re_company" name="re_company" value="" placeholder="Tên công ty" class="form-control" />
                    </div>
                    <div class="form-group col-xs-12 col-md-6 nopadding-left">
                        <input type="text" id="re_phone" name="re_phone" value="" placeholder="Điện thoại" class="form-control" />
                    </div>
                    <div class="form-group col-xs-12 col-md-6 nopadding-right">
                        <input type="text" id="re_fax" name="re_fax" value="" placeholder="Fax" class="form-control" />
                    </div>
                    <div class="form-group">
                        <textarea id="re_content" name="re_content" class="form-control vert" placeholder="Nội dung"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="<?php echo $omw_theme_settings->ct_recaptcha_public_key ?>"></div>
                        <div id="catpcha"></div>
                    </div>
                    <div class="form-group">
                        <div class="controls center-block">
                            <button type="submit" class="btn btn-success inline-block">Gửi Thư</button>
                            <button type="reset" class="btn btn-success inline-block">Xóa</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <?php
            $args = array(
                'hide_empty' => 0
            );
            $terms = get_terms('company-branch', $args);
            ?>
            <?php foreach ($terms as $term): ?>
                <div class="all-coms clearfix">
                    <h2><?php echo $term->name ?></h2>
                    <?php
                    $args = array(
                        'post_type' => 'company-info',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'company-branch',
                                'field' => 'slug',
                                'terms' => array($term->slug),
                            ),
                        ),
                    );
                    $loop = new WP_Query($args);
                    ?>
                    <?php if ($loop->have_posts()): ?>
                        <?php while ($loop->have_posts()): $loop->the_post(); ?>
                            <div class="col-xs-3 nopadding-left nopadding-right">
                                <?php $company_image = get_field('image') ?>
                                <img class="img-responsive" src="<?php echo $company_image['sizes']['medium'] ?>" />
                            </div>
                            <div class="col-xs-9">
                                <p><?php echo get_field('address') ?></p>
                                <p><span class="c-info-title">Điện thoại</span> <?php echo get_field('tel') ?></p>
                                <p><span class="c-info-title">Fax</span> <?php echo get_field('fax') ?></p>
                                <p><span class="c-info-title">Email</span> <?php echo get_field('email') ?></p>
                                <p><span class="c-info-title">Website</span> <?php echo get_field('website') ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata() ?>
                </div>
            <?php endforeach; ?>
            <div class="margin-top-xl"></div>
            <?php get_template_part('part-google-map') ?>
        </div>
    </div>
</div>
<!-- contact info end -->

<?php get_footer(); ?>