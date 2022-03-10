<!doctype html >
<!--[if IE 8]>
<html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9]>
<html class="ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php
        wp_head(); /** we hook up in wp_booster @see td_wp_booster_functions::hook_wp_head */
    ?>
    <!--Custom css-->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/tin24h/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/tin24h/css/slick-theme.css' ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/tin24h/css/slick.css' ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/tin24h/css/font-awesome.min.css' ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/tin24h/css/custom.css' ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/tin24h/css/new-style.css' ?>">
</head>

<body>

<?php
    $nav_is_child = array();
    $object_parent = array();
    $nav_parent = array();
    $nav_dropdown = get_terms('category', array(
        'hide_empty' => false,
        'orderby'    => 'count',
        'order'      => 'DESC',
    ));
    foreach ($nav_dropdown as $nav) {
        if ($nav->parent !== 0) {
            array_push($nav_is_child, $nav);
            array_push($nav_parent, $nav->parent);
        }
    }
?>

<section class="header">
    <div class="header_layout">
        <div class="header-block">
            <div class="header-container">
                <?php
                    $header_logo = get_field('logo', 'option');
                    if ($header_logo):
                        ?>
                        <a href="<?= $header_logo['link'] ?>" class="logo">
                            <img src="<?= $header_logo['image'] ?>" alt="">
                        </a>
                        <ul class="top-menu">
                            <li class="top-menu--item">
                                <a href="<?= $header_logo['link'] ?>" class="s2-subtitle"><img
                                            src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/home.svg' ?>"
                                            alt=""></a>
                            </li>
                            <li>
                                <?php
                                    wp_nav_menu(
                                        array(
                                            'menu'       => 'main-menu',
                                            'depth'      => 0,
                                            'menu_id'    => 'nav-menu',
                                            'container'  => 'ul',
                                            'menu_class' => 'top-menu w-inherit',
                                            'echo'       => true,
                                        )
                                    );
                                ?>
                            </li>
                            <li class="top-menu--item">
                                <a href="javascript:;" class="s2-subtitle js-toggle-dropdownmenu"><img
                                            src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/keypad.svg' ?>"
                                            alt=""></a>
                            </li>
                        </ul>
                    <?php endif; ?>
            </div>
            <!--new update: add block-->
            <div class="header-mobile">
                <div class="col-12">
                    <div class="row">
                        <?php
                            $header_logo = get_field('logo', 'option');
                            if ($header_logo):
                                ?>
                                <div class="col-6">
                                    <a href="<?= $header_logo['link'] ?>" class="s2-subtitle"><img
                                                src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/logo.png' ?>"
                                                class="mr-2" alt=""></a>
                                </div>
                            <?php endif; ?>
                        <div class="col-6">
                            <div class="col-8 offset-4">
                                <div class="row">
                                    <div class="col-8 text-right wrap-xl">
                                        <button type="button" class=" btn btn-active-mobile-search s2-subtitle"><img
                                                    src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/search-white.svg' ?>"
                                                    alt=""></button>
                                        <form role="search" method="get" id="searchform"
                                              action="<?php echo esc_url(home_url('/')); ?>" class="form-mobile-search">
                                            <input type="text" placeholder="Nhập nội dung tìm kiếm"
                                                   class="inp-mobile-search" value="<?php echo get_search_query(); ?>"
                                                   name="s" id="s">
                                            <button type="submit" class=" btn btn-mobile-search s2-subtitle"><img
                                                        src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/search-white.svg' ?>"
                                                        alt=""></button>
                                        </form>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="#" class="s2-subtitle js-toggle-dropdownmenu text-right"><img
                                                    src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/keypad.svg' ?>"
                                                    alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <?php
                if ($nav_parent) {
                    ?>
                    <div class="header-dropdown">

                        <div class="header-container isPC">
                            <ul class="menu-items col-12 row">
                                <?php
                                    $list_nav_parent = get_terms('category', array(
                                        'hide_empty' => false,
                                        'orderby'    => 'count',
                                        'order'      => 'DESC',
                                        'include'    => $nav_parent
                                    ));
                                    foreach ($list_nav_parent as $parent) {
                                        $term_parent = get_term_link($parent, 'category');
                                        ?>
                                        <li class="col-6 col-md-4 col-xl-2 ">
                                            <a href="<?= $term_parent ?>" class="h6-headline"><?= $parent->name ?></a>

                                            <ul class="sub-menu">
                                                <?php
                                                    foreach ($nav_is_child as $c) {
                                                        if ($c->parent === $parent->term_id) {
                                                            $term_c = get_term_link($c->term_id, 'category');
                                                            
                                                            ?>
                                                            <li>
                                                                <a href="<?= $term_c ?>"
                                                                   class="p2-paragraph"><?= $c->name ?></a>
                                                            </li>
                                                        <?php }
                                                    } ?>

                                            </ul>
                                        </li>
                                    <?php } ?>
                            </ul>
                        </div>
                        <div class="header-container isMobile">
                            <ul class="menu-items col-12 row">
                                <?php
                                    $list_nav_parent = get_terms('category', array(
                                        'hide_empty' => false,
                                        'orderby'    => 'parent',
                                        'order'      => 'DESC',
                                        'exclude'    => [1, 2, 6, 7, 13, 21]
                                    ));
                                    foreach ($list_nav_parent as $parent) {
                                        $term_parent = get_term_link($parent, 'category');
                                        if ($parent->parent === 0) {
                                            ?>
                                            <li class="col-6 col-md-4 col-xl-2 "
                                                style="<?= !empty($parent) ? 'margin-bottom: 0px' : '' ?>">
                                                <a href="<?= $term_parent ?>"
                                                   class="h6-headline"><?= $parent->name ?></a>

                                                <ul class="sub-menu">
                                                    <?php
                                                        foreach ($nav_is_child as $c) {
                                                            if ($c->parent === $parent->term_id) {
                                                                $term_c = get_term_link($c->term_id, 'category');
                                                                
                                                                ?>
                                                                <li>
                                                                    <a href="<?= $term_c ?>"
                                                                       class="p2-paragraph"><?= $c->name ?></a>
                                                                </li>
                                                            <?php }
                                                        } ?>

                                                </ul>
                                            </li>
                                        <?php }
                                    } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>

        </div>
    </div>
    <div class="hot-feeds">
        <div class="header-container">
            <div class="col-12">
                <div class="row">
                    <?php
                        $terms = get_terms('post_tag', array(
                            'hide_empty' => false,
                            'orderby'    => 'count',
                            'order'      => 'DESC',
                            'number'     => 5
                        ));
                        
                        if ($terms) {
                            ?>
                            <div class="feeds col-8">
                                <div class="row">
                                    <div class="feed-head col-4 col-xl-2">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/increase.svg' ?>"
                                             alt="" class="mr-2"> <span
                                                class="p2-paragraph">Xu hướng</span>
                                    </div>
                                    <ul class="col-8 col-xl-10">
                                        <?php
                                            foreach ($terms as $t) {
                                                $term_link = get_term_link($t, 'post_tag');
                                                ?>
                                                <li>
                                                    <a href="<?= $term_link ?>" class="p2-medium">#<?= $t->name ?></a>
                                                </li>
                                            <?php } ?>
                                    </ul>
                                </div>

                            </div>
                        <?php } ?>
                    <div class="search col-4">
                        <form role="search" method="get" id="searchform" class="searchform"
                              action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="text" class="inp-search text-right" value="<?php echo get_search_query(); ?>"
                                   name="s" id="s" placeholder="Tìm kiếm..." autocomplete="off">
                            <button type="submit" class="btn-search">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/tin24h/images/search.svg' ?>"
                                     alt="">
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<?php
    $slide_header = get_field('slide_header', 'option');
    if ($slide_header):
        ?>
        <section class="big-banners">
            <div class="container container-pl100">
                <div class="banner-slides">
                    <?php
                        foreach ($slide_header as &$slide) :
                            ?>
                            <a target='<?= $slide['link']['target'] ?>' href="<?= $slide['link']['url'] ?>"><img
                                        src="<?= $slide['image'] ?>" alt=""></a>
                        <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif ?>

