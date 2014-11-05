<?php


/* ---------------------------------------------------------------------- */
/*	Get images attached to post
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_post_images' ) ) {

	function sp_post_images( $args=array() ) {
		global $post;

		$defaults = array(
			'numberposts'		=> -1,
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order',
			'post_mime_type'	=> 'image',
			'post_parent'		=>  $post->ID,
			'post_type'			=> 'attachment',
		);

		$args = wp_parse_args( $args, $defaults );

		return get_posts( $args );
	}
	
}

/* ---------------------------------------------------------------------- */
/*	Get images attached info by attached id
/* ---------------------------------------------------------------------- */
function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

/* ---------------------------------------------------------------------- */
/*	Get thumbnail post
/* ---------------------------------------------------------------------- */
if( !function_exists('sp_post_thumbnail') ) {

	function sp_post_thumbnail( $size = 'thumbnail'){
			global $post;
			$thumb = '';

			//get the post thumbnail;
			$thumb_id = get_post_thumbnail_id($post->ID);
			$thumb_url = wp_get_attachment_image_src($thumb_id, $size);
			$thumb = $thumb_url[0];
			if ($thumb) return $thumb;
	}		

}

/* ---------------------------------------------------------------------- */
/*	Start content wrap
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_start_content_wrap') ) {

	add_action( 'sp_start_content_wrap_html', 'sp_start_content_wrap' );

	function sp_start_content_wrap() {
		echo '<section id="content" class="container clearfix">';
	}
	
}

/* ---------------------------------------------------------------------- */
/*	End content wrap
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_end_content_wrap') ) {

	add_action( 'sp_end_content_wrap_html', 'sp_end_content_wrap' );

	function sp_end_content_wrap() {
		echo '</section> <!-- #content .container .clearfix -->';
	}

}

/* ---------------------------------------------------------------------- */
/*	Thumnail for social share
/* ---------------------------------------------------------------------- */

if ( !function_exists('sp_facebook_thumb') ) {

	function sp_facebook_thumb() {
		if ( is_singular( 'sp_work' ) ) {
			global $post;

			$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
			echo '<meta property="og:image" content="' . esc_attr($thumbnail_src[0]) . '" />';
		}
	}

	add_action('wp_head', 'sp_facebook_thumb');
}


/* ---------------------------------------------------------------------- */               							
/*  Retrieve the terms list and return array
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_terms_list') ) {

	function sp_get_terms_list($taxonomy){
		$args = array(
				'hide_empty'	=> 0
			);
		$taxonomies = get_terms($taxonomy, $args);
		return $taxonomies;
	}

}


/* ---------------------------------------------------------------------- */               							
/*  Get related post by Taxonomy
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_posts_related_by_taxonomy') ) {

	function sp_get_posts_related_by_taxonomy($post_id, $taxonomy, $args=array()) {

		//$query = new WP_Query();
		$terms = wp_get_object_terms($post_id, $taxonomy);
		if (count($terms)) {
		
		// Assumes only one term for per post in this taxonomy
		$post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
		$post = get_post($post_id);
		$args = wp_parse_args($args,array(
		  'post_type' => $post->post_type, // The assumes the post types match
		  //'post__in' => $post_ids,
		  'post__not_in' => array($post_id),
		  'tax_query' => array(
		  			array(
						'taxonomy' => $taxonomy,
						'field' => 'term_id',
		  				'terms' => $terms[0]->term_id
					)),
		  'orderby' => 'rand',
		  'posts_per_page' => -1
		  
		));
		$query = new WP_Query($args);
		}
		return $query;
	}

}

/* ---------------------------------------------------------------------- */
/*	Displays a page pagination
/* ---------------------------------------------------------------------- */

if ( !function_exists('sp_pagination') ) {

	function sp_pagination( $pages = '', $range = 2 ) {

		$showitems = ( $range * 2 ) + 1;

		global $paged, $wp_query;

		if( empty( $paged ) )
			$paged = 1;

		if( $pages == '' ) {

			$pages = $wp_query->max_num_pages;

			if( !$pages )
				$pages = 1;

		}

		if( 1 != $pages ) {

			$output = '<nav class="pagination">';

			// if( $paged > 2 && $paged >= $range + 1 /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( 1 ) . '" class="next">&laquo; ' . __('First', 'sptheme_admin') . '</a>';

			if( $paged > 1 /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged - 1 ) . '" class="next">&larr; ' . __('Previous', SP_TEXT_DOMAIN) . '</a>';

			for ( $i = 1; $i <= $pages; $i++ )  {

				if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ) )
					$output .= ( $paged == $i ) ? '<span class="current">' . $i . '</span>' : '<a href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';

			}

			if ( $paged < $pages /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged + 1 ) . '" class="prev">' . __('Next', SP_TEXT_DOMAIN) . ' &rarr;</a>';

			// if ( $paged < $pages - 1 && $paged + $range - 1 <= $pages /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( $pages ) . '" class="prev">' . __('Last', 'sptheme_admin') . ' &raquo;</a>';

			$output .= '</nav>';

			return $output;

		}

	}

}

