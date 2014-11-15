<?php

/*  Initialize the options before anything else. 
/* ------------------------------------ */
add_action( 'admin_init', 'custom_theme_options', 1 );


/*  Build the custom settings & update OptionTree.
/* ------------------------------------ */
function custom_theme_options() {
	
	// Get a copy of the saved settings array.
	$saved_settings = get_option( 'option_tree_settings', array() );

	// Custom settings array that will eventually be passed to the OptionTree Settings API Class.
	$custom_settings = array(

/*  Help pages
/* ------------------------------------ */	
	'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'Documentation',
          'content'   => '
			<h1>Hueman</h1>
			<p>Thanks for using this theme! Enjoy.</p>
			<ul>
				<li>Read the theme documentation <a target="_blank" href="'.get_template_directory_uri().'/functions/documentation/documentation.html">here</a></li>
				<li>Download the sample child theme <a href="https://github.com/AlxMedia/hueman-child/archive/master.zip">here</a></li>
				<li>Download or contribute translations <a target="_blank" href="https://github.com/AlxMedia/hueman-languages">here</a></li>
				<li>Feel free to rate/review the theme <a target="_blank" href="http://wordpress.org/support/view/theme-reviews/hueman">here</a></li>
				<li>If you have theme questions, go <a target="_blank" href="http://wordpress.org/support/theme/hueman">here</a></li>
				<li>Hueman is on <a target="_blank" href="https://github.com/AlxMedia/hueman">GitHub</a></li>
			</ul>
			<hr />
			<p>You can support the theme author by donating <a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=K54RW72RZM2HN">here</a> – any amount is always appreciated.</p>
		'
        )
      )
    ),
	
/*  Admin panel sections
/* ------------------------------------ */	
	'sections'        => array(
		array(
			'id'		=> 'general',
			'title'		=> 'General'
		),
		array(
			'id'		=> 'background',
			'title'		=> 'Background'
		),
		array(
			'id'		=> 'contact',
			'title'		=> 'Contact'
		),
		array(
			'id'		=> 'layout',
			'title'		=> 'Layout'
		),
		array(
			'id'		=> 'sidebars',
			'title'		=> 'Sidebars'
		),
		array(
			'id'		=> 'social-links',
			'title'		=> 'Social Links'
		),
	),
	
