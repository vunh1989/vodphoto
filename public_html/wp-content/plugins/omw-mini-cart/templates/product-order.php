<?php
/*
 * Author: KhangLe
 *
 */

if (!defined('ABSPATH')) {
    die('No script kiddies please!');
}
?>

<?php if (is_user_logged_in() && current_user_can('sale_staff')): ?>
<div class="box-prod-info">
    <table class="table">
        <thead>
            <tr>
                <th>Loại</th>
                <th>Giá</th>
                <th>Số lượng</th>
            </tr>
        </thead>
        <?php if (have_rows('price_plans')): ?>
            <?php while (have_rows('price_plans')): the_row(); ?>
                <tr>
                    <td><?php echo get_sub_field('weight') ?></td>
                    <td align="right" class=""><span class="new-price padding-right-lg"><?php echo get_sub_field('price') ?></span></td>
                    <td>
                        <div class="box-add-to-cart">
                            <input type="text" class="text" value="1"/>
                            <a href="javascript:void(0)" class="quan-edit quan-minus"><span><i class="fa fa-minus"></i></span></a>
                            <a href="javascript:void(0)" class="quan-edit quan-plus"><span><i class="fa fa-plus"></i></span></a>
                            <button class="btn btn-default btn-sm btn-add-cart" data-id="<?php the_ID() ?>" data-weight="<?php echo get_sub_field('weight') ?>"><span>Thêm</span></button>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </table>
</div>
<?php
 endif; ?>