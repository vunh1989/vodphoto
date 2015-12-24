<aside class="news-most-ref">
    <h4 class="title"><span>Tin xem nhiều</span></h4>
    <?php
    $args = array(
        'post_type' => array('health'),
        'posts_per_page' => 9,
        'order' => 'DESC',
        'orderby' => 'meta_value_num',
        'meta_key' => 'view-news',
        'tax_query' => array(
            array(
                'taxonomy' => 'news-type',
                'field' => 'slug',
                'terms' => array('recruiting'),
                'operator' => 'NOT IN',
            ),
        ),
    );
    $loop = new WP_Query($args);
    $i = 1;
    ?>
    <ul>
        <?php if ($loop->have_posts()): ?>
            <?php while ($loop->have_posts()): $loop->the_post(); ?>
                <li>
                    <a href="<?php the_permalink() ?>">
                        <span class="num"><?php echo $i ?></span><span class="ref-title"><?php the_title() ?></span>
                    </a>
                </li>
                <?php $i++ ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_postdata() ?>
    </ul>
</aside>