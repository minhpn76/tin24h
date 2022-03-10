<?php
    /*  ----------------------------------------------------------------------------
        the author template
     */
    
    get_header();
    
    $loop_includes_post_big = array();
    $loop_includes_post_douple_small = array();

?>
    <section class="main tag">
        <div class="container">
            <div class="content col-12">
                <div class="row">
                    <div class="w-100 result_box">
                        <div class="col-12 result-search with-border-bottom">
                            <div class="row">
                                <p class="w-100">
                        <span class="s2-subtitle">
                            Tìm kiếm với từ khóa
                        </span>
                                </p>
                                <?php
                                    if (has_tag()) :
                                        ?>
                                        <p class="key-search w-100">
                                            <span class="h2-headline">#<?= single_tag_title("", false) ?></span>
                                        </p>
                                    <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-12 with-border-bottom result-post">
                            <div class="row">
                                <div class="box-with-ads-right">
                                    <div class="col-12 hottest-feeds">
                                        <div class="row">
                                            <div class="hottest-feeds--content">
                                                <ul>
                                                    
                                                    <?php
                                                        $args = array(
                                                            'tag'            => single_tag_title("", false),
                                                            'posts_per_page' => '5'
                                                        );
                                                        $recent_posts = new WP_Query($args);
                                                        if ($recent_posts->have_posts()) :
                                                            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                                                                ?>

                                                                <li class="hottest-feed">
                                                                    <h5><a href="<?php the_permalink(); ?>"
                                                                           class="h5-headline on-mobile"><?= get_limit_tilte(150); ?></a>
                                                                    </h5>
                                                                    <a href="<?php the_permalink(); ?>"
                                                                       class="wrap_image"><?= the_post_thumbnail('post-thumb') ?></a>
                                                                    <div class="hottest-feed--description">
                                                                        <h5><a href="<?php the_permalink(); ?>"
                                                                               class="h5-headline"><?= get_limit_tilte(150); ?></a>
                                                                        </h5>
                                                                        <p>
                                                                            <?php
                                                                                //get all the categories the post belongs to
                                                                                $categories = wp_get_post_categories(get_the_ID());
                                                                                //loop through them
                                                                                foreach ($categories as $c) {
                                                                                    $cat = get_category($c);
                                                                                    //get category tin hot includes TINHOT & DANG DUOC QUAN TAM & TIN NOI BAT
                                                                                    $cat_id = get_cat_ID($cat->name);
                                                                                    if (!in_array($cat_id, [6, 7, 13, 21])) {
                                                                                        //make a list item containing a link to the category
                                                                                        echo '<a class="category-item" href="' . get_category_link($cat_id) . '">' . $cat->name . '</a>';
                                                                                    }
                                                                                }
                                                                            ?>
                                                                            <span class="created-at ml-4"><?= meks_time_ago(); ?></span>
                                                                        </p>
                                                                        <p class="p2-paragraph text-3lines"><?= get_excerpt_no_more(150) ?></p>
                                                                    </div>
                                                                </li>
                                                            
                                                            
                                                            <?php
                                                            endwhile;
                                                        
                                                        else :
                                                            ?>
                                                            <li class="hottest-feed">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <p>Không tìm thấy kết quả chứa từ khóa của
                                                                            bạn!</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endif;
                                                        wp_reset_postdata(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ads ads-right">
                                    <?php
                                        $tag_sidebar_ads_1 = get_field('tag_sidebar_ads_1', 'option');
                                        if ($tag_sidebar_ads_1):
                                            ?>
                                            <div class="vertical-ads">
                                                <a href="<?= $tag_sidebar_ads_1['link'] ?>" target="_blank"><img
                                                            src="<?= $tag_sidebar_ads_1['image'] ?>" alt=""></a>
                                            </div>
                                        <?php endif ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="box_related_news">
                <div class="row">
                    <div class="w-100 related_wrap">
                        <div class="big-category-title h6-headline">
                            <span>Tin nổi bật</span>
                        </div>
                        <div class="w-100 related_box">
                            <div class="box-with-ads-right">
                                <div class="col-12 box_highlight_feeds">
                                    <div class="row">
                                        <div class="block-top">
                                            <ul>
                                                <?php
                                                    $params = array(
                                                        'numberposts' => 1,
                                                        'category'    => 13,
                                                    );
                                                    $post_list = get_posts($params);
                                                    if ($post_list) {
                                                        foreach ($post_list as $post) :
                                                            setup_postdata($post);
                                                            array_push($loop_includes_post_big, $post->ID);
                                                            ?>
                                                            <li class="big_feed">
                                                                <a href="<?php the_permalink(); ?>"
                                                                   class="big_feed--img"><?= the_post_thumbnail('big-feed-thumb') ?></a>
                                                                <div class="big_feed--title">
                                                                    <h5><a href="<?php the_permalink(); ?>"
                                                                           class="h5-headline text-2lines"><?php the_title(); ?></a>
                                                                    </h5>
                                                                    <p class="p2-paragraph text-2lines"><?= get_excerpt_no_more(150) ?></p>
                                                                </div>
                                                            </li>
                                                        <?php
                                                        endforeach;
                                                        wp_reset_postdata();
                                                    }
                                                ?>
                                                <li class="double_feeds">
                                                    <?php
                                                        $params = array(
                                                            'numberposts' => 3,
                                                            'category'    => 13,
                                                        );
                                                        $post_list = get_posts($params);
                                                        if ($post_list) {
                                                            foreach ($post_list as $post) :
                                                                if (!in_array($post->ID, $loop_includes_post_big)) {
                                                                    setup_postdata($post);
                                                
                                                                    array_push($loop_includes_post_douple_small, $post->ID);
                                                                    ?>
                                                                    <div class="double_feeds--feed">
                                                                        <a href="<?php the_permalink(); ?>"
                                                                           class="wrap_image"><?= the_post_thumbnail('double-feed-thumb') ?></a>
                                                                        <h6 class=""><a href="<?php the_permalink(); ?>"
                                                                                        class="h6-headline text-2lines"><?= the_title() ?></a>
                                                                        </h6>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php
                                                            endforeach;
                                                            wp_reset_postdata();
                                                        }
                                                    ?>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="block-bottom">
                                            <ul class="block-bottom--slides">
                                                <?php
                                                    $params = array(
                                                        'numberposts' => 100,
                                                        'category'    => 13,
                                                    );
                                                    $post_list = get_posts($params);
                                                    if ($post_list) {
                                                        foreach ($post_list as $post) :
                                                            if (!in_array($post->ID, array_merge($loop_includes_post_big, $loop_includes_post_douple_small))) {
                                                                setup_postdata($post);
                                                                ?>
                                                                <li>
                                                                    <a href="<?php the_permalink(); ?>"
                                                                       class="wrap_image"><?= the_post_thumbnail('post-thumb') ?></a>
                                                                    <h6><a href="<?php the_permalink(); ?>"
                                                                           class="h6-headline text-3lines"><?php the_title() ?></a>
                                                                    </h6>
                                                                </li>
                                                            <?php } ?>
                                                        <?php
                                                        endforeach;
                                                        wp_reset_postdata();
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $tag_content_ads_1 = get_field('tag_content_ads_1', 'option');
                                    if ($tag_content_ads_1):
                                        ?>
                                        <div class="ads ads-bottom w-100">
                                            <a href="<?= $tag_content_ads_1['link'] ?>" target="_blank"><img
                                                        src="<?= $tag_content_ads_1['image'] ?>" class="w-100"
                                                        alt=""></a>
                                        </div>
                                    <?php endif ?>
                            </div>
                            <div class="ads ads-right">
                                <?php
                                    $tag_sidebar_ads_2 = get_field('tag_sidebar_ads_2', 'option');
                                    if ($tag_sidebar_ads_2):
                                        ?>
                                        <div class="vertical-ads">
                                            <a href="<?= $tag_sidebar_ads_2['link'] ?>" target="_blank"><img
                                                        src="<?= $tag_sidebar_ads_2['image'] ?>" alt=""></a>
                                        </div>
                                    <?php endif ?>

                            </div>
                        </div>
                    </div>
                   

                </div>
            </div>
        </div>
    </section>

<?php
    get_footer();
?>