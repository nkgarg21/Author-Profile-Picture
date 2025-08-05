=== Author Profile Shortcodes ===
Contributors: yourname
Tags: author, profile, picture, shortcode, avatar
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Upload author profile pictures via WordPress media and display them with customizable shortcodes.

== Description ==

Author Profile Shortcodes allows authors to upload custom profile pictures and add social media links through the WordPress admin, then display them anywhere on your site using flexible shortcodes.

**Features:**

* Upload profile pictures via WordPress media library
* Display author names (first name, last name, display name) with shortcodes
* Display author biographical information with shortcodes
* Add social media links (Facebook, Twitter, LinkedIn) with Font Awesome icons
* Customizable shortcode with multiple options
* Automatic display on author archive pages and blog posts
* Rounded images with customizable borders
* Rounded social media icons with hover effects
* Responsive design
* Option to display author name with picture
* Admin panel shows shortcode usage examples

**Shortcode Usage:**

Author Information - Basic usage:
`[author_first_name]` `[author_last_name]` `[author_display_name]` `[author_bio]`

Author Information - With custom styling:
`[author_first_name class="custom-name" style="font-weight: bold;"]`
`[author_bio length="100" class="short-bio"]`

Profile Picture - Basic usage:
`[author_profile_pic]`

Profile Picture - With custom options:
`[author_profile_pic size="100" border_width="5" border_radius="25" border_color="#ff0000" show_name="true"]`

Social Links - Basic usage:
`[author_social_links]`

Social Links - With custom options:
`[author_social_links size="40" border_width="3" background_color="#333333" icon_color="#ffffff"]`

**Author Information Shortcode Parameters:**

* `author_id` - Specific author ID (auto-detected if not provided)
* `class` - Additional CSS class for custom styling
* `style` - Inline CSS styles
* `length` - Maximum character length for bio (bio shortcode only)

**Profile Picture Shortcode Parameters:**

* `author_id` - Specific author ID (auto-detected if not provided)
* `size` - Image size in pixels (default: 80)
* `border_width` - Border width in pixels (default: 3)
* `border_radius` - Border radius percentage (default: 50 for circle)
* `border_color` - Border color hex code (default: #ffffff)
* `class` - Additional CSS class
* `show_name` - Show author name (true/false, default: false)
* `name_position` - Name position: above, below, left, right (default: below)

**Social Links Shortcode Parameters:**

* `author_id` - Specific author ID (auto-detected if not provided)
* `size` - Icon size in pixels (default: 30)
* `border_width` - Border width in pixels (default: 2)
* `border_radius` - Border radius percentage (default: 50 for circle)
* `border_color` - Border color hex code (default: #ffffff)
* `background_color` - Background color hex code (default: #3498db)
* `icon_color` - Icon color hex code (default: #ffffff)
* `spacing` - Space between icons in pixels (default: 10)
* `class` - Additional CSS class

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/author-profile-shortcodes` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to Users > Your Profile to upload a profile picture and add social media links.
4. Use the shortcodes in your posts, pages, or templates.

== Frequently Asked Questions ==

= How do I upload a profile picture? =

Go to Users > Your Profile in your WordPress admin. Scroll down to the "Author Profile Picture" section and click "Upload Picture" to select an image from your media library. You can also add your social media links in the "Social Media Links" section.

= How do I add social media links? =

In your user profile, scroll down to the "Social Media Links" section and enter your Facebook, Twitter, and LinkedIn URLs. Only the platforms with URLs will be displayed.

= Can I use different sizes for different locations? =

Yes! Use the `size` parameter in both shortcodes: `[author_profile_pic size="120"]` or `[author_social_links size="40"]`

= How do I make the image square instead of round? =

Use `border_radius="0"` in the shortcode: `[author_profile_pic border_radius="0"]`

= Can I display the author's name with the picture? =

Yes! Use `show_name="true"`: `[author_profile_pic show_name="true" name_position="below"]`

= Can I customize the social media icon colors? =

Yes! Use the color parameters: `[author_social_links background_color="#333333" icon_color="#ffffff" border_color="#cccccc"]`

= Where can I see the shortcode usage examples? =

When editing your user profile, scroll down to see the "Shortcode Usage" section which shows all available shortcodes and parameters.

== Screenshots ==

1. User profile page with profile picture upload field
2. User profile page with social media links fields
3. Admin panel showing shortcode usage examples
4. Frontend display of author profile picture
5. Frontend display of social media icons
6. Combined display with profile picture and social links

== Changelog ==

= 1.0.0 =
* Initial release
* Profile picture upload functionality
* Social media links (Facebook, Twitter, LinkedIn)
* Font Awesome icons integration
* Customizable shortcode with multiple parameters
* Responsive design with hover effects
* Admin panel with shortcode usage examples

== Upgrade Notice ==

= 1.0.0 =
Initial release of Author Profile Shortcodes plugin with profile pictures and social media links.