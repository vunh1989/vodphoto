<?php
/*
 * Author: KhangLe
 *
 */
get_header();
?>

<!-- product all -->
<div class="container product-all margin-top-lg margin-bottom-lg">
    <div class="row margin-top-xl">
        <?php
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
        );
        $loop = new WP_Query($args);
        ?>
        <?php if ($loop->have_posts()): ?>
            <?php while ($loop->have_posts()): $loop->the_post(); ?>
                <div class="col-xs-12 col-md-4">
                    <a href="<?php the_permalink() ?>">
                        <?php if (have_rows('images')): ?>
                            <?php while (have_rows('images')): the_row(); ?>
                                <?php
                                $image = get_sub_field('image');
                                // thumbnail
                                $size = 'large';
                                $thumb = $image['sizes'][$size];
                                ?>
                                <img class="img-responsive center-block" src="<?php echo $thumb ?>" alt="<?php the_title() ?>" />
                                <?php break; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <h2 class="prod-title"><?php the_title() ?></h2>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
<!-- product all //-->

<?php get_footer(); ?>