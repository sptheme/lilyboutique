<?php
/**
 * Template Name: Home
 */

get_header(); ?>

<?php do_action( 'sp_start_content_wrap_html' ); ?>
    
    <?php 

        $home_meta = get_post_meta( $post->ID );
        
        $args = array(
            'post_type' => 'home_slider', 
            'posts_per_page' => $home_meta['sp_slide_num'][0],
            'post_status' => 'publish'
        );
        $custom_query = new WP_Query( $args );
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($){
        $("#featured-slideshow").flexslider({
            animation: "fade",
            directionNav: false,
            pauseOnHover: true
        });
    });     
    </script>
    <section id="featured-slideshow" class="flexslider">
        <ul class="slides">
    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>    
        <li>
        <?php 
        $thumb = wp_get_attachment_url(get_post_thumbnail_id(), 'large');
        $image_url = aq_resize( $thumb, 960, 450, true );

        $slide_link = (get_post_meta( $post->ID, 'sp_slide_btn_url', true ) == '') ? '#' : get_post_meta( $post->ID, 'sp_slide_btn_url', true );
        ?>
            <img src="<?php echo $image_url; ?>">
            <figcaption class="flex-caption">
                <?php the_content(); ?>
                <a class="btn" href="<?php echo $slide_link; ?>">
                    <?php echo get_post_meta( $post->ID, 'sp_slide_btn_name', true ); ?>
                </a>
            </figcaption>
        </li>
    <?php endwhile; wp_reset_postdata(); ?>    
        </ul>
    </section> <!-- #featured-slideshow -->

    <section id="welcome-msg">
        <p><?php echo $home_meta['sp_welcome_msg'][0]; ?></p>
    </section> <!-- #welcome-msg -->

    <section id="facilities">
        <?php echo sp_post_type_highlight('facility', $home_meta['sp_facility_num'][0]); ?>
    </section> <!-- #facilities -->

    <section id="testimonial">
        <p><img src="<?php echo SP_ASSETS_THEME ?>images/quote.png"  alt=""/></p>
        <?php
            $args = array(
                'post_type' => 'testimonial', 
                'posts_per_page' => 1,
                'post_status' => 'publish'
            );
            $custom_query = new WP_Query( $args );
        ?>
        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
        <?php the_content(); ?>
        <h4><?php the_title(); ?></h4>
        <span><?php echo get_post_meta( $post->ID, 'sp_testimonial_cite_subtext', true ); ?></span>
        <span><?php echo get_post_meta( $post->ID, 'sp_testimonial_cite', true ); ?>, <?php the_date(); ?></span>
        <?php endwhile; wp_reset_postdata(); ?>   
        
        <a class="learn-more" href="<?php echo get_the_permalink($home_meta['sp_testimonial_page_id'][0]); ?>"><?php echo $home_meta['sp_more_guest_txt'][0]; ?></a>
    </section><!--.testimonial-->

<?php do_action( 'sp_end_content_wrap_html' ); ?>
<?php get_footer(); ?>