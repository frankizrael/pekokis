<?php
set_query_var('ENTRY', 'page');
get_header();
?>
<section class="pageDefault">
    <div class="banner" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>')">
        <h1><?php the_title(); ?></h1>
    </div>
    <div class="content">
        <div class="x-container">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php get_footer();