<?php
/* Template Name: About Page */
get_header();
// Get Hero Field
$hero = get_field('hero');
?>
<!-- Page Hero -->
<?php if($hero['show_hero']) { 
    include(locate_template('template-parts/hero.php'));
} ?>
<div class="about-page py-12">
    <div class="container mx-auto px-4">
        <div class="about-page-inner">

            <?php the_content(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>