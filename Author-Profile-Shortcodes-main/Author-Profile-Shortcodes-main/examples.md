# Author Profile Shortcodes - Usage Examples

## Author Information Examples

### Basic Author Information
```
[author_first_name]
[author_last_name]
[author_display_name]
[author_bio]
```
Display the author's first name, last name, display name, and biographical information.

### Custom Styled Names
```
[author_first_name style="font-weight: bold; color: #2c3e50;"]
[author_last_name class="surname" style="text-transform: uppercase;"]
[author_display_name class="author-title" style="font-size: 24px; color: #3498db;"]
```
Apply custom styling to author names.

### Truncated Bio
```
[author_bio length="150"]
[author_bio length="100" class="short-description" style="font-style: italic;"]
```
Display a shortened version of the author's bio.

### Specific Author Information
```
[author_first_name author_id="5"]
[author_bio author_id="3" length="200" class="team-member-bio"]
```
Display information for a specific author by ID.

## Profile Picture Examples

### Simple Profile Picture
```
[author_profile_pic]
```
Displays the current author's profile picture with default settings (80px, white border, circular).

### Custom Size
```
[author_profile_pic size="120"]
```
Displays a 120px profile picture.

### Square Image
```
[author_profile_pic border_radius="10"]
```
Creates a rounded square image instead of a circle.

### Colored Border
```
[author_profile_pic border_color="#3498db" border_width="5"]
```
Blue border with 5px width.

## Advanced Usage

### With Author Name
```
[author_profile_pic show_name="true" name_position="below"]
```
Shows the profile picture with the author's name below it.

### Horizontal Layout
```
[author_profile_pic show_name="true" name_position="right" size="60"]
```
Shows a smaller profile picture with the name to the right.

### Specific Author
```
[author_profile_pic author_id="5" size="100" show_name="true"]
```
Displays the profile picture for author with ID 5.

### Custom Styling
```
[author_profile_pic class="my-custom-author" size="150" border_width="0"]
```
Adds a custom CSS class for additional styling.

## Social Media Links Examples

### Basic Social Links
```
[author_social_links]
```
Displays social media icons with default settings (30px, white border, blue background).

### Custom Sized Icons
```
[author_social_links size="40"]
```
Displays 40px social media icons.

### Square Icons
```
[author_social_links border_radius="15"]
```
Creates rounded square icons instead of circles.

### Custom Colors
```
[author_social_links background_color="#333333" icon_color="#ffffff" border_color="#cccccc"]
```
Dark background with white icons and light gray border.

### Custom Spacing
```
[author_social_links spacing="20" size="35"]
```
Larger icons with more space between them.

### Specific Author Social Links
```
[author_social_links author_id="5" size="25" background_color="#e74c3c"]
```
Shows social links for author with ID 5 with red background.

## Combined Usage

### Complete Author Information Card
```html
<div class="author-info-card">
    [author_profile_pic size="80" show_name="false"]
    <h3>[author_display_name]</h3>
    <p><strong>[author_first_name] [author_last_name]</strong></p>
    [author_bio length="200" class="author-description"]
    [author_social_links size="25" spacing="10"]
</div>
```

### Author Byline
```html
<div class="author-byline">
    <span>By [author_first_name] [author_last_name]</span>
    [author_social_links size="20" spacing="8"]
</div>
```

### Profile Picture with Social Links
```
[author_profile_pic size="80" show_name="true" name_position="below"]
[author_social_links size="30" spacing="15"]
```
Shows profile picture with name, followed by social media icons.

### Horizontal Layout
```html
<div style="display: flex; align-items: center; gap: 20px;">
    [author_profile_pic size="60"]
    <div>
        <h3><?php echo get_the_author_meta('display_name'); ?></h3>
        [author_social_links size="25"]
    </div>
</div>
```

## Template Usage

### In Author Archive Template
```php
<?php
// In author.php template
echo do_shortcode('[author_profile_pic size="120" show_name="true" name_position="below"]');
echo do_shortcode('[author_social_links size="35" spacing="15"]');
?>
```

### In Single Post Template
```php
<?php
// In single.php template
echo do_shortcode('[author_profile_pic size="80" show_name="true" name_position="right"]');
echo do_shortcode('[author_social_links size="25"]');
?>
```

### In Widget or Sidebar
```php
<?php
// For specific author in sidebar
$author_id = get_the_author_meta('ID');
echo do_shortcode('[author_profile_pic author_id="' . $author_id . '" size="100"]');
echo do_shortcode('[author_social_links author_id="' . $author_id . '" size="30"]');
?>
```

## CSS Customization

You can add custom CSS to further style the profile pictures:

