<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<p class="woocommerce-result-count">
	<?php
	if ( 1 === $total ) {
		_e( 'Showing the single result', 'woocommerce' );
	} elseif ( $total <= $per_page || -1 === $per_page ) {
		/* translators: %d: total results */
		printf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'woocommerce' ), $total );
	} else {
		$first = ( $per_page * $current ) - $per_page + 1;
		$last  = min( $total, $per_page * $current );
		/* translators: 1: first result 2: last result 3: total results */
		printf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'woocommerce' ), $first, $last, $total );
	}
	?>
</p>
<div class="filterMobile" style="display:none">
	<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path d="M6.82593 9.28954H7.32593C7.32593 9.1718 7.28437 9.05783 7.20859 8.96772L6.82593 9.28954ZM1.2366 2.64365L1.61926 2.32182L1.2366 2.64365ZM16.4719 2.64365L16.0893 2.32183L16.4719 2.64365ZM10.8259 9.3569L10.4433 9.03508C10.3675 9.12519 10.3259 9.23916 10.3259 9.3569H10.8259ZM10.8259 14.0282L11.1259 14.4282C11.2518 14.3337 11.3259 14.1856 11.3259 14.0282H10.8259ZM6.82593 17.0282H6.32593C6.32593 17.2176 6.43293 17.3907 6.60232 17.4754C6.77171 17.5601 6.97442 17.5418 7.12593 17.4282L6.82593 17.0282ZM7.20859 8.96772L1.61926 2.32182L0.853938 2.96547L6.44327 9.61137L7.20859 8.96772ZM1.61926 2.32182C1.34572 1.99658 1.57694 1.5 2.00192 1.5V0.5C0.726987 0.5 0.0333277 1.98974 0.853938 2.96547L1.61926 2.32182ZM2.00192 1.5H15.7066V0.5H2.00192V1.5ZM15.7066 1.5C16.1316 1.5 16.3628 1.99658 16.0893 2.32183L16.8546 2.96547C17.6752 1.98974 16.9815 0.5 15.7066 0.5V1.5ZM16.0893 2.32183L10.4433 9.03508L11.2086 9.67873L16.8546 2.96547L16.0893 2.32183ZM10.3259 9.3569V14.0282H11.3259V9.3569H10.3259ZM10.5259 13.6282L6.52593 16.6282L7.12593 17.4282L11.1259 14.4282L10.5259 13.6282ZM7.32593 17.0282V9.28954H6.32593V17.0282H7.32593Z" fill="black"/>
	</svg>
	Filtrar
</div>