/* ---------------------------------------------------------------------- */
/*	Comment Template
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_comment_template' ) ) {

	function sp_comment_template( $comment, $args, $depth ) {
		global $retina;
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>

		<li id="comment-<?php comment_ID(); ?>" class="comment clearfix">

			<?php $av_size = isset($retina) && $retina === 'true' ? 96 : 48; ?>
			
			<div class="user"><?php echo get_avatar( $comment, $av_size, $default=''); ?></div>

			<div class="message">
				
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 3 ) ) ); ?>

				<div class="info">
					<h4><?php echo (get_comment_author_url() != '' ? comment_author_link() : comment_author()); ?></h4>
					<span class="meta"><?php echo comment_date('F jS, Y \a\t g:i A'); ?></span>
				</div>

				<?php comment_text(); ?>
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="await"><?php _e( 'Your comment is awaiting moderation.', 'goodwork' ); ?></em>
				<?php endif; ?>

			</div>

		</li>

		<?php
			break;
			case 'pingback'  :
			case 'trackback' :
		?>
		
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'goodwork' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'goodwork'), ' ' ); ?></p></li>
		<?php
				break;
		endswitch;
	}
	
}

/* ---------------------------------------------------------------------- */
/*	Ajaxify Comments
/* ---------------------------------------------------------------------- */

add_action('comment_post', 'ajaxify_comments',20, 2);
function ajaxify_comments($comment_ID, $comment_status){
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	//If AJAX Request Then
		switch($comment_status){
			case '0':
				//notify moderator of unapproved comment
				wp_notify_moderator($comment_ID);
			case '1': //Approved comment
				echo "success";
				$commentdata=&get_comment($comment_ID, ARRAY_A);
				$post=&get_post($commentdata['comment_post_ID']); 
				wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
			break;
			default:
				echo "error";
		}
		exit;
	}
}

