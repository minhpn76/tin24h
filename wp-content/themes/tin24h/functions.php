<?php
/* ----------------------------------------------------------------------------
 * Add theme support for features
 */
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
// add_theme_support('automatic-feed-links');
// add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
// add_theme_support('bbpress');
// add_theme_support('align-wide');
// add_theme_support('align-full');

//Customs image size
add_image_size('image-slide-thumb', 400, 211, true);
add_image_size('big-feed-thumb', 484, 367, true);
add_image_size('double-feed-thumb', 306, 173, true);
add_image_size('post-thumb', 256, 168, true);
add_image_size('post-category-thumb', 400, 262, true);
add_image_size('post-category-small-thumb', 192, 134, true);

// Register the three useful image sizes for use in Add Media modal
add_filter( 'image_size_names_choose', 'wpshout_custom_sizes' );
function wpshout_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'image-slide-thumb' => __( 'Image slide thumb' ),
        'big-feed-thumb' => __( 'Big Feed Thumb' ),
        'double-feed-thumb' => __( 'Double Feed Thumb' ),
        'post-thumb' => __( 'Post Thumb' ),
        'post-category-thumb' => __( 'Post Category Thumb' ),
        'post-category-small-thumb' => __( 'Post Category Small Thumb' ),
    ) );
}

add_filter( 'wp_title', 'wpdocs_hack_wp_title_for_home' );

// Custom css nav
function add_menuclass($ulclass) {
    return preg_replace('/<a /', '<a class="s2-subtitle"', $ulclass);
 }
add_filter('wp_nav_menu','add_menuclass');
 
