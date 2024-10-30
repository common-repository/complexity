=== Complexity ===
Contributors: Bjoern Kjos-Hanssen
Donate link: http://math.hawaii.edu/wordpress/bjoern/
Tags: math, complexity
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 0.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a shortcode for nondeterministic automatic complexity. Example: [complexity string="0110"] is replaced by the string 3.

== Description ==

This plugin provides a shortcode that calculates a specific mathematical function. That function is known as the *nondeterministic automatic complexity*
and was studied in [Kayleigh Hyde's Master thesis at University of Hawaii at Manoa in 2013](http://math.hawaii.edu/kkhyde). An earlier deterministic version was studied by Shallit and Wang in 2001.
 
== Installation ==

1. Upload the directory `complexity` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `[complexity string="0110"]` in any post and it will be replaced by `3`. Similarly for any binary string of length at most 23.

== Frequently Asked Questions ==

= Why is there a length limit of 23? =

As you may know, there are 16,777,216 binary strings of length 24. It takes time to compute the complexity of all of these, and upload the results
to the database. In short, we had to stop somewhere and in the current version that somewhere is length 23.

= Why would I install this plugin? =

It is not very useful yet, but I will probably add additional functionality such as shortcodes for drawing a diagram of a witnessing automaton for the complexity.
The plugin is useful for blogging about nondeterministic automatic complexity.

= How does the plugin work? =

First the complexity is computed in Python and saved to SQL files. These files are then uploaded to a database.
The complexity of a string like 0110 is then available as JSON data from an [API link](http://math.hawaii.edu/~bjoern/complexity-api/?string=0110).
The plugin itself just uses a simple PHP script to retrieve that data.

== Changelog ==

= 0.1 =
* Very basic initial version providing only the [complexity string="0110"] shortcode.

