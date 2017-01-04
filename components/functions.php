<?php

// Inject menu system in header
function add_shift8_fullnav_menu() {
        // Build array from primary nav menu
        $menu_name = 'primary';
        $menu_locations = get_nav_menu_locations();
        $menu_id = $menu_locations[ $menu_name ] ;
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
        foreach ($menu_array as $menu_item) {
		// item does not have a parent so menu_item_parent equals 0 (false)
		if ( !$menu_item->menu_item_parent ) {
			// save this id for later comparison with sub-menu items
			$parent_id = $menu_item->ID;
			?>
			<li class="dropdown"><a href="<?php echo $menu_item->url; ?>" class="title"><?php echo $menu_item->title; ?></a>
			<?php
		} 
		
		if ( $parent_id == $menu_item->menu_item_parent ) {  ?>
			<?php if ( !$submenu ) {
				$submenu = true; ?>
				<ul class="dropdown-content">
			<?php } ?>
			<li><a href="<?php echo $menu_item->url; ?>" class="title"><?php echo $menu_item->title; ?></a>
			<?php if ( $menu_array[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ) { ?>
		            	</ul>
		            	<?php $submenu = false; 
			} ?>

        <?php } ?>

		<?php if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ) { ?>
			</li>
		    <?php $submenu = false; 
		} ?>

		<?php $count++; 
	} 

        echo '</ul>
        </nav>
        </header>
        ';
        echo '<nav>
        <ul class="fn-primary-nav">';

        foreach ($menu_array as $menu_item) {
                echo '<li><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
        }

        // build social icons
        $social_twitter = (!empty(esc_attr( get_option('shift8_fullnav_social_twitter') ) ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_twitter') ) . '"><i class="fa fa-twitter"></i></a></li>' : '');
        $social_facebook = (!empty(esc_attr( get_option('shift8_fullnav_social_facebook') ) ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_facebook') ) . '"><i class="fa fa-facebook"></i></a></li>' : '');
        $social_googleplus = (!empty(esc_attr( get_option('shift8_fullnav_social_googleplus') ) ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_googleplus') ) . '"><i class="fa fa-google-plus"></i></a></li>' : '');
        $social_linkedin = (!empty(esc_attr( get_option('shift8_fullnav_social_linkedin') ) ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_linkedin') ) . '"><i class="fa fa-linkedin"></i></a></li>' : '');
        $social_instagram = (!empty(esc_attr( get_option('shift8_fullnav_social_instagram') ) ) ? '<li class="shift8-social"><a href="' . esc_attr( get_option('shift8_fullnav_social_instagram') ) . '"><i class="fa fa-instagram"></i></a></li>' : '');
        echo $social_twitter . $social_facebook . $social_googleplus . $social_instagram . $social_linkedin . '
        </ul>
        </nav>';
        wp_enqueue_script( 'shift8_fullnav_main', plugin_dir_url( __FILE__ ) . 'js/main.js', array(), true );
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
