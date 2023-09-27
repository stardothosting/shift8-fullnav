<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('admin_head', 'shift8_fullnav_custom_favicon');
function shift8_fullnav_custom_favicon() {
  echo '
    <style>
    .dashicons-shift8 {
        background-image: url("'. plugin_dir_url(dirname(__FILE__)) .'/img/shift8pluginicon.png");
        background-repeat: no-repeat;
        background-position: center; 
    }
    </style>
  '; 
}

// create custom plugin settings menu
add_action('admin_menu', 'shift8_fullnav_create_menu');
function shift8_fullnav_create_menu() {
        //create new top-level menu
        if ( empty ( $GLOBALS['admin_page_hooks']['shift8-settings'] ) ) {
                add_menu_page('Shift8 Settings', 'Shift8', 'administrator', 'shift8-settings', 'shift8_main_page' , 'dashicons-shift8' );
        }
        add_submenu_page('shift8-settings', 'Full Nav Settings', 'Full Nav Settings', 'manage_options', __FILE__.'/custom', 'shift8_fullnav_settings_page');
        //call register settings function
        add_action( 'admin_init', 'register_shift8_fullnav_settings' );
}

// Register admin settings
function register_shift8_fullnav_settings() {
    //register our settings
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_enabled' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_mobilemode' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_mobilebreak' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_navlocation' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_logo' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_logowidth' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_logowidth_mobile' );

    // options for search bar 
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_search' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_search_top' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_search_background' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_search_button_background' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_search_button_font_col' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_search_button_font_siz' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_search_button_hover' );
	register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_search_button_hover_font_col' );

    // options for top padding for content and menu bar height
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_toppadding' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_barheight' );

    // options for menu fonts
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_bar_font' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_bar_font_col' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_bar_font_siz' );

    // options for menu overlay font
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_ovr_font' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_ovr_font_col' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_ovr_font_siz' );

    // options for menu dropdown font
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_drp_font' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_drp_font_col' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_drp_font_siz' );

    // options for menu bar and overlay color and opacity
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_bar_col' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_bar_tra' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_ovr_col' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_ovr_tra' );

    // Dropdown hover and bg colors
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_drp_bak' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_drp_hvr' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_drp_subbak' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_design_drp_subhvr' );

    // options for social media accounts
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_facebook' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_twitter' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_instagram' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_googleplus' );
    register_setting( 'shift8-fullnav-settings-group', 'shift8_fullnav_social_linkedin' );
}
