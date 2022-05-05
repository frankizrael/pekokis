<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>

	<form method="post" class="edit-address">
		<h2>Agregar dirección</h2>

		<div class="woocommerce-address-fields">
			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

			<div class="woocommerce-address-fields__field-wrapper">
				<?php
				foreach ( $address as $key => $field ) {
					woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
				}
				?>
			</div>

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

			<p>
				<button type="submit" class="button" name="save_address" value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>"><?php esc_html_e( 'Save address', 'woocommerce' ); ?></button>
				<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</p>
		</div>

	</form>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>

<script>
	jQuery(document).ready(function () {
		jQuery('#dataDirections').addClass('active');
		jQuery("#ajax_departamento").select2();
		jQuery("#ajax_provincia").select2();
		jQuery("#ajax_distrito").select2();

		var ajaxurl = "<?php echo site_url(); ?>/wp-admin/admin-ajax.php"

		function rt_ubigeo_event_departamento(select, selectType) {
			var data = {
				'action': 'rt_ubigeo_load_provincias_front',
				'idDepa': jQuery(select).val()
			}
			jQuery.ajax({
				type: 'POST',
				url: ajaxurl,
				data: data,
				dataType: 'json',
				success: function (response) {
					jQuery('#ajax_provincia').html('');
					if (response) {
						jQuery('#ajax_provincia').append('<option value="">Seleccionar Provincia</option>');
						for (var r in response) {
							jQuery('#ajax_provincia').append('<option value=' + r + '>' + response[r] + '</option>');
						}
					}
				}
			})
		}

		function rt_ubigeo_event_provincia(select, selectType) {
			var data = {
				'action': 'rt_ubigeo_load_distritos_front',
				'idProv': jQuery(select).val()
			}
			jQuery.ajax({
				type: 'POST',
				url: ajaxurl,
				data: data,
				dataType: 'json',
				success: function (response) {
					jQuery('#ajax_distrito').html('');
					if (response) {
						jQuery('#ajax_distrito').append('<option value="">Seleccionar Distrito</option>');
						for (var r in response) {
							jQuery('#ajax_distrito').append('<option value=' + r + '>' + response[r] + '</option>')
						}
					}
				}
			})
		}

		jQuery('#ajax_departamento').on('change', function () {
			rt_ubigeo_event_departamento(this, 'billing')
		});
		jQuery('#ajax_provincia').on('change', function () {
			rt_ubigeo_event_provincia(this, 'billing')
		});
	});
</script>