<?php

/*  Initialize the meta boxes.
/* ------------------------------------ */
add_action( 'admin_init', '_custom_meta_boxes' );

function _custom_meta_boxes() {

	$prefix = 'sp_';
  
/*  Custom meta boxes
/* ------------------------------------ */
$post_options = array(
	'id'          => 'page-options',
	'title'       => 'Page Options',
	'desc'        => '',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'default',
	'fields'      => array(
		array(
			'label'		=> 'Primary Sidebar',
			'id'		=> $prefix . 'sidebar_primary',
			'type'		=> 'sidebar-select',
			'desc'		=> 'Overrides default'
		),
		array(
			'label'		=> 'Layout',
			'id'		=> $prefix . 'layout',
			'type'		=> 'radio-image',
			'desc'		=> 'Overrides the default layout option',
			'std'		=> 'inherit',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Layout',
					'src'		=> SP_ASSETS_ADMIN . 'images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> SP_ASSETS_ADMIN . 'images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> SP_ASSETS_ADMIN . 'images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> SP_ASSETS_ADMIN . 'images/col-2cr.png'
				)
			)
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Gallery post type
/* ---------------------------------------------------------------------- */
$post_type_gallery = array(
	'id'          => 'gallery-setting',
	'title'       => 'Upload Photos',
	'desc'        => 'These settings enable you to upload photos and present all photos as slideshow.',
	'pages'       => array( 'gallery' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Upload photo',
			'id'		=> $prefix . 'gallery',
			'type'		=> 'gallery',
			'desc'		=> 'Upload photos'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: video
/* ---------------------------------------------------------------------- */
$post_format_video = array(
	'id'          => 'format-video',
	'title'       => 'Format: Video',
	'desc'        => 'These settings enable you to embed videos into your posts.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Video URL',
			'id'		=> $prefix . 'video_url',
			'type'		=> 'text',
			'desc'		=> 'Recommended to use.'
		),
		array(
			'label'		=> 'Video Embed Code',
			'id'		=> $prefix . 'video_embed_code',
			'type'		=> 'textarea',
			'rows'		=> '2'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Audio
/* ---------------------------------------------------------------------- */
$post_format_audio = array(
	'id'          => 'format-audio',
	'title'       => 'Format: Audio',
	'desc'        => 'These settings enable you to embed audio into your posts. You must provide both .mp3 and .ogg/.oga file formats in order for self hosted audio to function accross all browsers.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'MP3 File URL',
			'id'		=> $prefix . 'audio_mp3_url',
			'type'		=> 'upload',
			'desc'		=> 'The URL to the .mp3 or .m4a audio file'
		),
		array(
			'label'		=> 'OGA File URL',
			'id'		=> $prefix . 'audio_ogg_url',
			'type'		=> 'upload',
			'desc'		=> 'The URL to the .oga, .ogg audio file'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Gallery
/* ---------------------------------------------------------------------- */
$post_format_gallery = array(
	'id'          => 'format-gallery',
	'title'       => 'Background Slideshow',
	'desc'        => 'Standard post galleries.</i>',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'default',
	'fields'      => array(
		array(
			'label'		=> 'Upload photo',
			'id'		=> $prefix . 'post_gallery',
			'type'		=> 'gallery',
			'desc'		=> 'Upload photos'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Testimonial post type
/* ---------------------------------------------------------------------- */
$post_type_testimonial = array(
	'id'          => 'testimonial-setting',
	'title'       => 'Testimonial meta',
	'desc'        => '',
	'pages'       => array( 'testimonial' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Nationality',
			'id'		=> $prefix . 'testimonial_cite',
			'type'		=> 'text',
			'desc'		=> 'Enter the country name of the testimonial.'
		),
		array(
			'label'		=> 'Testimonial Cite Subtext',
			'id'		=> $prefix . 'testimonial_cite_subtext',
			'type'		=> 'text',
			'desc'		=> 'Enter living action of this guest (optional).'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Room post type
/* ---------------------------------------------------------------------- */
$post_type_room = array(
	'id'          => 'room-setting',
	'title'       => 'Room Info',
	'desc'        => '',
	'pages'       => array( 'room' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Price',
			'id'		=> $prefix . 'room_rate',
			'type'		=> 'text',
			'desc'		=> 'Price per day. Only value. e.g: 58'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Metabox for Page and Post Background
/* ---------------------------------------------------------------------- */
$page_bg_slideshow = array(
	'id'          => 'slide-settings',
	'title'       => 'Background Slideshow',
	'desc'        => '',
	'pages'       => array( 'page', 'facility', 'room' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Upload image',
			'id'		=> $prefix . 'home_slide',
			'type'		=> 'gallery',
			'desc'		=> 'Upload background images, max 5. and use min size 1024px by 768px'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Metabox for Contact template
/* ---------------------------------------------------------------------- */
$page_template_contact = array(
	'id'          => 'contact-settings',
	'title'       => 'contact settings',
	'desc'        => '',
	'pages'       => array( 'page' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Address',
			'id'		=> $prefix . 'address',
			'type'		=> 'text',
			'desc'		=> 'e.g: # A27-A28 , La Seine , Koh Pich, Phnom Penh, Cambodia',
			'std'		=> ''
		),
		array(
			'label'		=> 'Tel',
			'id'		=> $prefix . 'tel',
			'type'		=> 'text',
			'desc'		=> 'e.g: +855 23 982 656',
			'std'		=> ''
		),
		array(
			'label'		=> 'Phone',
			'id'		=> $prefix . 'phone',
			'type'		=> 'text',
			'desc'		=> 'e.g: +855 17 666 916',
			'std'		=> ''
		),
		array(
			'label'		=> 'Fax',
			'id'		=> $prefix . 'fax',
			'type'		=> 'text',
			'desc'		=> 'e.g: +855 23 982 655',
			'std'		=> ''
		),
		array(
			'label'		=> 'Email',
			'id'		=> $prefix . 'email',
			'type'		=> 'text',
			'desc'		=> 'e.g: info@shalyboutiquehotel.com',
			'std'		=> ''
		),
		array(
			'label'		=> 'Latitude and Longitude of a Point',
			'id'		=> $prefix . 'contact_map',
			'type'		=> 'text',
			'desc'		=> 'You can get latitude and longitude coordinates of a point from <a href="http://itouchmap.com/latlong.html" target="_blank">Itouchmap</a>',
			'std'		=> '11.555509,104.926082'
		)
	)
);

function sp_maybe_include() {
	// Include in back-end only
	if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN ) {
		return false;
	}

	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return true;
	}

	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	}
	elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}
	else {
		$post_id = false;
	}

	$post_id = (int) $post_id;
	$post    = get_post( $post_id );

	$template = get_post_meta( $post_id, '_wp_page_template', true );

	return $template;
}

/*  Register meta boxes
/* ------------------------------------ */
	ot_register_meta_box( $post_options );
	ot_register_meta_box( $post_format_audio );
	ot_register_meta_box( $post_format_gallery );
	ot_register_meta_box( $post_format_video );
	ot_register_meta_box( $post_type_gallery );
	ot_register_meta_box( $post_type_testimonial );
	ot_register_meta_box( $post_type_room );
	ot_register_meta_box( $page_bg_slideshow );

	$template_file = sp_maybe_include();
	if ( $template_file == 'template-contact.php' ) {
	    ot_register_meta_box( $page_template_contact );
	}
}