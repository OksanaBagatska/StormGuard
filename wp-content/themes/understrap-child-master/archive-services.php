<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod('understrap_container_type');

?>
<div class="wrapper" id="page-wrapper">
    <div class="<?php echo esc_attr($container); ?> container-block" id="content" tabindex="-1">
        <?php ?>
        <main class="site-main" id="main">
            <div class="row m-0 p-0">
                <?php if (have_posts()) : ?>
                    <div class="col-12">
                        <header class="page-header">
                            <?php
                            the_archive_title('<h1 class="page-title">', '</h1>');
                            the_archive_description('<div class="taxonomy-description">', '</div>');
                            ?>
                        </header><!-- .page-header -->
                    </div>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-lg-4 col-md-4 col-6 d-flex justify-content-center mb-4">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url() ?>" alt="gallery">
                                <h3><?php the_title() ?></h3>
                            </a>
                        </div>
                        <?php
                        ?>

                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </main><!-- #main -->
        <?php ?>
    </div>
</div>
<?php get_footer('page'); ?>