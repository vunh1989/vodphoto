<?php
/*
 * Author: KhangLe
 *
 */
get_header();
?>

<div class="container news margin-top-xl margin-bottom-xl">
    <div class="row">
        <div class="col-xs-12 col-md-2">
            <?php get_sidebar('news-left') ?>
        </div>
        <div class="col-xs-12 col-md-7 nopadding">
            <?php
            $args = array(
                'post_type' => array('news', 'health'),
                'posts_per_page' => 12,
                'order' => 'DESC',
                'orderby' => 'post_date',
                'paged' => $paged,
            );
            $wp_query = new WP_Query($args);
            ?>
            <?php if ($wp_query->have_posts()): ?>
                <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                    <?php $image = get_field('image'); ?>
                    <div class="col-xs-12 col-md-3 padding-left-xs padding-right-xs margin-bottom-sm margin-top-xs">
                        <article class="box">
                            <a href="<?php the_permalink() ?>">
                                <figure>
                                    <img src="<?php echo $image['sizes']['thumbnail'] ?>" class="img-responsive center-block" />
                                </figure>
                                <h2><?php the_title() ?></h2>
                            </a>
                        </article>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <div class="col-xs-12">
                <div class="paging-navigation text-center">
                    <?php
                    wpbeginner_numeric_posts_nav();
                    ?>
                </div>
            </div>
            <?php wp_reset_postdata() ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <?php get_sidebar('news-right') ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>