/* ---------------------------------------------------------------------- */
/*	Embeded add video from youtube, vimeo and dailymotion
/* ---------------------------------------------------------------------- */
function sp_get_video_img($url) {
	
	$video_url = @parse_url($url);
	$output = '';

	if ( $video_url['host'] == 'www.youtube.com' || $video_url['host']  == 'youtube.com' ) {
		parse_str( @parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video_id =  $my_array_of_vars['v'] ;
		$output .= 'http://img.youtube.com/vi/'.$video_id.'/0.jpg';
	}elseif( $video_url['host'] == 'www.youtu.be' || $video_url['host']  == 'youtu.be' ){
		$video_id = substr(@parse_url($url, PHP_URL_PATH), 1);
		$output .= 'http://img.youtube.com/vi/'.$video_id.'/0.jpg';
	}
	elseif( $video_url['host'] == 'www.vimeo.com' || $video_url['host']  == 'vimeo.com' ){
		$video_id = (int) substr(@parse_url($url, PHP_URL_PATH), 1);
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
		$output .=$hash[0]['thumbnail_large'];
	}
	elseif( $video_url['host'] == 'www.dailymotion.com' || $video_url['host']  == 'dailymotion.com' ){
		$video = substr(@parse_url($url, PHP_URL_PATH), 7);
		$video_id = strtok($video, '_');
		$output .='http://www.dailymotion.com/thumbnail/video/'.$video_id;
	}

	return $output;
	
}

/* ---------------------------------------------------------------------- */
/*	Embeded add video from youtube, vimeo and dailymotion
/* ---------------------------------------------------------------------- */
function sp_add_video ($url, $width = 620, $height = 349) {

	$video_url = @parse_url($url);
	$output = '';

	if ( $video_url['host'] == 'www.youtube.com' || $video_url['host']  == 'youtube.com' ) {
		parse_str( @parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video =  $my_array_of_vars['v'] ;
		$output .='<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	}
	elseif( $video_url['host'] == 'www.youtu.be' || $video_url['host']  == 'youtu.be' ){
		$video = substr(@parse_url($url, PHP_URL_PATH), 1);
		$output .='<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	}
	elseif( $video_url['host'] == 'www.vimeo.com' || $video_url['host']  == 'vimeo.com' ){
		$video = (int) substr(@parse_url($url, PHP_URL_PATH), 1);
		$output .='<iframe src="http://player.vimeo.com/video/'.$video.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	}
	elseif( $video_url['host'] == 'www.dailymotion.com' || $video_url['host']  == 'dailymotion.com' ){
		$video = substr(@parse_url($url, PHP_URL_PATH), 7);
		$video_id = strtok($video, '_');
		$output .='<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="http://www.dailymotion.com/embed/video/'.$video_id.'"></iframe>';
	}

	return $output;
}

/* ---------------------------------------------------------------------- */
/*	Embeded soundcloud
/* ---------------------------------------------------------------------- */

function sp_soundcloud($url , $autoplay = 'false' ) {
	return '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.$url.'&amp;auto_play='.$autoplay.'&amp;show_artwork=true"></iframe>';
}

function sp_portfolio_grid( $col = 'list', $posts_per_page = 5 ) {
	
	$temp ='';
	$output = '';
	
	$args = array(
			'posts_per_page' => (int) $posts_per_page,
			'post_type' => 'portfolio',
			);
			
	$post_list = new WP_Query($args);
		
	ob_start();
	if ($post_list && $post_list->have_posts()) {
		
		$output .= '<ul class="portfolio ' . $col . '">';
		
		while ($post_list->have_posts()) : $post_list->the_post();
		
		$output .= '<li>';
		$output .= '<div class="two-fourth"><div class="post-thumbnail">';
		$output .= '<a href="'.get_permalink().'"><img src="' . sp_post_thumbnail('portfolio-2col') . '" /></a>';
		$output .= '</div></div>';
		
		$output .= '<div class="two-fourth last">';
		$output .= '<a href="'.get_permalink().'" class="port-'. $col .'-title">' . get_the_title() .'</a>';
		$output .= '</div>';	
		
		$output .= '</li>';	
		endwhile;
		
		$output .= '</ul>';
		
	}
	$temp = ob_get_clean();
	$output .= $temp;
	
	wp_reset_postdata();
	
	return $output;
	
}

/* ---------------------------------------------------------------------- */
/*	Get latest gallery/album
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_get_album_gallery' ) ) {
	function sp_get_album_gallery( $album_id = '', $photo_num = 10, $size = 'thumbnail' ) {

		global $post;

		$gallery = explode( ',', get_post_meta( $album_id, 'sp_gallery', true ) );
		$out = '<div class="gallery thumb-container clearfix">';
		
		if ( $gallery[0] != '' ) :
			foreach ( $gallery as $image ) :
			
			$thumb = wp_get_attachment_url($image, 'large');
            $image_url = aq_resize( $thumb, 300, 220, true );

			$out .= '<article class="one-third">';
			$out .= '<div class="thumb-icon">';
			$out .= '<img class="attachment-medium wp-post-image" src="' . $image_url . '">';
			$out .= '<div class="bg-mask">';
            $out .= '<a href="' . $thumb . '" class="icon icon-search-1"></a>';
            $out .= '</div>';
			$out .= '</div>';
			$out .= '</article><!-- .one-third -->';
			endforeach; 
		else : 
			$out .= __( 'Sorry there is no image for this album.', SP_TEXT_DOMAIN );
		endif;
		$out .= '</div>';

		return $out;
	}
}

/* ---------------------------------------------------------------------- */
/*	Get Cover of Album
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_get_cover_album' ) ) {
	function sp_get_cover_album( $photo_num = 10, $size = 'thumbnail' ) {

		global $post;

		$args = array(
			'post_type' 		=>	'gallery',
			'posts_per_page'	=>	$photo_num,
		);

		$custom_query = new WP_Query( $args );

		if( $custom_query->have_posts() ) :
			$out = '<div class="thumb-container clearfix">';
			while ( $custom_query->have_posts() ) : $custom_query->the_post();
				
				$thumb = wp_get_attachment_url(get_post_thumbnail_id(), 'large');
	            $image_url = aq_resize( $thumb, 480, 240, true );

				$out .= '<article class="one-third">';
				$out .= '<div class="thumb-icon">';
				$out .= '<img class="attachment-medium wp-post-image" src="' . $image_url . '">';
				$out .= '<div class="bg-mask">';
	            $out .= '<a href="' . get_the_permalink() . '" class="icon icon-search-1"></a>';
	            $out .= '</div>';
	            $out .= '</div>';
	            $out .= '<h5><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h5>';
	            $out .= '</article><!-- .one-third -->';

			endwhile; wp_reset_postdata();
			$out .= '</div><!-- .album-cover -->';
		endif;

		return $out;
	}
}

/* ---------------------------------------------------------------------- */
/*	Display sliders
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_sliders' ) ) {
	function sp_sliders( $slide_sytle = 1, $slide_id, $size = 'thumbnail' ){
		
		$sliders = explode( ',', get_post_meta( $slide_id, 'sp_gallery', true ) );
		$out = '';
		if ( $slide_sytle == 1 ) {
			$out .='<script type="text/javascript">
					jQuery(document).ready(function($){
						$(".post-slider").flexslider({
							animation: "slide",
							pauseOnHover: true,
							smoothHeight: "true",
							before: function(slider) {
							    $(".flex-caption").delay(100).fadeOut(100);
							},
							after: function(slider) {
							  $(".flex-active-slide").find(".flex-caption").delay(200).fadeIn(400);
							}
						});
					});		
					</script>';
		} else {
			$out .='<script type="text/javascript">
					jQuery(document).ready(function($){
						$(".post-slider-thumb").flexslider({
							animation: "slide",
							controlNav: false,
							itemWidth: 120,
							itemMargin: 20,
							asNavFor: ".post-slider"
						});

						$(".post-slider").flexslider({
							animation: "slide",
							pauseOnHover: true,
							controlNav: false,
							sync: ".post-slider-thumb"
						});
					});		
					</script>';
		}	

		$out .= '<div class="post-slider flexslider">';
		$out .= '<ul class="slides">';

		foreach ( $sliders as $image ){
			
			$image_data = wp_get_attachment( $image );
			$thumb = wp_get_attachment_url( $image, 'large' );
			$image_url = aq_resize( $thumb, 960, 450, true );

			$out .= '<li>';
			$out .= '<img src="' . $image_url . '" alt="' . $image_data['caption'] . '">';
			if ( $image_data['caption'] ):
				$out .= '<p class="flex-caption">' . $image_data['caption'] . '</p>';
			endif; 
			$out .= '</li>';
		
		}

		$out .= '</ul>';
		$out .= '</div>';
		
		if ( $slide_sytle == 2 ) {
			$out .= '<div class="post-slider-thumb flexslider">';
			$out .= '<ul class="slides">';
			
			foreach ( $sliders as $thumb ){
				
				$thumb_url = wp_get_attachment_url($thumb, 'medium');

				$out .= '<li>';
				$out .= '<img src="' . $thumb_url . '">';
				$out .= '</li>';
			
			}

			$out .= '</ul>';
			$out .= '</div>';
		}

		return $out;	
	}
}

/* ---------------------------------------------------------------------- */
/*	Insert post type highlight
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_post_type_highlight' ) ) {
	function sp_post_type_highlight( $post_type, $post_cols = 'one_third', $numberposts = '10', $excerpt = true ){

		$args = array(
            'post_type' => $post_type, 
            'posts_per_page' => $numberposts,
            'post_status' => 'publish'
        );

        $custom_query = new WP_Query( $args );

        $out = '<div class="thumb-container clearfix">';
        
        while ( $custom_query->have_posts() ) : $custom_query->the_post();
            $thumb = wp_get_attachment_url(get_post_thumbnail_id(), 'large');
            $image_url = aq_resize( $thumb, 450, 330, true );
        	$out .= '<article class="'. $post_cols .'">';    
            $out .= '<div class="thumb-icon">';
            if ( has_post_thumbnail() ) :
                $out .= '<img class="attachment-medium wp-post-image" src="' . $image_url . '"/>'; 
            else : 
                $out .= '<img class="attachment-medium wp-post-image" src="' . SP_ASSETS_THEME .'images/placeholder/thumbnail-300x225.gif">';   
            endif;
            $out .= '<div class="bg-mask">';
            $out .= '<a href="' . get_the_permalink() . '" class="icon icon-search-1"></a>';
            $out .= '</div>';
            $out .= '</div>';
            $out .= '<h5><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h5>';
            if ( $excerpt )
           		$out .= '<p>' . get_the_excerpt() . '</p>';	
           	$out .= '</article>';
        endwhile;
        wp_reset_postdata(); 
        
        $out .= '</div>';

        return $out;
	}
}
/* ---------------------------------------------------------------------- */
/*	Testimonial
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_get_testimonial' ) ) {
	function sp_get_testimonial( $style = 'light', $numberposts = '10' ){
		global $post;

		$out = '';
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => 'testimonial',
			'post_status' => 'publish',
			'posts_per_page' => $numberposts,
			'paged' => $paged
			);
		$custom_query = new WP_Query( $args );

		while ( $custom_query->have_posts() ) : $custom_query->the_post();

			$testimonial_text = get_the_content();
        	$testimonial_cite = get_post_meta($post->ID, 'sp_testimonial_cite', true);
        	$testimonial_cite_subtext = get_post_meta($post->ID, 'sp_testimonial_cite_subtext', true);

        	$out .= '<figure class="testimonial ' . $style . '">';
			$out .= '<blockquote>';
			$out .= $testimonial_text;
			$out .= '</blockquote>';
			$out .= '<figcaption>';
			$out .= '<p>' . get_the_title() . '</p>';
			$out .= '<span>' . $testimonial_cite_subtext . '</span>';
			$out .= '<span>' . $testimonial_cite . ', ' . get_the_date() . '</span>';
			$out .= '</figcaption>';
			$out .= '</figure>';
		
		endwhile;
		wp_reset_postdata();
		// Pagination
        if(function_exists('wp_pagenavi'))
            $out .= wp_pagenavi();
        else 
            $out .= sp_pagination($custom_query->max_num_pages);

		return $out;	
	}
}

/* ---------------------------------------------------------------------- */
/*	Render all amenities
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_html_amenities' ) ) {
	function sp_html_amenities() {
		$out = '';
		$out .= '<ul class="amenities">';
        $out .= '<li class="livingroom">' . __('Family room', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="wifi">' . __('Wifi', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="tv">' . __('LED TV', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="fridge">' . __('Mini fridge', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="air-conditioner">' . __('Air Conditioner', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="safe-deposit">' . __('Safety deposit boxes', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="bathroom">' . __('Bathroom', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="brackfast">' . __('Breakfast', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="laundry">' . __('Laundry service', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="parking">' . __('Car Parking', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="smoking">' . __('Smoking', SP_TEXT_DOMAIN) . '</li>';
        $out .= '<li class="skybar">' . __('Skybar', SP_TEXT_DOMAIN) . '</li>';
        $out .= '</ul>';

        return $out;
	}	
}

/* ---------------------------------------------------------------------- */
/*	Get post type as sub navigation
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_post_type_sub_nav' ) ) {
	function sp_post_type_sub_nav( $post_type ) {

		global $post;
		
		$current_post = $post->ID;
		$out = '';

		$args = array(
				'post_type'		=>	$post_type,
				'order'			=> 	'ASC',
				'orderby'		=> 	'menu_order',
				'post_status'	=>	'publish'
			);
		$custom_query = new WP_Query( $args );
		if( $custom_query->have_posts() ) :
		$out .= '<ul class="sub-nav">';
			while ( $custom_query->have_posts() ) : $custom_query->the_post();
			if ( get_the_ID() == $current_post ) {
				$out .= '<li class="current_page_item">' . get_the_title() . '</li>'; 
			} else {
				$out .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>'; 
			}
			endwhile; wp_reset_postdata();
		$out .= '</ul>';	

		endif; 

		return $out;
	}
}

/* ---------------------------------------------------------------------- */
/*	Social icons - Widget
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_show_social_icons' ) ) {
	function sp_show_social_icons() {

		$social_icons = ot_get_option( 'social-links' );

		$out = '<section class="social-btn clearfix round">';
		$out .= '<ul>';
		
		foreach ($social_icons as $icons) {
			if ( $icons['social-icon'] == 'icon-facebook' )	
				$out .= '<li class="i-square icon-facebook-squared"><a href="#" target="_self"></a></li>';
			
			if ( $icons['social-icon'] == 'icon-twitter' )
				$out .= '<li class="i-square icon-twitter"><a href="#" target="_self"></a></li>';
			
			if ( $icons['social-icon'] == 'icon-gplus' )
				$out .= '<li class="i-square icon-gplus"><a href="#" target="_self"></a></li>';
			
			if ( $icons['social-icon'] == 'icon-youtube' )	
				$out .= '<li class="i-square icon-youtube"><a href="#" target="_self"></a></li>';
		}

		$out .= '</ul>';
		$out .= '</section>';

		return $out;

	}
}

