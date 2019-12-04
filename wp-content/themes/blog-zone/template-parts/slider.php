<?php
/**
 * Template part for slider
 *
 * @package Education_Care
 */
// Slider status.
$slider_status = blog_zone_options('slider_status');
if (1 != $slider_status) {
    return;
}

$slider_status = blog_zone_options('slider_status');
$slider_type = blog_zone_options('slider_type');
$hide_slider_date = blog_zone_options('hide_slider_date');
$hide_slider_cat = blog_zone_options('hide_slider_cat');
$slider_transition_effect = blog_zone_options('slider_transition_effect');
$slider_transition_delay = blog_zone_options('slider_transition_delay');
$slider_transition_duration = blog_zone_options('slider_transition_duration');
$slider_arrow_status = blog_zone_options('slider_arrow_status');
$slider_autoplay_status = blog_zone_options('slider_autoplay_status');
$slider_overlay_status = blog_zone_options('slider_overlay_status');

$featured_post_type = blog_zone_options('featured_post_type');
$hide_featured_post_date = blog_zone_options('hide_featured_post_date');
$hide_featured_post_cat = blog_zone_options('hide_featured_post_cat');

if (true === $slider_overlay_status) {

    $overlay_class = 'gradient-overlay';
} else {

    $overlay_class = '';
}
?>
<section class="main-blog-section">

    <div class="container">

        <div class="main-blog-left">

            <?php
            $slick_args = array(
                'dots' => false,
                'slidesToShow' => 1,
                'slidesToScroll' => 1,
            );

            if (1 === absint($slider_autoplay_status)) {
                $slick_args['autoplay'] = true;
                $slick_args['autoplaySpeed'] = 1000 * absint($slider_transition_delay);
            }

            if (1 === absint($slider_arrow_status)) {
                $slick_args['arrows'] = true;
            } else {
                $slick_args['arrows'] = false;
            }

            if ('fade' === $slider_transition_effect) {
                $slick_args['fade'] = true;
            } else {
                $slick_args['fade'] = false;
            }

            if ('scrollVertz' === $slider_transition_effect) {
                $slick_args['vertical'] = true;
            } else {
                $slick_args['vertical'] = false;
            }

            $slick_args_encoded = wp_json_encode($slick_args);
            ?>

            <div class="main-blog-slider" data-slick='<?php echo $slick_args_encoded; ?>'>

                <?php
                if ('pages' == $slider_type) {

                    $slider_number = 5;

                    $page_ids = array();

                    for ($i = 1; $i <= $slider_number; $i++) {
                        $page_id = blog_zone_options("slide_$i");
                        if (absint($page_id) > 0) {
                            $page_ids[] = absint($page_id);
                        }
                    }

                    if (empty($page_ids)) {
                        return $output;
                    }

                    $slider_args = array(
                        'posts_per_page' => count($page_ids),
                        'orderby' => 'post__in',
                        'post_type' => 'page',
                        'post__in' => $page_ids,
                        'meta_query' => array(
                            array('key' => '_thumbnail_id'),
                        ),
                    );
                } elseif ('category_posts' == $slider_type) {

                    $slider_cat = blog_zone_options("slider_category");

                    $slider_args = array(
                        'posts_per_page' => 10,
                        'cat' => absint($slider_cat),
                        'post_type' => 'post',
                        'meta_query' => array(
                            array('key' => '_thumbnail_id'),
                        ),
                    );
                }

                $slider_query = new WP_Query($slider_args);

                if ($slider_query->have_posts()) {
                    $count = 1;
                    while ($slider_query->have_posts()) {

                        $slider_query->the_post();

                        if (has_post_thumbnail(get_the_ID())) {
                            ?>

                            <div class="item">

                                <article class="bigger-post">

                                    <figure class="post-image <?php echo $overlay_class; ?>">
                                        <?php the_post_thumbnail('blog-zone-slider'); ?>
                                    </figure><!-- .post-image -->

                                    <div class="post-content">

                                        <?php if (1 !== absint($hide_slider_date)) { ?>

                                            <span class="posted-date"><?php echo esc_html(get_the_date()); ?><?php
                                                if (1 !== absint($hide_slider_cat) && ( 'post' === get_post_type() )) {
                                                    echo esc_html__(' - ', 'blog-zone');
                                                }
                                                ?></span>
                                            <?php
                                        }

                                        if (1 !== absint($hide_slider_cat) && ( 'post' === get_post_type() )) {

                                            /* translators: used between list items, there is a space after the comma */
                                            $categories_list = get_the_category_list(esc_html__(', ', 'blog-zone'));

                                            if ($categories_list) {
                                                printf('<span class="cat-links">%s</span>', $categories_list); // WPCS: XSS OK.
                                            }
                                        }
                                        
                                        $tag = ($count == 1)?'h1':'h2';
                                        ?>

                                        <<?php echo $tag;?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></<?php echo $tag;?>>

                                    </div><!-- .post-content -->

                                </article> 

                            </div> <!-- .item -->

                            <?php
                        }
                        $count++;
                    }

                    wp_reset_postdata();
                }
                ?>

            </div> <!-- .main-blog-slider -->

        </div><!-- .main-blog-left -->   

        <div class="main-blog-right">
            <?php
            if ('pages' == $featured_post_type) {

                $post_number = 2;

                $page_ids = array();

                for ($i = 1; $i <= $post_number; $i++) {
                    $page_id = blog_zone_options("featured_post_$i");
                    if (absint($page_id) > 0) {
                        $page_ids[] = absint($page_id);
                    }
                }

                if (empty($page_ids)) {
                    return $output;
                }

                $post_args = array(
                    'posts_per_page' => count($page_ids),
                    'orderby' => 'post__in',
                    'post_type' => 'page',
                    'post__in' => $page_ids,
                    'meta_query' => array(
                        array('key' => '_thumbnail_id'),
                    ),
                );
            } elseif ('category_posts' == $featured_post_type) {

                $post_cat = blog_zone_options("featured_post_category");

                $post_args = array(
                    'posts_per_page' => 2,
                    'cat' => absint($post_cat),
                    'post_type' => 'post',
                    'meta_query' => array(
                        array('key' => '_thumbnail_id'),
                    ),
                );
            }

            $post_query = new WP_Query($post_args);

            if ($post_query->have_posts()) {

                while ($post_query->have_posts()) {

                    $post_query->the_post();

                    if (has_post_thumbnail(get_the_ID())) {
                        ?>

                        <article class="smaller-post">

                            <figure class="post-image gradient-overlay">
            <?php the_post_thumbnail('blog-zone-custom'); ?>
                            </figure><!-- .post-image -->

                            <div class="post-content">
                                    <?php if (1 !== absint($hide_featured_post_date)) { ?>

                                    <span class="posted-date"><?php echo esc_html(get_the_date()); ?><?php
                                    if (1 !== absint($hide_featured_post_cat) && ( 'post' === get_post_type() )) {
                                        echo esc_html__(' - ', 'blog-zone');
                                    }
                                    ?></span>
                                    <?php
                                }

                                if (1 !== absint($hide_featured_post_cat) && ( 'post' === get_post_type() )) {

                                    /* translators: used between list items, there is a space after the comma */
                                    $cat_list = get_the_category_list(esc_html__(', ', 'blog-zone'));

                                    if ($cat_list) {
                                        printf('<span class="cat-links">%s</span>', $cat_list); // WPCS: XSS OK.
                                    }
                                }
                                ?>

                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </div><!-- .post-content -->

                        </article>

                        <?php
                    }
                }

                wp_reset_postdata();
            }
            ?>

        </div><!-- .main-blog-right -->

    </div><!-- .container -->

</section><!-- .main-blog-section -->