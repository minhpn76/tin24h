<?php
/*  ----------------------------------------------------------------------------
    the blog index template
 */

get_header();
$loop_includes_post_big = array();
$loop_includes_post_small_cate = array();
$loop_includes_post_big_cate = array();
$cat_id = get_queried_object_id();

$current_category_id = get_query_var('cat');
$current_category_obj = get_category($current_category_id);


//handle nav is parent
$nav_parent = array();
$parent_nav = array();
$nav_is_child = array();
$nav_dropdown = get_terms('category',array(
    'hide_empty'=>false,
    'orderby' => 'count',
    'order' => 'DESC',
));
foreach($nav_dropdown as $nav) {
    if ($nav->parent !== 0) {
    
        array_push($nav_parent, $nav->parent);
        array_push($nav_is_child, $nav->term_id);
    }
}
$parent_nav = array_unique($nav_parent);
//get parent from child
$temp_parent;
if (in_array($current_category_id, $nav_is_child)) {
    foreach($nav_dropdown as $nv_d) {
        if ($nv_d->term_id === $current_category_id) {
            $temp_parent = $nv_d->parent;
        }
    }
}


//
?>
    <section class="main category">
        <div class="container">
            <div class="breadcrumb-bar col-12">
                <?php 
                    if (empty($temp_parent)) {
                ?>
                <div class="row">
                    <div class="text-uppercase category-name text-white">
                        <?php
                            if (!in_array($current_category_id, $parent_nav)) {
                        ?>
                        <span><?= $current_category_obj->name?></span>
                        <?php } else { ?>

                        <div class="d-inline-block">
                            <span class="sub-categories-mobile"><?= $current_category_obj->name?></span>
                            <span class="ml-3 mr-3"><i class="fa fa-angle-right text-white"></i></span>
                        </div>
                        <?php }?>
                    </div>
                    <?php
                        if (in_array($current_category_id, $parent_nav)) {
                            $nav_c_t = get_terms('category',array(
                                'hide_empty'=>false,
                                'orderby' => 'count',
                                'order' => 'DESC',
                            ));
                    ?>
                    <ul class="sub-categories-list">
                        <?php
                            foreach($nav_c_t as $nv_cp) {
                                if ($nv_cp->parent === $current_category_id) {
                                    $link_nv_c = get_term_link( $nv_cp->term_id, 'category' );
                        ?>
                            <li class="active"><a href="<?= $link_nv_c?>" class="sub-category"><?= $nv_cp->name?></a></li>
                        <?php }}?>
                    </ul>
                    <?php }?>
                </div>
                <?php } else {
                    $obj_parent = get_category($temp_parent);
                ?>
                <div class="row">
                    <div class="text-uppercase category-name text-white">
                        <div class="d-inline-block">
                            <span class="sub-categories-mobile"><?= $obj_parent->name?></span>
                            <span class="ml-3 mr-3"><i class="fa fa-angle-right text-white"></i></span>
                        </div>
                    </div>
                    <?php
                        if (in_array($temp_parent, $parent_nav)) {
                            $nav_c_t_i = get_terms('category',array(
                                'hide_empty'=>false,
                                'orderby' => 'count',
                                'order' => 'DESC',
                            ));
                    ?>
                    <ul class="sub-categories-list">
                        <?php
                            foreach($nav_c_t_i as $nv_cp_i) {
                                if ($nv_cp_i->parent === $temp_parent) {
                                    $link_nv_c_i = get_term_link( $nv_cp_i->term_id, 'category' );
                        ?>
                            <li class="<?php if($nv_cp_i->term_id === $current_category_id) { ?> active <?php }?>"><a href="<?= $link_nv_c_i?>" class="sub-category"><?= $nv_cp_i->name?></a></li>
                        <?php }}?>
                    </ul>
                    <?php }?>
                </div>
                <?php }?>
            </div>
            

            <div class="content-after-post">
                <div class="row">
                    <div class="box-with-ads-right">
                        <div class="col-12 box_highlight_feeds">
                            <div class="row">
                                <div class="block-top">
                                    
                                        <?php
                                            $params = array(
                                                'numberposts'      => 1,
                                                'category'         => $cat_id,
                                            );
                                            $post_list = get_posts($params);
                                            if ( $post_list ) {
                                        ?>
                                            <ul>
                                            <?php
                                                foreach ( $post_list as $post ) : 
                                                    setup_postdata( $post ); 
                                                    array_push($loop_includes_post_big_cate, $post->ID);
                                                ?>
                                                    <li class="big_feed">
                                                        <a href="<?php the_permalink(); ?>" class="big_feed--img"><?= the_post_thumbnail('big-feed-thumb')?></a>
                                                        <div class="big_feed--title">
                                                            <h5><a href="<?php the_permalink(); ?>"  class="h5-headline text-2lines"><?php the_title(); ?></a></h5>
                                                            <p class="p2-paragraph text-2lines"><?= get_excerpt_no_more(150)?></p>
                                                        </div>
                                                    </li>
                                                <?php
                                                    endforeach;
                                                    wp_reset_postdata();
                                            ?>
                                            <li class="double_feeds">
                                                <?php
                                                    $params = array(
                                                        'numberposts'      => 3,
                                                        'category'         => $cat_id,
                                                    );
                                                    $post_list = get_posts($params);
                                                    if ( $post_list ) {
                                                        foreach ( $post_list as $post ) : 
                                                            if (!in_array($post->ID,$loop_includes_post_big_cate)) {
                                                                setup_postdata( $post ); 
                                                                array_push($loop_includes_post_small_cate, $post->ID);
                                                        
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
                                        <?php  } else {?>
                                            <div class="row">
                                                <div class="col-12">Không có dữ liệu</div>
                                            </div>
                                        <?php }?>

                                </div>

                                <div class="category-heading orange-heading">
                                    <!--diem tin chinh 21-->
                                    <h6 class="h6-headline text-uppercase">điểm tin chính</h6>
                                </div>

                                <div class="block-bottom block-orange">
                                    <?php
                                        $params = array(
                                            'numberposts'      => 100,
                                            'cat'              => $cat_id,
                                        );
                                        $post_list = get_posts($params);
                                        if ( $post_list ) {
                                    ?>
                                        <ul class="block-bottom--slides">
                                        <?php
                                            foreach ( $post_list as $post ) : 
                                                setup_postdata( $post ); 
                                                $categories = wp_get_post_categories( $post->ID );
                                                foreach($categories as $c) {
                                                    if ($c === 21) {
        
                                            ?>
                                                <li>
                                                    <a href="<?php the_permalink(); ?>" class="wrap_image"><?= the_post_thumbnail('post-thumb')?></a>
                                                    <h6><a href="<?php the_permalink(); ?>"  class="h6-headline text-3lines"><?= the_title()?></a></h6>
                                                </li>
                                            <?php
                                                }
                                            }
                                            endforeach;
                                            wp_reset_postdata();
        
                                        ?>
                                        
                                        </ul>
                                        <?php } else {?>
                                            <div class="row">
                                                <div class="col-12">Không có dữ liệu</div>
                                            </div>
                                        <?php }?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 hottest-feeds">
                            <div class="row">
                                <div class="hottest-feeds--content">
                                    <ul>
                                        <?php
                                            $args_by_cate = array(
                                                'numberposts'      => 5,
                                                'category'         => $cat_id,
                                                'exclude'          => array_merge($loop_includes_post_big_cate, $loop_includes_post_small_cate)
                                            );
                                            $post_by_cat = get_posts($args_by_cate);
                                            if ( $post_by_cat ) {
                                                foreach ( $post_by_cat as $post ) : 
                                                    setup_postdata( $post ); ?>
                                                    <li class="hottest-feed">
                                                        <h5><a href="<?php the_permalink(); ?>"  class="h5-headline on-mobile"><?= get_limit_tilte(150); ?></a></h5>
                                                        <a  href="<?php the_permalink(); ?>" class="img"><?= the_post_thumbnail('post-thumb')?></a>
                                                        <div class="hottest-feed--description">
                                                            <h5><a href="<?php the_permalink(); ?>"  class="h5-headline"><?= get_limit_tilte(150); ?></a></h5>
                                                            <p>
                                                                <?php
                                                                    //get all the categories the post belongs to
                                                                    $categories = wp_get_post_categories( get_the_ID() );
                                                                    //loop through them
                                                                    foreach($categories as $c){
                                                                        $cat = get_category( $c );
                                                                        //get category tin hot includes TINHOT & DANG DUOC QUAN TAM & TIN NOI BAT & Diem tin chinh
                                                                        $cat_id_id = get_cat_ID( $cat->name );
                                                                        if ($cat_id_id === $cat_id) {
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
                                                        <?= the_post_thumbnail('post-thumb')?>
                                                    </a>
                                                    <div class="top-followings--title">
                                                        <p><a href="<?php the_permalink(); ?>"  class="h5-headline"><?php echo get_limit_tilte(150)?></a></p>
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

                        <div class="col-12 box_highlight_feeds">
                            <div class="row">
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
                            </div>
                        </div>

                    </div>
                    <div class="ads ads-right">
                        <?php
                            $category_sidebar_ads_1 = get_field('category_sidebar_ads_1','option');
                            if( $category_sidebar_ads_1 ):
                        ?>     
                        <div class="vertical-ads">
                            <a href="<?= $category_sidebar_ads_1['link']?>" target="_blank"><img src="<?= $category_sidebar_ads_1['image']?>" alt=""></a>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

get_footer();