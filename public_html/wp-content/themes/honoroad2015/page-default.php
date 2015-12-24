<?php
/*
 * Author: KhangLe
 * Template Name: Default
 */
get_header();
?>

<div class="container margin-top-xl margin-bottom-lg">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <?php echo $post->post_content; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>