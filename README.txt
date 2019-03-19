=== Simple Ajax Search ===
Contributors: sumapress, pablocianes
Donate link: https://pablocianes.com
Tags: search, search engine, ajax, blog, seeker
Requires at least: 4.6
Tested up to: 5.1
Stable tag: trunk
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily create a dynamic ajax search engine for your blog.

== Description ==

With this plugin you can create very easily a dynamic ajax search engine of your blog.

For setup this search engine use the followings `[shortcodes]`:

== [sas-input] ==

Write this shortcode where you want the input components for the dynamic search, and you get:
* One input field where write words to search into the blog with WordPress engine.
* Several categories to filter the search depending what you checked. By default all checked.

If you want you have some attributes to customize this shortcode:
* `[sas-input blank="true"]` if you want to open in new window each link of the results. It's false by default.
* `[sas-input dashicons="dashicons-admin-post"]` this is an example to change the icon of each link.
* `[sas-input headings="#29AAE3"]` this is the color by default for headings, but you can put here what you want.
* `[sas-input checked="#F8931F"]` this is the color by default for checked categories to filter the search.
* `[sas-input unchecked="#ccc"]` this is the color by default for unchecked categories to filter the search.
* `[sas-input not_found="Sorry but there are no results for your search."]` put here the text you want to show when there are no results.

Also you can change the placeholder of the input field with the content of the shortcode. This is the value by default:
* `[sas-input]Write here your search...[/sas-input]`

An example: `[sas-input blank="true" dashicons="dashicons-welcome-write-blog" headings="#ccc"]Write here...[/sas-input]`

Note: [Code of dashicons](https://developer.wordpress.org/resource/dashicons)

== [sas-result] ==

With this one the plugin show the output of the search in real time with the ajax engine. You can see the structure of this in the screenshots.

You don't need put for this shortcode any attribute, but could be you want to add some aditional css for the best integration with your theme.


**In summary** just put **`[sas-input]`** where you want the input for the search, and put **`[sas-result]`** where you want the results. You will usually put them together, but you can decide how, like use a conditional widget into a sidebar for the first one.

== Installation ==

1. Upload the plugin files to the **`/wp-content/plugins/`** directory, or into admin area of WordPress visit **`Plugins -> Add New`** and search **`Simple ajax search`**.
2. Install & Activate the plugin through the **`Plugins' page`** in WordPress.
3. After the plugin is activated you can use the shortcodes **`[sas-input]` & `[sas-result]`** in the same page or for example the first one in a condicitional widget in a sidebar an the other one inside one page for show the results.

== Frequently Asked Questions ==

= What can I do with this plugin? =

You can create very easily a dynamic ajax search engine of your blog. Just use the [shortcodes] of this plugin.

= How do I setup this plugin? =

Just put **`[sas-input]`** where you want the input for the search, and put **`[sas-result]`** where you want the results. You will usually put them together, but you can decide how, like use a conditional widget into a sidebar for the first one.

== Screenshots ==

1. Both shortcodes together in the same page.
2. One shortcode in conditional widget and the other one into a page.

== Changelog ==

= 1.0.0 =
* First publicly available version.

== Upgrade Notice ==

= 1.0.0 =
* First publicly available version.

== Feedback and support ==

I would be happy to receive your feedback to improve this plugin.
Please let me know through [support forums](https://wordpress.org/support/plugin/simple-ajax-search) if you like it and please be sure to [leave a review.](https://wordpress.org/support/plugin/simple-ajax-search/reviews/#new-post).

Also you can contact me on my personal page [Pablo Cianes](https://pablocianes.com/) or even visit [Github of Simple Ajax Search](https://github.com/PCianes/simple-ajax-search) where you can find all the development code of this plugin.

I hope it is useful for you and look forward to reading your reviews! ;-) Thanks!
