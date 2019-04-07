<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function understrap_remove_scripts()
{
    wp_dequeue_style('understrap-styles');
    wp_deregister_style('understrap-styles');

    wp_dequeue_script('understrap-scripts');
    wp_deregister_script('understrap-scripts');

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}

add_action('wp_enqueue_scripts', 'understrap_remove_scripts', 20);
add_action('wp_enqueue_scripts', 'jquery_script_method');
function jquery_script_method()
{
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//code.jquery.com/jquery-1.11.0.min.js', false, null, false);
    wp_enqueue_script('jquery');
}

function stormGuard_scripts()
{

    wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style('css-slick-css', get_template_directory_uri() . '/css/slick.css');
    wp_enqueue_style('fancybox-css', "//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css");
    wp_enqueue_script('jquery-migratejhj', '//code.jquery.com/jquery-migrate-1.2.1.min.js');
    wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
    wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js');
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js');
}

add_action('wp_enqueue_scripts', 'stormGuard_scripts');

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{

    // Get the theme data
    $the_theme = wp_get_theme();
    wp_enqueue_style('child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get('Version'));
    wp_enqueue_script('jquery');
    wp_enqueue_script('child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get('Version'), true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

function add_child_theme_textdomain()
{
    load_child_theme_textdomain('understrap-child', get_stylesheet_directory() . '/languages');
}

add_action('after_setup_theme', 'add_child_theme_textdomain');

if (function_exists('acf_add_options_page')) {
    acf_add_options_page('Theme Options');
}

function new_excerpt_more($excerpt)
{
    return str_replace('[...]', ' ', $excerpt);
}

add_filter('wp_trim_excerpt', 'new_excerpt_more');

function bannerLocation($atts, $content = null)
{
    ob_start(); ?>
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
    <?php $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('bannerLocationshortcd', 'bannerLocation');

function bannerLocationPage($atts, $content = null)
{
    ob_start(); ?>
    <section class="find-franchise banner__block">
        <div class="container container-block">
            <div class="d-flex justify-content-between">
                <div class="float-lg-left float-none">
                    <h3><?php the_field('title_become_a_franchise', 'options') ?></h3>
                    <p><?php the_field('text_become_a_franchise', 'options') ?></p>
                </div>
                <div class="float-lg-right float-none">
                    <a href="<?php the_field('button_link_become_a_franchise', 'options') ?>">
                        <?php the_field('button_text_become_a_franchise', 'options') ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('bannerLocationshortcdPage', 'bannerLocationPage');

function categoryServices($atts, $content = null)
{
    ob_start(); ?>
    <section class="get-started ">
        <div class="container container-block">
            <h3 class="section__title"><?php the_field('title_get_started', 'options') ?></h3>
            <span class="section__text"><?php the_field('text_get_started', 'options') ?></span>
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
    <?php $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('servicesShtcd', 'categoryServices');


add_filter('excerpt_more', function($more) {
    return ' ';
});

/**
 * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
 *
 * @param string/array $args Параметры.
 *
 * @return string HTML
 *
 * @ver 2.6.3
 */
function kama_excerpt( $args = '' ){
    global $post;

    if( is_string($args) )
        parse_str( $args, $args );

    $rg = (object) array_merge( array(
        'maxchar'   => 350,   // Макс. количество символов.
        'text'      => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
        // Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется все до <!--more--> вместе с HTML.
        'autop'     => true,  // Заменить переносы строк на <p> и <br> или нет?
        'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
        'more_text' => 'Читать дальше...', // Текст ссылки `Читать дальше`.
    ), $args );

    $rg = apply_filters( 'kama_excerpt_args', $rg );

    if( ! $rg->text )
        $rg->text = $post->post_excerpt ?: $post->post_content;

    $text = $rg->text;
    $text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text ); // убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
    $text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text ); // убираем шоткоды: [singlepic id=3]. Учитывает markdown
    $text = trim( $text );

    // <!--more-->
    if( strpos( $text, '<!--more-->') ){
        preg_match('/(.*)<!--more-->/s', $text, $mm );

        $text = trim( $mm[1] );

        $text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
    }
    // text, excerpt, content
    else {
        $text = trim( strip_tags($text, $rg->save_tags) );

        // Обрезаем
        if( mb_strlen($text) > $rg->maxchar ){
            $text = mb_substr( $text, 0, $rg->maxchar );
            $text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1 ...', $text ); // убираем последнее слово, оно 99% неполное
        }
    }

    // Сохраняем переносы строк. Упрощенный аналог wpautop()
    if( $rg->autop ){
        $text = preg_replace(
            array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
            array('',     '</p><p>',  '<br />', '</p>'),
            $text
        );
    }

    $text = apply_filters( 'kama_excerpt', $text, $rg );

    if( isset($text_append) )
        $text .= $text_append;

    return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
}

function servicesFun()
{
    ob_start();

    ?>
    <section class="services">
        <h3 class="section__title">View Our Other Services</h3>
        <div class="section__text">From home upgrades to storm restoration, Storm Guard offers
            a range of services to help you with your home.</div>
        <div class="container container-block">
            <div class="row m-0 p-0 ">
                <?php
                $currentID = get_the_ID();
                $args = array(
                    'post_type' => 'services',
                    'posts_per_page' => 6,
                    'order' => 'ASC',
                    'orderby' => 'date',

                    'post__not_in' => array($currentID),
                );
                $newquery = new WP_Query($args);
                while ($newquery->have_posts()) {
                    $newquery->the_post(); ?>
                    <div class="col-lg-4 col-md-6 col-12 services__item">
                        <img src="<?php the_field('logo_service') ?>" alt="image">
                        <a href="<?php the_permalink(); ?>">
                            <h4> <?php the_title(); ?></h4></a>
                        <span><?php echo kama_excerpt( ); ?></span>
                    </div>
                <?php }
                wp_reset_query();
                ?>
            </div>
        </div>
    </section>
    <?php $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('services', 'servicesFun');

function qt_custom_breadcrumbs()
{

    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = '>'; // delimiter between crumbs
    $home = 'Home'; // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<li><span class="current">'; // tag before the current crumb
    $after = '</span></li>'; // tag after the current crumb

    global $post;

    $homeLink = get_bloginfo('url');

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';

    } else {

        echo '<div id="crumbs">
            <ul itemscope itemtype="http://schema.org/BreadcrumbList">
            	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" itemprop="name" href="' . $homeLink . '"><span itemprop="name">' . $home . '</span><meta itemprop="position" content="1" /></a> </li>' . $delimiter . ' ';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
            echo $before . '' . single_cat_title('', false) . '' . $after;

        } elseif (is_search()) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;

        } elseif (is_day()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> </li>' . $delimiter . ' ';
            echo '<li> <a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;

        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;

        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;

        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
//                var_dump($post_type);
                $slug = $post_type->rewrite;
                echo '<li> <a href="' . $homeLink . '/' . $slug['slug'] . '">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter;
                echo $before . get_the_title() . $after;
//                echo $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name;
//                if ($showCurrent == 1) echo '<li>' . $delimiter . ' <li> ' . $before . get_the_title() . $after . '</li>';
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, false, ' ');
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                $link = get_category_link($cat);
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href=' . $link . '><span itemprop="name">' . $cats . '</span><meta itemprop="position" content="2" /></a></li>/';
                if ($showCurrent == 1) echo '' . $before . get_the_title() . $after;
            }

        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, '' . $delimiter . ' ');
            echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
            if ($showCurrent == 1) echo '' . $delimiter . ' ' . $before . get_the_title() . $after;

        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1) echo '' . $before . get_the_title() . $after;

        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs) - 1) echo '' . $delimiter . ' ';
            }
            if ($showCurrent == 1) echo '' . $delimiter . '' . $before . get_the_title() . $after;

        } elseif (is_tag()) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;

        } elseif (is_404()) {
            echo $before . 'Error 404' . $after;
        }

        if (get_query_var('paged')) {
//            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
//            echo __(' Page ') . ' ' . get_query_var('paged');
//            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
        }

        echo '</div>';

    }
}
add_image_size('gallery-image', 129, 129);
add_image_size('blog-image', 370, 197);
function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged)) $paged = 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class=\"pagination\">";
//<span>Page " . $paged . " of " . $pages . "</span>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link(1) . "'>&laquo; First</a>";
        if ($paged > 1) echo "<a href='" . get_pagenum_link($paged - 1) . "'> prev</a>";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a>";
            }
        }

        if ($paged < $pages - 1) {
            echo "<a href='" . get_pagenum_link($pages) . "'>...</a>";
        }
        if ($paged < $pages) echo "<a href=\"" . get_pagenum_link($paged + 1) . "\">next</a>";

        echo "</div>\n";
    }
}
