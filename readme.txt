=== Analytics Events for Tawkto Chat ===
Contributors: garubi
Donate link: https://paypal.me/StefanoGaruti
Tags: chat, tawkto, analytics
Requires at least: 4.5
Tested up to: 5.4.2
Requires PHP: 7.3.2
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Send an event to Google Analytics when a visitor interacts with the Tawkto Chat widget.

== Description ==

This plugin sends an Event to Google Analytics if the visitors chat for at least 60 seconds, or if he submit the "Chat Offline Form"

This plugins requires that on your site is active a Tawk.to chat widget. The easyest way to install a Tawk.to Chat on your site is by the [official Tawk.to WordPress plugin](https://it.wordpress.org/plugins/tawkto-live-chat/) but you can copy-paste the widget code from Tawk.to dashboard too.

This plugin supports automatic updates via [GitHub Updater plugin](https://github.com/afragen/github-updater)

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0.1 =
* Fix sending the event onOfflineSubmit

= 1.0 =
* First relase

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](https://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: https://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
