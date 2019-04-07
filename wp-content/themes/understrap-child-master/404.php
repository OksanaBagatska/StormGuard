<?php
get_header();
$container = get_theme_mod('understrap_container_type');

?>

    <div class="wrapper page-404" id="page-wrapper">
        <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">
            <div class="content-404">
                <p class="gradient">404</p>
                <p>Oops, We couldnt find that page, I’m sorry.</p>
                <div><a href="<?php echo home_url(); ?>"><i class="fa fa-long-arrow-left"></i>Go Home</a>
                </div>
            </div>
        </div>

    </div>
<?php
get_footer();
?>