<?php

// Load custom CSS and JS
function shift8_fullnav_scripts() {
        // pop out nav
        wp_enqueue_style( 'shift8-fullnav-style', plugin_dir_url(dirname(__FILE__)) . 'css/style.css');
        wp_enqueue_script( 'shift8-fullnav-modern', plugin_dir_url(dirname(__FILE__)) . 'js/modernizr.js', array(), true );
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

        // Force mobile menu if option is enabled
        if (esc_attr( get_option('shift8_fullnav_mobilemode') ) == 'on') {
                $shift8_fullnav_mobileonly_css = "
                        .fn-secondary-nav {
                                display:none !important;
                        }
                        .fn-primary-nav-trigger {
                                display: inline-block !important;
                        }
                ";
        } else {
                $shift8_fullnav_mobileonly_css = null;
        }

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
                " . $shift8_fullnav_mobileonly_css . "
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

// Register admin scripts for custom fields
function load_shift8_fullnav_wp_admin_style() {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'fullnav-color-picker-script', plugin_dir_url(dirname(__FILE__)) . 'js/shift8_fullnav_color.js', array( 'wp-color-picker' ), false, true );
        // admin always last
        wp_enqueue_style( 'shift8_fullnav_css', plugin_dir_url(dirname(__FILE__)) . 'css/shift8_fullnav_admin.css' );
        wp_enqueue_media();
        wp_enqueue_script( 'shift8_fullnav_script', plugin_dir_url(dirname(__FILE__)) . 'js/shift8_fullnav_admin.js' );
}
add_action( 'admin_enqueue_scripts', 'load_shift8_fullnav_wp_admin_style' );