/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function wpdocs_hack_wp_title_for_home( $title )
{
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = __( 'Trang chủ', 'textdomain' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}

//Thumbnail

//customs footer & header

if( function_exists('acf_add_options_page') ) {
    acf_add_options_sub_page('Header');
    acf_add_options_sub_page('Footer');
    acf_add_options_sub_page('Social network');
}

//TODO: ADS settings
add_action('acf/init', 'ads_setting_init');
function ads_setting_init() {

    // Check function exists.
    if( function_exists('acf_add_options_sub_page') ) {

        // // Add parent.
        $parent = acf_add_options_page(array(
            'page_title'  => __('Ads Settings'),
            'menu_title'  => __('Ads Settings'),
            'redirect'    => false,
        ));

        // Add sub page.
        $home_ads = acf_add_options_sub_page(array(
            'page_title'  => __('Home Ads'),
            'menu_title'  => __('Home Ads'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $category_ads = acf_add_options_sub_page(array(
            'page_title'  => __('Category Ads'),
            'menu_title'  => __('Category Ads'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $post_ads = acf_add_options_sub_page(array(
            'page_title'  => __('Post Ads'),
            'menu_title'  => __('Post Ads'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $search_ads = acf_add_options_sub_page(array(
            'page_title'  => __('Search Ads'),
            'menu_title'  => __('Search Ads'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $tag_ads = acf_add_options_sub_page(array(
            'page_title'  => __('Tag Ads'),
            'menu_title'  => __('Tag Ads'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }
}



//Time ago when publish
function meks_time_ago() {
	return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'trước' );
}

function get_excerpt_no_more($limit, $source = null){

    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    // $excerpt = $excerpt.'... <a href="'.get_permalink($post->ID).'">more</a>';
    return $excerpt;
}


function get_limit_tilte($limit, $source = null){
    // var_dump('=get_the_title()', get_the_title());
    $excerpt = get_the_title();
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    // $excerpt = $excerpt.'... <a href="'.get_permalink($post->ID).'">more</a>';
    return $excerpt;
}

//GET view post
function gt_get_post_view($title) {
    $count = get_post_meta(get_the_ID(), 'post_views_count', true );
    if ($title) {
        if ($count === 0 || !$count) {
            return "0 lượt xem";
        }
        return "$count $title";
    }
    if ($count === 0 || !$count) {
        return "0 lượt xem";
    }
    return "$count lượt xem";
}
function set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//Tax

// get taxonomies terms links
function custom_taxonomies_terms_links() {
    global $post, $post_id;
    // get post by post id
    $post = &get_post($post->ID);
    // get post type by post
    $post_type = $post->post_type;
    // get post type taxonomies
    $taxonomies = get_object_taxonomies($post_type);
    $out = "<ul class='tag-lists'>";
    foreach ($taxonomies as $taxonomy) {        
        // get the terms related to post
        if ($taxonomy === 'post_tag'){
            $terms = get_the_terms( $post->ID, $taxonomy );
            if ( !empty( $terms ) ) {
                foreach ( $terms as $term )
                    $out .= '<li><a href="' .get_term_link($term->slug, $taxonomy) .'" class="tag-item">'.$term->name.'</a></li> ';
            }
        }

    }
    $out .= "</ul>";
    return $out;
}


function category_has_children() {
    $list_temp = array();
    $list_child = array();
    global $wpdb;
    $term = get_queried_object();
    $category_children_check = $wpdb->get_results(" SELECT * FROM wp_term_taxonomy WHERE parent !=  0 ");
    
    foreach($category_children_check as $cat) {
        array_push($list_temp, $cat->parent); 
    }
    $list_parent_cate = array_unique($list_temp);
    $in = '(' . implode(',', $list_parent_cate) .')';
    $list_temp_child = $wpdb->get_results(" SELECT * FROM wp_term_taxonomy WHERE parent IN $in ");
    foreach($list_temp_child as $child) {
        array_push($list_child, $child->term_id); 
    }
    
    
}

$THEME = get_stylesheet_directory_uri();
function pagination_tdc() {
    if( is_singular() )
    return;
    global $wp_query;
    if( $wp_query->max_num_pages <= 1 )
    return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max = intval( $wp_query->max_num_pages );
 
    if ( $paged >= 1 )
    $links[] = $paged;

    if ( $paged >= 3 ) {
           $links[] = $paged - 1;
           $links[] = $paged - 2;
     }
 
     if ( ( $paged + 2 ) <= $max ) {
           $links[] = $paged + 2;
           $links[] = $paged + 1;
      }
 
    echo '<ul>' . "\n";
    
    if ( $paged > 1) {
        $min_page = wp_guess_url() . "/page/" . 1 . "/?s=" . get_query_var('s');
        // if (get_query_var('s')) {
        //     $min_page = $min_page . "/?s=" . get_query_var('s');
        // }
        printf( '<li class="next"><a href='. $min_page .'><img src='. get_stylesheet_directory_uri() . "/tin24h/images/double-chevron-right.svg'" .' alt=""></li></a>' . "\n");
    }
    if ( get_previous_posts_link() ) {
    printf( '<li class="next" style="transform: matrix(1, 0, 0, 1, 0, 0);">%s</li>' . "\n", get_previous_posts_link('<img src='. get_stylesheet_directory_uri() . "/tin24h/images/chevron-left.svg'" .' alt="">') );
    }

    if ( ! in_array( 1, $links ) ) {
    $class = 1 == $paged ? ' class="active"' : '';
    printf( '<li %s><a rel="nofollow" class="page larger" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
    if ( ! in_array( 2, $links ) )
    echo '<li><a>…</a></li>';
    }
    
    sort( $links );
    foreach ( (array) $links as $link ) {
    $class = $paged == $link ? ' class="active"' : '';
    printf( '<li%s><a rel="nofollow" class="page larger" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
    
    if ( ! in_array( $max, $links ) ) {
    if ( ! in_array( $max - 1, $links ) )
    echo '<li><a>…</a></li>' . "\n";
    $class = $paged == $max ? ' class="active"' : '';
    printf( '<li%s><a rel="nofollow" class="page larger" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
  
    if ( get_next_posts_link() ) {
    printf( '<li style="transform: matrix(1, 0, 0, 1, 0, 0);" class="last">%s</li>' . "\n", get_next_posts_link('<img src='. get_stylesheet_directory_uri() . "/tin24h/images/chevron-right-1.svg'" .' alt="">') );
    // echo '</ul>' . "\n";
    }
    
    if ($max) {
        $lastest_page = wp_guess_url() . "/page/" . $max . "/?s=" . get_query_var('s');
        // if (get_query_var('s')) {
        //     $lastest_page = $lastest_page . "/?s=" . get_query_var('s');
        // }
        printf( '<li class="last"><a href='. $lastest_page .'><img src='. get_stylesheet_directory_uri() . "/tin24h/images/double-chevron-right.svg'" .' alt=""></li></a>' . "\n");
        echo '</ul>' . "\n";
    }
 }

add_filter('next_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
  return 'class="on-mobile"';
}

 