<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod('understrap_container_type');

?>
<?php if (!empty(get_field('banner_page'))) { ?>
    <div class="banner banner__page" style="background-image: url('<?php the_field('banner_page') ?>');">
    </div>
<?php } ?>
    <div class="wrapper wrapper-blog" id="page-wrapper">

        <div class="<?php echo esc_attr($container); ?> container-block" id="content" tabindex="-1">
            <?php if (function_exists('qt_custom_breadcrumbs')) qt_custom_breadcrumbs(); ?>
            <main>

                <div class="col-12">
                    <h1><?php the_title(); ?></h1>
                </div>
                        <div class="row m-0 p-0">
                            <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args = array(
                                'post_type' => 'post',
                                'orderby' => 'data',
                                'posts_per_page' => 3,
                                'order' => 'DESC',
                                'paged' => $paged);
                            $my_query = new wp_query($args);

                            while ($my_query->have_posts()) {
                            $my_query->the_post(); ?>
                            <div class="col-lg-4 col-md-12  mx-md-auto post__item">
                                <div class="item-img">
                                    <img src="<?php the_post_thumbnail_url('blog-image'); ?>" alt="post-image">
                                    <div class="post-date">
                                        <?php echo get_the_date('M'); ?> <br/>
                                        <span class="post-date-year"> <?php echo get_the_date('y'); ?></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4> <?php the_title(); ?></h4>
                                </div>
                            </div>
                        <?php
                        }
                        wp_reset_query(); ?>

                    </div>
                    <div class="col-12">
                        <?php if (function_exists("pagination")) {
                            pagination($my_query->max_num_pages);

                        } ?>

                    </div>
            </main>
        </div>
        <?php echo do_shortcode('[bannerLocationshortcdPage]') ?>
    </div>
<?php get_footer('page'); ?>