<?php
/*
 * Template name: Front page
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod('understrap_container_type');

?>
<div class="banner" style="background-image: url('<?php the_field('banner_page') ?>');">
    <!--    <img src="--><?php //the_field("banner_page") ?><!--" alt="">-->
    <div class="container container-block">
        <div class="banner__info">
            <div class="banner__text">
                <?php the_field('banner_text') ?>
            </div>
            <a class="banner__button" href="<?php the_field('banner_button_link') ?>">
                <?php the_field('banner_button_text') ?>
            </a>
        </div>
    </div>
</div>

<section class="find-franchise">
    <div class="container container-block">
        <div>
            <img src="<?php the_field('icon_find_franchise', 'options') ?>" alt="icon">

            <h3><?php the_field('title_find_franchise', 'options') ?></h3>
            <p><?php the_field('text_find_franchise', 'options') ?></p>
        </div>
        <form action="">
            <input type="text" name="" class="" placeholder="Enter Zip Code">
            <button>Submit</button>
        </form>
    </div>
</section>
<section class="services">
    <h3 class="section__title"><?php the_field('title_services', 'options') ?></h3>
    <div class="section__text"><?php the_field('text_services', 'options') ?></div>
    <div class="container container-block">
        <div class="row m-0 p-0 ">
            <?php
            $args = array(
                'post_type' => 'services',
                'posts_per_page' => 6,
                'order' => 'ASC',
                'orderby' => 'date'
            );
            $newquery = new WP_Query($args);
            while ($newquery->have_posts()) {
                $newquery->the_post(); ?>
                <div class="col-lg-4 col-md-6 col-12 services__item">
                     <img src="<?php the_field('logo_service') ?>" alt="">
                    <a href="<?php the_permalink(); ?>">
                        <h4> <?php the_title(); ?></h4></a>
                    <span><?php the_excerpt(); ?></span>
                 </div>
             <?php }
            wp_reset_query();
            ?>
        </div>
    </div>
    <a class="section__button"
       href="<?php the_field('button_link_services', 'options') ?>"><?php the_field('button_text_services', 'options') ?></a>
</section>

<section class="get-started">
    <h3 class="section__title"><?php the_field('title_get_started', 'options') ?></h3>
    <span class="section__text"><?php the_field('text_get_started', 'options') ?></span>
    <div class="container container-block">
        <div class=" row d-flex m-0 justify-content-between p-0 ">
            <?php
            $args = array(
                'category_name' => 'service',
                'posts_per_page' => 3,
                'order' => 'ASC',
                'orderby' => 'date'
            );
            $newquery = new WP_Query($args);
            while ($newquery->have_posts()) {
                $newquery->the_post(); ?>
                <div class="col-lg-4 p-0 col-12 mx-sm-auto block-item">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="image">
                    <div class="bottom-section">
                        <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
                    </div>
                </div>
            <?php }
            wp_reset_query();
            ?>
        </div>
    </div>
</section>

<section class="comments__block">
    <h3 class="section__title"><?php the_field('title_comments', 'options') ?></h3>
    <div class="container container-block">
        <div class="slider-comments">
            <?php
            if (have_rows('comments_repeater', 'options')):
                while (have_rows('comments_repeater', 'options')) : the_row(); ?>
                    <div>
                        <div class="slide-item">
                            <?php the_sub_field('comment_text', 'options'); ?></div>
                        <span class="slide-item-author"><?php the_sub_field('comment_author', 'options'); ?></span>

                    </div>
                <?php endwhile;
            endif; ?>
        </div>
    </div>
</section>

<section class="news__block">
    <h3 class="section__title"><?php the_field('title_news', 'options') ?></h3>
    <div class="container container-block">
        <div class=" row d-flex m-0 justify-content-between p-0 ">
            <?php
            $args = array(
                'post_type' => 'post',
                'category_name' => 'blog',
                'posts_per_page' => 3,
                'order' => 'ASC',
                'orderby' => 'date'
            );
            $query = new WP_Query($args);
            while ($query->have_posts()) {
                $query->the_post(); ?>
                <div class="col-lg-4 col-md-6 col-12 mx-sm-auto post__item">
                    <div class="item-img">
                        <img src="<?php the_post_thumbnail_url('homepage-image'); ?>" alt="post-image">
                        <div class="post-date">
                            <?php echo get_the_date('M'); ?> <br/>
                            <span class="post-date-year"> <?php echo get_the_date('y'); ?></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4> <?php the_title(); ?></h4>
                        <?php the_content( 'Read More', TRUE ); ?>
                        <hr/>
                        <div class="author-post">
                            <?php
                            $my_post = get_post($id);
                            $author_id = $my_post->post_author; ?>
                            By <?php echo get_the_author_meta('first_name', $author_id); ?>
                        </div>
                    </div>
                </div>
            <?php }
            wp_reset_query();
            ?>
        </div>
    </div>
    <a class="section__button"
       href="<?php the_field('button_link_news', 'options'); ?>"><?php the_field('button_text_news', 'options'); ?></a>

</section>

<?php get_footer(); ?>
