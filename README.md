# Shift8 Full Nav
* Contributors: shift8
* Donate link: https://www.shift8web.ca
* Tags: full screen nav,full screen navigation,sticky navigation,responsive nav menu,responsive menu,full screen menu,mobile menu
* Requires at least: 3.0.1
* Tested up to: 4.5.2
* Stable tag: 1.10
* License: GPLv3
* License URI: http://www.gnu.org/licenses/gpl-3.0.html

Plugin that integrates a sticky navigation bar that expands to the full screen when open.

## Description 

## Installation 

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/shif8-fullnav` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Navigate to the plugin settings page and define your design and other settings
3. Once enabled, the navigation bar should show up.

## Frequently Asked Questions 

### The nav bar is conflicting with an existing navigation menu!

Since every theme is different, its possible that you may have to "hide" the existing menu if its conflicting. The first thing you could try is simply identifying the container class or identifier for the navigation menu you want to hide. Then modify your theme's CSS to "display:none" that selector.

### How can I style the markup? 

Key elements of the markup is dynamically generated based on your design choices made in the administrative options. You can re-declare some of the classes in your theme's stylesheet. This plugin may be modified to include additional options down the line. 

### How do I get the dropdown options to work?

You simply need to add second level (only) options in the Wordpress menu section

### What else have you done?

You can visit [our website](https://www.shift8web.ca "Toronto Web Design") to see! :)

### Screenshots 

1. This is the options page where you define the design and other settings for the menu
2. This is an example of the menu extended 

## Changelog 

### 1.0 
* Stable version created
* Implemented short code options 

### 1.01 
* Added google font choices
* Bug fixes

### 1.02
* Fixed bug with inherit font logic

### 1.03
* Adjusted breakpoint for mobile menu from 768px to 980px

### 1.04
* Fixed header logo linking to site url

### 1.05
* Added option to force mobile mode of menu all the time so only the hamburger icon will display

### 1.06 
* Fixed z-index conflict with shift8-portfolio plugin

### 1.07
* Fixed main.js loading error
* Added fully customizable dropdown capability for menu options in non-mobile mode
* Added option to define mobile breakpoint for when the menu switches to mobile mode
* Added option to define font sizes for menu bar, overlay and dropdown

### 1.08
* Fixed bug in inherit logic for dropdown font if set to site default
* Set default font size if nothing set in admin options (inherit)
* Set default breakpoint width for mobile if nothing set in admin options (980px)

### 1.09
* Fixed padding for dropdown menu options

### 1.10
* Set default color to inherit if no color is defined to avoid CSS errors
