# Shift8 Full Nav
* Contributors: shift8
* Donate link: https://www.shift8web.ca
* Tags: full screen nav,full screen navigation,sticky navigation,responsive nav menu,responsive menu,full screen menu,mobile menu
* Requires at least: 3.0.1
* Tested up to: 4.7.2
* Stable tag: 1.16
* License: GPLv3
* License URI: http://www.gnu.org/licenses/gpl-3.0.html

Plugin that integrates a sticky navigation bar that expands to the full screen when open.

## Want to see the plugin in action?

You can view two example sites where this plugin is live :

- Example Site 1 : [Wordpress Hosting](https://www.stackstar.com "Wordpress Hosting")
- Example Site 2 : [Web Design in Toronto](https://www.shift8web.ca "Web Design in Toronto")

## Features 

- Customizable mobile breakpoint
This means that you can customize when the mobile version of the menu "kicks" in. By default it is set to a screen width of 980px

- Mobile mode for all screen sizes
You can set the plugin to "mobile mode" which means the mobile version of the menu will be always displaying

- Definable font styles everywhere
You can define the fonts from a list of all google fonts, or inherit the fonts defined in your theme. You can also adjust font size and color.

- Upload your logo
Upload your logo and it will display seamlessly

- Change colors and opacity
You can change the color and opacity of the menu bar as well as the mobile flyout

- Dropdown functionality out of the box
If you have parent/child menu items, they will be automatically rendered as dropdown for mobile/desktop view of the menu. You can change color and styling of the dropdown for desktop as well

## Remember : Dont forget to set the switch "Enable Full Nav" after installing and activating!

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

### 1.11
* Implemented dropdown logic for mobile overlay menu (triangle for menu options that have sub nav children)

### 1.12
* Fixed bug in mobile dropdown logic for triangle direction change

### 1.13
* Fixed bug default color for dropdown backgrounds

### 1.14 
* Fixed is-fixed class which didnt apply in desktop

### 1.15
* Fixed fatal error with older versions of PHP

### 1.16
* Fixed bug where primary menu was not being pulled properly and no menu displayed
