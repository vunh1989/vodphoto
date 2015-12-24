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
            <?php // $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
            <!--<h2 class="tax-title"><span><?php // echo $term->name      ?></span></h2>-->
            <section id="news-list">
                <?php
                $args = array(
                    'post_type' => array('news'),
                    'order' => 'DESC',
                    'orderby' => 'post_date',
                    'paged' => $paged,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'news-type',
                            'field' => 'slug',
                            'terms' => array(get_query_var('term')),
                        ),
                    ),
                );
                $wp_query = new WP_Query($args);
                ?>
                <?php if ($wp_query->have_posts()): ?>
                    <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                        <?php $image = get_field('image'); ?>
                        <div class="col-xs-12 col-md-12 padding-left-xs padding-right-xs margin-bottom-xs margin-top-xs">
                            <article class="box-row">
                                <a href="<?php the_permalink() ?>">
                                    <figure>
                                        <img width="100" src="<?php echo $image['sizes']['thumbnail'] ?>" class="img-responsive center-block" />
                                    </figure>
                                    <h2>
                                        <?php the_title() ?>
                                        <span class="hidden-sm hidden-xs des">
                                            <?php echo wp_trim_words(get_the_content(), 50, '...') ?>
                                        </span>
                                    </h2>
                                    <span class="hidden-lg hidden-md des">
                                        <?php echo wp_trim_words(get_the_content(), 50, '...') ?>
                                    </span>
                                </a>
                            </article>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </section>
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