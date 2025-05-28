<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=no">
    <?php wp_head(); ?>
</head>
<!-- Theme Options -->
<?php
    $options = get_option('pixelpress_options', []);
    $logo = !empty($options['logo']) ? $options['logo'] : '';
?>
<body <?php body_class(); ?>>

<header class="py-4 relative shadow-md">
    <div class="container mx-auto px-4 flex items-center justify-between">

        <?php if($logo) { ?>
            <a href="<?php echo home_url() ?>">
                <img class="w-full h-auto max-w-[180px]" src="<?php echo esc_url($logo); ?>" alt="PixelPress Theme" />
            </a>
        <?php } else { ?>
            <a href="<?php echo home_url() ?>">
                <p class="text-4xl font-bold tracking-tighter">Ink<span class="font-normal">Well</span></p>
            </a>
        <?php } ?>

        <!-- Nav menu -->
        <div class="theme-main-menu bg-[--bg-color] h-screen w-2/3 absolute right-0 top-20 md:static md:w-auto md:h-auto md:pl-6 md:pt-6 md:pb-6">
        <?php
            wp_nav_menu( array( 
                'theme_location' => 'header-menu',
                'menu_class'    => 'nav-menu',
                'container'     => false,
                'order' => 'ASC'
            ) ); 
        ?>
        </div>
        <!-- Mobile Nav Menu Trigger -->
        <div class="mobile-tav-trigger md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="19" viewBox="0 0 26 19">
                <path id="Union_54" data-name="Union 54" d="M0,19V16H26v3Zm6.933-8V8H26v3ZM0,3V0H26V3Z" fill="#0f0f10"/>
            </svg>
        </div>         

    </div>
</header>