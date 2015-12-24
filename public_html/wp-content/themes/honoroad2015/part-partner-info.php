<!-- main bottom -->
<div id="main-bottom" class="margin-top-lg">
    <div class="container">
        <div class="row">
            <?php
            $i = 1;
            $args = array(
                'post_type' => 'partner-info',
                'posts_per_page' => -1,
            );
            $loop = new WP_Query($args);
            ?>
            <?php if ($loop->have_posts()): ?>
                <?php while ($loop->have_posts()): $loop->the_post(); ?>
                    <?php
                    $image = get_field('logo');
                    // thumbnail
                    $size = 'medium';
                    $thumb_logo = $image['sizes'][$size];
                    ?>
                    <div class="col-xs-12 col-md-4 wow fadeInUp" data-wow-delay="<?php echo $i * 0.25 ?>s">
                        <article>
                            <figure>
                                <img class="img-responsive center-block" src="<?php echo $thumb_logo ?>"/>
                            </figure>
                        </article>
                    </div>
                    <?php $i++; ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata() ?>
        </div>
    </div>
</div>
<!-- main bottom end -->