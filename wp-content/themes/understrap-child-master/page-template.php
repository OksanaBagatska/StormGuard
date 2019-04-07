<?php
/*
 * Template name: Template page
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod('understrap_container_type');

?>
    <div class="banner banner__page" style="background-image: url('<?php the_field('banner_page') ?>');">

    </div>
    <div class="wrapper" id="page-wrapper">

        <div class="<?php echo esc_attr($container); ?> container-block" id="content" tabindex="-1">
            <?php if (function_exists('qt_custom_breadcrumbs')) qt_custom_breadcrumbs(); ?>
            <main>
                <div class="row m-0 p-0 row__page">
                    <div class="col-lg-6 col-12 p-0 banner-thumbnail">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="image">
                    </div>
                    <div class="col-lg-6 col-12 p-0 block-content">
                        <h1><?php the_title(); ?></h1>
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
                </div>
            </main>
            <?php  echo do_shortcode('[servicesShtcd]') ?>
        </div>
        <?php  echo do_shortcode('[bannerLocationshortcd]') ?>
    </div>
    </div>
<?php get_footer('page'); ?>