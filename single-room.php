<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<?php do_action( 'sp_start_content_wrap_html' ); ?>
    <div id="main" class="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php echo sp_post_type_sub_nav('room'); ?>

			<?php echo sp_sliders( 1, $post->ID, 'large' ); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="room-rate">
						<span>USD</span> <?php echo get_post_meta( $post->ID, 'sp_room_rate', true ); ?><span>/day</span>
					</div>
				</header>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php if(ot_get_option('agoda')) : ?>
						<a href="<?php echo ot_get_option('agoda'); ?>" class="button" target="_blank"><span class="icon-calendar"></span>Make reservation</a>
					<?php endif; ?>
					<!-- <a href="#booking-form" class="button" id="book"><span class="icon-calendar"></span>Make reservation</a> -->
					<script type="text/javascript">
						/*jQuery(document).ready(function(){
							$('#book').magnificPopup({
		                            type: 'inline',
		                            preloader: false,
		                            removalDelay: 500,
		                            mainClass: 'mfp-fade'
		                        });
						});*/
					</script>
				</div><!-- .entry-content -->
				<?php if ( ot_get_option('social_share') != 'off' ) { get_template_part('library/contents/social-share'); } ?>
			</article><!-- #post -->
		<?php endwhile;
		else : 
			get_template_part('library/contents/error404');
		endif; ?>
	</div><!-- #main -->
	<?php get_sidebar();?>
<?php do_action( 'sp_end_content_wrap_html' ); ?>

<div id="booking-form" class="mfp-hide white-popup-block">
    <?php $page = get_post(ot_get_option('reservation-page')); ?>
    <h3><?php echo $page->post_title; ?></h3>
    <?php $content = apply_filters('the_content', $page->post_content); 
    echo $content; ?>
</div>

<?php get_footer(); ?>