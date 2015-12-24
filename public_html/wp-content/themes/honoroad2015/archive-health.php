<?php
/*
 * Author: KhangLe
 *
 */
get_header();
?>

<div class="row nopadding nomargin" style="min-height: 150px;">
    <div class="header-sta-health">
        <h2></h2>
    </div>
</div>

<div class="container health-nutri margin-top-xl margin-bottom-xl">
    <div class="row">
        <?php
        $args = array(
            'post_type' => 'health',
            'paged' => $paged,
        );
        $wp_query = new WP_Query($args);
        ?>
        <?php if ($wp_query->have_posts()): ?>
            <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                <?php $image = get_field('image'); ?>
                <div class="col-xs-12 col-md-3">
                    <article>
                        <a class="fancybox" href="#content-<?php the_ID() ?>" rel="health-news" data-id="<?php the_ID() ?>">
                            <figure>
                                <img src="<?php echo $image['sizes']['thumbnail'] ?>" class="img-responsive center-block" />
                            </figure>
                            <h2><?php the_title() ?></h2>
                        </a>
                    </article>
                    <div class="fan-content" id="content-<?php the_ID() ?>">
                        <h2><?php the_title() ?></h2>
                        <p><?php echo $post->post_content ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="paging-navigation text-center">
            <?php wpbeginner_numeric_posts_nav(); ?>
        </div>
    </div>
    <?php wp_reset_postdata() ?>
</div>

<?php get_footer(); ?>