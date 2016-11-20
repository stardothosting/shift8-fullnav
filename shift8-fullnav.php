<?php
/**
 * Plugin Name: Shift8 Full Nav
 * Plugin URI: https://github.com/stardothosting/shift8-fullnav
 * Description: This plugin adds a sticky menu to your site. When the menu is clicked it expands to the full screen
 * Version: 1.0.3
 * Author: Shift8 Web 
 * Author URI: https://www.shift8web.ca
 * License: GPLv3
 */

// Load custom CSS and JS
function shift8_fullnav_scripts() {
	// pop out nav
	wp_enqueue_style( 'shift8-fullnav-style', plugin_dir_url( __FILE__ ) . 'css/style.css');
	wp_enqueue_script( 'shift8-fullnav-modern', plugin_dir_url( __FILE__ ) . 'js/modernizr.js', array(), true );
	// font awesome
	wp_enqueue_style( 'font-awesome-real', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );

        // Build inline style for menu based on administrative options chosen
        $shift8_fullnav_bar_color = hex2rgba(esc_attr( get_option('shift8_fullnav_design_bar_col') ), $opacity = esc_attr( get_option('shift8_fullnav_design_bar_tra')));
        $shift8_fullnav_ovr_color = hex2rgba(esc_attr( get_option('shift8_fullnav_design_ovr_col') ), $opacity = esc_attr( get_option('shift8_fullnav_design_ovr_tra')));
	// Load google fonts if necessary
	$shift8_fullnav_bar_font = (esc_attr( get_option('shift8_fullnav_bar_font') ) == "Site default font" ? "inherit" : explode(':', esc_attr( get_option('shift8_fullnav_bar_font') ), 2));
	$shift8_fullnav_bar_font_color = esc_attr( get_option('shift8_fullnav_bar_font_col') );
	$shift8_fullnav_ovr_font = (esc_attr( get_option('shift8_fullnav_ovr_font') ) == "Site default font" ? "inherit" : explode(':', esc_attr( get_option('shift8_fullnav_ovr_font') ), 2));
	$shift8_fullnav_ovr_font_color = esc_attr( get_option('shift8_fullnav_ovr_font_col') );

	// Fix if its an array 
	$shift8_fullnav_bar_font = (is_array($shift8_fullnav_bar_font) ? "'" . $shift8_fullnav_bar_font[0] . "'" : $shift8_fullnav_bar_font);
	$shift8_fullnav_ovr_font = (is_array($shift8_fullnav_ovr_font) ? "'" . $shift8_fullnav_ovr_font[0] . "'" : $shift8_fullnav_ovr_font);

        $shift8_fullnav_custom_css = "
                .fn-header {
                        background-color: {$shift8_fullnav_bar_color};
                }
		.fn-primary-nav {
			background-color: {$shift8_fullnav_ovr_color};	
		}
		.fn-secondary-nav a, .fn-menu-text {
			font-family: {$shift8_fullnav_bar_font};
			color : {$shift8_fullnav_bar_font_color};
		}
		.fn-primary-nav-trigger {
			color: {$shift8_fullnav_bar_font_color};
		}
		.fn-menu-icon, .fn-menu-icon::after, .fn-menu-icon::before, .fn-primary-nav-trigger .fn-menu-icon.is-clicked::before, .fn-primary-nav-trigger .fn-menu-icon.is-clicked::after {
			background-color: {$shift8_fullnav_bar_font_color};
		}
		.fn-menu-icon.is-clicked {
			background-color: transparent;
		}
		.fn-primary-nav a {
			font-family: {$shift8_fullnav_ovr_font};
			color : {$shift8_fullnav_ovr_font_color};
		}
		.shift8-social {
			color: {$shift8_fullnav_ovr_font_color};
		}
        ";
	wp_add_inline_style( 'shift8-fullnav-style', $shift8_fullnav_custom_css );
}
/* Google Fonts */
function shift8_fullnav_load_google_fonts() {
	$shift8_bar_font = get_option('shift8_fullnav_bar_font');
	$shift8_ovr_font = get_option('shift8_fullnav_ovr_font');

	if ($shift8_bar_font != "Site default font") {
		wp_enqueue_style( 'shift8-fullnav-bar-font', '//fonts.googleapis.com/css?family=' . $shift8_bar_font );
	}
	if ($shift8_ovr_font != "Site default font") {
		wp_enqueue_style( 'shift8-fullnav-ovr-font', '//fonts.googleapis.com/css?family=' . $shift8_ovr_font );
	}
}

// Enqueue scripts and styles if enabled
if (esc_attr( get_option('shift8_fullnav_enabled') ) == 'on') {
	add_action( 'wp_enqueue_scripts', 'shift8_fullnav_scripts', 12,1 );
	add_action( 'wp_print_styles', 'shift8_fullnav_load_google_fonts');
}

