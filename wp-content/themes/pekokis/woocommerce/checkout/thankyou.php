<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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
?>
<div class="woocommerce-order" id="thankYou">
	<div class="woocommerce-order-flex">
		<?php if ( $order ) :
			do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>
				<?php if ( $order->has_status( 'failed' ) ) : ?>					
					<div class="woocommerce-order-flex__left">
						<div class="order-content">
							<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>
							<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
								<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
								<?php if ( is_user_logged_in() ) : ?>
									<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
								<?php endif; ?>
							</p>
						</div>
					</div>
				<?php else : ?>
					<div class="woocommerce-order-flex__left">
						<div class="order-content">
							<div class="descriptionPaymenth">

							</div>
							<div class="contentOrder">							
								<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

									<li class="woocommerce-order-overview__order order">
										<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
										<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
									</li>

									<li class="woocommerce-order-overview__date date">
										<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
										<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
									</li>

									<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
										<li class="woocommerce-order-overview__email email">
											<?php esc_html_e( 'Email:', 'woocommerce' ); ?>
											<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
										</li>
									<?php endif; ?>

									<li class="woocommerce-order-overview__total total">
										<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
										<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
									</li>

									<?php if ( $order->get_payment_method_title() ) : ?>
										<li class="woocommerce-order-overview__payment-method method">
											<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
											<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
										</li>
									<?php endif; ?>

								</ul>
								<div class="thanksMethod">
									<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>		
								</div>
							</div>							
						</div>	
					</div>					
					<div class="woocommerce-order-flex__right">
						<div class="details">
							<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>	
						
						<p class="order-again">
							<a href="<?php echo site_url(); ?>/tienda" class="btn" style="max-width: 200px;margin-top: 20px"><?php esc_html_e( 'Seguir comprando', 'woocommerce' ); ?></a>
						</p>
						</div>
					</div>
					<script>
						const typeNumber = "<?php echo $order->get_payment_method(); ?>";
						const templateBacs = '<div><h2>Genera tu pedido</h2><p>Si desea, podrá hacer la compra mediante el depósito a una cuenta bancaria, desde un cajero, internet o en el mismo banco.Al dar a generar pedido se le dará el número de cuenta para que haga el depósito, una vez aceptado el depósito, se procederá a la entrega de su pedido.</p><a href="javascript:void(0)" class="btn btnMore">Generar pedido</a></div>';												
						switch (typeNumber) {
							case 'bacs': 
								jQuery('.banner h1').text('Depósito a cuenta bancaria');
								jQuery('.descriptionPaymenth').html(templateBacs);
								jQuery('.contentOrder').hide();
								jQuery('.btnMore').on('click',function(){
									jQuery('.descriptionPaymenth').hide();
									jQuery('.contentOrder').show();
								});
								break;
							default: 
								jQuery('.banner h1').text('Gracias por su compra');
						}
					</script>
				<?php endif; ?>	
		<?php else : ?>
			<div class="woocommerce-order-flex__left">
				<div class="order-content">
					<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
						<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null );?>
					</p>
				</div>		
			</div>	
		<?php endif; ?>
	</div>


</div>
