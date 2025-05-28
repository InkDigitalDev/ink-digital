<?php
/* Template Name: Contact Page */
get_header();
// Get Hero Field
$hero = get_field('hero');
?>
<!-- Page Hero -->
<?php if($hero['show_hero']) { 
    include(locate_template('template-parts/hero.php'));
} ?>
<div class="contact-content py-12">
    <div class="container mx-auto px-4">
        <div class="contact-content-inner">

            <?php echo do_shortcode('[pixel_form id="1"]'); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>