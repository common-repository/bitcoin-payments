=== Bitcoin Payments ===
Donate link: http://blockchain.info/address/17Xvz6QzceYfD5MW8hwup1Nr4wTnEY8fV2
Contributors: Jandal
Tags: bitcoin, litecoin, dogecoin, bit coin, lite coin, doge coin, cryptocurrency, crypto currency, qrcode, address, qr code, widget, shortcode
Requires at least: 3.0.1
Tested up to: 3.9.1
Stable tag: 1.4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use Shortcodes and Widgets to advertise your cryptocurrency (bitcoin, litecoin, dogecoin) address and or QRCode. Use a default or individual address.


== Description ==

Use Shortcodes and Widgets to advertise your cryptocurrency (bitcoin, litecoin, dogecoin) address on your blog.  Display the address and or QRCode.  Use your default address or individual addresses per Shortcode or Widget.

You can put multiple addresses for different cryptocurrencies on the one or many pages.

This is not a shopping cart plugin. Sorry, maybe in the future it can be expanded upon.

You insert custom addresses so you can keep track of which content is bringing you the best return.

For example, each post you write, you could create a new address and then when you add a shortcode to the post, you can insert the custom address.

This plugin currently does not require a 3rd party account to use it.
This plugin currently does not support a 3rd party account if you want to use it.

= Future Ideas =
* Better management of many addresses
* Use a coin image and a jQuery popup box to show address information

= Thank You Addresses =
bitcoin: <a href="http://bitcoin:17Xvz6QzceYfD5MW8hwup1Nr4wTnEY8fV2">17Xvz6QzceYfD5MW8hwup1Nr4wTnEY8fV2</a><br>
litecoin: <a href="http://litecoin:Lb6LETF1RyvEBvhEekNEUFR7oj19XeZRWh">Lb6LETF1RyvEBvhEekNEUFR7oj19XeZRWh</a><br>
dogecoin: <a href="http://dogecoin:DTgguHQ7wht2oRoHD2haduV6QKsaxdSdfn">DTgguHQ7wht2oRoHD2haduV6QKsaxdSdfn</a>

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `bitcoin-payments.zip` to the `wp-content/plugins` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the default Settings in 'Settings > Bitcoin Payments'
4. Add a widget or shortcode to your content
5. Receive crypto goodness!


== Frequently Asked Questions ==

= Can I use multiple addresses? =

Yes, you can define custom addresses per widget or shortcode, this will allow you to track which code is attracting the most payments.

= Can I use multiple cryptocurrencies? =

Yes, much wow, if you have dogecoin you can use this plugin to display that address and others too!

= Do I need a 3rd Party account to use this? =

No, currently this plugin does not integrate with other services directly.  You enter and manage the addresses you want to use.  Those addresses can be generated and kept on any device or web or paper wallet of your choice.

= Is this a shopping cart? =

No, this is just the ability to display your address as text or a QRCode as many times where ever you like on your site.

= Why do I have 2 different QRCodes for 1 address, and 1 address with no QRCode? =

There is a good chance that the QRCodes have the same DIV ID, if you are using the widget, please check the last setting in the widget settings, and in the shortcode you can set "div_id". Please check the "How To Use It" tab on the Settings page for more details.

= The address in the Widget is breaking my theme design =

Try adding the following CSS to your theme Style Sheet, it will do it's best to try and force those long addresses to break on to multiple lines.
`.btcpWAddress{ 
	word-wrap: break-word;
	word-break: break-all;
}`

Or you could hide the address, please check the "How To Use It" tab on the Settings page for more details.


== Screenshots ==

1. This is the Plugin Settings page

2. This is the Plugin Settings "How To Use It" Tab

3. This is the Plugin Settings "Learn About Bitcoin" Tab

4. This is the Plugin Widget settings

5. This is an example of what it could look like on your website using multiple codes on the same page with multiple cryptocurrencies


== Changelog ==

= 1.4.2 - 2014-06-02 =
* FIXED a possible issue where jQuery was loaded after the plugin.

= 1.4.1 - 2014-05-19 =
* UPDATED code to clean up a couple of small things before we add a new feature.

= 1.4 - 2014-05-02 = 
* FIXED widget div id random number was not random when you added more than 1 widget at a time.

= 1.3 - 2014-04-28 =
* ADDED prefix and postfix options in the Settings and on the Shortcodes and Widgets.
* ADDED QRCode title tag to show address.
* ADDED reference to cryptocurrencies as multiple coins are now supported.
* ADDED the ability to add/remove the href/hyperlink around the address.
* UPDATED the shortcode help to include the Div ID setting.
* FIXED height setting name, this may break old height settings, please check "QRCode Height" after updating.
* FIXED CSS on Settings page for sidebar and wrapping the address
* FIXED JS error that was unrelated to the plugin and removed extra script.

= 1.2 =
* ADDED setting to hide the address when using the shortcode, so you can show the QRCode only.
* ADDED "Learn About Bitcoin" tab in the Settings.
* ADDED descriptions for QRCode height and width in the Settings.
* UPDATED bitcoin address so it is a new one.
* UPDATED code to clean up a couple of things before we add a new feature.

= 1.1 =
* FIXED settings page by adding missing .js file that used to be theme dependant.
* FIXED typo on How To Use It page
* UPDATED bitcoin address due to the random number security issue

= 1.0 =
* Initial version is being released.


== Upgrade Notice ==


= 1.4.2 = 
* Fix a possibly jQuery load timing issue.

= 1.4.1 = 
* Minor vanity update.

= 1.4 = 
* Minor widget bug update.

= 1.3 =
* This update has new customization settings for multiple cryptocurrencies and advanced users to take advantage of.

= 1.2 =
* This update cleans up a few things in the code and offers the feature to hide the address when using the shortcode.

= 1.1 =
* Fixes and updates to the silly errors to make the plugin usable.

= 1.0 =
* Initial version is being released.