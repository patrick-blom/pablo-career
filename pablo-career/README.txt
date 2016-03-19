=== Pablo Career ===
Contributors: pbl0m
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9SLVDBUGATJHC
Tags: content, joboffers, jobs, personal management, resource management
Requires at least: 4.3.1
Tested up to: 4.4.2
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Manage your job offers easy within WordPress

== Description ==

With Pablo Career you can easily manage all your job offers you to want publish in your WordPress page. The admin interface makes
it easy to create, edit, delete, active or deactivate your job offers. You can also separate your job offers by a given language.
Currently the following Languages are supported de, nl and pl.

== Installation ==

= From your WordPress dashboard =
1. Visit 'Plugins > Add New'
2. Search for 'PaBlo Career'
3. Activate PaBlo Career from your Plugins page.
4. Configure your job offer single view page using the settings
5. Place the `[joboffer-list lang=de]` shortcode in you post or page to display the job offers list
6. Place the `[joboffer-view lang=de]` shortcode in your previously selected single view page to display the single view

= Manually =
1. Upload `pablo-career` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure your job offer single view page using the settings
4. Place the `[joboffer-list lang=de]` shortcode in you post or page to display the job offers list
5. Place the `[joboffer-view lang=de]` shortcode in your previously selected single view page to display the single view

== Frequently Asked Questions ==

= I got an 500 Internal Error. Whats wrong? =

Check out the folder privileges. The plugin tmp folder has to be writable for the web server. In case of not smarty can not generate the templates.
Check out your server logs. Maybe the plugin has some conflicts with another plugin. In this case, copy the thrown error and feel free to contact me on github or via mail info[at]bl0m[dot]de

= How can I customize the Plugin-Templates =

The templates are stored in the `templates` folder inside the smarty directory beneath the plugin dir. Pablo Career uses Smarty3 which simplifies making changes to the templates.
For detailed information about smarty 3 visit the [official smarty project page](http://www.smarty.net/)

= How can I edit the Plugin-Styles =
The Plugin-CSS is located in the `/public/css` directory inside plugin dir. Feel free to edit these to your needs.

== Changelog ==

= v1.0.3=
* Fixing sort icon bug. Sorting icons were only displayed with a logged in user

= v1.0.2 =
* Edit shortcode rendering. Lists and detail view will now appear anywhere in the text and not only at the top
* Add some documentation

= v1.0.1 =
* Add some documentation