<?php
/*
Template Name: Contact
*/

get_header(); ?>

    <?php 
        //Past meta value into var
        $map_locations = get_post_meta($post->ID, 'sp_contact_map', true); //'11.549118,104.937882'; 
        $map_loc = explode(',', $map_locations);
        $latitude_center = $map_loc[0] + 0.008;// Variable to align the marker on the right side of the map, instead of the center    
    ?>

    <div id="map-container">
        <div class="map-inner">
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <script type="text/javascript">                 
              jQuery(document).ready(function ($)
                {
                    
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
                                        '<h3>Lily Boutique Hotel</h3>'+
                                        '<span># A27-A28 , La Seine , Koh Pich, Pnom Penh, Cambodia</span>'+
                                        '<span>HP: 017 666 916</span>'+
                                        '<span>E-mail: <a href="mailto:info@lilyboutiquehotel.com"> info@lilyboutiquehotel.com</a></span>'+
                                        '<div class="directions-container">'+
                                        '<a href="https://maps.google.com/?saddr=&amp;daddr=<?php echo $map_locations; ?>" class="button" target="_blank"><span class="icon-location"></span>Get Directions</a>'+
                                        '<a href="#" class="button last" target="_blank"><span class="icon-calendar"></span>Make reservation</a>'+
                                        '</div>'+
                                        '</div>';
                    var infowindow = new google.maps.InfoWindow({content: contentString }); 
                    
                    var mapOptions = {  
                        center: new google.maps.LatLng(<?php echo $latitude_center . ',' . $map_loc[1]; ?>),
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
                });
            </script>

            <div id="single-map-canvas" class="google-map-img-reset" style="width:100%; height: 100%;"></div>
        </div> <!-- .map-inner -->
    </div> <!-- #map-container -->
	
<?php get_footer(); ?>