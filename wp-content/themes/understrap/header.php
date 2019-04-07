<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$container = get_theme_mod('understrap_container_type');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" type="text/css" href="css/slick.css"/>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/slick.min.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="site" id="page">

    <header>
        <div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

            <a class="skip-link sr-only sr-only-focusable"
               href="#content"><?php esc_html_e('Skip to content', 'understrap'); ?></a>



                <?php if ('container' == $container) : ?>

                <?php endif; ?>
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 p-0 m-0 top-bar">
                        <div class="container container-block d-flex align-items-center">
                            <nav class="navbar navbar-expand-md p-0 w-100">
                            <div class="d-flex w-100 justify-content-between">
                                <a class="header-link"
                                   href="<?php the_field('header_link', 'options'); ?>"><?php the_field('header_text', 'options'); ?></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarNavDropdown"
                                        aria-controls="navbarNavDropdown" aria-expanded="false"
                                        aria-label="<?php esc_attr_e('Toggle navigation', 'understrap'); ?>">
                                    <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
                                </button>
                            </div>

                            <!-- The WordPress Menu goes here -->
                            <?php wp_nav_menu(
                                array(
                                    'menu' => 'Header top bar',
                                    'container_class' => 'collapse navbar-collapse',
                                    'container_id' => 'navbarNavDropdown',
                                    'menu_class' => 'navbar-nav ml-auto',
                                    'menu_id' => 'main-menu',
                                    'walker' => new Understrap_WP_Bootstrap_Navwalker(),
                                )
                            ); ?>
                            </nav>
                        </div>
                    </div>
                    <div class="col-12 p-0 m-0 bottom-bar">
                        <div class="container container-block d-flex align-items-center">
                            <nav class="navbar navbar-expand-lg p-0 w-100">
                            <div class="d-flex w-100 justify-content-between">
                                <?php if (!has_custom_logo()) { ?>
                            <?php if (is_front_page() && is_home()) : ?>
                                <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>"
                                                                 title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
                                                                 itemprop="url"><?php bloginfo('name'); ?></a></h1>
                            <?php else : ?>

                                <a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>"
                                   title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
                                   itemprop="url"><?php bloginfo('name'); ?></a>

                            <?php endif; ?>


                                <?php } else {
                                    the_custom_logo();
                                } ?><!-- end custom logo -->
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarNavDropdownBottom"
                                        aria-controls="navbarNavDropdownBottom" aria-expanded="false"
                                        aria-label="<?php esc_attr_e('Toggle navigation', 'understrap'); ?>">
                                    <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
                                </button>
                            </div>
                                <?php wp_nav_menu(
                                    array(
                                        'menu' => 'Header bottom bar',
                                        'container_class' => 'collapse navbar-collapse',
                                        'container_id' => 'navbarNavDropdownBottom',
                                        'menu_class' => 'navbar-nav ml-auto',
                                        'fallback_cb' => '',
                                        'menu_id' => 'menu bottom bar',
                                        'depth' => 2,
                                        'walker' => new Understrap_WP_Bootstrap_Navwalker(),
                                    )
                                ); ?>
                            </nav><!-- .site-navigation -->
                            </div>

                    </div>
                    <?php if ('container' == $container) : ?>
                </div>
            <?php endif; ?>



        </div><!-- #wrapper-navbar end -->
    </header>