// create custom plugin settings menu
add_action('admin_menu', 'shift8_fullnav_create_menu');
function shift8_fullnav_create_menu() {
	//create new top-level menu
        if ( empty ( $GLOBALS['admin_page_hooks']['shift8-settings'] ) ) {
                add_menu_page('Shift8 Settings', 'Shift8', 'administrator', 'shift8-settings', 'shift8_main_page' , 'dashicons-building' );
        }
	add_submenu_page('shift8-settings', 'Full Nav Settings', 'Full Nav Settings', 'manage_options', __FILE__.'/custom', 'shift8_fullnav_settings_page');
	//call register settings function
	add_action( 'admin_init', 'register_shift8_fullnav_settings' );
}

// Register admin scripts for custom fields
function load_shift8_fullnav_wp_admin_style() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'fullnav-color-picker-script', plugins_url('js/shift8_fullnav_color.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
        // admin always last
        wp_enqueue_style( 'shift8_fullnav_css', plugin_dir_url( __FILE__ ) . 'css/shift8_fullnav_admin.css' );
        wp_enqueue_media();
        wp_enqueue_script( 'shift8_fullnav_script', plugin_dir_url( __FILE__ ) . 'js/shift8_fullnav_admin.js' );
}
add_action( 'admin_enqueue_scripts', 'load_shift8_fullnav_wp_admin_style' );

// Register admin settings
function register_shift8_fullnav_settings() {
	//register our settings
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_enabled' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_logo' );
	// options for menu fonts
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_bar_font' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_bar_font_col' );
        register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_ovr_font' );
        register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_ovr_font_col' );
	// options for menu bar and overlay color and opacity
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_bar_col' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_bar_tra' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_ovr_col' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_ovr_tra' );
	// options for social media accounts
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_facebook' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_twitter' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_instagram' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_googleplus' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_linkedin' );
}

// Admin welcome page
if (!function_exists('shift8_main_page')) {
	function shift8_main_page() {
	?>
	<div class="wrap">
	<h2>Shift8 Plugins</h2>
	Shift8 is a Toronto based web development and design company. We specialize in Wordpress development and love to contribute back to the Wordpress community whenever we can! You can see more about us by visiting <a href="https://www.shift8web.ca" target="_new">our website</a>.
	</div>
	<?php
	}
}

