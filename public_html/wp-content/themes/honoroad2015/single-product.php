<?php
/*
 * Author: KhangLe
 *
 */
get_header();
?>

<!-- product detail -->
<div class="container prodcut-detail margin-top-xl margin-bottom-xl">
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <ul class="thumb-list-side">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                );
                $loop = new WP_Query($args);
                ?>
                <?php if ($loop->have_posts()): ?>
                    <?php while ($loop->have_posts()): $loop->the_post(); ?>
                        <li>
                            <?php $prod_img = get_field('images'); ?>
                            <a class="<?php echo (get_query_var('product') == $post->post_name) ? 'active' : '' ?>" href="<?php the_permalink() ?>">
                                <img width="50" src="<?php echo $prod_img[0]['image']['sizes']['thumbnail'] ?>" alt="<?php the_title() ?>"/>
                                <span><?php the_title() ?></span>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata() ?>
            </ul>
        </div>
        <div class="col-xs-12 col-md-9">
            <div class="col-xs-12 col-md-6">

                <div class="image-block clearfix">
                    <?php $prod_img = get_field('images'); ?>
                    <img class="img-responsive center-block" src="<?php echo $prod_img[0]['image']['url'] ?>" />
                </div>

                <div class="thumb-list clearfix">
                    <?php while (have_rows('images')): the_row(); ?>
                        <?php
                        $prod_img = get_sub_field('image');
                        //
                        $url = $prod_img['url'];
                        $prod_thumb = $prod_img['sizes']['thumbnail'];
                        $prod_large = $prod_img['sizes']['large'];
                        ?>

                        <ul class="touch-list">
                            <li>
                                <a href="javascript:void(0)" data-large="<?php echo $prod_large ?>" data-full="<?php echo $url ?>"><img width="50" src="<?php echo $prod_thumb ?>"/></a>
                            </li>
                        </ul>

                    <?php endwhile; ?>
                </div>
                
                <div class="social-navigation">
                    <div class="fb-share-button" 
                         data-href="<?php bloginfo('url') ?>" 
                         data-layout="button_count">
                    </div>
                </div>

                <div class="prod-detail margin-top-xl">
                    <?php if (trim(get_field('description')) != ''): ?>
                        <div class="prod-attr">Mô tả:</div> 
                        <p>
                            <?php echo get_field('description') ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <h2 class="prod-name"><?php the_title() ?></h2>
                <div class="prod-detail">
                    <?php if (trim(get_field('ingredients')) != ''): ?>
                        <div class="prod-attr"><?php echo get_field('title_1') ?>:</div> 
                        <p>
                            <?php echo get_field('ingredients') ?>
                        </p>
                    <?php endif; ?>
                    <?php if (trim(get_field('features')) != ''): ?>
                        <div class="prod-attr"><?php echo get_field('title_2') ?>:</div>
                        <p>
                            <?php echo get_field('features') ?>
                        </p>
                    <?php endif; ?>
                    <h5 class="prod-attr"><?php echo get_field('title_3') ?></h5>
                    <?php if (have_rows('sensory')): ?>
                        <div class="prod-attr"><?php echo get_field('title_4') ?></div>
                        <p>
                            <?php while (have_rows('sensory')): the_row(); ?>
                                <?php echo get_sub_field('attribute') ?>：<?php echo get_sub_field('description') ?><br/>
                            <?php endwhile; ?>
                        </p>
                    <?php endif; ?>
                    <?php if (have_rows('physical_and_chemical_indicators')): ?>
                        <div class="prod-attr"><?php echo get_field('title_5') ?></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hạng mục</th>
                                    <th>Đơn vị</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <?php while (have_rows('physical_and_chemical_indicators')): the_row(); ?>
                                <tr>
                                    <td><?php echo get_sub_field('item') ?></td>
                                    <td><?php echo get_sub_field('unit') ?></td>
                                    <td><?php echo get_sub_field('amount') ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    <?php endif; ?>
                    <?php if (trim(get_field('usage')) != ''): ?>
                        <div class="prod-attr"><?php echo get_field('title_6') ?></div>
                        <p>
                            <?php echo get_field('usage') ?>
                        </p>
                    <?php endif; ?>
                    <?php if (trim(get_field('target_user')) != ''): ?>
                        <div class="prod-attr"><?php echo get_field('title_7') ?></div>
                        <p>
                            <?php echo get_field('target_user') ?>
                        </p>
                    <?php endif; ?>
                    <?php if (trim(get_field('preservation')) != ''): ?>
                        <div class="prod-attr"><?php echo get_field('title_8') ?></div>
                        <p>
                            <?php echo get_field('preservation') ?>
                        </p>
                    <?php endif; ?>
                    <?php if (trim(get_field('number_of_quality_standard')) != ''): ?>
                        <div class="prod-attr"><?php echo get_field('title_9') ?></div>
                        <p>
                            <?php echo get_field('number_of_quality_standard') ?>
                        </p>
                    <?php endif; ?>
                    <?php if (have_rows('nutritional_information')): ?>
                        <h5 class="prod-attr"><?php echo get_field('title_10') ?></h5>
                        <div>*Hàm lượng trung bình trong mỗi khẩu phần</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hạng mục</th>
                                    <th>*14g</th>
                                    <th>*100g</th>
                                </tr>
                            </thead>
                            <?php while (have_rows('nutritional_information')): the_row(); ?>
                                <tr>
                                    <td><?php echo get_sub_field('attribute') ?></td>
                                    <td><?php echo get_sub_field('average_in_14g') ?></td>
                                    <td><?php echo get_sub_field('average_in_100g') ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    <?php endif; ?>
                    <?php if (trim(get_field('usage_in_field')) != ''): ?>
                        <div class="prod-attr"><?php echo get_field('title_11') ?></div>
                        <p>
                            <?php echo get_field('usage_in_field') ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (have_rows('feature_images')): ?>
                <div class="col-xs-12 col-md-4">
                    <div class="prod-img-features">
                        <?php while (have_rows('feature_images')): the_row(); ?>
                            <?php
                            $feature_images = get_sub_field('image');
                            //
                            $url = $feature_images['url'];
                            $feature_images_thumb = $feature_images['sizes']['medium'];
                            ?>
                            <a class="fancybox-features" href="<?php echo $url ?>" rel="usage-products" class="col-md-3 nopadding"><img class="img-responsive" src="<?php echo $feature_images_thumb ?>" alt=""/></a>
                            <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- product detail //-->

<?php get_footer(); ?>