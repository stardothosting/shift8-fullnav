<?php

// Inject menu system in header
function add_shift8_fullnav_menu() {
        // Build array from primary nav menu
        $locations = get_theme_mod( 'nav_menu_locations' );
        if (!empty($locations)) {
            foreach ($locations as $locationId => $menuValue) {
                if (has_nav_menu($locationId)) {
                    $shift8_fullnav_menu = $locationId;
                }
            }
        }
        $menu_locations = get_nav_menu_locations();
        $menu_id = $menu_locations[ $shift8_fullnav_menu ] ;
        $menu_array = wp_get_nav_menu_items($menu_id);

        echo '<header class="fn-header is-visible is-fixed">
        <div class="fn-logo"><a href="' . get_site_url() . '"><img src="' . esc_attr( get_option('shift8_fullnav_logo')) . '" alt="Logo"></a></div>
        <a class="fn-primary-nav-trigger" href="#0">
        <span class="fn-menu-text">Menu</span><span class="fn-menu-icon"></span>
        </a>
        <nav>
        <ul class="fn-secondary-nav">';
	$count = 0;
	$submenu = false;
	foreach( $menu_array as $item ) {
		$link = $item->url;
		$title = $item->title;
		$target = $item->target;
		// item does not have a parent so menu_item_parent equals 0 (false)
		if ( !$item->menu_item_parent ){
			// save this id for later comparison with sub-menu items
			$parent_id = $item->ID;
			echo '<li class="fn-dropdown">
			<a href="' .  $link . '" class="title" target="' . $target . '">
			' . $title . '
			</a>';
		}

		if ( $parent_id == $item->menu_item_parent ) {
			if ( !$submenu ) { 
				$submenu = true; 
				echo '<ul class="fn-dropdown-content">';
			}
			echo '<li>
			<a href="' . $link . '" class="title" target="' . $target . '">' . $title . '</a>
                	</li>';

			if ( $menu_array[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ) {
				echo '</ul>';
				$submenu = false;
			}
		}

		if ( $menu_array[ $count + 1 ]->menu_item_parent != $parent_id ) { 
			echo '</li>';
			$submenu = false;
		}
		$count++;  
	}
    // Add woocommerce cart link if it exists
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        $count = WC()->cart->cart_contents_count;
        echo '<li class="fn-dropdown"><a class="title" href="' . WC()->cart->get_cart_url() . '"><i class="fa fa-shopping-cart">&nbsp;</i> ' . esc_html( $count ) . '</a></li>';
    }

            echo '</ul></nav></header>';

        echo '<nav>
        <ul class="fn-primary-nav">';

	$mcount = 0;
	$msubmenu = false;
        foreach ($menu_array as $menu_item) {
		if (!$menu_item->menu_item_parent) {
			$mparent_id = $menu_item->ID;
			echo '<li class="fn-menu-mobile-parent fn-menu-mobile-parent-item-' . $mparent_id .'"><a href="' . $menu_item->url . '">' . $menu_item->title . '</a>';
		}
                if ( $mparent_id == $menu_item->menu_item_parent ) {
                        if ( !$msubmenu ) {
                                $msubmenu = true;
                                echo '<span id="fn-arrow-dropdown" class="fn-arrow-down"></span><ul class="fn-mobile-dropdown-content fn-mobile-dropdown-content-' . $mparent_id .'">';
                        }
			echo '<li class="fn-menu-child-item fn-menu-child-item-' . $mparent_id .'"><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';

                        if ( $menu_array[ $mcount + 1 ]->menu_item_parent != $mparent_id && $msubmenu ) {
                                echo '</ul>';
				echo '<script>
					jQuery(".fn-menu-mobile-parent-item-' . $mparent_id . '").click( function() {
						if (jQuery(".fn-menu-mobile-parent-item-' . $mparent_id . ' #fn-arrow-dropdown").hasClass("fn-arrow-down")) {
							jQuery(".fn-menu-mobile-parent-item-' . $mparent_id . ' #fn-arrow-dropdown").removeClass("fn-arrow-down");
							jQuery(".fn-menu-mobile-parent-item-' . $mparent_id . ' #fn-arrow-dropdown").addClass("fn-arrow-up");
						} else {
                                                        jQuery(".fn-menu-mobile-parent-item-' . $mparent_id . ' #fn-arrow-dropdown").removeClass("fn-arrow-up");
                                                        jQuery(".fn-menu-mobile-parent-item-' . $mparent_id . ' #fn-arrow-dropdown").addClass("fn-arrow-down");
						}
						jQuery(".fn-mobile-dropdown-content-' . $mparent_id . '").slideToggle();
					});
					</script>';
                                $msubmenu = false;
                        }
                }

                if ( $menu_array[ $mcount + 1 ]->menu_item_parent != $mparent_id ) {
                        echo '</li>';
                        $msubmenu = false;
                }
                $mcount++;
        }

        // build social icons
        $social_twitter = (esc_attr( get_option('shift8_fullnav_social_twitter') ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_twitter') ) . '" target="_new"><i class="fa fa-twitter"></i></a></li>' : '');
        $social_facebook = (esc_attr( get_option('shift8_fullnav_social_facebook') ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_facebook') ) . '" target="_new"><i class="fa fa-facebook"></i></a></li>' : '');
        $social_googleplus = (esc_attr( get_option('shift8_fullnav_social_googleplus') ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_googleplus') ) . '" target="_new"><i class="fa fa-google-plus"></i></a></li>' : '');
        $social_linkedin = (esc_attr( get_option('shift8_fullnav_social_linkedin') ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_linkedin') ) . '" target="_new"><i class="fa fa-linkedin"></i></a></li>' : '');
        $social_instagram = (esc_attr( get_option('shift8_fullnav_social_instagram') ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_instagram') ) . '" target="_new"><i class="fa fa-instagram"></i></a></li>' : '');
        echo $social_twitter . $social_facebook . $social_googleplus . $social_instagram . $social_linkedin . '
        </ul>
        </nav>';
}
// Convert hexdec color string to rgb(a) string
function hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if(empty($color))
        return $default;

        //Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
                $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
                if(abs($opacity) > 1)
                $opacity = 1.0;
                $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
                $output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}

// Function to get image ID
function shift8_fullnav_get_image_id($image_url) {
        global $wpdb;
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
}

// Function to get list of Google Fonts
function shift8_get_google_fonts() {
        $apikey = 'AIzaSyAc-nHc5ViyUFP_yLVIZMTcxb7qSq_JnhM';
        $fontFile = plugin_dir_path( __FILE__ ) . 'cache/fonts.json';

        //Total time the file will be cached in seconds, set to a week
        $cachetime = 86400 * 7;
        if(file_exists($fontFile) && $cachetime < filemtime($fontFile)) {
                $content = json_decode(file_get_contents($fontFile));
        } else {
                $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=' . $apikey;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_URL, $googleApi);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $fontContent = curl_exec($ch);
                curl_close($ch);
                $fp = fopen($fontFile, 'w');
                fwrite($fp, $fontContent);
                fclose($fp);
                $content = json_decode($fontContent);
        }
        if($amount == 'all') {
                return $content->items;
        } else {
                return array_slice($content->items, 0, $amount);
        }
}
