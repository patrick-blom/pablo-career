=== Plugin Name ===
Contributors: pbl0m
Donate link: [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9SLVDBUGATJHC)
Tags: content, joboffers, jobs, personal management, resource management
Requires at least: 4.3.1
Tested up to: 4.4.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: [GPLv2](http://www.gnu.org/licenses/gpl-2.0.html)

Manage your joboffers easy within wordpress

== Description ==

With Palbo Career you can easily manage all your joboffers you to want publish in your wordpress page. The admin interface makes
it easy to create, edit, delete, active or deactivate your job offers. You can also separate your joboffers by a given language.
Currently the following Languages are supported de, nl and pl.

Developers can easily extend or customize the plugin. It's written using the SOLID principle, smarty3 and composer autoload.

== Installation ==

1. Upload `pablo-career` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure your joboffer single view page using the settings
1. Place the `[joboffer-list lang=de]` shortcode in you post or page to display the joboffers list
1. Place the `[joboffer-view lang=de]` shortcode in your previously selected single view page to display the single view

== Frequently Asked Questions ==

= I got an 500 Internal Error. Whats wrong? =

Check out the folder privileges. The plugin tmp folder has to be writable for the web server. In case of not smarty can not generate the templates.
Check out your server logs. Maybe the plugin has some conflicts with another plugin. In this case, copy the thrown error and feel free to contact me on github or via mail info[at]bl0m[dot]de
