<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>
	<div class="orderSection">
		<h2 class="sectionTitle">Mis pedidos</h2>
		<p class="sectionsubTitle">Revisa el estado de tus pedidos</p>
		<div class="orderSectionBody">
			<?php
			foreach ( $customer_orders->orders as $customer_order ) {
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>
				<article id="<?php echo $order->get_order_number(); ?>">
					<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="smallTop"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></a>
					<div class="bodyArticle">
						<div class="bodyArticle__top">
							<div class="bodyArticle__flex">
								<div class="bodyArticle__flex__left">
									<div class="bodyArticle__product">										
										<?php 
											$order_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
											foreach ( $order_items as $item_id => $item ) {
												$product = $item->get_product();
												if ($product) {
													$id = $product->get_ID();
													$img = get_the_post_thumbnail_url($id);
													$name = get_the_title($id);
												}
												?>
											<div class="itemFlexBody">
												<?php
													if ($product) {
												?>
												<img src="<?php echo $img; ?>">
												<span><?php echo $name; ?></span>
												<?php } ?>
											</div>
												<?php
											}											
										?>
									</div>
								</div>
								<div class="bodyArticle__flex__right">									
									<div class="bodyArticle__status" data="<?php echo $order->get_status(); ?>">
										<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="bodyArticle__middle">
							<div class="bodyArticle__middle__left">
								<?php
								/* translators: 1: formatted order total 2: total order items */
								echo wp_kses_post( sprintf( _n( '%1$s por %2$s producto', '%1$s por %2$s productos', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
								?>			
							</div>
							<div class="bodyArticle__middle__right">
								<?php
									$actions = wc_get_account_orders_actions( $order );

									if ( ! empty( $actions ) ) {
										foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
											echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button btn ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
										}
									}
								?>
							</div>
						</div>
						<?php
							if ($order->get_status() == 'on-hold') {
								?>
							<div class="bodyArticle__bottom">
								<div class="msjInfo">No te olvides depositar a la siguiente cuenta:</div>
								<div class="msjBody">
									<?php
									$gateways = WC()->payment_gateways->get_available_payment_gateways();
									$enabled_gateways = [];									
									if( $gateways ) {
										foreach( $gateways as $gateway ) {									
											if( $gateway->enabled == 'yes' ) {									
												$enabled_gateways[] = $gateway;									
											}
										}
									}
									$accountDetails = $enabled_gateways[0]->account_details;
									if ($accountDetails) {
										foreach ($accountDetails as $cc) {
											?>
										<div class="msjBodyItem">
											<div class="strongItem">
												<?php echo $cc['account_name']; ?>
											</div>
											<div class="strongItem_content">
												<?php echo $cc['account_number']; ?>
											</div>
										</div>
											<?php
										}
									}
									?>
								</div>
								<div class="msjFoot">Luego de hacer el depósíto, envíanos una foto o captura del comprobante de depósito y tu nombre al Whatsapp (01) 936 508 066 </div>
							</div>
								<?php
							}
						?>
					</div>
				</article>
				<?php
			}
			?>
		</div>
	</div>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="orderSection">
		<h2 class="sectionTitle">Mis pedidos</h2>
		<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">			
			<?php esc_html_e( 'No tienes pedidos aún', 'woocommerce' ); ?>
		</div>
	</div>
<?php endif; ?>
<script>
	jQuery('#ordersNav').addClass('active');
</script>
<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
