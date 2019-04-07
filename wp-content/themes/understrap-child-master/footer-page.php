<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$container = get_theme_mod('understrap_container_type');
?>

<?php get_template_part('sidebar-templates/sidebar', 'footerfull'); ?>
<footer class="footer-page">
    <div class="wrapper" id="wrapper-footer">
        <div class="row m-0 p-0 footer-top-row">
            <div class="<?php echo esc_attr($container); ?> container-block">
                <div class="row m-0 p-0">
                    <div class="col-lg-6 p-0 contact-us">
                        <h3><?php the_field('title_footer_column_1', 'options') ?></h3>
                        <p><?php the_field('text_column_footer_1', 'options') ?></p>
                       <?php
                       $button = get_field('button_contact', 'options')?>
                        <a class="button-contact" href="<?php  echo $button['button_contact_local_link'];?>">
                            <?php echo $button['button_contact_local'] ?></a>
                        <a class="button-contact" href="<?php echo $button['button_contact_storm_link'] ?>">
                            <?php echo $button['button_contact_storm'] ?></a>
                    </div>
                    <div class="col-lg-6 p-0 block__gallery">
                        <h3><?php the_field('title_footer', 'options') ?></h3>
                        <p><?php the_field('section_gallery_page_text', 'options') ?></p>
                        <div class="row d-flex justify-content-lg-between justify-content-md-start">
                            <?php
                            $args = array(
                                'post_type' => 'gallery',
                                'posts_per_page' => 8,
                                'order' => 'ASC',
                                'orderby' => 'date'
                            );
                            $newquery = new WP_Query($args);
                            while ($newquery->have_posts()) {
                                $newquery->the_post(); ?>
                                <div class="col-lg-3 col-md-4 col-4 gallery__item">
                                    <a href="<?php the_post_thumbnail_url('homepage-image'); ?>" data-fancybox="gallery" data-caption="Caption for single image">
                                        <img src="<?php the_post_thumbnail_url('homepage-image'); ?>" alt="image">
                                    </a>
                                </div>
                            <?php }
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                </div>
            </div><!-- row end -->

        </div><!-- container end -->
        <div class="row m-0 p-0 footer-bottom-row">
            <div class="<?php echo esc_attr($container); ?> container-block">
                <div><?php the_field('footer_copyright', 'options') ?></div>
                <?php wp_nav_menu(
                    array(
                        'menu' => 'Footer',
                        'container_class' => '',
                        'container_id' => 'navbarNavDropdown',
                        'menu_class' => 'navbar-nav ml-auto',
                        'menu_id' => 'main-menu',
                        'walker' => new Understrap_WP_Bootstrap_Navwalker(),
                    )
                ); ?>
            </div>
        </div>
    </div><!-- wrapper end -->

    </div><!-- #page we need this extra closing tag here -->
</footer>
<?php wp_footer(); ?>

</body>

</html>