<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$productid = $product->get_id();
$price_html_m2y = $product->get_price_html();?>
<section class="ContentsingleProduct">
	<div class="x-container">
		<div class="myProductModal">
			<div class="breadcrumsMy">
				<?php woocommerce_breadcrumb(); ?>
			</div>
			<div class="myProductModal__content">
				<div class="myProductModal__content__flex">
					<div class="myProductModal__content__flex__left">
						<div class="myProductModal__image">
							<div class="myProductModal__image__top">
								<img src="<?php echo get_the_post_thumbnail_url($productid); ?>" title="<?php echo get_the_title($productid);?>">
							</div>
							<div class="myProductModal__image__bottom">
								<?php
									$attachment_ids = $product->get_gallery_image_ids();
									if (count($attachment_ids) > 0) {
										if($attachment_ids) {
											foreach ($attachment_ids as $attachment_id) {
												$image = wp_get_attachment_url( $attachment_id );
												?>
									<img src="<?php echo $image; ?>">
												<?php
											}
										}
									}
								?>
							</div>
						</div>
					</div>
					<div class="myProductModal__content__flex__right">
						<div class="myProductModal__description">
							<h3><?php echo get_the_title($productid);?></h3>
							<div class="inPrice">
								<?php echo $price_html_m2y; ?>
							</div>
							<div class="exceprt">
								<?php echo apply_filters( 'the_excerpt', $product->post->post_excerpt ); ?>
							</div>
							<div class="isPosibleAdd">
								<?php if ( $product->is_in_stock() ) : ?>

								<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

								<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
									<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>



									<div class="simpleSpinner">
										<div class="minus">-</div>									
										<?php
										do_action( 'woocommerce_before_add_to_cart_quantity' );

										woocommerce_quantity_input( array(
											'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
											'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
											'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
										) );

										do_action( 'woocommerce_after_add_to_cart_quantity' );
										?>
										<div class="plus">+</div>
									</div>



									<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="btn">AGREGAR AL CARRITO</button>

									<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
								</form>

								<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

								<?php endif; ?>
							</div>
							<div class="isBuyNow">
							</div>
							<?php if ( !$product->is_in_stock() ) : ?>
								<div class="notdisponible">
									<h4>Producto no disponible</h4>
									<p>Puedes ver otros productos de reemplazo o compatibles con este producto.</p>
									<a href="#moreinfo" class="btn">
										PRODUCTOS DE REEMPLAZO
										<i>
											<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
												<circle cx="7" cy="7" r="7" fill="white"/>
												<path d="M4 7L10 7" stroke="#C41A2C" stroke-linecap="round"/>
												<path d="M8 4L10 7L8 10" stroke="#C41A2C" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</i>
									</a>
								</div>
							<?php endif; ?>
							<div class="sku">
								<span>SKU</span>
								<p>
								<?php 
									echo $product->get_sku();
								?></p>
							</div>
							<div class="metaList">
								<ul>
									<li>
										<i>
											<svg width="22" height="14" viewBox="0 0 22 14" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M3 11H1V1H14V11H7" stroke="#C41A2C" stroke-linecap="round"/>
											<path d="M19 11H21V6.55556L19 3H14V11H15" stroke="#C41A2C" stroke-linecap="round"/>
											<circle cx="5" cy="11" r="2" stroke="#C41A2C"/>
											<circle cx="17" cy="11" r="2" stroke="#C41A2C"/>
											</svg>
										</i>
										Envios a todo el Perú
									</li>
									<li>
										<i>
											<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M5 9.85714L7.4 12L13 7" stroke="#C41A2C" stroke-linecap="round"/>
											<path fill-rule="evenodd" clip-rule="evenodd" d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#C41A2C"/>
											</svg>
										</i>
										Repuestos 100% originales
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="additionalInfo" id="moreinfo">
	<div class="x-container">
		<?php
			$id_paquete = get_field('id_paquete');
			if ($id_paquete) {
				?>
				<div class="paquetesection">
					<h2>Cómpralo en paquete</h2>
					<div class="paquetecontent">
						<div class="paquetecontent__left">
							<?php
								$paquetes = get_field('products_paquete',$id_paquete);
								if ($paquetes) {
									foreach ($paquetes as $prod) {
										$productid = $prod['id'];
										$productInside = wc_get_product( $productid );
										$price_html_m2y = $productInside->get_price_html();
										?>
							<div class="myProduct">
								<a href="<?php echo get_permalink($productid); ?>">
									<div class="myProduct__image">
										<img src="<?php echo get_the_post_thumbnail_url($productid); ?>" title="<?php echo get_the_title($productid);?>">
										<?php
											$discont = get_field('discount', $productid);
											if ($discont) {
												echo '<span class="discount">'.$discont.'</span>';
											}
										?>
									</div>
									<div class="myProduct__content">
										<h3><?php echo get_the_title($productid);?></h3>
										<div class="inPrice">
											<?php echo $price_html_m2y; ?>
										</div>
									</div>
								</a>
							</div>
										<?php
									}
								}
							?>
						</div>
						<div class="paquetecontent__right">
							<div class="buyman">
								<h3>Precio Total</h3>
								<?php									
									$Paqueteproduct = wc_get_product( $id_paquete );
									$price_html_paquete = $Paqueteproduct->get_price_html();
								?>
								<div class="inPrice">
									<?php echo $price_html_paquete; ?>
								</div>
								<div class="itemHoverMyProduct">
									<?php
										echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
										sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
											esc_url( $Paqueteproduct->add_to_cart_url() ),
											esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
											esc_attr( isset( $args['class'] ) ? $args['class'] : 'btn' ),
											isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
											'AGREGAR AL CARRITO'
										),
										$Paqueteproduct, $args );
									?>
								</div>
								<div class="linkDiv">
									<a href="<?php echo get_permalink($id_paquete);?>" class="btn">COMPRALOS AHORA</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		?>
		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>						
	</div>
</section>


<?php do_action( 'woocommerce_after_single_product' ); ?>
