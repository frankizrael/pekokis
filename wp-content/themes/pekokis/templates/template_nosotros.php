<?php /* Template Name: about */
set_query_var('ENTRY', 'page');
get_header();
?>
<section class="pageDefault">
    <div class="banner" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>')">
        <h1><?php the_title(); ?></h1>
    </div>
    <div class="content">
        <div class="x-container">
            <div class="aboutFlex">
                <div class="aboutFlex__left">
                    <div class="aboutoItems">
                         <img src="<?php the_field('imagen_center'); ?>">
                    </div>              
                </div>
                <div class="aboutFlex__right">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="about_valores">
        <div class="x-container">
            <div class="x-title">
                <h2><?php echo get_field('title_valores');?></h2>
                <p><?php echo get_field('subtitle_valores');?></p>
            </div>
            <div class="valoresItems">
                <?php 
                    $contacto = get_field('list');
                    if ($contacto) {
                        foreach ($contacto as $cc) {
                            ?>
                    <div class="valoresItem">
                        <div class="valoresItem__img">
                            <img src="<?php echo $cc['img']; ?>">
                        </div>
                        <div class="valoresItem__content">
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
    </div>
    <div class="mantenimiento">
        <div class="x-container">
            <div class="x-title">
                <h2><?php echo get_field('title_mantenimiento');?></h2>
                <p><?php echo get_field('subtitle_mantenimiento');?></p>
            </div>
            <div class="mantenimientoItems">
                <?php 
                    $mantenimiento = get_field('mantenimiento');
                    if ($mantenimiento) {
                        foreach ($mantenimiento as $cc) {
                            ?>
                    <div class="mantenimientoItem">
                        <div class="mantenimientoItem__img">
                            <img src="<?php echo $cc['img']; ?>">
                        </div>
                        <div class="mantenimiento__content">
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
    </div>
</section>
<?php
get_footer();
?>