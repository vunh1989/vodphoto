<aside class="news-sidebar">
    <h4 class="title">Thông tin</h4>
    <ul>
        <?php
        $args = array(
            'hide_empty' => 0
        );
        $terms = get_terms('news-type', $args);
        ?>
        <?php foreach ($terms as $term): ?>
            <li>
                <a href="<?php echo get_term_link($term) ?>">
                    <h5 class="head-news-type <?php echo (get_query_var('news-type') == $term->slug) ? 'active' : '' ?> "><?php echo $term->name ?></h5>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>