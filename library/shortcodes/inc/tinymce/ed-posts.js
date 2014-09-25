/**
 * Posts Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.posts', {
        init : function( ed, url ) {
             ed.addButton( 'posts', {
                title : 'Insert Posts',
                image : url + '/ed-icons/insert_posts.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'posts Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=sc-posts-form' );
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'posts', tinymce.plugins.posts );
	jQuery( function() {
		var form = jQuery( '<div id="sc-posts-form"><table id="sc-posts-table" class="form-table">\
							<tr>\
							<th><label for="sc-post-type">Select post type</label></th>\
							<td><select name="post-type" id="sc-post-type">\
							<option value="facility">Facilities</option>\
							<option value="room">Rooms</option>\
							</select><br />\
							<small>Select a style for post.</small></td>\
							</tr>\
							<tr>\
							<th><label for="sc-post-num">Number of post</label></th>\
							<td><input type="text" name="sc-post-num" id="sc-post-num" value="-1" /><small> (-1 to show all.)</small></td>\
							</tr>\
							<tr>\
							<th><label for="sc-excerpt">Show short description</label></th>\
							<td><input type="checkbox" name="sc-excerpt" id="sc-excerpt" value="1" /></td>\
							</tr>\
							</table>\
							<p class="submit">\
							<input type="button" id="sc-posts-submit" class="button-primary" value="Insert posts" name="submit" />\
							</p>\
							</div>' );
		var table = form.find( 'table' );
		form.appendTo( 'body' ).hide();
		form.find( '#sc-posts-submit' ).click( function() {
			var post_type = table.find( '#sc-post-type' ).val(),
			numberposts = table.find( '#sc-post-num' ).val(),
			excerpt = '';
			shortcode = '';
			if (table.find( '#sc-excerpt' ).is(':checked')) {
				excerpt = 1;
			} else {
				excerpt = 0;
			}
			shortcode += '[posts post_type="' + post_type + '" numberposts="' + numberposts + '" excerpt="' + excerpt + '"]';

			tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
			tb_remove();
		} );
	} );
 } )();