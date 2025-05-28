<?php 
// Theme support and custom menu registration
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

register_nav_menus( array(
    'header' => 'Custom Primary Menu',
  ) );

// Custom Menu Register
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' ),
     )
   );
 }
add_action( 'init', 'register_my_menus' );

// Get ACF Options via API
// add_action("rest_api_init", function () {
//   register_rest_route("options", "/all", [
//     "methods" => "GET",
//     "callback" => "acf_options_route",
//   ]);
// });

// function acf_options_route() {
//   return get_fields('options');
// };

 // Add Custom CSS & Scripts
function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style('globals', get_template_directory_uri() . '/dist/style.css', array(), '1.0.0', 'all');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

// Add tailwind classes to active menu item
add_filter('nav_menu_css_class' , 'tailwind_active_menu_item' , 10 , 2);

function tailwind_active_menu_item ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}
// Gsap Animation Library
// wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
function theme_gsap_script(){
  // The core GSAP library
  wp_enqueue_script( 'gsap-js', 'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js', array(), false, true );
  // ScrollTrigger - with gsap.js passed as a dependency
  wp_enqueue_script( 'gsap-st', 'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js', array('gsap-js'), false, true );
  // Your animation code file - with gsap.js passed as a dependency
  wp_enqueue_script( 'gsap-js2', get_template_directory_uri() . '/dist/gsap.js', array('gsap-js'), false, true );
}

add_action( 'wp_enqueue_scripts', 'theme_gsap_script' );

////////////////////////////////////////////////////////////////////////////////////////////////////////
// PIXELPRESS CUSTOM THEME
////////////////////////////////////////////////////////////////////////////////////////////////////////

// Register the Theme Options Page
add_action('admin_menu', 'pixelpress_options_page');

function pixelpress_options_page() {
    add_menu_page(
        'PixelPress Settings',       // Page title
        'PixelPress',                // Menu title
        'manage_options',            // Capability
        'pixelpress-settings',       // Menu slug
        'pixelpress_options_display', // Callback
        'dashicons-admin-generic',   // Icon (optional)
        199                           // Position (after Settings)
    );
}

