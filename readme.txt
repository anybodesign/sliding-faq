=== AD Sliding FAQ ===
Contributors: anybodesign, bizingreclaire, thierrypigot, sebastienserre
Tags: faq, faq plugin, faqs, wordpress faq, frequently asked questions, accordion
Requires at least: 4.0
Tested up to: 5.4
Stable tag: 2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Create a nice and accessible accordion FAQ section with sliding Q/A.


== Description ==

AD Sliding FAQ creates a custom post type in order to create your FAQ. Once your FAQ posts are created you can add the FAQ in a page or a post with a shortcode, or in a template with a function. This plugin has been created with accessibility in mind.


= How-To =

To display your FAQ use the shortcode [sliding_faq] in a page or a post. By default, the questions are wrapped inside a *H2* HTML tag.
If you want to have *H3* instead, just add the attribute *heading* to the shortcode, for example: `[sliding_faq heading='h3']`.
You can create different topics for your FAQ using the custom taxonomy *FAQ Topics*, this way you can display multiple FAQ. To do so, add the *topic* attribute to the shortcode with the name of your topic(s), for example: `[sliding_faq topic='Accessibility, SEO']`.
You can of course use both attributes: `[sliding_faq heading='h3' topic='Accessibility']`.
Featured images are now supported and the default size is 'thumbnail'. You can choose other dimensions size with the 'size' attribute: `[sliding_faq size='large']`. The attribute will support *thumbnail, medium, large* and *full* or any custom size. (Note that you'll have to customize the CSS if you want to display a large image.)


= Translations = 

You can translate AD Sliding FAQ on [translate.wordpress.org](https://translate.wordpress.org).


= To-Do = 

* Turn the shortcode to a block
* Add Widget Support


== Installation ==

* Download the zip archive and upload it to your WordPress site. 
* Activate the plugin, then you will notice a new FAQ section in your dashboard. 
* Start creating your FAQ!


== Frequently Asked Questions ==

= How can I display my FAQ? =

To display your FAQ, just add the shortcode `[sliding_faq]` in a post or a page! Use the *heading* attribute to select the heading level, for example: `[sliding_faq heading='h3']`. Use the *topic* attribute to display multiple FAQ, for example: `[sliding_faq topic='Accessibility, SEO']`.

= Can I use a function directly in one of my theme templates to display my FAQ? =

Sure, you can use the function `<?php sliding_faq(); ?>` in your theme templates. As for the shortcode, you can choose the heading level you want instead of *h2* for the questions, for example: `<?php sliding_faq('h3'); ?>`, and you can choose a FAQ topic: `<?php sliding_faq('h3','Accessibility'); ?>`


== Screenshots ==

1. FAQ List View
2. FAQ Editor View
3. The FAQ on a page
4. The Shortcode attributes


== Changelog ==

= 2.4 - 2020-04-22 =
* New editor support
* Hierarchical topics
* Bugfix: first faq output

= 2.3 - 2018-07-22 =
* Load JS only if the shortcode is on the page
* Featured image support
* CPT custom title and column

= 2.2 - 2018-04-13 =
* Add the possibility to display several topics in one shortcode (thanks to Sébastien Serre)

= 2.1 - 2018-04-04 =
* A11y: Arrow sign on the button instead of the title

= 2.0 - 2018-03-29 =
* Taxonomy support
* Topic shortcode attribute
* New screenshot

= 1.9.1 - 2018-03-28 =
* Add cap for administrators :)

= 1.9 - 2018-03-28 =
* Capabilities added (thanks to Thierry Pigot)

= 1.8 - 2017-11-24 =
* Bugfix: output all the FAQs
* WordPress 4.9 ready

= 1.7 - 2017-07-06 =
* Accessibility improvements with aria-hidden and aria-controls attributes (thanks to Claire Bizingre)
* SEO improvements with new HTML markup (headings)
* Shortcode heading attribute

= 1.6.6 - 2017-07-02 =
* French Translation Completed

= 1.6.5 - 2017-06-29 =
* WP repository submission

= 1.6 - 2017-06-08 =
* Auto-update via GitHub
* Button styles

= 1.5 - 2017-06-07 =
* Auto-update
* Changelog
* Text domain fix

= 1.4 - 2017-06-02 =
* Accessibility improvements

= 1.3 - 2016-10-12 =
* JS improvements

= 1.2 - 2015-11-12 =
* Text domain fix

= 1.1 - 2015-10-02 =
* Add page attributes support for the FAQ 

= 1.0 - 2015-06-30 =
* Initial Commit


== Upgrade Notice ==

= 2.3 =
Add the possibility to display a featured image, and only load the JS on the pages where the shortcode is inserted

= 2.2 =
Add possibility to display several topics in one shortcode

= 1.7 =
Accessibility and SEO improvements. 