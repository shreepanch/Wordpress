<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Zone
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="site">
            <?php
            if (is_active_sidebar('advertisement-1')) {

                $header_class = 'advertisement-active';
            } else {

                $header_class = '';
            }
            ?>
            <header id="masthead" class="site-header <?php echo $header_class; ?>" role="banner">
                <div class="container">

                    <div class="site-branding">
                        <?php
                        $logo_type = blog_zone_options('logo_type');

                        if ('logo-only' == $logo_type) {

                            if (function_exists('the_custom_logo')) {

                                the_custom_logo();
                            }
                        } elseif ('title-desc' == $logo_type) {
                            ?>

                            <h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>

                            <?php
                            $description = get_bloginfo('description', 'display');

                            if ($description || is_customize_preview()) :
                                ?>

                                <h3 class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></h3>

                                <?php
                            endif;
                        }elseif ('logo-title' == $logo_type) {

                            if (function_exists('the_custom_logo')) {

                                the_custom_logo();
                            }
                            ?>

                            <h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>

                            <?php
                        } elseif ('logo-desc' == $logo_type) {

                            if (function_exists('the_custom_logo')) {

                                the_custom_logo();
                            }

                            $description = get_bloginfo('description', 'display');

                            if ($description || is_customize_preview()) :
                                ?>

                                <h3 class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></h3>

                                <?php
                            endif;
                        }
                        ?>
                    </div><!-- .site-branding -->

                    <?php if (is_active_sidebar('advertisement-1')) { ?>

                        <div class="header-advertisement">

                            <?php dynamic_sidebar('advertisement-1'); ?>

                        </div><!-- .header-advertisement -->

                    <?php }
                    ?>

                </div>

                <div class="main-navigation-holder">
                    <div class="container">
                        <div id="main-nav" class="clear-fix">
                            <nav id="site-navigation" class="main-navigation" role="navigation">
                                <?php
                                $home_icon = blog_zone_options('home_icon');

                                if (1 == absint($home_icon)) {

                                    if (is_front_page()) {

                                        $home_icon = 'home-icon home-active';
                                    } else {

                                        $home_icon = 'home-icon';
                                    }
                                    ?>

                                    <div class="<?php echo $home_icon; ?>">

                                        <a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-home"></i></a>

                                    </div>

                                <?php }
                                ?>

                                <div class="wrap-menu-content">
                                    <?php
                                    wp_nav_menu(array(
                                        'theme_location' => 'menu-1',
                                        'menu_id' => 'primary-menu',
                                    ));
                                    ?>
                                </div><!-- .wrap-menu-content -->
                            </nav>
                        </div> <!-- #main-nav -->

                        <?php
                        $social_icons = blog_zone_options('social_icons');
                        $show_search = blog_zone_options('show_search');

                        if (( 1 === absint($social_icons) ) || ( 1 === absint($show_search) )) {
                            ?>

                            <div class="top-widgets-wrap">

                                <?php
                                if (1 === absint($social_icons)) {

                                    the_widget('Blog_Zone_Social_Widget');
                                }

                                if (1 === absint($show_search)) {
                                    ?>
                                    <div class="search-holder">
                                        <a href="#" class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></a>

                                        <div class="search-box" style="display: none;">
                                            <?php get_search_form(); ?>
                                        </div>
                                    </div>
                                <?php }
                                ?>

                            </div><!-- .social-widgets -->
                        <?php }
                        ?>

                    </div><!-- .container -->
                </div><!-- .main-navigation-holder -->
            </header><!-- #masthead -->

            <div id="content" class="site-content">

                <?php
                if (is_front_page() || is_home()) {

                    get_template_part('template-parts/slider');

                    if (is_active_sidebar('advertisement-2')) {
                        ?>
                        <section class="advertisement-full-section">
                            <div class="container">
                                <?php dynamic_sidebar('advertisement-2'); ?>
                            </div>
                        </section><!-- .advertisement-ful-section -->
                        <?php
                    }
                }
                ?>

                <div class="container">
                    <div class="inner-wrapper">
