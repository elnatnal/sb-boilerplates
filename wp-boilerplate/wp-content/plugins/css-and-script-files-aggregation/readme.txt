=== CSS And Script Files Aggregation ===
Contributors: yacobir 
Donate link:https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7KGK3D9TRDF6E
Tags: optimize,speed,css,script,aggregate,caching,load
Requires at least: 2.8
Tested up to: 3.0.1
Stable tag: 1.3.1

Aggregate all the .css and .js files from all plugins into combined files in order to speed up page load and minimize HTTP Requests from the browsers.

== Description ==

Aggregate all the .css and .js files from all plugins into combined files in order to speed up page load and minimize HTTP Requests from the browsers.

Many plugins add CSS files and script files to your blog. This will require more HTTP requests and will slow down page load because browsers are limited by the number of concurrent connections.

Using Caching plugins is not enough because they will only optimize the server side, this plugin will help optimizing the client side by reducing requests.

This plugin does everything automatically and supports browser caching.

Features:


* Support for CSS media types

* Support for header and footer scripts

* Support browser caching by changing ?ver=x when a file is modified

* Automatically generating new css/js when one of the css/js files is changed


Notes: 

The plugin will only aggregate css/js files which plugins add in the standard way (enqueuing). Other files would not be aggregated and would still be included separately. Most plugins adds script and style files in the standard way.

WPMU - the plugin doesn't currently support WPMU. Please stay tuned for next version.  

<div>
  <br />
</div>

== Changelog ==

= 1.3 =

* Added admin option page

= 1.2.1 =

* Another bug fix
* The plugin will now automatically regenerate combined files after the plugin is upgraded

= 1.2 =
* bug fix: sometimes background images in css files had relative url which wasn't modified correctly

= 1.1 =

* fixed problem when css/js files used parameters
* skipping dynamic css/js files and keeping them as is

== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

You can use Yslow to test your blog's performance grade before and after adding the plugin. People are already reporting two-three grades improvements!
http://developer.yahoo.com/yslow/

== Frequently Asked Questions ==

**Q:What if I modify one of the css or js files?**

A:The plugin will automatically identify that a file was modified and will recreate the relevant aggregated file.

**Q: How can I know that the plugin works?**

You can look at the your blog\'s page source before activating the plugin and look for .js and .css files. Do it again after activating the plugin and see how it minimizes the number of .js and .css files.

**Q:Will it create new aggregated files each time the page loads?**

A: No. It will only generate files in the first time and when you make changes to one of the script/style files.

**Q:Will this plugin slow my site?**

A:No! In my tests the plugin runs less than 2 milliseconds when it creates new aggregated files. When there are no changes it is even faster.

==Readme Generator== 

This Readme file was generated using <a href = 'http://sudarmuthu.com/wordpress/wp-readme'>wp-readme</a>, which generates readme files for WordPress Plugins.