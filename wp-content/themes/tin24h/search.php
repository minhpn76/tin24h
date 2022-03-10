<?php
    /*  ----------------------------------------------------------------------------
        the search template
     */
    
    get_header();
    $loop_includes_post_big = array();
    $loop_includes_post_douple_small = array();

?>
    <section class="main search">
        <div class="container">
            <div class="content col-12">
                <div class="row">
                    <div class="search_box">
                        <div class="box-with-ads-right">
                            <div class="col-12 result-search">
                                <div class="row">
                                    <p class="w-100">
                                    <span class="s2-subtitle">
                                        Tìm kiếm với từ khóa
                                    </span>
                                    </p>
                                    <div class="col-12 search-box">
                                        <div class="row">
                                            <form class="w-100" role="search" method="get" id="searchform"
                                                  class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
                                                <input type="text" class="form-control search-box__inp"
                                                       value="<?php echo get_search_query(); ?>" name="s" id="s">
                                                <button type="submit" class="search-box__btn">
                                                    <img
                                                            src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/search-1.svg' ?>"
                                                            alt="">
                                                </button>
                                            </form>
                                            
                                            <?php
                                                $allsearch = new WP_Query("s=$s&showposts=-1");
                                                $count = $allsearch->post_count;
                                                _e('<p class="p2-headline dark-blue-gray mt-2">Tìm thấy ');
                                                echo $count . ' ';
                                                _e('kết quả');
                                                wp_reset_query();
                                            ?>
                                            <!-- <p class="p2-headline dark-blue-gray mt-2">Tìm thấy 145 kết quả</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-with-ads-right">
                            <div class="col-12 hottest-feeds">
                                <?php
                                    $s = get_search_query();
                                    $paged = (get_query_var('paged')) ? get_query_var('paged') : '1';
                                    $args = array(
                                        's'              => $s,
                                        'nopaging'       => false,
                                        'paged'          => $paged,
                                        'posts_per_page' => '5',
                                        'post_type'      => 'post',
                                    );
                                    // The Query
                                    $the_query = new WP_Query($args);
                                    if ($the_query->have_posts()) {
                                        ?>
                                        <div class="row">
                                            <div class="hottest-feeds--content">
                                                <ul>
                                                    <?php
                                                        //  previous_posts_link( '« Newer Entries' );
                                                        while ($the_query->have_posts()) {
                                                            $the_query->the_post();
                                                            ?>
                                                            <li class="hottest-feed">
                                                                <h5><a href="<?= the_permalink() ?>"
                                                                       class="h5-headline on-mobile"><?= get_limit_tilte(150); ?></a>
                                                                </h5>
                                                                <a href="<?= the_permalink() ?>"
                                                                   class="img"><?= the_post_thumbnail('post-thumb') ?></a>
                                                                <div class="hottest-feed--description">
                                                                    <h5><a href="<?= the_permalink() ?>"
                                                                           class="h5-headline text-3lines"><?= get_limit_tilte(150); ?></a>
                                                                    </h5>

                                                                    <div>
                                                                        <?php
                                                                            //get all the categories the post belongs to
                                                                            $categories = wp_get_post_categories(get_the_ID());
                                                                            //loop through them
                                                                            foreach ($categories as $c) {
                                                                                $cat = get_category($c);
                                                                                //get the name of the category
                                                                                $cat_id = get_cat_ID($cat->name);
                                                                                //make a list item containing a link to the category
                                                                                if (!in_array($cat_id, [6, 7, 13, 21])) {
                                                                                    echo '<a class="category-item" href="' . get_category_link($cat_id) . '">' . $cat->name . '</a>';
                                                                                }
                                                                            }
                                                                        ?>
                                                                        <span class="created-at ml-4"><?= meks_time_ago(); ?></span>
                                                                    </div>
                                                                    <p class="p2-paragraph text-3lines"><?= get_excerpt_no_more(150) ?></p>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        }
                                                    
                                                    ?>
                                                </ul>

                                                <div class="pagination">
                                                    <?php
                                                        pagination_tdc()
                                                    ?>


                                                    <!-- <br>
                                            <ul>
                                                <li class="first disabled"><a href=""><img src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/double-chevron-right.svg' ?>"
                                                                                        alt=""></a></li>
                                                <li class="prev disabled"><a href=""><img src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/chevron-left.svg' ?>" alt=""></a>
                                                </li>
                                                <li class="1 active"><a href="">1</a></li>
                                                <li class="2"><a href="">2</a></li>
                                                <li class="..."><a href="">...</a></li>
                                                <li class="6"><a href="">6</a></li>
                                                <li class="7"><a href="">7</a></li>
                                                <li class="next"><a href=""><img src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/chevron-right-1.svg' ?>" alt=""></a></li>
                                                <li class="last"><a href=""><img src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/double-chevron-right.svg' ?>" alt=""></a>
                                                </li>
                                            </ul> -->
                                                    
                                                    <div class="s2-subtitle">
                                                    <?php next_posts_link('Xem thêm <i class="fa fa-chevron-down"></i>', '') ?></div>

                                                </div>
                                            </div>

                                        </div>
                                        <?php
                                        wp_reset_postdata();
                                    }
                                    else {
                                        ?>
                                        <div class="row">
                                            <p>Không tìm thấy kết quả chứa từ khóa của bạn!</p>
                                        </div>
                                    <?php } ?>
                            </div>
                        </div>
                        <?php
                            $search_sidebar_ads_1 = get_field('search_sidebar_ads_1', 'option');
                            if ($search_sidebar_ads_1):
                                ?>
                                <div class="ads ads-right">
                                    <div class="vertical-ads">
                                        <a href="<?= $search_sidebar_ads_1['link'] ?>" target="_blank"><img
                                                    src="<?= $search_sidebar_ads_1['image'] ?>" alt=""></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="content-after-post">
                <div class="row">
                    <div class="big-category-title h6-headline">
                        <span>Tin nổi bật</span>
                    </div>
                    <div class="box-with-ads-right">
                        <div class="col-12 box_highlight_feeds">
                            <div class="row">
                                <!--ID 13 === tin noi bat-->
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
                                                            <a href="<?php the_permalink(); ?>" class="wrap_image"><img
                                                                        src="<?= get_the_post_thumbnail_url($post->ID, array(256, 168)) ?>"
                                                                        alt=""></a>
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
                            $search_content_ads_1 = get_field('search_content_ads_1', 'option');
                            if ($search_content_ads_1):
                                ?>
                                <div class="ads ads-bottom w-100">
                                    <a href="<?= $search_content_ads_1['link'] ?>" target="_blank"><img
                                                src="<?= $search_content_ads_1['image'] ?>" alt=""></a>
                                </div>
                            <?php endif; ?>
                    </div>
                    <?php
                        $search_sidebar_ads_2 = get_field('search_sidebar_ads_2', 'option');
                        if ($search_sidebar_ads_2):
                            ?>
                            <div class="ads ads-right">
                                <div class="vertical-ads">
                                    <a href="<?= $search_sidebar_ads_2['link'] ?>" target="_blank"><img
                                                src="<?= $search_sidebar_ads_2['image'] ?>" alt=""></a>
                                </div>
                            </div>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php
    get_footer();
?>