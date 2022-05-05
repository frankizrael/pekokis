<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">

		<h2><?php esc_html_e( 'Productos relacionados', 'woocommerce' ); ?></h2>
		
		<?php woocommerce_product_loop_start(); ?>
		<div class="relatedProducts">
            <div class="swiper-container">
                <div class="swiper-wrapper"> 	
						<?php foreach ( $related_products as $related_product ) : ?>
							<div class="swiper-slide">							
							<?php
								$post_object = get_post( $related_product->get_id() );

								setup_postdata( $GLOBALS['post'] =& $post_object );

								wc_get_template_part( 'content', 'product_cat' ); ?>
							
					</div>
						<?php endforeach; ?>
				</div>				
				<div class="swiper-button-prev">
					<svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.499998 22.5C0.499999 10.3497 10.3497 0.500001 22.5 0.500002C34.6503 0.500003 44.5 10.3497 44.5 22.5C44.5 34.6503 34.6503 44.5 22.5 44.5C10.3497 44.5 0.499997 34.6503 0.499998 22.5Z" stroke="white"/>
						<path d="M28 22.9993L18 22.9993" stroke="white" stroke-linecap="round"/>
						<path d="M21.334 28L18.0007 23L21.334 18" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>
				<div class="swiper-button-next">
					<svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M44.5 22.5C44.5 34.6503 34.6503 44.5 22.5 44.5C10.3497 44.5 0.499994 34.6503 0.499996 22.5C0.499998 10.3497 10.3497 0.500002 22.5 0.500004C34.6503 0.500006 44.5 10.3497 44.5 22.5Z" stroke="white"/>
						<path d="M17 22.0007L27 22.0007" stroke="white" stroke-linecap="round"/>
						<path d="M23.666 17L26.9993 22L23.666 27" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>
			</div>
		</div>
		<?php woocommerce_product_loop_end(); ?>
	</section>

<?php endif;

wp_reset_postdata();
