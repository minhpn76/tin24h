<?php

get_header();
$loop_includes_post_big = array();
$loop_includes_post_douple_small = array();
$single_post_id = 0;

//TODO set postView
set_post_views(get_the_ID());

//handle nav is parent
$nav_parent = array();
$parent_nav = array();
$nav_dropdown = get_terms('category',array(
    'hide_empty'=>false,
    'orderby' => 'count',
    'order' => 'DESC',
));
foreach($nav_dropdown as $nav) {
    if ($nav->parent !== 0) {
        array_push($nav_parent, $nav->parent);
    }
}
$parent_nav = array_unique($nav_parent);

//

?>
    <?php 
        if (have_posts()) : while (have_posts()) : the_post(); 
        $single_post_id = get_the_ID();
    ?>
    <?php
        $cate_detail = array();
        $cate = get_the_category($single_post_id);
        $cate_display;
        $cate_child_display;
        foreach($cate as $ct) {

            if (!in_array($ct->term_id,[6,7,13,21])){
                if (in_array($ct->term_id, $parent_nav)) {
                    $cate_display = $ct;
                }
            }
        }
        if (empty($cate_display)) {
            $cate_child_display = $cate[0];
        }    
    ?>

    <section class="main post">
        <div class="container">
            <div class="breadcrumb-bar col-12">

                <div class="row">
                    <div class="text-uppercase category-name text-white">
                        <?php
                            if (!empty($cate_display)) {
                        ?>
                        <div class="d-inline-block">
                            <span class="sub-categories-mobile"><?= $cate_display->name?></span>
                            <span class="ml-3 mr-3"><i class="fa fa-angle-right text-white"></i></span>
                        </div>
                        <?php } else {?>
                        <span><?= $cate_child_display->name?></span>
                        <?php }?>

                    </div>
                    <?php 
                        if (!empty($cate_display)) {
                            $nav_has_child = get_terms('category',array(
                                'hide_empty'=>false,
                                'orderby' => 'count',
                                'order' => 'DESC',
                            ));
                            
                    ?>
                    <ul class="sub-categories-list">
                        <?php
                            foreach($nav_has_child as $nv_c) {
                                if ($nv_c->parent === $cate_display->term_id) {
                                    $link_nv_c = get_term_link( $nv_c->term_id, 'category' );
                        ?>
                        <li ><a href="<?= $link_nv_c?>" class="sub-category"><?= $nv_c->name?></a></li>
                        <?php }}?>
                    </ul>
                    <?php }?>
                </div>
            </div>
            <div class="content col-12">
                <div class="row">
                    <div class="navigation-vertical">
                        <ul>
                            <?php
                                $home_social = get_field('home_social','option');
                                if( $home_social ):
                            ?>  
                            <li class="nav-home"><a href="<?= $home_social?>" ><img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/home-1.svg'?>" alt=""></a></li>
                            <?php endif?>
                            <li class="nav-facebook"><a target="_blank" href="https://www.facebook.com/sharer.php?u=<?= the_permalink(); ?>" ><i class="fa fa-facebook"></i></a></li>
                            <!-- <?php
                                $facebook_social = get_field('facebook_social','option');
                                if( $facebook_social ):
                            ?>  
                            <li class="nav-facebook"><a href="<?= $facebook_social?>" ><i class="fa fa-facebook"></i></a></li>
                            <?php endif?> -->
                        </ul>
                    </div>
                    <div id="post-content" class=" box-with-ads-right">
                        <h2 class="h2-headline post-title"><?php the_title(); ?></h2>

                        <div class="post-info col-12">
                            <div class="row">
                                <?php
                                    //get all the categories the post belongs to
                                    $categories = wp_get_post_categories( get_the_ID() );
                                    //loop through them
                                    foreach($categories as $c){
                                    $cat = get_category( $c );
                                    //get the name of the category
                                    $cat_id = get_cat_ID( $cat->name );
                                    //make a list item containing a link to the category
                                    if (!in_array($cat_id, [6,7,13,21])) {
                                        echo '<a class="category-item" href="'.get_category_link($cat_id).'">'.$cat->name.'</a>';
                                    }
                                    }
                                ?>
                                <p class="d-inline-block ml-3 mb-0 post-created-time"><img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/clock.svg'?>" alt=""
                                                                                        class="mr-1"><span> <?php echo get_the_date(); ?></span>
                                </p>
                                <!-- <p class="text-right post-views mb-0 ml-auto">
                                    <img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/eye.svg'?>" alt="">
                                    <span><?= gt_get_post_view('đã xem')?></span>
                                </p> -->
                            </div>
                        </div>
                        <?php if (has_excerpt()):?>
                        <div class="post-short-description">
                            <span class="s1-subtitle"><?= the_excerpt()?></span>
                        </div>
                        <?php endif;?>

                        <div class="col-12 posts-related">

                            <div class="row">
                                <?php
                                    $the_query = new WP_Query( 'posts_per_page=3&tag='.$post_tag );
                                    if ( $the_query->have_posts() ) {
                                ?>
                                    <ul class="related_lists">
                                        <?php
                                        $index= 0;
                                        while ( $the_query->have_posts() ) {
                                            $the_query->the_post();
                                            $index++;
                                            if ($index < 4) {
                                        ?>
                                            <li class="post-related"><a href="<?php the_permalink(); ?>" ><?= the_title(); $index ?></a></li>
                                        <?php } } ?>
                                    </ul>  
                                <?php
                                    }
                                    wp_reset_postdata();
                                ?>
                            </div>
                        </div>

                        <div class="col-12 post-content p-0">
                            <?php the_content(); ?>
                        </div>
                        
                        <div class="col-12 post-share-fb">
                            <div class="row">
                                <div class="col-12 action">
                                    <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?= the_permalink(); ?>">
                                        <i class="fa fa-facebook"></i>Chia sẻ
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 post-signature">
                            <div class="row">
                                <div class="col-12 col-md-8 order-1 order-md-0 tags">
                                    <?php 
                                        if (has_tag()) :
                                    ?>
                                    <div class="row">
                                        <div class="tag-title">
                                            <span>Tags:</span>
                                        </div>
                                        <?= custom_taxonomies_terms_links()?>
                                    </div>
                                    <?php endif?>
                                </div>
                                

                                <div class="col-12 col-md-4 order-0 order-md-1 signature mb-3 mb-md-0">

                                    <a href="" class="author"><?= get_the_author()?>
                                    </a>
                                    <?php
                                        $source_post = get_field('source_post');
                                        if( $source_post ):
                                    ?><span>, <?= $source_post?></span>
                                    <?php endif?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 hottest-feeds">
                            <div class="row">
                                <div class="hottest-feeds--content">
                                    <ul>
                                        <?php
                                            $index=0;
                                            foreach($categories as $c) {
                                                $params = array(
                                                    'numberposts'      => 5,
                                                    'category'         => $c,
                                                );
                                                $post_list = get_posts($params);
                                                
                                                if ( $post_list ) {
                                                    foreach ( $post_list as $post ) : 
                                                        setup_postdata( $post ); 
                                                        $index++;
                                                        if ($index < 5 && $post->ID !== $single_post_id) {
                                                    ?>
                                                        <li class="hottest-feed">
                                                            <h5><a href="<?php the_permalink(); ?>"   class="h5-headline on-mobile"><?= get_limit_tilte(150)?></a></h5>
                                                            <a href="<?php the_permalink(); ?>"   class="img"><?= the_post_thumbnail("post-thumb")?></a>
                                                            <div class="hottest-feed--description">
                                                                <h5><a href="<?php the_permalink(); ?>"   class="h5-headline text-3lines"><?= get_limit_tilte(150)?></a></h5>
                                                                <p>
                                                                    <?php
                                                                        //get all the categories the post belongs to
                                                                        $categories = wp_get_post_categories( get_the_ID() );
                                                                        //loop through them
                                                                        foreach($categories as $c){
                                                                        $cat = get_category( $c );
                                                                        //get the name of the category
                                                                        $cat_id = get_cat_ID( $cat->name );
                                                                        //make a list item containing a link to the category
                                                                        if (!in_array($cat_id, [6,7,13,21])) {
                                                                            echo '<a class="category-item" href="'.get_category_link($cat_id).'">'.$cat->name.'</a>';
                                                                        }
                                                                        }
                                                                    ?>
                                                                    <span class="created-at ml-4"><?= meks_time_ago()?></span>
                                                                </p>
                                                                <p class="p2-paragraph"><?= get_excerpt_no_more(150)?></p>
                                                            </div>
                                                        </li>
                                                    <?php
                                                        }
                                                    endforeach;
                                                    wp_reset_postdata();
                                                }
                                            }

                                        ?>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="post-ads ads ads-right">
                        <?php
                            $post_sidebar_ads_1 = get_field('post_sidebar_ads_1','option');
                            if( $post_sidebar_ads_1 ):
                        ?>  
                        <div class="vertical-ads">
                            <a href="<?= $post_sidebar_ads_1['link']?>" target="_blank"><img src="<?= $post_sidebar_ads_1['image']?>" alt=""></a>
                        </div>
                        <?php endif?>
                        <?php
                            $post_sidebar_ads_2 = get_field('post_sidebar_ads_2','option');
                            if( $post_sidebar_ads_2 ):
                        ?> 
                        <div class="vertical-ads">
                            <a href="<?= $post_sidebar_ads_2['link']?>" target="_blank"><img src="<?= $post_sidebar_ads_2['image']?>" alt=""></a>
                        </div>
                        <?php endif?>

                    </div>
                </div>
            </div>

            <div class="content-after-post">
                <div class="row">
                    <div class="big-category-title h6-headline">
                        <span>Cùng chuyên mục</span>
                    </div>

                    <div class="box-with-ads-right">
                        <div class="col-12 categories-blocks">
                            <div class="row">
                                <div class="col-sm-6 col-12 category-block">
                                    <!--Category Block-->
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
                                                        <a  href="<?php the_permalink(); ?>" class="wrap_image"><?= the_post_thumbnail("post-category-thumb")?></a>
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
                                <div class="col-sm-6 col-12 category-block">
                                    <!--Category Block-->
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
                                                    <a  href="<?php the_permalink(); ?>" class="wrap_image"><?= the_post_thumbnail("post-category-thumb")?></a>
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
                            $post_content_ads_1 = get_field('post_content_ads_1','option');
                            if( $post_content_ads_1 ):
                        ?>  
                        <div class="col-12 ads long-ads mt-2 p-0">
                            <a href="<?= $post_content_ads_1['link']?>" target="_blank" ><img src="<?= $post_content_ads_1['image']?>" class="w-100" alt=""></a>
                        </div>
                        <?php endif?>

                        <div class="col-12 categories-blocks">
                            <div class="row">
                                <div class="col-md-6 col-12 category-block-vertical">
                                    <div class="category-block-item">
                                        <div class="category-heading">
                                            <h6 class="h6-headline text-uppercase"><a href="<?= get_term_link( 11, 'category' );?>">Người nổi tiếng</a></h6>
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
                                                        <a href="<?php the_permalink(); ?>"  class="col-md-6 col-sm-3 p-0 wrap_image"><?= the_post_thumbnail("post-category-small-thumb")?></a>
                                                        <div class="title--wrap col-md-6 col-sm-9 p-0 pl-2">
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
                                <div class="col-md-6 col-12 category-block-vertical">
                                    <div class="category-block-item">
                                        <div class="category-heading">
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
                                                        <a href="<?php the_permalink(); ?>"  class="col-md-6 col-sm-3 p-0 wrap_image"><?= the_post_thumbnail("post-category-small-thumb")?></a>
                                                        <div class="title--wrap col-md-6 col-sm-9 p-0 pl-2">
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

                    </div>
                    <div class="ads ads-right">
                        <?php
                            $post_sidebar_ads_3 = get_field('post_sidebar_ads_3','option');
                            if( $post_sidebar_ads_3 ):
                        ?>  
                        <div class="vertical-ads">
                            <a href="<?= $post_sidebar_ads_3['link']?>" target="_blank"><img src="<?= $post_sidebar_ads_3['image']?>" alt=""></a>
                        </div>
                        <?php endif?>

                    </div>

                    <div class="big-category-title h6-headline">
                        <!--ID 13 === tin noi bat-->
                        <span>Tin nổi bật</span>
                    </div>

                    <div class="box-with-ads-right">
                        <div class="col-12 box_highlight_feeds">
                            <div class="row">
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
                                                    <li class="big_feed">
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
                                        <li class="double_feeds">
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
                                                            <a href="<?php the_permalink(); ?>" class="wrap_image" ><?= the_post_thumbnail('double-feed-thumb')?></a>
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
                                                        <a href="<?php the_permalink(); ?>" class="wrap_image" ><?= the_post_thumbnail('double-feed-thumb')?></a>
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
                        <?php
                            $post_content_ads_2 = get_field('post_content_ads_2','option');
                            if( $post_content_ads_2 ):
                        ?>  
                        <div class="ads ads-bottom w-100">
                            <a href="<?= $post_content_ads_2['link']?>" target="_blank"><img src="<?= $post_content_ads_2['image']?>" class="w-100" alt=""></a>
                        </div>
                        <?php endif?>
                    </div>
                    <div class="ads ads-right">
                        <?php
                            $post_sidebar_ads_4 = get_field('post_sidebar_ads_4','option');
                            if( $post_sidebar_ads_4 ):
                        ?>  
                        <div class="vertical-ads">
                            <a href="<?= $post_sidebar_ads_4['link']?>" target="_blank"><img src="<?= $post_sidebar_ads_4['image']?>" alt=""></a>
                        </div>
                        <?php endif?>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <?php endwhile; ?>
    <?php endif; ?> 

<?php

get_footer();