function pixelpress_options_display() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('pixelpress_options_group');
            do_settings_sections('pixelpress-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'pixelpress_register_settings');

function pixelpress_register_settings() {
    register_setting(
        'pixelpress_options_group',
        'pixelpress_options',
        'pixelpress_sanitize_options'
    );

    add_settings_section(
        'pixelpress_general',
        'General Settings',
        'pixelpress_section_cb',
        'pixelpress-settings'
    );


    // Logo Field
    add_settings_field(
      'pixelpress_logo',
      'Site Logo',
      'pixelpress_logo_field_cb',
      'pixelpress-settings',
      'pixelpress_general'
    );

    // Primary Colour Field
    add_settings_field(
        'pixelpress_primary_colour',
        'Primary Colour',
        'pixelpress_primary_colour_field_cb',
        'pixelpress-settings',
        'pixelpress_general'
    );

    // Secondary Colour Field
    add_settings_field(
        'pixelpress_secondary_colour',
        'Secondary Colour',
        'pixelpress_secondary_colour_field_cb',
        'pixelpress-settings',
        'pixelpress_general'
    );

    // Accent Colour Field
    add_settings_field(
        'pixelpress_accent_colour',
        'Accent Colour',
        'pixelpress_accent_colour_field_cb',
        'pixelpress-settings',
        'pixelpress_general'
    );
}

function pixelpress_section_cb() {
    echo '<p>Customize your PixelPress theme settings below.</p>';
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
// CALLBACKS
////////////////////////////////////////////////////////////////////////////////////////////////////////

// Logo callback
function pixelpress_logo_field_cb() {
    $options = get_option('pixelpress_options', []);
    $logo_url = isset($options['logo']) ? $options['logo'] : '';
    ?>
    <div class="pixelpress-logo-preview">
        <?php if ($logo_url) : ?>
            <img src="<?php echo esc_url($logo_url); ?>" alt="Logo Preview" style="max-width: 200px; display: block; margin-bottom: 10px;" />
        <?php else : ?>
            <p>No logo uploaded yet.</p>
        <?php endif; ?>
    </div>
    <input type="hidden" name="pixelpress_options[logo]" id="pixelpress_logo" value="<?php echo esc_attr($logo_url); ?>" />
    <input type="button" class="button pixelpress-media-upload-button" value="<?php echo $logo_url ? 'Change Logo' : 'Upload Logo'; ?>" data-target="#pixelpress_logo" />
    <?php if ($logo_url) : ?>
        <input type="button" class="button pixelpress-media-remove-button" value="Remove Logo" style="margin-left: 10px;" />
    <?php endif; ?>
    <p class="description">Upload a logo for your site.</p>
    <?php
}
// Primary colour callback
function pixelpress_primary_colour_field_cb() {
  $options = get_option('pixelpress_options', []);
  $colour = isset($options['primary_colour']) ? $options['primary_colour'] : '#000000';
  ?>
  <input type="text" name="pixelpress_options[primary_colour]" id="pixelpress_primary_colour" value="<?php echo esc_attr($colour); ?>" class="pixelpress-colour-picker" />
  <div class="pixelpress-colour-preview" style="width: 30px; height: 30px; background-color: <?php echo esc_attr($colour); ?>; display: inline-block; vertical-align: middle; margin-left: 10px;"></div>
  <span class="pixelpress-colour-hex" style="margin-left: 10px;"><?php echo esc_html($colour); ?></span>
  <p class="description">Select the primary colour for your theme.</p>
  <?php
}
// Secondary colour callback
function pixelpress_secondary_colour_field_cb() {
  $options = get_option('pixelpress_options', []);
  $colour = isset($options['secondary_colour']) ? $options['secondary_colour'] : '#666666';
  ?>
  <input type="text" name="pixelpress_options[secondary_colour]" id="pixelpress_secondary_colour" value="<?php echo esc_attr($colour); ?>" class="pixelpress-colour-picker" />
  <div class="pixelpress-colour-preview" style="width: 30px; height: 30px; background-color: <?php echo esc_attr($colour); ?>; display: inline-block; vertical-align: middle; margin-left: 10px;"></div>
  <span class="pixelpress-colour-hex" style="margin-left: 10px;"><?php echo esc_html($colour); ?></span>
  <p class="description">Select the secondary colour for your theme.</p>
  <?php
}
// Accent colour callback
function pixelpress_accent_colour_field_cb() {
  $options = get_option('pixelpress_options', []);
  $colour = isset($options['accent_colour']) ? $options['accent_colour'] : '#ff0000';
  ?>
  <input type="text" name="pixelpress_options[accent_colour]" id="pixelpress_accent_colour" value="<?php echo esc_attr($colour); ?>" class="pixelpress-colour-picker" />
  <div class="pixelpress-colour-preview" style="width: 30px; height: 30px; background-color: <?php echo esc_attr($colour); ?>; display: inline-block; vertical-align: middle; margin-left: 10px;"></div>
  <span class="pixelpress-colour-hex" style="margin-left: 10px;"><?php echo esc_html($colour); ?></span>
  <p class="description">Select the accent colour for your theme.</p>
  <?php
}

function pixelpress_sanitize_options($input) {
  $sanitized = [];
  if (isset($input['logo'])) {
      $sanitized['logo'] = esc_url_raw($input['logo']);
  }
  if (isset($input['primary_colour'])) {
      $sanitized['primary_colour'] = sanitize_hex_color($input['primary_colour']);
  }
  if (isset($input['secondary_colour'])) {
      $sanitized['secondary_colour'] = sanitize_hex_color($input['secondary_colour']);
  }
  if (isset($input['accent_colour'])) {
      $sanitized['accent_colour'] = sanitize_hex_color($input['accent_colour']);
  }
  return $sanitized;
}
add_action('admin_enqueue_scripts', 'pixelpress_enqueue_scripts');


function pixelpress_enqueue_scripts($hook) {
    if ($hook !== 'toplevel_page_pixelpress-settings') {
        return;
    }
    // Enqueue media uploader for logo
    wp_enqueue_media();
    wp_enqueue_script(
        'pixelpress-media',
        get_template_directory_uri() . '/dist/admin-js/media-upload.js',
        ['jquery'],
        '1.0',
        true
    );
    // Enqueue color picker
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script(
        'pixelpress-colour-picker',
        get_template_directory_uri() . '/dist/admin-js/colour-picker.js',
        ['wp-color-picker'],
        '1.0',
        true
    );
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
// Pass theme colours down to CSS
////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action('wp_head', 'pixelpress_add_custom_css_variables');

function pixelpress_add_custom_css_variables() {
    $options = get_option('pixelpress_options', []);
    $primary_colour = !empty($options['primary_colour']) ? esc_attr($options['primary_colour']) : '#f5f5f5';
    $secondary_colour = !empty($options['secondary_colour']) ? esc_attr($options['secondary_colour']) : '#222222';
    $accent_colour = !empty($options['accent_colour']) ? esc_attr($options['accent_colour']) : '#7124c9';
    ?>
    <style type="text/css">
        :root {
            --pixelpress-primary: <?php echo $primary_colour; ?>;
            --pixelpress-secondary: <?php echo $secondary_colour; ?>;
            --pixelpress-accent: <?php echo $accent_colour; ?>;
        }
    </style>
    <?php
}