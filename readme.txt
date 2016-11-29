=== Shift8 Full Nav ===
Contributors: shift8 
Donate link: https://www.shift8web.ca
Tags: sticky navigation, sticky nav, full width nav, sticky menu, full width menu, modal menu, full screen modal menu, full screen modal navigation, full screen nav, css navigation,responsive sticky nav, responsive sticky navigation, responsive sticky menu, responsive menu, responsive nav,responsive,navigation,menu
Requires at least: 3.0.1
Tested up to: 4.6.1
Stable tag: 1.05
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

This plugin implements a very simple and clean sticky navigation bar. The navigation is fully responsive and the mobile version of the menu has a full screen modal drop down effect. 

== Description ==

[Shift8](https://www.shift8web.ca) Full Nav is a plugin that allows you to create a full width, sticky and responsive navigation menu. The plugin allows you to define key design options such as menu color, google fonts for menu options, overlay color (for mobile dropdown) and menu/overlay transparency.

There are planned features for future releases such as dropdown effects for second level menu options. This plugin is based on the full screen pop out navigation by [Codyhouse](https://codyhouse.co/gem/full-screen-pop-out-navigation/).

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/shif8-full-nav` directory, or install the plugin through the WordPress plugins screen directly.
2. Disable any other 3rd party menu plugins you may have installed
3. Activate the plugin through the 'Plugins' screen in WordPress
4. Navigate to the plugin settings page and define your logo, font and design options. Dont forget to enable the plugin in the settings page!
5. The menu should show up by injecting its code into your header

== Frequently Asked Questions ==

= My menu is not showing up? =

Try disabling any other plugins that may be conflicting. Also take a look at inspect element in your browser and confirm if there are any javascript errors in the console. g

= Can I see what it looks like live? =

You can check out our wordpress hosting website to see it in action : https://www.stackstar.com

= How can I style the markup? =

The idea was to make design options available in the administrative interface of the plugin settings. The design options, when chosen, generate inline style markup that applies the styling. There is a stylesheet that imports other common styling elements. You can overwrite anything in your own theme's stylesheet.

= What if I have second level menu options? =

We plan on implementing a built-in dropdown feature for hierarchical menu options (2nd and 3rd level menu options). Currently this functionality is not built in.

= What else have you done? =

We do [web design](https://www.shift8web.ca "Toronto Web Design") , development and [web hosting](https://www.stackstar.com)! :)

== Screenshots ==

1. This is an example of how the menu looks on a desktop
2. This is an example of how the menu looks on mobile with the menu not extended.
3. This is an example of how the menu looks on mobile with the menu extended

== Changelog ==

= 1.0 =
* Stable version created
* Implemented design options and inline style generator

= 1.01 =
* Added google font choices
* Bug fixes

= 1.02 =
* Fixed bug with inherit font logic

= 1.03 = 
* Adjusted breakpoint for mobile menu from 768px to 980px

= 1.04 =
* Fixed header logo linking to site url

= 1.05 =
* Added option to force mobile mode of menu all the time so only the hamburger icon will display
