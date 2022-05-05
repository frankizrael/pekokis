<?php /* Template Name: contacto */
set_query_var('ENTRY', 'page');
get_header();
?>
<section class="pageDefault">
    <div class="banner" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>')">
        <h1><?php the_title(); ?></h1>
    </div>
    <div class="content contentContact">
        <div class="x-container">
            <div class="contactoFlex">
                <div class="contactoFlex__left">
                    <div class="contactoItems">
                    <?php 
                        $contacto = get_field('list');
                        if ($contacto) {
                            foreach ($contacto as $cc) {
                                ?>
                        <div class="contactoItem">
                            <div class="contactoItem__img">
                                <img src="<?php echo $cc['img']; ?>">
                            </div>
                            <div class="contactoItem__content">
                                <h3><?php echo $cc['title']; ?></h3>
                                <p><?php echo $cc['text']; ?></p>
                            </div>
                        </div>    
                                <?php
                            }
                        }
                    ?>      
                    </div>              
                </div>
                <div class="contactoFlex__right">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="iframe">
        <?php the_field('iframe'); ?>
    </div>
</section>
<?php
get_footer();
?>