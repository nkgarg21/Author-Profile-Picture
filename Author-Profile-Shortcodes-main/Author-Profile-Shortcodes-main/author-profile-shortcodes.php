<?php
/**
 * Plugin Name: Author Profile Shortcodes
 * Plugin URI: https://example.com/author-profile-shortcodes
 * Description: Upload author profile pictures via WordPress media and display them with customizable shortcodes on author archive pages and blog posts.
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 * Text Domain: author-profile-shortcodes
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class AuthorProfileShortcodes {
    
    private $plugin_url;
    private $plugin_path;
    
    public function __construct() {
        $this->plugin_url = plugin_dir_url(__FILE__);
        $this->plugin_path = plugin_dir_path(__FILE__);
        
        add_action('init', array($this, 'init'));
    }
    
    public function init() {
        // Add user profile fields
        add_action('show_user_profile', array($this, 'add_profile_picture_field'));
        add_action('edit_user_profile', array($this, 'add_profile_picture_field'));
        
        // Save user profile fields
        add_action('personal_options_update', array($this, 'save_profile_picture_field'));
        add_action('edit_user_profile_update', array($this, 'save_profile_picture_field'));
        
        // Register shortcode
        add_shortcode('author_profile_pic', array($this, 'author_profile_pic_shortcode'));
        add_shortcode('author_social_links', array($this, 'author_social_links_shortcode'));
        add_shortcode('author_first_name', array($this, 'author_first_name_shortcode'));
        add_shortcode('author_last_name', array($this, 'author_last_name_shortcode'));
        add_shortcode('author_bio', array($this, 'author_bio_shortcode'));
        add_shortcode('author_display_name', array($this, 'author_display_name_shortcode'));
        
        // Enqueue admin scripts
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        
        // Add CSS for frontend
        add_action('wp_head', array($this, 'add_frontend_styles'));
        
        // Enqueue Font Awesome
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_scripts'));
    }
    
    /**
     * Add profile picture field to user profile page
     */
    public function add_profile_picture_field($user) {
        $profile_picture_id = get_user_meta($user->ID, 'profile_picture_id', true);
        $profile_picture_url = '';
        
        if ($profile_picture_id) {
            $profile_picture_url = wp_get_attachment_image_url($profile_picture_id, 'medium');
        }
        
        // Get social media links
        $facebook_url = get_user_meta($user->ID, 'facebook_url', true);
        $twitter_url = get_user_meta($user->ID, 'twitter_url', true);
        $linkedin_url = get_user_meta($user->ID, 'linkedin_url', true);
        ?>
        <h3><?php _e('Author Profile Picture', 'author-profile-shortcodes'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="profile_picture"><?php _e('Profile Picture', 'author-profile-shortcodes'); ?></label></th>
                <td>
                    <div id="profile-picture-container">
                        <?php if ($profile_picture_url): ?>
                            <img src="<?php echo esc_url($profile_picture_url); ?>" style="max-width: 150px; height: auto; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);" />
                        <?php endif; ?>
                    </div>
                    <input type="hidden" id="profile_picture_id" name="profile_picture_id" value="<?php echo esc_attr($profile_picture_id); ?>" />
                    <button type="button" class="button" id="upload_profile_picture_button">
                        <?php echo $profile_picture_id ? __('Change Picture', 'author-profile-shortcodes') : __('Upload Picture', 'author-profile-shortcodes'); ?>
                    </button>
                    <?php if ($profile_picture_id): ?>
                        <button type="button" class="button" id="remove_profile_picture_button"><?php _e('Remove Picture', 'author-profile-shortcodes'); ?></button>
                    <?php endif; ?>
                    <p class="description"><?php _e('Upload a profile picture that will be displayed with the [author_profile_pic] shortcode.', 'author-profile-shortcodes'); ?></p>
                </td>
            </tr>
        </table>
        
        <h3><?php _e('Social Media Links', 'author-profile-shortcodes'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="facebook_url"><?php _e('Facebook URL', 'author-profile-shortcodes'); ?></label></th>
                <td>
                    <input type="url" id="facebook_url" name="facebook_url" value="<?php echo esc_attr($facebook_url); ?>" class="regular-text" />
                    <p class="description"><?php _e('Enter your Facebook profile or page URL.', 'author-profile-shortcodes'); ?></p>
                </td>
            </tr>
            <tr>
                <th><label for="twitter_url"><?php _e('Twitter URL', 'author-profile-shortcodes'); ?></label></th>
                <td>
                    <input type="url" id="twitter_url" name="twitter_url" value="<?php echo esc_attr($twitter_url); ?>" class="regular-text" />
                    <p class="description"><?php _e('Enter your Twitter profile URL.', 'author-profile-shortcodes'); ?></p>
                </td>
            </tr>
            <tr>
                <th><label for="linkedin_url"><?php _e('LinkedIn URL', 'author-profile-shortcodes'); ?></label></th>
                <td>
                    <input type="url" id="linkedin_url" name="linkedin_url" value="<?php echo esc_attr($linkedin_url); ?>" class="regular-text" />
                    <p class="description"><?php _e('Enter your LinkedIn profile URL.', 'author-profile-shortcodes'); ?></p>
                </td>
            </tr>
        </table>
        
        <h3><?php _e('Shortcode Usage', 'author-profile-shortcodes'); ?></h3>
        <div style="background: #f9f9f9; padding: 15px; border-left: 4px solid #0073aa; margin: 20px 0;">
            <h4><?php _e('Author Information Shortcodes:', 'author-profile-shortcodes'); ?></h4>
            <p><strong><?php _e('Display author names and bio:', 'author-profile-shortcodes'); ?></strong></p>
            <code>[author_first_name]</code> - <?php _e('Display author first name', 'author-profile-shortcodes'); ?><br>
            <code>[author_last_name]</code> - <?php _e('Display author last name', 'author-profile-shortcodes'); ?><br>
            <code>[author_display_name]</code> - <?php _e('Display author display name', 'author-profile-shortcodes'); ?><br>
            <code>[author_bio]</code> - <?php _e('Display author biographical info', 'author-profile-shortcodes'); ?><br><br>
            
            <p><strong><?php _e('With custom styling:', 'author-profile-shortcodes'); ?></strong></p>
            <code>[author_first_name class="custom-name" style="color: #333; font-weight: bold;"]</code><br>
            <code>[author_bio class="author-description" style="font-style: italic; color: #666;"]</code><br><br>
            
            <h4><?php _e('Profile Picture Shortcode:', 'author-profile-shortcodes'); ?></h4>
            <p><strong><?php _e('Basic usage:', 'author-profile-shortcodes'); ?></strong></p>
            <code>[author_profile_pic]</code>
            
            <p><strong><?php _e('With all options:', 'author-profile-shortcodes'); ?></strong></p>
            <code>[author_profile_pic size="100" border_width="5" border_radius="25" border_color="#ff0000" show_name="true" name_position="below" class="my-custom-class"]</code>
            
            <h4><?php _e('Social Links Shortcode:', 'author-profile-shortcodes'); ?></h4>
            <p><strong><?php _e('Basic usage:', 'author-profile-shortcodes'); ?></strong></p>
            <code>[author_social_links]</code>
            
            <p><strong><?php _e('With all options:', 'author-profile-shortcodes'); ?></strong></p>
            <code>[author_social_links size="30" border_width="2" border_radius="50" border_color="#ffffff" background_color="#3498db" icon_color="#ffffff" spacing="10" class="my-social-links"]</code>
            
            <h4><?php _e('Available Parameters:', 'author-profile-shortcodes'); ?></h4>
            <ul style="margin-left: 20px;">
                <li><strong>author_id:</strong> <?php _e('Specific author ID (auto-detected if not provided)', 'author-profile-shortcodes'); ?></li>
                <li><strong>class:</strong> <?php _e('Additional CSS class for custom styling', 'author-profile-shortcodes'); ?></li>
                <li><strong>style:</strong> <?php _e('Inline CSS styles', 'author-profile-shortcodes'); ?></li>
            </ul>
            
            <h4><?php _e('Profile Picture & Social Links Parameters:', 'author-profile-shortcodes'); ?></h4>
            <ul style="margin-left: 20px;">
                <li><strong>size:</strong> <?php _e('Icon/image size in pixels', 'author-profile-shortcodes'); ?></li>
                <li><strong>border_width:</strong> <?php _e('Border width in pixels', 'author-profile-shortcodes'); ?></li>
                <li><strong>border_radius:</strong> <?php _e('Border radius percentage (0-50)', 'author-profile-shortcodes'); ?></li>
                <li><strong>border_color:</strong> <?php _e('Border color hex code', 'author-profile-shortcodes'); ?></li>
                <li><strong>background_color:</strong> <?php _e('Background color hex code (social links only)', 'author-profile-shortcodes'); ?></li>
                <li><strong>icon_color:</strong> <?php _e('Icon color hex code (social links only)', 'author-profile-shortcodes'); ?></li>
                <li><strong>spacing:</strong> <?php _e('Space between icons in pixels (social links only)', 'author-profile-shortcodes'); ?></li>
                <li><strong>class:</strong> <?php _e('Additional CSS class', 'author-profile-shortcodes'); ?></li>
            </ul>
            
            <h4><?php _e('Complete Author Card Example:', 'author-profile-shortcodes'); ?></h4>
            <div style="background: #fff; padding: 10px; border: 1px solid #ddd; margin: 10px 0;">
                <code style="display: block; white-space: pre-wrap;">&lt;div class="author-card"&gt;
    [author_profile_pic size="100" show_name="false"]
    &lt;h3&gt;[author_display_name]&lt;/h3&gt;
    &lt;p&gt;&lt;strong&gt;[author_first_name] [author_last_name]&lt;/strong&gt;&lt;/p&gt;
    [author_bio class="author-description"]
    [author_social_links size="30" spacing="15"]
&lt;/div&gt;</code>
            </div>
        </div>
        <?php
    }
    
    /**
     * Save profile fields
     */
    public function save_profile_picture_field($user_id) {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }
        
        if (isset($_POST['profile_picture_id'])) {
            update_user_meta($user_id, 'profile_picture_id', sanitize_text_field($_POST['profile_picture_id']));
        }
        
        // Save social media links
        if (isset($_POST['facebook_url'])) {
            update_user_meta($user_id, 'facebook_url', esc_url_raw($_POST['facebook_url']));
        }
        if (isset($_POST['twitter_url'])) {
            update_user_meta($user_id, 'twitter_url', esc_url_raw($_POST['twitter_url']));
        }
        if (isset($_POST['linkedin_url'])) {
            update_user_meta($user_id, 'linkedin_url', esc_url_raw($_POST['linkedin_url']));
        }
    }
    
    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts($hook) {
        if ($hook !== 'profile.php' && $hook !== 'user-edit.php') {
            return;
        }
        
        wp_enqueue_media();
        wp_enqueue_script(
            'author-profile-admin',
            $this->plugin_url . 'assets/admin.js',
            array('jquery'),
            '1.0.0',
            true
        );
    }
    
    /**
     * Enqueue frontend scripts
     */
    public function enqueue_frontend_scripts() {
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
            array(),
            '6.4.0'
        );
    }
    
    /**
     * Author profile picture shortcode
     */
    public function author_profile_pic_shortcode($atts) {
        $atts = shortcode_atts(array(
            'author_id' => '',
            'size' => '80',
            'border_width' => '3',
            'border_radius' => '50',
            'border_color' => '#ffffff',
            'class' => '',
            'show_name' => 'false',
            'name_position' => 'below'
        ), $atts, 'author_profile_pic');
        
        // Get author ID
        $author_id = $atts['author_id'];
        if (empty($author_id)) {
            if (is_author()) {
                $author_id = get_queried_object_id();
            } elseif (is_single()) {
                $author_id = get_the_author_meta('ID');
            } else {
                return '';
            }
        }
        
        // Get profile picture
        $profile_picture_id = get_user_meta($author_id, 'profile_picture_id', true);
        if (!$profile_picture_id) {
            return '';
        }
        
        $profile_picture_url = wp_get_attachment_image_url($profile_picture_id, 'full');
        if (!$profile_picture_url) {
            return '';
        }
        
        // Sanitize attributes
        $size = intval($atts['size']);
        $border_width = intval($atts['border_width']);
        $border_radius = intval($atts['border_radius']);
        $border_color = sanitize_hex_color($atts['border_color']);
        $class = sanitize_html_class($atts['class']);
        $show_name = $atts['show_name'] === 'true';
        $name_position = in_array($atts['name_position'], array('above', 'below', 'left', 'right')) ? $atts['name_position'] : 'below';
        
        // Generate unique ID for this instance
        $unique_id = 'author-profile-' . uniqid();
        
        // Build CSS
        $css = "
        #{$unique_id} {
            display: inline-block;
            text-align: center;
        }
        #{$unique_id} img {
            width: {$size}px;
            height: {$size}px;
            border: {$border_width}px solid {$border_color};
            border-radius: {$border_radius}%;
            object-fit: cover;
            display: block;
        }
        #{$unique_id}.name-left,
        #{$unique_id}.name-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        #{$unique_id}.name-left {
            flex-direction: row-reverse;
        }
        #{$unique_id} .author-name {
            font-weight: 600;
            color: #333;
            margin: 5px 0;
        }
        ";
        
        // Get author name
        $author_name = get_the_author_meta('display_name', $author_id);
        
        // Build HTML
        $html = "<style>{$css}</style>";
        
        $container_class = 'author-profile-container';
        if ($class) {
            $container_class .= ' ' . $class;
        }
        if ($show_name) {
            $container_class .= ' name-' . $name_position;
        }
        
        $html .= "<div id='{$unique_id}' class='{$container_class}'>";
        
        if ($show_name && $name_position === 'above') {
            $html .= "<div class='author-name'>{$author_name}</div>";
        }
        
        $html .= "<img src='" . esc_url($profile_picture_url) . "' alt='" . esc_attr($author_name) . "' />";
        
        if ($show_name && in_array($name_position, array('below', 'left', 'right'))) {
            $html .= "<div class='author-name'>{$author_name}</div>";
        }
        
        $html .= "</div>";
        
        return $html;
    }
    
    /**
     * Author social links shortcode
     */
    public function author_social_links_shortcode($atts) {
        $atts = shortcode_atts(array(
            'author_id' => '',
            'size' => '30',
            'border_width' => '2',
            'border_radius' => '50',
            'border_color' => '#ffffff',
            'background_color' => '#3498db',
            'icon_color' => '#ffffff',
            'spacing' => '10',
            'class' => ''
        ), $atts, 'author_social_links');
        
        // Get author ID
        $author_id = $atts['author_id'];
        if (empty($author_id)) {
            if (is_author()) {
                $author_id = get_queried_object_id();
            } elseif (is_single()) {
                $author_id = get_the_author_meta('ID');
            } else {
                return '';
            }
        }
        
        // Get social media links
        $facebook_url = get_user_meta($author_id, 'facebook_url', true);
        $twitter_url = get_user_meta($author_id, 'twitter_url', true);
        $linkedin_url = get_user_meta($author_id, 'linkedin_url', true);
        
        // If no social links, return empty
        if (empty($facebook_url) && empty($twitter_url) && empty($linkedin_url)) {
            return '';
        }
        
        // Sanitize attributes
        $size = intval($atts['size']);
        $border_width = intval($atts['border_width']);
        $border_radius = intval($atts['border_radius']);
        $border_color = sanitize_hex_color($atts['border_color']);
        $background_color = sanitize_hex_color($atts['background_color']);
        $icon_color = sanitize_hex_color($atts['icon_color']);
        $spacing = intval($atts['spacing']);
        $class = sanitize_html_class($atts['class']);
        
        // Generate unique ID for this instance
        $unique_id = 'author-social-' . uniqid();
        
        // Build CSS
        $css = "
        #{$unique_id} {
            display: flex;
            gap: {$spacing}px;
            align-items: center;
        }
        #{$unique_id} a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: {$size}px;
            height: {$size}px;
            background-color: {$background_color};
            border: {$border_width}px solid {$border_color};
            border-radius: {$border_radius}%;
            color: {$icon_color};
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: " . ($size * 0.5) . "px;
        }
        #{$unique_id} a:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        #{$unique_id} a.facebook:hover {
            background-color: #1877f2;
        }
        #{$unique_id} a.twitter:hover {
            background-color: #1da1f2;
        }
        #{$unique_id} a.linkedin:hover {
            background-color: #0077b5;
        }
        ";
        
        // Build HTML
        $html = "<style>{$css}</style>";
        
        $container_class = 'author-social-links';
        if ($class) {
            $container_class .= ' ' . $class;
        }
        
        $html .= "<div id='{$unique_id}' class='{$container_class}'>";
        
        // Facebook link
        if (!empty($facebook_url)) {
            $html .= "<a href='" . esc_url($facebook_url) . "' target='_blank' rel='noopener noreferrer' class='facebook' title='Facebook'>";
            $html .= "<i class='fab fa-facebook-f'></i>";
            $html .= "</a>";
        }
        
        // Twitter link
        if (!empty($twitter_url)) {
            $html .= "<a href='" . esc_url($twitter_url) . "' target='_blank' rel='noopener noreferrer' class='twitter' title='Twitter'>";
            $html .= "<i class='fab fa-twitter'></i>";
            $html .= "</a>";
        }
        
        // LinkedIn link
        if (!empty($linkedin_url)) {
            $html .= "<a href='" . esc_url($linkedin_url) . "' target='_blank' rel='noopener noreferrer' class='linkedin' title='LinkedIn'>";
            $html .= "<i class='fab fa-linkedin-in'></i>";
            $html .= "</a>";
        }
        
        $html .= "</div>";
        
        return $html;
    }
    
    /**
     * Author first name shortcode
     */
    public function author_first_name_shortcode($atts) {
        $atts = shortcode_atts(array(
            'author_id' => '',
            'class' => '',
            'style' => ''
        ), $atts, 'author_first_name');
        
        // Get author ID
        $author_id = $atts['author_id'];
        if (empty($author_id)) {
            if (is_author()) {
                $author_id = get_queried_object_id();
            } elseif (is_single()) {
                $author_id = get_the_author_meta('ID');
            } else {
                return '';
            }
        }
        
        $first_name = get_the_author_meta('first_name', $author_id);
        if (empty($first_name)) {
            return '';
        }
        
        // Sanitize attributes
        $class = sanitize_html_class($atts['class']);
        $style = esc_attr($atts['style']);
        
        // Build HTML
        $html = '<span class="author-first-name';
        if ($class) {
            $html .= ' ' . $class;
        }
        $html .= '"';
        if ($style) {
            $html .= ' style="' . $style . '"';
        }
        $html .= '>' . esc_html($first_name) . '</span>';
        
        return $html;
    }
    
    /**
     * Author last name shortcode
     */
    public function author_last_name_shortcode($atts) {
        $atts = shortcode_atts(array(
            'author_id' => '',
            'class' => '',
            'style' => ''
        ), $atts, 'author_last_name');
        
        // Get author ID
        $author_id = $atts['author_id'];
        if (empty($author_id)) {
            if (is_author()) {
                $author_id = get_queried_object_id();
            } elseif (is_single()) {
                $author_id = get_the_author_meta('ID');
            } else {
                return '';
            }
        }
        
        $last_name = get_the_author_meta('last_name', $author_id);
        if (empty($last_name)) {
            return '';
        }
        
        // Sanitize attributes
        $class = sanitize_html_class($atts['class']);
        $style = esc_attr($atts['style']);
        
        // Build HTML
        $html = '<span class="author-last-name';
        if ($class) {
            $html .= ' ' . $class;
        }
        $html .= '"';
        if ($style) {
            $html .= ' style="' . $style . '"';
        }
        $html .= '>' . esc_html($last_name) . '</span>';
        
        return $html;
    }
    
    /**
     * Author display name shortcode
     */
    public function author_display_name_shortcode($atts) {
        $atts = shortcode_atts(array(
            'author_id' => '',
            'class' => '',
            'style' => ''
        ), $atts, 'author_display_name');
        
        // Get author ID
        $author_id = $atts['author_id'];
        if (empty($author_id)) {
            if (is_author()) {
                $author_id = get_queried_object_id();
            } elseif (is_single()) {
                $author_id = get_the_author_meta('ID');
            } else {
                return '';
            }
        }
        
        $display_name = get_the_author_meta('display_name', $author_id);
        if (empty($display_name)) {
            return '';
        }
        
        // Sanitize attributes
        $class = sanitize_html_class($atts['class']);
        $style = esc_attr($atts['style']);
        
        // Build HTML
        $html = '<span class="author-display-name';
        if ($class) {
            $html .= ' ' . $class;
        }
        $html .= '"';
        if ($style) {
            $html .= ' style="' . $style . '"';
        }
        $html .= '>' . esc_html($display_name) . '</span>';
        
        return $html;
    }
    
    /**
     * Author bio shortcode
     */
    public function author_bio_shortcode($atts) {
        $atts = shortcode_atts(array(
            'author_id' => '',
            'class' => '',
            'style' => '',
            'length' => ''
        ), $atts, 'author_bio');
        
        // Get author ID
        $author_id = $atts['author_id'];
        if (empty($author_id)) {
            if (is_author()) {
                $author_id = get_queried_object_id();
            } elseif (is_single()) {
                $author_id = get_the_author_meta('ID');
            } else {
                return '';
            }
        }
        
        $bio = get_the_author_meta('description', $author_id);
        if (empty($bio)) {
            return '';
        }
        
        // Truncate bio if length is specified
        if (!empty($atts['length']) && is_numeric($atts['length'])) {
            $length = intval($atts['length']);
            if (strlen($bio) > $length) {
                $bio = substr($bio, 0, $length) . '...';
            }
        }
        
        // Sanitize attributes
        $class = sanitize_html_class($atts['class']);
        $style = esc_attr($atts['style']);
        
        // Build HTML
        $html = '<div class="author-bio';
        if ($class) {
            $html .= ' ' . $class;
        }
        $html .= '"';
        if ($style) {
            $html .= ' style="' . $style . '"';
        }
        $html .= '>' . wp_kses_post($bio) . '</div>';
        
        return $html;
    }
    
    /**
     * Add frontend styles
     */
    public function add_frontend_styles() {
        echo "<style>
        .author-profile-container {
            margin: 10px 0;
        }
        .author-profile-container img {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .author-profile-container img:hover {
            transform: scale(1.05);
        }
        .author-social-links {
            margin: 10px 0;
        }
        .author-first-name,
        .author-last-name,
        .author-display-name {
            display: inline;
        }
        .author-bio {
            margin: 10px 0;
            line-height: 1.6;
        }
        </style>";
    }
}

// Initialize the plugin
new AuthorProfileShortcodes();