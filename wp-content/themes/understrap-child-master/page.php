<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod('understrap_container_type');

?>
<?php if(!empty(get_field('banner_page'))){ ?>
    <div class="banner banner__page" style="background-image: url('<?php the_field('banner_page') ?>');">
    </div>
    <?php } ?>
    <div class="wrapper" id="page-wrapper">

        <div class="<?php echo esc_attr($container); ?> container-block" id="content" tabindex="-1">
            <?php if (function_exists('qt_custom_breadcrumbs')) qt_custom_breadcrumbs(); ?>
            <main>
                <div class="row m-0 p-0">
                    <?php
                    global $post;
                    if (!$post->post_parent) { ?>
                        <h1><?php the_title(); ?></h1>
                    <?php } ?>
                    <div><?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                the_content();
                            }
                        }
                        ?>
                    </div>
                </div>
            </main>
        </div>
        <?php echo do_shortcode('[bannerLocationshortcdPage]') ?>
    </div>
<?php get_footer('page'); ?>