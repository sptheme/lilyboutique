<?php
/*
Template Name: Contact
*/

get_header(); ?>

    <?php 
        //Past meta value into var
        $contact_meta = get_post_meta( $post->ID );
        $map_locations = $contact_meta['sp_contact_map'][0]; //'11.549118,104.937882'; 
        $map_loc = explode(',', $map_locations);
        $latitude_center = $map_loc[0] + 0.010;
        $longtitude_center = $map_loc[1] - 0.060;// Variable to align the marker on the right side of the map, instead of the center    
    ?>

    <div id="map-container">
        <div class="map-inner">
                 
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <script type="text/javascript">    
              jQuery(document).ready(function($){
                    
                    var map_styles = [
                        {
                            // Style the map with the custom hue
                            stylers: [
                                { "hue":"#0274cb" }
                            ]
                        },
                        {
                            // Remove road labels
                            featureType:"road",
                            elementType:"labels",
                            stylers: [
                                { "visibility":"off" }
                            ]
                        },
                        {
                            // Style the road
                            featureType:"road",
                            elementType:"geometry",
                            stylers: [
                                { "lightness":100 },
                                { "visibility":"simplified" }
                            ]
                        }
                    ];

                    var contentString = '<div id="map-info">'+
                                        '<h3><?php echo esc_attr( get_bloginfo("name") ); ?></h3>'+
                                        '<span><?php echo $contact_meta["sp_address"][0]; ?></span>'+
                                        '<span>Tel: <?php echo $contact_meta["sp_tel"][0]; ?></span>'+
                                        '<span>HP: <?php echo $contact_meta["sp_phone"][0]; ?></span>'+
                                        '<span>Fax: <?php echo $contact_meta["sp_fax"][0]; ?></span>'+
                                        '<span>E-mail: <a href="mailto:<?php echo $contact_meta["sp_email"][0]; ?>"> <?php echo $contact_meta["sp_email"][0]; ?></a></span>'+
                                        '<div class="directions-container">'+
                                        '<a href="https://maps.google.com/?saddr=&amp;daddr=<?php echo $map_locations; ?>" class="button" target="_blank"><span class="icon-location"></span>Get Directions</a>'+
                                        '<a href="<?php echo $contact_meta["sp_agoda"][0]; ?>" class="button last" id="book" target="_blank"><span class="icon-calendar"></span>Make reservation</a>'+
                                        '</div>'+
                                        '</div>';
                    var infowindow = new google.maps.InfoWindow({content: contentString }); 
                    
                    var mapOptions = {  
                        center: new google.maps.LatLng(<?php echo $latitude_center . ',' . $longtitude_center; ?>),
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.LARGE,
                            position: google.maps.ControlPosition.RIGHT_CENTER
                        },
                        panControlOptions: {
                            position: google.maps.ControlPosition.RIGHT_CENTER
                        },
                        streetViewControl:false,
                        zoom:13,
                        mapTypeControlOptions: {
                            mapTypeIds:[]
                        }
                    }
                    var map = new google.maps.Map(document.getElementById("single-map-canvas"), mapOptions);

                    var styledMap = new google.maps.StyledMapType(map_styles, { name:"Contact Map" });

                    map.mapTypes.set('Contact Map', styledMap);
                    map.setMapTypeId('Contact Map');
                    
                    
                    var image = '<?php echo SP_ASSETS_THEME ;?>' + 'images/google-map-marker.png'; // Marker image

                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(<?php echo $map_locations; ?>), 
                        map: map,
                        icon:image,
                        animation: google.maps.Animation.DROP
                    });
                    
                    infowindow.open(map,marker);

                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map,marker);
                    });
                   
                    /*google.maps.event.addListener(infowindow, 'domready', function() {
                        $('#book').magnificPopup({
                            type: 'inline',
                            preloader: false,
                            removalDelay: 500,
                            mainClass: 'mfp-fade'
                        });
                    });*/
                    
                });
            </script>

            <div id="single-map-canvas" class="google-map-img-reset" style="width:100%; height: 100%;"></div>
        </div> <!-- .map-inner -->
    </div> <!-- #map-container -->
    <div id="booking-form" class="mfp-hide white-popup-block">
        <?php $page = get_post(ot_get_option('reservation-page')); ?>
        <h3><?php echo $page->post_title; ?></h3>
        <?php $content = apply_filters('the_content', $page->post_content); 
        echo $content; ?>
    </div>
	
<?php get_footer(); ?>