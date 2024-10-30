=== Keyword Density ===
Contributors: AHMED HAMED
Donate link: http://projects.codealizer.com/donate
Tags: keyword, density, phrase, post, page, custom
Requires at least: 3.0
Tested up to: 3.1
Stable tag: trunk

Adding Meta-box in the post edit screen and calculate how much times a Keyword Phrase repeated within the post content.

== Description ==

Adding Meta-box in the post edit screen and calculate how much times a Keyword  Phrase repeated in the post content. Each time the post get updated the Meta-box will recalculate the Keyword density, showing up the repeated count and the percentage.

* Add admin Meta-box on the post edit screen (upper right corner).
* Calculate Words repeat counts and the percentage for that count.
* Support multiple options (case sensitive and exact match).
* Save Meta-box state (fields) for each post.
* Options page that allow setting up default values and which "posts type" (post, page or any custom post type) the Meta-box would get displayed.

[Keyword Density Help](http://projects.codealizer.com/projects/wordpress/plugins/keyword-density "Keyword Density Home Page")

== Installation ==

* The simplest method
1. Go to your Wordpress dashboard Plugins page ( Plugins -> Add New ).
1. Type 'Keyword Density' Keyword in the search field.
1. Keyword Density plugin should be the first and then click install.
1. After Wordpress showing up a message that says "Plugin installed sucessful" click Activate the plugin.

* It also a simple method
1. Upload the Plugin folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Follow the notice message that appears in the notice bar.

== Frequently Asked Questions ==

= What is the purpose of "Case snsitive" option? =

If "checked" the option tells the plugin to differentiate between lowercase letters and Uppercase letters.

= What is the purpose of "Exact Match" option? =

If "not checked" the plugin will split the Keyword phrase into a muliple word, for example if "Hello world" Keyword phrase is the target Keyword the plugin will split it to two seperated words (Hello and world), then it'll find how many times each Word is repeated within the post content (it doesn't matter if they become consecutive or not).

= How to prevent the Keyword density plugin Meta-box from showing up in certain post type ( post, page, "custom post type" )? =

Go to the site Settings Menu -> Wrting section and select in which post type the Meta-box Widget should displayed.

== Screenshots ==

1. Calculate muliple key word density ( Exact Match is off ) in case sensitive mode.
2. Calculate the density for the entire phrase ( Exact match is on ).
3. Options page ( under Settings -> Writing section ), setting up the default post Meta-box values.

== Changelog ==

= 1.0 =
* Initial release
