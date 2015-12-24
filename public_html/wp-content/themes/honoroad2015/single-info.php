<?php
/*
 * Author: KhangLe
 *
 */
get_header();
?>

<!-- top about us -->
<div class="container top-about-us margin-top-xl margin-bottom-xl">
    <div class="col-xs-12 col-md-9 nopadding">
        <div class="module-container">
            <header>
                <h2 class="module-title"><span><?php the_title() ?></span></h2>
            </header>
            <div class="module-article">
                <p>
                    <?php echo $post->post_content ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-3 ref-post">

        <div class="news">
            <?php get_sidebar('news-right') ?>
        </div>

        <div class="module-container">
            <header>
                <h2 class="module-title-2"><span>Bài viết</span></h2>
            </header>
            <div class="module-article-post margin-top-md">
                <ul>
                    <?php
                    $args = array(
                        'hide_empty' => 0
                    );
                    $terms = get_terms('news-type', $args);
                    ?>
                    <?php foreach ($terms as $term): ?>
                        <li><a class="" href="<?php echo get_term_link($term) ?>"><?php echo $term->name ?></a></li>
                    <?php endforeach; ?>

                    <?php
                    $args = array(
                        'post_type' => 'info',
                        'posts_per_page' => -1,
                        'post__not_in' => array($post->ID),
                    );
                    $loop = new WP_Query($args);
                    ?>
                    <?php if ($loop->have_posts()): ?>
                        <?php while ($loop->have_posts()): $loop->the_post(); ?>
                            <li><a href="<?php echo get_permalink() ?>"><?php the_title() ?></a></li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata() ?>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- top about us //-->

<?php get_footer(); ?>