<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<div class="woocommerce-info">
(*) Para envió a Provincia, el cliente asume el costo del Flete en Destino más el envío a la agencia que escoja.
</div>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<h3 id="order_review_heading"><?php esc_html_e( 'Tu Orden', 'woocommerce' ); ?></h3>
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		<div id="maquinariasProvincia" style="display:none">	
			<div class="woocommerce-info">
			(*) Para envió a Provincia, el cliente asume el costo del Flete en Destino más el envío a la agencia que escoja.
			</div>
		</div>
	</div>
	

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<script>
	<?php 
		$razon_social = get_field('razon_social','user_'.get_current_user_id()); 
		$telefono = get_field('telefono','user_'.get_current_user_id()); 
		$dni = get_field('dni','user_'.get_current_user_id()); 
	?>
	<?php 
		if ($razon_social) {
			?>
		jQuery('#billing_razon_social').val('<?php echo $razon_social; ?>');	
			<?php
		}
	?>
	<?php 
		if ($telefono) {
			?>
		jQuery('#billing_phone').val('<?php echo $telefono; ?>');	
			<?php
		}
	?>
	<?php 
		if ($dni) {
			?>
		jQuery('#billing_dni').val('<?php echo $dni; ?>');	
			<?php
		}
	?>
	const Mydelivery = jQuery('#billing_tipo_envio_field .woocommerce-input-wrapper input').eq(0);
	const Myrecojo = jQuery('#billing_tipo_envio_field .woocommerce-input-wrapper input').eq(1);
	function searchLocal() {
		const searchINput = jQuery('#shipping_method input');
		jQuery('#shipping_method li').hide();
		for (let i=0;i<searchINput.length;i++){
			const value = searchINput.eq(i).attr('value');
			if (value.split('local_pick').length > 1 ) {
				searchINput.eq(i).closest('li').show();
				searchINput.eq(i).prop("checked", true);
			}
		}
	}
	function searchFlat() {
		const searchINput = jQuery('#shipping_method input');
		jQuery('#shipping_method li').hide();
		for (let i=0;i<searchINput.length;i++){
			const value = searchINput.eq(i).attr('value');
			if (value.split('flat_rat').length > 1 ) {
				searchINput.eq(i).closest('li').show();
				searchINput.eq(i).prop("checked", true);
			}
		}
	}
	jQuery(document.body).bind('click', '.editDirection',function(){
		console.log('waiting ...');
		setTimeout(function(){
			console.log('udpateWoocmmerce');
			jQuery(document.body).trigger("update_checkout", {update_shipping_method: true});
		}, 5500);
	});
	Mydelivery.prop("checked", true);
	searchFlat();
	jQuery('#billing_tipo_envio_field .woocommerce-input-wrapper input').on('change',function(){
		if (Myrecojo.is(':checked')) {
			searchLocal();
		} else {
			searchFlat();
		}
	});	
	jQuery('#billing_departamento').on('change',function(){
		if (jQuery('#billing_departamento').val() == '15') {
			jQuery('#maquinariasProvincia').hide();
		} else {        
			console.log('adsasd');
			jQuery('#maquinariasProvincia').show();
		}
	});
</script>