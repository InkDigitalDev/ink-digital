<!-- ACF Options -->
<?php
    $options = get_option('pixelpress_options', []);
    $logo = !empty($options['logo']) ? $options['logo'] : '';
?>
<footer class="footer py-8 border-t border-[#999]">
    <div class="container mx-auto px-4 flex flex-col items-center justify-between md:flex-row">
        <?php if($logo) { ?>
            <a href="<?php echo home_url() ?>">
                <img class="w-full h-auto max-w-[180px]" src="<?php echo esc_url($logo); ?>" alt="PixelPress Theme" />
            </a>
        <?php } else { ?>
            <a href="<?php echo home_url() ?>">
                <p class="text-4xl font-bold tracking-tighter">Ink<span class="font-normal">Well</span></p>
            </a>
        <?php } ?>
        <a href="#" target="_blank">&copy; <?php echo date("Y"); ?> Ink Digital</a>
    </div>
</footer>
<?php wp_footer(); ?>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/dist/app.js"></script>
</body>
</html>