```css
/* Custom styling for profile pictures */
.my-custom-author img {
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.my-custom-author img:hover {
    transform: scale(1.1) rotate(5deg);
}

/* Style the author name */
.author-profile-container .author-name {
    font-family: 'Georgia', serif;
    font-size: 18px;
    color: #2c3e50;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Custom social media styling */
.my-social-links a {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.my-social-links a:hover {
    transform: scale(1.2) rotate(10deg);
}

/* Brand-specific hover colors */
.author-social-links a.facebook:hover {
    background-color: #1877f2 !important;
}

.author-social-links a.twitter:hover {
    background-color: #1da1f2 !important;
}

.author-social-links a.linkedin:hover {
    background-color: #0077b5 !important;
}
```

## Common Use Cases

### Author Bio Box
```html
<div class="author-bio">
    [author_profile_pic size="80" show_name="true" name_position="left"]
    [author_social_links size="25" spacing="10"]
    <p>Author bio text goes here...</p>
</div>
```

### Team Page
```html
<div class="team-member">
    [author_profile_pic author_id="3" size="150" show_name="true" border_radius="15"]
    <h3>Job Title</h3>
    [author_social_links author_id="3" size="30" background_color="#2c3e50"]
    <p>Member description...</p>
</div>
```

### Author Card
```html
<div class="author-card" style="text-align: center; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
    [author_profile_pic size="100" border_width="4" border_color="#3498db"]
    <h3 style="margin: 15px 0 5px 0;">[author_display_name]</h3>
    <p style="color: #666; margin-bottom: 15px;">[author_bio length="150"]</p>
    [author_social_links size="30" spacing="15" background_color="#3498db"]
</div>
```

### Comment Author Enhancement
```php
// In comments template
$comment_author_id = get_comment_meta($comment->comment_ID, 'user_id', true);
if ($comment_author_id) {
    echo do_shortcode('[author_profile_pic author_id="' . $comment_author_id . '" size="40"]');
    echo do_shortcode('[author_social_links author_id="' . $comment_author_id . '" size="20"]');
}
```

## Profile Picture Parameters Reference

| Parameter | Default | Description | Example |
|-----------|---------|-------------|---------|
| `author_id` | auto-detect | Specific author ID | `author_id="5"` |
| `size` | 80 | Image size in pixels | `size="120"` |
| `border_width` | 3 | Border width in pixels | `border_width="5"` |
| `border_radius` | 50 | Border radius percentage | `border_radius="25"` |
| `border_color` | #ffffff | Border color hex code | `border_color="#ff0000"` |
| `class` | empty | Additional CSS class | `class="my-style"` |
| `show_name` | false | Show author name | `show_name="true"` |
| `name_position` | below | Name position | `name_position="right"` |

## Author Information Parameters Reference

| Parameter | Default | Description | Example |
|-----------|---------|-------------|---------|
| `author_id` | auto-detect | Specific author ID | `author_id="5"` |
| `class` | empty | Additional CSS class | `class="custom-name"` |
| `style` | empty | Inline CSS styles | `style="color: #333;"` |
| `length` | unlimited | Max character length (bio only) | `length="150"` |

## Social Links Parameters Reference

| Parameter | Default | Description | Example |
|-----------|---------|-------------|---------|
| `author_id` | auto-detect | Specific author ID | `author_id="5"` |
| `size` | 30 | Icon size in pixels | `size="40"` |
| `border_width` | 2 | Border width in pixels | `border_width="3"` |
| `border_radius` | 50 | Border radius percentage | `border_radius="25"` |
| `border_color` | #ffffff | Border color hex code | `border_color="#cccccc"` |
| `background_color` | #3498db | Background color hex code | `background_color="#333333"` |
| `icon_color` | #ffffff | Icon color hex code | `icon_color="#ffffff"` |
| `spacing` | 10 | Space between icons in pixels | `spacing="15"` |
| `class` | empty | Additional CSS class | `class="my-social"` |

## Tips

1. **Auto-Detection**: The plugin automatically detects the current author on author pages and single posts, so you don't need to specify `author_id` in most cases.

2. **Responsive**: Use percentage-based sizes in your CSS for responsive designs.

3. **Fallback**: If no profile picture is uploaded or no social links are added, the shortcodes return empty content, so they won't break your layout.

4. **Font Awesome**: The plugin automatically loads Font Awesome 6.4.0 from CDN for the social media icons.

5. **Accessibility**: All social media links include proper title attributes and open in new tabs with security attributes.

6. **Performance**: Profile pictures are served from WordPress media library, so they benefit from any caching plugins you have installed.

7. **Customization**: Use the `class` parameter to add your own CSS classes for advanced styling.