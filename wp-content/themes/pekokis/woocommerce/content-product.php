<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$productid = $product->get_id();
$price_html_m2y = $product->get_price_html();
?>
<li class="jsProduct">
	<div class="myProduct">
		<div class="modalmyProduct">
			<div class="myProduct__image">
				<img src="<?php echo get_the_post_thumbnail_url($productid); ?>" title="<?php echo get_the_title($productid);?>">
				<?php
					$discont = get_field('discount', $productid);
					if ($discont) {
						echo '<span class="discount">'.$discont.'</span>';
					}
				?>				
				<div class="hovermyProduct">	
					<div class="midddler">	
						<div class="itemHoverMyProduct">
							<?php
								echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
								sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
									esc_url( $product->add_to_cart_url() ),
									esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
									esc_attr( isset( $args['class'] ) ? $args['class'] : 'anybutton' ),
									isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
									'<svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 1H2.49578C2.74508 1 3.29354 1.21176 3.49297 2.05882C3.69241 2.90588 4.90566 7.35294 5.48735 9.47059C5.48735 9.64706 5.68679 10 6.48454 10C7.48173 10 12.717 10 13.2156 10C13.7142 10 14.2128 9.73529 14.4621 9.20588C14.6615 8.78235 15.5423 5.32353 15.9578 3.64706C16.0409 3.47059 16.0576 3.11765 15.4592 3.11765C14.8609 3.11765 9.89161 3.11765 7.48173 3.11765" stroke="#404047" stroke-linecap="round" stroke-linejoin="round"/>
									<circle cx="7" cy="13" r="0.5" fill="#404047" stroke="#404047"/>
									<circle cx="13" cy="13" r="0.5" fill="#404047" stroke="#404047"/>
									</svg>'
								),
								$product, $args );
							?>
						</div>	
						<div class="itemHoverMyProduct">
							<a href="<?php echo get_permalink($productid); ?>" class="OpenLink">
								<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M13.0258 11.4789H12.2358L11.9728 11.2139C12.9801 10.0334 13.5533 8.54382 13.5973 6.99257C13.6412 5.44131 13.1532 3.92169 12.2144 2.68605C11.2755 1.4504 9.9422 0.573059 8.4359 0.199717C6.9296 -0.173624 5.34094 -0.0205095 3.93367 0.633639C2.5264 1.28779 1.38521 2.40361 0.699601 3.79583C0.0139969 5.18804 -0.174773 6.77289 0.164628 8.28719C0.504029 9.8015 1.35117 11.1542 2.56542 12.1206C3.77966 13.087 5.28792 13.609 6.83977 13.5999C8.49255 13.5953 10.0857 12.9819 11.3148 11.8769L11.5778 12.1419V12.9419L16.8428 18.2419L18.4228 16.6509L13.0258 11.4789ZM6.70778 11.4789C5.76231 11.4858 4.83609 11.2118 4.04659 10.6916C3.25708 10.1713 2.63987 9.42834 2.27324 8.55682C1.90661 7.6853 1.80706 6.72453 1.98726 5.79636C2.16746 4.8682 2.61925 4.01446 3.28536 3.34344C3.95146 2.67242 4.80184 2.21435 5.72865 2.02732C6.65547 1.8403 7.61697 1.93276 8.49117 2.29296C9.36536 2.65317 10.1129 3.26489 10.6389 4.05055C11.1649 4.83621 11.4458 5.76039 11.4458 6.70589C11.4507 7.3311 11.3317 7.9511 11.0957 8.53011C10.8598 9.10911 10.5116 9.63567 10.0711 10.0794C9.63061 10.5231 9.10663 10.8753 8.52937 11.1155C7.95212 11.3557 7.33301 11.4792 6.70778 11.4789Z" fill="#808080"/>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="myProduct__content">
				<h3><?php echo get_the_title($productid);?></h3>
				<div class="inPrice">
					<?php echo $price_html_m2y; ?>
				</div>
			</div>
		</div>
	</div>
</li>