// Admin settings page
function shift8_fullnav_settings_page() {
	$fullnav_logo = esc_attr( get_option('shift8_fullnav_logo'));
	$fullnav_logo_id = shift8_fullnav_get_image_id($fullnav_logo);
	$fullnav_logo_thumb = wp_get_attachment_image_src($fullnav_logo_id, 'thumbnail');
	$fullnav_google_fonts = shift8_get_google_fonts();
?>
<div class="wrap">
<h2>Shift8 Full Nav Settings</h2>
<?php if (is_admin()) { ?>
<form method="post" action="options.php">
    <?php settings_fields( 'shift8-fullnav-settings-group' ); ?>
    <?php do_settings_sections( 'shift8-fullnav-settings-group' ); ?>
    <?php
	if (!has_nav_menu('primary')) {
                echo '<span style="color:red;">You need to create a primary menu in Appearances -> menus first!</span>';
	}
	?>
    <table class="form-table">
	<tr valign="top">
	<th scope="row">Core Settings</th>
	</tr>
	<tr valign="top">
	<td>Enable Full Nav : </td>
	<td>
	<?php 
	if (esc_attr( get_option('shift8_fullnav_enabled') ) == 'on') { 
		$enabled_checked = "checked";
	} else {
		$enabled_checked = "";
	}
	?>
                <label class="switch">
                <input type="checkbox" name="shift8_fullnav_enabled" <?php echo $enabled_checked; ?>>
                <div class="slider round"></div>
                </label>
	</td>
	</th>
	</tr>
        <tr valign="top">
        <th scope="row">Menu Bar Logo</th>
	</tr>
	<tr valign="top">
	<td><input type="hidden" name="shift8_fullnav_logo" id="shift8_fullnav_logo" value="<?php echo esc_attr( get_option('shift8_fullnav_logo') );  ?>" />
        <input type="button" id="shift8_fullnav_image_button" class="button" style="vertical-align:bottom;" value="<?php _e( 'Choose or Upload Logo', 'prfx-textdomain' )?>" name="shift8_fullnav_logo" /></td>
        <?php if (!empty($fullnav_logo_thumb[0])) { ?>
		<td><img src="<?php echo $fullnav_logo_thumb[0]; ?>"></td>
		<?php } ?>
        </tr>
        <tr valign="top">
        <th scope="row">Font Options</th>
        </tr>
        <tr valign="top">
        <td>Menu Bar Font Color :</td><td><input type="text" name="shift8_fullnav_bar_font_col" value="<?php echo esc_attr( get_option('shift8_fullnav_bar_font_col') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
        </tr>
        <tr valign="top">
        <td>Menu Bar Font : </td>
	<td>
		<div class="shift8-fullnav-select">
		<select name="shift8_fullnav_bar_font">
			<option>Site default font</option>
			<?php
                                foreach ($fullnav_google_fonts as $fullnav_google_font) {
                                        $fullnav_google_font_item = esc_attr( $fullnav_google_font->family ) . ":" . implode(',', $fullnav_google_font->variants );
                                        $selected = ($fullnav_google_font_item == get_option('shift8_fullnav_bar_font') ? 'selected' : '');
                                        echo "<option value='" . $fullnav_google_font_item . "' " . $selected . ">" . esc_attr( $fullnav_google_font->family ) . "</option>";
                                }
			?>
		</select> 
		</div>
	</td>
        </tr>
        <tr valign="top">
        <td>Menu Overlay Font color : </td><td><input type="text" name="shift8_fullnav_ovr_font_col" value="<?php echo esc_attr( get_option('shift8_fullnav_ovr_font_col') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
        </tr>
        <tr valign="top">
        <td>Menu Overlay Font : </td>
        <td>
		<div class="shift8-fullnav-select">
                <select name="shift8_fullnav_ovr_font">
                        <option>Site default font</option>
                        <?php
                                foreach ($fullnav_google_fonts as $fullnav_google_font) {
					$fullnav_google_font_item = esc_attr( $fullnav_google_font->family ) . ":" . implode(',', $fullnav_google_font->variants );
					$selected = ($fullnav_google_font_item == get_option('shift8_fullnav_ovr_font') ? 'selected' : ''); 
					echo "<option value='" . $fullnav_google_font_item . "' " . $selected . ">" . esc_attr( $fullnav_google_font->family ) . "</option>";
                                }
                        ?>
                </select>
		</div>
        </td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Design Options</th>
	</tr>
	<tr valign="top">
        <td>Menu Bar Color :</td><td><input type="text" name="shift8_fullnav_design_bar_col" value="<?php echo esc_attr( get_option('shift8_fullnav_design_bar_col') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
	</tr>
	<tr valign="top">
        <td>Menu Bar Transparency : </td><td><div id="barTraFilter" style="background-color:<?php echo esc_attr( get_option('shift8_fullnav_design_bar_col') ); ?>"></div><div id="barTraSlider"><input id="barTra" type="range" name="shift8_fullnav_design_bar_tra" value="<?php echo esc_attr( get_option('shift8_fullnav_design_bar_tra') ); ?>" max="1.0" min="0" step="0.01"/></div></td>
	</tr>
	<tr valign="top">
        <td>Overlay color : </td><td><input type="text" name="shift8_fullnav_design_ovr_col" value="<?php echo esc_attr( get_option('shift8_fullnav_design_ovr_col') ); ?>" class="fullnav-color-field" data-default-color="#252525" /></td>
	</tr>
	<tr valign="top">
        <td>Overlay transparency : </td><td><div id="ovrTraFilter" style="background-color:<?php echo esc_attr( get_option('shift8_fullnav_design_ovr_col') ); ?>"></div><div id="ovrTraSlider"><input id="ovrTra" type="range" name="shift8_fullnav_design_ovr_tra" value="<?php echo esc_attr( get_option('shift8_fullnav_design_ovr_tra') ); ?>" max="1.0" min="0" step="0.01"/></div></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Social Media Links</th>
	</tr>
        <tr valign="top">
        <td>Twitter : </td><td><input type="text" name="shift8_fullnav_social_twitter" value="<?php echo esc_attr( get_option('shift8_fullnav_social_twitter') ); ?>" /></td>
        </tr>
	<tr valign="top">
        <td>Facebook : </td><td><input type="text" name="shift8_fullnav_social_facebook" value="<?php echo esc_attr( get_option('shift8_fullnav_social_facebook') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <td>Instagram : </td><td><input type="text" name="shift8_fullnav_social_instagram" value="<?php echo esc_attr( get_option('shift8_fullnav_social_instagram') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <td>Google Plus : </td><td><input type="text" name="shift8_fullnav_social_googleplus" value="<?php echo esc_attr( get_option('shift8_fullnav_social_googleplus') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <td>Linkedin : </td><td><input type="text" name="shift8_fullnav_social_linkedin" value="<?php echo esc_attr( get_option('shift8_fullnav_social_linkedin') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php 
	} // is_admin
}

// Inject menu system in header
function add_shift8_fullnav_menu() {
        // Build array from primary nav menu
        $menu_name = 'primary';
        $menu_locations = get_nav_menu_locations();
        $menu_id = $menu_locations[ $menu_name ] ;
        $menu_array = wp_get_nav_menu_items($menu_id);

	echo '<header class="fn-header is-visible is-fixed">
	<div class="fn-logo"><a href="#0"><img src="' . esc_attr( get_option('shift8_fullnav_logo')) . '" alt="Logo"></a></div>
	<a class="fn-primary-nav-trigger" href="#0">
	<span class="fn-menu-text">Menu</span><span class="fn-menu-icon"></span>
	</a> 
	<nav>
	<ul class="fn-secondary-nav">';
	foreach ($menu_array as $menu_item) {
		echo '<li><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';	
	}
	echo '</ul>
	</nav>
	</header>
	<nav>';
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
// add the menu if its switched on
if (esc_attr( get_option('shift8_fullnav_enabled') ) == 'on') {
	add_action('wp_footer', 'add_shift8_fullnav_menu', 1);
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
