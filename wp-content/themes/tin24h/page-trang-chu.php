<?php 
get_header(); 
$loop_includes_post_big = array();
$loop_includes_post_douple_small = array();
$loop_hot_tag_1 = array();
?>
<section class="main">
    <div class="container container-pl100">
        <section class="slide-top-feeds">
            <ul>
                <?php
                    $args = array(
                        'post_type'=> 'post',
                        'orderby'    => 'ID',
                        'post_status' => 'publish',
                        'order'    => 'DESC',
                        'posts_per_page' => -1 // this will retrive all the post that is published 
                        );
                    $result = new WP_Query( $args );
                    if ( $result-> have_posts() ) : ?>
                    <?php while ( $result->have_posts() ) : $result->the_post(); ?>
                    <li>
                        <div>
                            <a class="wrap_image" href="<?php the_permalink(); ?>" ><img src="<?= the_post_thumbnail_url('big_feed_thu')?>" alt=""></a>
                            <p><a href="<?php the_permalink(); ?>"  class="h6-headline text-2lines"><?= the_title()?>.</a></p>
                        </div>
                    </li>
                    <?php endwhile; ?>
                    <?php endif; wp_reset_postdata(); ?>
                    

                
            </ul>
        </section>


        <div class="col-12">
            <div class="row">
                <div class="main-content">
                    <div class="col-12 box_highlight_feeds">
                        <div class="row">
                            <!--ID 13 === tin noi bat-->
                            <div class="category-heading">
                                <h6 class="h6-headline text-uppercase">Tin nổi bật</h6>
                            </div>
                            <div class="block-top">
                                <ul>
                                    <?php
                                        $params = array(
                                            'numberposts'      => 1,
                                            'category'         => 13,
                                        );
                                        $post_list = get_posts($params);
                                        if ( $post_list ) {
                                            foreach ( $post_list as $post ) : 
                                                setup_postdata( $post ); 
                                                array_push($loop_includes_post_big, $post->ID);
                                            ?>
                                                <li class="big_feed home">
                                                    <a href="<?php the_permalink(); ?>"  class="big_feed--img"><?= the_post_thumbnail('big-feed-thumb')?></a>
                                                    <div class="big_feed--title">
                                                        <h5><a href="<?php the_permalink(); ?>"  class="h5-headline text-2lines"><?php the_title(); ?></a></h5>
                                                        <p class="p2-paragraph text-2lines"><?= get_excerpt_no_more(150)?></p>
                                                    </div>
                                                </li>
                                            <?php
                                            endforeach;
                                            wp_reset_postdata();
                                        }
                                    ?>
                                    <li class="double_feeds border_home">
                                        <?php
                                            $params = array(
                                                'numberposts'      => 3,
                                                'category'         => 13,
                                            );
                                            $post_list = get_posts($params);
                                            if ( $post_list ) {
                                                foreach ( $post_list as $post ) : 
                                                    if (!in_array($post->ID,$loop_includes_post_big)) {
                                                    setup_postdata( $post ); 
                                                  
                                                    array_push($loop_includes_post_douple_small, $post->ID);
                                                ?>
                                                    <div class="double_feeds--feed">
                                                        <a href="<?php the_permalink(); ?>" class="wrap_image"><?= the_post_thumbnail('double-feed-thumb')?></a>
                                                        <h6 class=""><a href="<?php the_permalink(); ?>"  class="h6-headline text-2lines"><?= the_title()?></a></h6>
                                                    </div>
                                                <?php }?>
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
                                            'numberposts'      => 100,
                                            'category'         => 13,
                                        );
                                        $post_list = get_posts($params);
                                        if ( $post_list ) {
                                            foreach ( $post_list as $post ) : 
                                                if (!in_array($post->ID,array_merge($loop_includes_post_big, $loop_includes_post_douple_small))) {
                                                setup_postdata( $post ); 
                                            ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>" ><?= the_post_thumbnail("post-thumb")?></a>
                                                    <h6><a href="<?php the_permalink(); ?>"  class="h6-headline text-3lines"><?php the_title()?></a></h6>
                                                </li>
                                            <?php }?>
                                            <?php
                                            endforeach;
                                            wp_reset_postdata();
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 covid-feed">
                        <div class="row">
                            <div class="category-heading">
                                <h6 class="h6-headline text-uppercase">BẢN TIN COVID</h6>
                            </div>

                            <div class="covid-feed--content col-12">
                                <div class="row">
                                    <div class="col-12 col-md-6 statistics_vietnam">
                                        <p class=" country-title"><img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/flag-vn.svg'?>" alt="" class="mr-2">Việt
                                            Nam
                                        </p>
                                        <ul>
                                            <li>
                                                <label> Ca nhiễm
                                                    <input type="submit" id="covid_vn_total" readonly class="ml-4 border-danger text-center float-right"
                                                           value="940">
                                                </label>
                                                <label> Tử vong
                                                    <input type="submit" id="covid_vn_death" readonly class="ml-4 border-white text-center float-right"
                                                           value="22">
                                                </label>
                                                <label> Phục hồi
                                                    <input type="submit" id="covid_vn_recovered" readonly
                                                           class="ml-4 border-success text-center float-right"
                                                           value="568">
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6 statistics_world mt-3 mt-md-0">
                                        <p class=" country-title"><img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/flag-world.svg'?>" alt="" class="mr-2">Thế
                                            giới</p>
                                        <ul>
                                            <li>
                                                <label> Ca nhiễm
                                                    <input type="submit" id="covid_global_total" readonly class="ml-4 border-danger text-center float-right"
                                                           value="12.234.567">
                                                </label>
                                                <label> Tử vong
                                                    <input type="submit" id="covid_global_death" readonly class="ml-4 border-white text-center float-right"
                                                           value="15.943">
                                                </label>
                                                <label> Phục hồi
                                                    <input type="submit" id="covid_global_recovered" readonly
                                                           class="ml-4 border-success text-center float-right"
                                                           value="1.445.677">
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 hottest-feeds">
                        <div class="row">
                            <!-- ID = 6 == Tin hot -->
                            <div class="category-heading">
                                <h6 class="h6-headline text-uppercase">Tin hot</h6>
                            </div>
                            <div class="hottest-feeds--content">
                                
                                <ul>
                                    <?php
                                        $args_tin_hot = array(
                                            'numberposts'      => 5,
                                            'category'         => 6,
                                        );
                                        $post_tin_hot = get_posts($args_tin_hot);
                                        if ( $post_tin_hot ) {
                                            foreach ( $post_tin_hot as $post ) : 
                                                setup_postdata( $post ); ?>
                                                <li class="hottest-feed">
                                                    <h5><a href="<?php the_permalink(); ?>"  class="h5-headline on-mobile"><?= get_limit_tilte(150); ?></a></h5>
                                                    <a  href="<?php the_permalink(); ?>" class="img"><?= the_post_thumbnail("post-thumb")?></a>
                                                    <div class="hottest-feed--description">
                                                        <h5><a href="<?php the_permalink(); ?>"  class="h5-headline text-3lines"><?= get_limit_tilte(150); ?></a></h5>
                                                        <p>
                                                            <?php
                                                                //get all the categories the post belongs to
                                                                $categories = wp_get_post_categories( get_the_ID() );
                                                                //loop through them
                                                                foreach($categories as $c){
                                                                    $cat = get_category( $c );
                                                                    //get category tin hot includes TINHOT & DANG DUOC QUAN TAM & TIN NOI BAT & Diem tin chinh
                                                                    $cat_id = get_cat_ID( $cat->name );
                                                                    if (!in_array($cat_id, [6,7,13,21])) {
                                                                        //make a list item containing a link to the category
                                                                        echo '<a class="category-item" href="'.get_category_link($cat_id).'">'.$cat->name.'</a>';
                                                                    }
                                                                }
                                                            ?>
                                                            <span class="created-at ml-4"><?= meks_time_ago(); ?></span>
                                                        </p>
                                                        <p class="p2-paragraph"><?= get_excerpt_no_more(150)?></p>
                                                    </div>
                                                </li>
                                            <?php
                                            endforeach;
                                            wp_reset_postdata();
                                        }
                                    ?>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 top-followings">
                        <div class="row">
                            <div class="following-heading">
                                <span class="star"><img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/star.png'?>" alt=""></span>
                                <h6 class="h6-headline text-uppercase">ĐANG ĐƯỢC QUAN TÂM</h6>
                                <!--ID 7 === dang duoc quan tam-->
                            </div>
                            <div class="top-followings-content">
                                <ul>
                                    <?php
                                        $param_q_tam = array(
                                            'numberposts'      => 3,
                                            'category'         => 7,
                                        );
                                        $post_q_tam = get_posts($param_q_tam);
                                        if ( $post_q_tam ) {
                                            foreach ( $post_q_tam as $post ) : 
                                                setup_postdata( $post ); ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>"  class="img">
                                                        <?= the_post_thumbnail("post-thumb")?>
                                                    </a>
                                                    <div class="top-followings--title">
                                                        <p><a href="<?php the_permalink(); ?>"  class="h5-headline"><?php the_title()?></a></p>
                                                        <span class="views-count p2-paragraph"><?= gt_get_post_view('lượt xem')?></span>
                                                    </div>
                                                </li>
                                            <?php
                                            endforeach;
                                            wp_reset_postdata();
                                        }
                                    ?>



                                </ul>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 categories-blocks">
                        <div class="row">
                            <div class="col-12 col-md-6 category-block">
                                <!--Category Block-->
                                <!-- ID = 5 == Showbiz -->
                                <div class="category-block-item">
                                    <div class="category-heading">
                                        <h6 class="h6-headline text-uppercase"><a href="<?= get_term_link( 5, 'category' );?>">SHOWBIZ</a></h6>
                                    </div>
                                    <ul>

                                    <?php
                                        $params = array(
                                            'numberposts'      => 4,
                                            'category'         => 5,
                                            
                                        );
                                        $post_list = get_posts($params);
                                        if ( $post_list ) {
                                            $index = 0;
                                            foreach ( $post_list as $post ) :    
                                                $index++;                                         
                                                setup_postdata( $post ); 
                                        ?>
                                            <?php
                                                if ($index === 1):
                                            ?>
                                            <li class="big-feed">
                                                <a  href="<?php the_permalink(); ?>"><?= the_post_thumbnail("post-category-thumb")?></a>
                                                <h6><a href="<?php the_permalink(); ?>"  class="h6-headline"><?php the_title(); ?></a></h6>
                                            </li>
                                            <?php else :?>

                                            <li>
                                                <a href="<?php the_permalink(); ?>"  class="s2-subtitle text-2lines"><?php the_title(); ?></a>
                                            </li>
                                            <?php endif;?>
                                            <?php
                                            endforeach;
                                            wp_reset_postdata();
                                        } 
                                    ?>
                                    </ul>
                                </div>
                                <!--End Category Block-->
                            </div>
                            <div class="col-12 col-md-6 category-block">
                                <!--Category Block-->
                                <!-- ID = 8 ==  Học đường -->
                                <div class="category-block-item">
                                    <div class="category-heading">
                                        <h6 class="h6-headline text-uppercase"><a href="<?= get_term_link( 8, 'category' );?>">HỌC ĐƯỜNG</a></h6>
                                    </div>
                                    <ul>
                                    <?php
                                        $params = array(
                                            'numberposts'      => 4,
                                            'category'         => 8,
                                            
                                        );
                                        $post_list = get_posts($params);
                                        if ( $post_list ) {
                                            $index = 0;
                                            foreach ( $post_list as $post ) :    
                                                $index++;                                         
                                                setup_postdata( $post ); 
                                        ?>
                                            <?php
                                                if ($index === 1):
                                            ?>
                                            <li class="big-feed">
                                                <a  href="<?php the_permalink(); ?>"><?= the_post_thumbnail("post-category-thumb")?></a>
                                                <h6><a href="<?php the_permalink(); ?>"  class="h6-headline"><?php the_title(); ?></a></h6>
                                            </li>
                                            <?php else :?>

                                            <li>
                                                <a href="<?php the_permalink(); ?>"  class="s2-subtitle text-2lines"><?php the_title(); ?></a>
                                            </li>
                                            <?php endif;?>
                                            <?php
                                            endforeach;
                                            wp_reset_postdata();
                                        } 
                                    ?>
                                    </ul>
                                </div>
                                <!--End Category Block-->
                            </div>
                            <div class="col-12 col-md-6 category-block">
                                <!--Category Block-->
                                <!-- ID = 9 == Cinemaz -->
                                <div class="category-block-item">
                                    <div class="category-heading">
                                        <h6 class="h6-headline text-uppercase"><a href="<?= get_term_link( 9, 'category' );?>">CINEMA</a></h6>
                                    </div>
                                    <ul>
                                    <?php
                                        $params = array(
                                            'numberposts'      => 4,
                                            'category'         => 9,
                                            
                                        );
                                        $post_list = get_posts($params);
                                        if ( $post_list ) {
                                            $index = 0;
                                            foreach ( $post_list as $post ) :    
                                                $index++;                                         
                                                setup_postdata( $post ); 
                                        ?>
                                            <?php
                                                if ($index === 1):
                                            ?>
                                            <li class="big-feed">
                                                <a  href="<?php the_permalink(); ?>"><?= the_post_thumbnail("post-category-thumb")?></a>
                                                <h6><a href="<?php the_permalink(); ?>"  class="h6-headline"><?php the_title(); ?></a></h6>
                                            </li>
                                            <?php else :?>

                                            <li>
                                                <a href="<?php the_permalink(); ?>"  class="s2-subtitle text-2lines"><?php the_title(); ?></a>
                                            </li>
                                            <?php endif;?>
                                            <?php
                                            endforeach;
                                            wp_reset_postdata();
                                        } 
                                    ?>
                                    </ul>
                                </div>
                                <!--End Category Block-->
                            </div>
                            <div class="col-12 col-md-6 category-block">
                                <!--Category Block-->
                                <!-- ID = 10 == du lich -->
                                <div class="category-block-item">
                                    <div class="category-heading">
                                        <h6 class="h6-headline text-uppercase"><a href="<?= get_term_link( 10, 'category' );?>">DU LỊCH</a></h6>
                                    </div>
                                    <ul>
                                    <?php
                                        $params = array(
                                            'numberposts'      => 4,
                                            'category'         => 10,
                                            
                                        );
                                        $post_list = get_posts($params);
                                        if ( $post_list ) {
                                            $index = 0;
                                            foreach ( $post_list as $post ) :    
                                                $index++;                                         
                                                setup_postdata( $post ); 
                                        ?>
                                            <?php
                                                if ($index === 1):
                                            ?>
                                            <li class="big-feed">
                                                <a  href="<?php the_permalink(); ?>"><?= the_post_thumbnail("post-category-thumb")?></a>
                                                <h6><a href="<?php the_permalink(); ?>"  class="h6-headline"><?php the_title(); ?></a></h6>
                                            </li>
                                            <?php else :?>

                                            <li>
                                                <a href="<?php the_permalink(); ?>"  class="s2-subtitle text-2lines"><?php the_title(); ?></a>
                                            </li>
                                            <?php endif;?>
                                            <?php
                                            endforeach;
                                            wp_reset_postdata();
                                        } 
                                    ?>
                                    </ul>
                                </div>
                                <!--End Category Block-->
                            </div>
                        </div>
                    </div>
                    <?php
                        $home_content_ads_1 = get_field('home_content_ads_1','option');
                        if( $home_content_ads_1 ):
                    ?>  
                    <div class="col-12 ads long-ads pc-ads mt-2 p-0">
                        <a href="<?= $home_content_ads_1['link']?>" ><img src="<?= $home_content_ads_1['image']?>" alt=""></a>
                    </div>
                    <?php endif?>
                    <?php
                        $home_content_ads_mobile_1 = get_field('home_content_ads_mobile_1','option');
                        if( $home_content_ads_mobile_1 ):
                    ?>  
                    <div class="col-12 ads mobile-ads mt-2 p-0">
                        <a href="<?= $home_content_ads_mobile_1['link']?>"><img src="<?= $home_content_ads_mobile_1['image']?>" alt=""></a>
                    </div>
                    <?php endif?>

                    <div class="col-12 categories-blocks">
                        <div class="row">
                            <div class="col-12 col-md-6 category-block-vertical">
                                <!-- ID = 11 == nguoi noi tieng -->
                                <div class="category-block-item">
                                    <div class="category-heading">
                                        <h6 class="h6-headline text-uppercase" ><a href="<?= get_term_link( 11, 'category' );?>">Người nổi tiếng</a></h6>
                                    </div>
                                    <ul>
                                        <?php
                                            $params = array(
                                                'numberposts'      => 3,
                                                'category'         => 11,
                                                
                                            );
                                            $post_list = get_posts($params);
                                            if ( $post_list ) {
                                                foreach ( $post_list as $post ) :                                    
                                                    setup_postdata( $post ); 
                                            ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>"  class="col-6 p-0 wrap_image"><?= the_post_thumbnail('post-category-small-thumb')?></a>
                                                    <div class="title--wrap col-6 p-0 pl-2">
                                                        <a href="<?php the_permalink(); ?>"><p class="p2-semibold text-3lines"><?php the_title(); ?></p></a>
                                                        <p class="p4-paragraph text-4lines"><?= get_excerpt_no_more(150)?></p>
                                                    </div>
                                                </li>
                                                <?php
                                                endforeach;
                                                wp_reset_postdata();
                                            } 
                                        ?>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 category-block-vertical">
                                <div class="category-block-item">
                                    <div class="category-heading">
                                        <!--ID 12 === fashion -->
                                        <h6 class="h6-headline text-uppercase"><a href="<?= get_term_link( 12, 'category' );?>">Fashion</a></h6>
                                    </div>
                                    <ul>
                                        <?php
                                            $params = array(
                                                'numberposts'      => 3,
                                                'category'         => 12,
                                                
                                            );
                                            $post_list = get_posts($params);
                                            if ( $post_list ) {
                                                foreach ( $post_list as $post ) :                                    
                                                    setup_postdata( $post ); 
                                            ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>"  class="col-6 p-0 wrap_image"><?= the_post_thumbnail('post-category-small-thumb')?></a>
                                                    <div class="title--wrap col-6 p-0 pl-2">
                                                        <a href="<?php the_permalink(); ?>"><p class="p2-semibold text-3lines"><?php the_title(); ?></p></a>
                                                        
                                                        <p class="p4-paragraph text-4lines"><?= get_excerpt_no_more(150)?></p>
                                                    </div>
                                                </li>
                                                <?php
                                                endforeach;
                                                wp_reset_postdata();
                                            } 
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $terms = get_terms('post_tag',array(
                            'hide_empty'=>false,
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 2
                        ));
                        
                        if ($terms) {
                    ?>
                    <div class="col-12 hot-search">
                        <div class="row">
                            <div class="following-heading">
                                <span class="star"><img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/trending-up.png'?>" alt=""></span>
                                <h6 class="h6-headline text-uppercase">TỪ KHÓA HOT</h6>
                            </div>

                            <div class="col-12 hot-search-list">
                                <div class="row">

                                    <div class="w-100 d-md-flex d-block">
                                        <?php
                                            $index=0;
                                            foreach($terms as $t) {
                                                $index++;
                                                $term_link = get_term_link( $t, 'post_tag' );
                                                array_push($loop_hot_tag_1, $t->term_id)
                                        ?>
                                        <?php 
                                            if ($index === 1) {
                                                
                                        ?>
                                            <div class="col-12 col-md-6 hot-search-block">
                                                <div class="hot-search-item hot-search-item__1"><a href="<?= $term_link?>">#<?= $t->name?></a></div>
                                            </div>
                                        <?php 
                                            } if ($index === 2) {
                                                
                                        ?>
                                            <div class="col-12 col-md-6 hot-search-block">
                                                <div class="hot-search-item hot-search-item__2"><a href="<?= $term_link?>">#<?= $t->name?></a></div>
                                            </div>

                                        <?php }}?>
                                    </div>
                                    <?php
                                        $exclude_tag_1 = '(' . implode(',', $loop_hot_tag_1) .')';
                                    
                                        $terms_tag_2 = get_terms('post_tag',array(
                                            'hide_empty'=>false,
                                            'orderby' => 'count',
                                            'order' => 'DESC',
                                            'number' => 3,
                                            'exclude' => $exclude_tag_1
                                        ));
                                        if ($terms_tag_2) {
                                    

                                    ?>
                                    <div class="w-100 d-md-flex d-block">
                                        <?php
                                            $index2=0;
                                            foreach($terms_tag_2 as $t2) {
                                                if (!in_array($t2->term_id, $loop_hot_tag_1)) {
                                                $index2++;
                                                $term_link2 = get_term_link( $t2, 'post_tag' );
                                        ?>
                                        <?php 
                                            if ($index2 === 1) {
                                                
                                        ?>
                                            <div class="col-12 col-md-6 hot-search-block">
                                                <div class="hot-search-item hot-search-item__3"><a href="<?= $term_link2?>">#<?= $t2->name?></a></div>
                                            </div>
                                        <?php 
                                            } if ($index2 === 2) {
                                                
                                        ?>
                                            <div class="col-12 col-md-6 hot-search-block">
                                                <div class="hot-search-item hot-search-item__4"><a href="<?= $term_link2?>">#<?= $t2->name?></a></div>
                                            </div>

                                        <?php }}}?>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <?php
                        $home_content_ads_2 = get_field('home_content_ads_2','option');
                        if( $home_content_ads_2 ):
                    ?>  
                    <div class="ads ads-bottom">
                        <a href="<?= $home_content_ads_2['link']?>" target="_blank"><img src="<?= $home_content_ads_2['image']?>" alt=""></a>
                    </div>
                    <?php endif;?>
                </div>
                <div class="ads ads-right mt-3">
                    <?php
                        $home_sidebar_ads_1 = get_field('home_sidebar_ads_1','option');
                        if( $home_sidebar_ads_1 ):
                    ?>     
                    <div class="vertical-ads">
                        <a href="<?= $home_sidebar_ads_1['link']?>" target="_blank"><img src="<?= $home_sidebar_ads_1['image']?>" alt=""></a>
                    </div>
                    <?php endif;?>
                    <?php
                        $home_sidebar_ads_2 = get_field('home_sidebar_ads_2','option');
                        if( $home_sidebar_ads_2 ):
                    ?>     
                    <div class="vertical-ads">
                        <a href="<?= $home_sidebar_ads_2['link']?>" target="_blank"><img src="<?= $home_sidebar_ads_2['image']?>" alt=""></a>
                    </div>
                    <?php endif;?>
                    <?php
                        $home_sidebar_ads_3 = get_field('home_sidebar_ads_3','option');
                        if( $home_sidebar_ads_3 ):
                    ?>     
                    <div class="vertical-ads">
                        <a href="<?= $home_sidebar_ads_3['link']?>" target="_blank"><img src="<?= $home_sidebar_ads_3['image']?>" alt=""></a>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>