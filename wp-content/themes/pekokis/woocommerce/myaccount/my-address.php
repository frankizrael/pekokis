<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;
?>

<section class="allAddress">	
	<h2>Direcciones de envío</h2>
	<p>Selecciona la dirección de envío por defecto</p>
	<div class="anyDirections">
		<ul>
		<?php
			$directions = get_field( 'direcciones', 'user_'.get_current_user_id() );
			if ($directions) {
				$a = 0;
				foreach ($directions as $dir) {
					?>
			<li data-id="<?php echo $a; ?>" departamento="<?php echo $dir['departamento']; ?>"
				provincia="<?php echo $dir['provincia']; ?>"
				distrito="<?php echo $dir['distrito']; ?>"
				direccion="<?php echo $dir['direccion']; ?>"
				numero="<?php echo $dir['numero']; ?>"
				piso="<?php echo $dir['piso']; ?>"
				interior="<?php echo $dir['interior']; ?>"
				referencia="<?php echo $dir['referencia']; ?>"
				>
				<span><i class="selectDirection"></i><?php echo $dir['direccion']; ?></span>
				<div><a href="javascript:void" class="editDirectionAjax">Editar</a>
				<a href="javascript:void" class="deleteDirectionAjax">Eliminar</a></div>
			</li>
					<?php
				$a++;
				}
			}
		?>
		</ul>
	</div>
	<div class="editOrAddDirections">
		<h4>Ingresa una nueva dirección de envío</h4>
		<form id="ajaxForm" class="ajaxForm" user-id="<?php echo $customer_id;?>">
			<div class="inputAjaxRow">
				<div class="inputAjaxRowInput">
					<label>Departamento</label>
					<select id="ajax_departamento">
						<option value="">Seleccionar Departamento</option><option value="1">AMAZONAS</option><option value="2">ANCASH</option><option value="3">APURIMAC</option><option value="4">AREQUIPA</option><option value="5">AYACUCHO</option><option value="6">CAJAMARCA</option><option value="7">CALLAO</option><option value="8">CUSCO</option><option value="9">HUANCAVELICA</option><option value="10">HUANUCO</option><option value="11">ICA</option><option value="12">JUNIN</option><option value="13">LA LIBERTAD</option><option value="14">LAMBAYEQUE</option><option value="15">LIMA</option><option value="16">LORETO</option><option value="17">MADRE DE DIOS</option><option value="18">MOQUEGUA</option><option value="19">PASCO</option><option value="20">PIURA</option><option value="21">PUNO</option><option value="22">SAN MARTIN</option><option value="23">TACNA</option><option value="24">TUMBES</option><option value="25">UCAYALI</option>
					</select>
					</select>
				</div>
				<div class="inputAjaxRowInput">
					<label>Provincia</label>
					<select id="ajax_provincia"><option value="">Seleccionar Provincia</option></select>
				</div>
			</div>
			<div class="inputAjaxRow">
				<div class="inputAjaxRowInput">
					<label>Distrito</label>
					<select id="ajax_distrito"><option value="">Seleccionar Distrito</option></select>
				</div>
			</div>
			<div class="inputAjaxRow">
				<div class="inputAjaxRowInputFull">
					<label>Dirección</label>
					<input type="text" id="ajax_direccion">
				</div>
			</div>
			<div class="inputAjaxRow">
				<div class="inputAjaxRowInput">
					<label>Número</label>
					<input type="text" id="ajax_numero">
				</div>
				<div class="inputAjaxRowInput">
					<label>Piso</label>
					<input type="text" id="ajax_piso">
				</div>
			</div>
			<div class="inputAjaxRow">
				<div class="inputAjaxRowInput">
					<label>Interior</label>
					<input type="text" id="ajax_interior">
				</div>
				<div class="inputAjaxRowInput">
					<label>Referencia</label>
					<input type="text" id="ajax_referencia">
				</div>
			</div>
			<div class="inputAjaxRow">
				<button id="sendAjax" class="btn">AGREGAR DIRECCIÓN</button>
			</div>
		</form>
	</div>	
</section>



<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="u-columns woocommerce-Addresses col2-set addresses">
<?php endif; ?>

<?php foreach ( $get_addresses as $name => $address_title ) : ?>
	<?php
		$address = wc_get_account_formatted_address( $name );
		$col     = $col * -1;
		$oldcol  = $oldcol * -1;
	?>

	<div class="u-column<?php echo $col < 0 ? 1 : 2; ?> col-<?php echo $oldcol < 0 ? 1 : 2; ?> woocommerce-Address" style="display:none">
		<div class="woocommerce-Address-title title">
			<h3><?php echo esc_html( $address_title ); ?></h3>
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit"><?php echo $address ? esc_html__( 'Edit', 'woocommerce' ) : esc_html__( 'Add', 'woocommerce' ); ?></a>
		</div>
		<address>
			<?php
				echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' );
			?>
		</address>
	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
	<?php
endif;
