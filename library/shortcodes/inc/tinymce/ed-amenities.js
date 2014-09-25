/**
 * Amenities Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.amenities', {
        init : function( ed, url ) {
             ed.addButton( 'amenities', {
                title : 'Insert amenities',
                image : url + '/ed-icons/amenities.png',
                onclick : function() {
                	var shortcode = '[amenities]';
                	tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
                }
             });
         },
		createControl : function( n, cm ) {
		 return null;
		},
     });
	
	tinymce.PluginManager.add( 'amenities', tinymce.plugins.amenities );

 } )();