/*  Theme options
/* ------------------------------------ */
	'settings'        => array(
		
		// General: Responsive Layout
		array(
			'id'		=> 'responsive',
			'label'		=> 'Responsive Layout',
			'desc'		=> 'Mobile and tablet optimizations [ <strong>responsive.css</strong> ]',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// Header: Custom Logo
		array(
			'id'		=> 'custom-logo',
			'label'		=> 'Custom Logo',
			'desc'		=> 'Upload your custom logo image. Set logo max-height in styling options.',
			'std'		=> SP_ASSETS_THEME . 'images/logo.png',
			'type'		=> 'upload',
			'section'	=> 'general'
		),
		// Header: Favicon
		array(
			'id'		=> 'custom-android-icon128',
			'label'		=> 'Add to homescreen for Chrome on Android',
			'desc'		=> 'Upload a 128px x 128px Png image',
			'std'		=> SP_ASSETS_THEME . 'images/touch/icon-128x128.png',
			'type'		=> 'upload',
			'section'	=> 'general'
		),
		array(
			'id'		=> 'custom-ios-title',
			'label'		=> 'Custom iOS Bookmark Title',
			'desc'		=> 'Enter a custom title for your site for when it is added as an iOS bookmark.',
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'general'
		),
		array(
			'id'		=> 'custom-ios-icon152',
			'label'		=> 'Add to homescreen for Safari on iOS',
			'desc'		=> 'Upload a 152px x 152px Png image',
			'std'		=> get_template_directory_uri() . '/apple-touch-icon-precomposed.png',
			'type'		=> 'upload',
			'section'	=> 'general'
		),
		array(
			'id'		=> 'custom-win8-tile-icon144',
			'label'		=> 'Tile icon for Win8',
			'desc'		=> 'Upload a 144px x 144px Png image',
			'std'		=> SP_ASSETS_THEME . 'images/touch/ms-touch-icon-144x144-precomposed.png',
			'type'		=> 'upload',
			'section'	=> 'general'
		),

		// Footer: Copyright
		array(
			'id'		=> 'copyright',
			'label'		=> 'Footer Copyright',
			'desc'		=> 'Replace the footer copyright text',
			'std'		=> 'WP Theme Testing © 2014. All Rights Reserved.',
			'type'		=> 'text',
			'section'	=> 'general'
		),
		// Contact:
		array(
			'id'		=> 'agoda',
			'label'		=> 'Agoda URL',
			'desc'		=> 'Enter Agoda page url',
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'contact'
		),
		array(
			'id'		=> 'tripadvisor',
			'label'		=> 'Trip Advisor URL',
			'desc'		=> 'Enter Tripadvisor page url',
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'contact'
		),
		array(
			'id'		=> 'facebook',
			'label'		=> 'Facebook URL',
			'desc'		=> 'Enter facebook page url',
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'contact'
		),
		array(
			'id'		=> 'address',
			'label'		=> 'Address',
			'desc'		=> '',
			'std'		=> '# A27-A28 , La Seine , Koh Pich, Pnom Penh, Cambodia',
			'type'		=> 'textarea-simple',
			'rows'      => '3',
			'section'	=> 'contact'
		),
		array(
			'id'		=> 'email',
			'label'		=> 'Email',
			'desc'		=> '',
			'std'		=> 'info@shalyboutiquehotel.com',
			'type'		=> 'text',
			'section'	=> 'contact'
		),
		array(
			'id'		=> 'tel',
			'label'		=> 'Telephone',
			'desc'		=> '+855 23 982 656',
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'contact'
		),
		array(
			'id'		=> 'phone',
			'label'		=> 'Mobile',
			'desc'		=> '+855 17 666 916',
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'contact'
		),
		array(
			'id'		=> 'fax',
			'label'		=> 'Fax number',
			'desc'		=> '+855 17 666 916',
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'contact'
		),
		array(
			'id'		=> 'fax',
			'label'		=> 'Fax',
			'desc'		=> '+855 23 982 655',
			'std'		=> '',
			'type'		=> 'text',
			'section'	=> 'contact'
		),
		array(
			'id'		=> 'reservation-page',
			'label'		=> 'Select reservation page',
			'desc'		=> 'Select page that have reservation shortcode',
			'std'		=> '',
			'type'		=> 'page-select',
			'section'	=> 'contact'
		),
		array(
			'id'		=> 'inquiry-page',
			'label'		=> 'Select Inquiry page',
			'desc'		=> 'Select page that have Inquiry shortcode',
			'std'		=> '',
			'type'		=> 'page-select',
			'section'	=> 'contact'
		),
		// Page: Background
		array(
			'id'		=> 'page-bg-slideshow',
			'label'		=> 'Background pages',
			'desc'		=> 'Upload background images, max 5. and use min size 1024px by 768px',
			'type'		=> 'gallery',
			'section'	=> 'background'
		),
		// Layout : Global
		array(
			'id'		=> 'layout-global',
			'label'		=> 'Global Layout',
			'desc'		=> 'Other layouts will override this option if they are set',
			'std'		=> 'col-1c',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
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
				/*array(
					'value'		=> 'col-3cm',
					'label'		=> '3 Column Middle',
					'src'		=> SP_ASSETS_ADMIN . 'images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> '3 Column Left',
					'src'		=> SP_ASSETS_ADMIN . 'images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> '3 Column Right',
					'src'		=> SP_ASSETS_ADMIN . 'images/col-3cr.png'
				)*/
			)
		),
		// Layout : Home
		array(
			'id'		=> 'layout-home',
			'label'		=> 'Home',
			'desc'		=> '[ <strong>is_home</strong> ] Posts homepage layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
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
		),
		// Layout : Single
		array(
			'id'		=> 'layout-single',
			'label'		=> 'Single',
			'desc'		=> '[ <strong>is_single</strong> ] Single post layout - If a post has a set layout, it will override this.',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
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
		),
		// Layout : Archive
		array(
			'id'		=> 'layout-archive',
			'label'		=> 'Archive',
			'desc'		=> '[ <strong>is_archive</strong> ] Category, date, tag and author archive layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
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
		),
		// Layout : Archive - Category
		array(
			'id'		=> 'layout-archive-category',
			'label'		=> 'Archive &mdash; Category',
			'desc'		=> '[ <strong>is_category</strong> ] Category archive layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
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
		),
		// Layout : Search
		array(
			'id'		=> 'layout-search',
			'label'		=> 'Search',
			'desc'		=> '[ <strong>is_search</strong> ] Search page layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
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
		),
		// Layout : Error 404
		array(
			'id'		=> 'layout-404',
			'label'		=> 'Error 404',
			'desc'		=> '[ <strong>is_404</strong> ] Error 404 page layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
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
		),
		// Layout : Default Page
		array(
			'id'		=> 'layout-page',
			'label'		=> 'Default Page',
			'desc'		=> '[ <strong>is_page</strong> ] Default page layout - If a page has a set layout, it will override this.',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
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
		),
		// Sidebars: Create Areas
		array(
			'id'		=> 'sidebar-areas',
			'label'		=> 'Create Sidebars',
			'desc'		=> 'You must save changes for the new areas to appear below. <br /><i>Warning: Make sure each area has a unique ID.</i>',
			'type'		=> 'list-item',
			'section'	=> 'sidebars',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'id',
					'label'		=> 'Sidebar ID',
					'desc'		=> 'This ID must be unique, for example "sidebar-about"',
					'std'		=> 'sidebar-',
					'type'		=> 'text',
					'choices'	=> array()
				)
			)
		),
		// Sidebar 1 & 2
		array(
			'id'		=> 's1-home',
			'label'		=> 'Home',
			'desc'		=> '[ <strong>is_home</strong> ] Primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-single',
			'label'		=> 'Single',
			'desc'		=> '[ <strong>is_single</strong> ] Primary - If a single post has a unique sidebar, it will override this.',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-archive',
			'label'		=> 'Archive',
			'desc'		=> '[ <strong>is_archive</strong> ] Primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-archive-category',
			'label'		=> 'Archive &mdash; Category',
			'desc'		=> '[ <strong>is_category</strong> ] Primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-search',
			'label'		=> 'Search',
			'desc'		=> '[ <strong>is_search</strong> ] Primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-404',
			'label'		=> 'Error 404',
			'desc'		=> '[ <strong>is_404</strong> ] Primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-page',
			'label'		=> 'Default Page',
			'desc'		=> '[ <strong>is_page</strong> ] Primary - If a page has a unique sidebar, it will override this.',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		// Social Links : List
		array(
			'id'		=> 'social-links',
			'label'		=> 'Social Links',
			'desc'		=> 'Create and organize your social links',
			'type'		=> 'list-item',
			'section'	=> 'social-links',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'social-icon',
					'label'		=> 'Icon Name',
					'desc'		=> 'Font Awesome icon names [<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><strong>View all</strong>]</a>  ',
					'std'		=> 'fa-',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-link',
					'label'		=> 'Link',
					'desc'		=> 'Enter the full url for your icon button',
					'std'		=> 'http://',
					'type'		=> 'text',
					'choices'	=> array()
				)
			)
		)
	)
);

/*  Settings are not the same? Update the DB
/* ------------------------------------ */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings ); 
	} 
}
