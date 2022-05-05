<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<h2>Mi cuenta</h2>
	<ul class="woocommerce-nav">
		<li>
			<a href="<?php echo site_url();?>/mi-cuenta/orders" id="ordersNav">
				<i>
					<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M10 1L19 6V16L10 21L1 16V6L10 1Z" stroke="#808080" stroke-linejoin="round"/>
						<path d="M1 6L10 11L19 6" stroke="#808080"/>
						<path d="M10 11V21" stroke="#808080"/>
					</svg>
				</i>
				<span>
					Mis pedidos
				</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/mi-cuenta/edit-account?password=true" id="passNav">
				<i>
					<svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="1" y="9" width="14" height="10" stroke="#808080" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M3 6C3 3.23858 5.23858 1 8 1V1C10.7614 1 13 3.23858 13 6V9H3V6Z" stroke="#808080" stroke-linecap="round" stroke-linejoin="round"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M8 15C8.55228 15 9 14.5523 9 14C9 13.4477 8.55228 13 8 13C7.44772 13 7 13.4477 7 14C7 14.5523 7.44772 15 8 15Z" stroke="#808080"/>
					</svg>
				</i>
				<span>
					Contraseña
				</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/mi-cuenta/edit-account?password=false" id="dataNav">
				<i>
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="1" y="1" width="18" height="18" stroke="#808080" stroke-linejoin="round"/>
						<path d="M9.10156 5.50001H14.5016" stroke="#808080" stroke-linecap="round"/>
						<path d="M9.10156 10H14.5016" stroke="#808080" stroke-linecap="round"/>
						<path d="M9.10156 14.5H14.5016" stroke="#808080" stroke-linecap="round"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M5.50156 6.40001C5.99862 6.40001 6.40156 5.99706 6.40156 5.50001C6.40156 5.00295 5.99862 4.60001 5.50156 4.60001C5.00451 4.60001 4.60156 5.00295 4.60156 5.50001C4.60156 5.99706 5.00451 6.40001 5.50156 6.40001Z" fill="#808080" stroke="#808080"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M5.50156 10.9C5.99862 10.9 6.40156 10.4971 6.40156 10C6.40156 9.50295 5.99862 9.10001 5.50156 9.10001C5.00451 9.10001 4.60156 9.50295 4.60156 10C4.60156 10.4971 5.00451 10.9 5.50156 10.9Z" fill="#808080" stroke="#808080"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M5.50156 15.4C5.99862 15.4 6.40156 14.9971 6.40156 14.5C6.40156 14.0029 5.99862 13.6 5.50156 13.6C5.00451 13.6 4.60156 14.0029 4.60156 14.5C4.60156 14.9971 5.00451 15.4 5.50156 15.4Z" fill="#808080" stroke="#808080"/>
					</svg>
				</i>
				<span>
					Información personal
				</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/mi-cuenta/edit-address/" id="dataDirections">
				<i>
					<svg width="22" height="14" viewBox="0 0 22 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3 11H1V1H14V11H7" stroke="#808080" stroke-linecap="round"/>
						<path d="M19 11H21V6.55556L19 3H14V11H15" stroke="#808080" stroke-linecap="round"/>
						<circle cx="5" cy="11" r="2" stroke="#808080"/>
						<circle cx="17" cy="11" r="2" stroke="#808080"/>
					</svg>
				</i>
				<span>
					Direcciones de envio
				</span>
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>">
				<i>
					<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10.244 10.243L2.48582 2.48488" stroke="#808080" stroke-width="3" stroke-linecap="round"/>
						<path d="M10.2427 2.48488L2.48454 10.243" stroke="#808080" stroke-width="3" stroke-linecap="round"/>
					</svg>
				</i>
				<span>
					Cerrar sesión
				</span>
			</a>
		</li>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
