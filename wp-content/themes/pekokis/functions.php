<?php
/* Theme Support */
add_theme_support('html-5');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo');
add_theme_support('title-tag');
add_theme_support( 'woocommerce' );
add_filter('show_admin_bar', '__return_false');


/* Register custom post types and custom taxonomies */
/*require_once 'inc/register-taxonomy-game.php';*/

/* Bootstrap Nav Walker */
/*require_once 'inc/bootstrap-nav-walker.php';*/

/* Register Widgets */
/*require_once 'inc/register-button-widget.php';*/

/* Register menus */
function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
		)
	);
}
add_action('init', 'register_my_menus');
add_filter( 'big_image_size_threshold', '__return_false' );
/* Hide posts from menu */
function hide_post_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'hide_post_menu');

/* Load assets */
function load_assets($entries) {
	$assets = file_get_contents(get_stylesheet_directory() . '/assets.json');
	$assets = json_decode($assets);
	foreach ( $assets as $chunk => $files ) {
		foreach ($entries as $entry) {
			if ( $chunk == $entry ) {
				foreach ($files as $type => $asset) {
					switch ($type) {
						case 'js':
							wp_enqueue_script($chunk, get_stylesheet_directory_uri() . '/dist/' . $asset, array(), false, true);
							break;
						case 'css':
							wp_enqueue_style($chunk, get_stylesheet_directory_uri() . '/dist/' . $asset);
					}
				}
			}
		}
	}
}


/* Register sidebar */
register_sidebar(array(
	'name' => 'sidebar',
	'id' => 'my-sidebar',
	'before_widget' => '<div id="%1$s" class="col-12 col-md mb-3 mb-md-0 widget %2$s">',
	'after_widget'  => '</div>',
));

/* Remove prefix */
function remove_archive_prefix($title) {
    return preg_replace('/^\w+: /', '', $title);
}
add_filter('get_the_archive_title', 'remove_archive_prefix');

/* Excerpt size */
function tn_custom_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'tn_custom_excerpt_length', 999);

/* Reduce terms to names */
function reduce_to_names($term) {
    return $term->name;
}

/* Change posts per page */
function change_posts_per_page( $query ) {
	if (is_post_type_archive('comments-matches')) {
		$query->set('posts_per_page', '5');
	}
}
add_action('pre_get_posts', 'change_posts_per_page');

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

/*pagination*/
function powernature_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo '<div class="navigation">';
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => __('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32.635 32.635" xml:space="preserve"><g><path d="M32.135,16.817H0.5c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h31.635c0.276,0,0.5,0.224,0.5,0.5 S32.411,16.817,32.135,16.817z"/><path d="M19.598,29.353c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l12.184-12.184L19.244,4.136 c-0.195-0.195-0.195-0.512,0-0.707s0.512-0.195,0.707,0l12.537,12.533c0.094,0.094,0.146,0.221,0.146,0.354 s-0.053,0.26-0.146,0.354L19.951,29.206C19.854,29.304,19.726,29.353,19.598,29.353z"/></g></svg>','decorlux'),
        'next_text' => __('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32.635 32.635" xml:space="preserve"><g><path d="M32.135,16.817H0.5c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h31.635c0.276,0,0.5,0.224,0.5,0.5 S32.411,16.817,32.135,16.817z"/><path d="M19.598,29.353c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l12.184-12.184L19.244,4.136 c-0.195-0.195-0.195-0.512,0-0.707s0.512-0.195,0.707,0l12.537,12.533c0.094,0.094,0.146,0.221,0.146,0.354 s-0.053,0.26-0.146,0.354L19.951,29.206C19.854,29.304,19.726,29.353,19.598,29.353z"/></g></svg>','decorlux'),
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 1
    ));
    echo '</div>';
}


add_action('wp_ajax_nopriv_send_myproducts', 'send_myproducts');

// Hook para usuarios logueados
add_action('wp_ajax_send_myproducts', 'send_myproducts');

// Función que procesa la llamada AJAX
function send_myproducts(){
    // Check parameters
	$category_slug  = isset( $_POST['category_slug'] ) ? $_POST['category_slug'] : false;
	$category_id  = isset( $_POST['category_id'] ) ? $_POST['category_id'] : false;
	//all products
	/*$allproducts = wc_get_products(array(
		'category' => array($category_slug),
		'orderby' => 'modified',
		'order' => 'ASC',
	));*/
	$terms = get_terms( array(                         
		'taxonomy' => 'product_cat',
		'hide_empty' => false,
		'parent' => $category_id
	) 
	);
	$listModels = array();
	if($terms){
		foreach($terms as $term){
			$id = $term->term_id;
			$name = $term->name;
			$termslug = $term->slug;
			$link = get_term_link($termslug, 'product_cat');
			array_push($listModels, array('id' => $id, 'name' => $name, 'link' => $link));
		}
	}
	//featured offert
	$featuredproducts = wc_get_products(array(
		'category' => array($category_slug),
		'featured' => true,
		'orderby' => 'modified',
		'order' => 'ASC',
		'limit' => 2,
	));
	/*if ($allproducts) {
		$allArrayProducts = array();
		foreach ($allproducts as $fe) {
			$id = $fe->get_id();
			$name = $fe->get_name();
			$link = get_permalink($id);
			array_push($allArrayProducts, array('id' => $id, 'name' => $name, 'link' => $link));
		}
	}*/
	/*if ($featuredproducts) {*/
		$featuredArrayproducts = array();
		foreach ($featuredproducts as $fe) {
			$id = $fe->get_id();
			$name = $fe->get_name();
			$link = get_permalink($id);
			$background = get_field('background_offert',$id);
            $percent = get_field('percent_offert', $id);
			array_push($featuredArrayproducts, array('id' => $id, 'name' => $name, 'link' => $link, 'background' => $background, 'percent' => $percent));
		}
	/*}*/
    wp_send_json( array('allproducts' => $listModels, 'featuredproducts' => $featuredArrayproducts ) );
}

add_action('wp_ajax_nopriv_send_mymodels', 'send_mymodels');

// Hook para usuarios logueados
add_action('wp_ajax_send_mymodels', 'send_mymodels');
function send_mymodels() {	
	$value  = isset( $_POST['value'] ) ? $_POST['value'] : false;
	$terms = get_terms( array(                         
		'taxonomy' => 'product_cat',
		'hide_empty' => false,
		'parent' => $value
	) 
	);
	$listModels = array();
	if($terms){
		foreach($terms as $term){
			$id = $term->term_id;
			$name = $term->name;
			array_push($listModels, array('id' => $id, 'name' => $name));
		}
	}
	wp_send_json( $listModels );
}

add_action('wp_ajax_nopriv_logicurls', 'logicurls');

// Hook para usuarios logueados
add_action('wp_ajax_logicurls', 'logicurls');
function logicurls() {	
	$marca  = isset( $_POST['marca'] ) ? $_POST['marca'] : false;
	$modelo  = isset( $_POST['modelo'] ) ? $_POST['modelo'] : false;
	$tipo  = isset( $_POST['tipo'] ) ? $_POST['tipo'] : false;
	$link = '';
	$linkTipo = '';
	if ($modelo != 0) {
		$modeloslug = get_term( $modelo )->slug;
		$link = get_term_link($modeloslug, 'product_cat');
	} else {
		$marcaslug = get_term( $marca )->slug;
		$link = get_term_link($marcaslug, 'product_cat');
	}
	if ($tipo) {
		if ($tipo != 0) {			
			$linkTipo = get_term( $tipo )->slug;
			$link = $link.'?product_tag='.$linkTipo;
		}
	}
	//return $link;	
	wp_send_json(array('link' => $link));
}

// Hook updatefields
add_action('wp_ajax_nopriv_update_fields_user', 'update_fields_user');

// Hook para usuarios logueados
add_action('wp_ajax_update_fields_user', 'update_fields_user');
function update_fields_user() {	
	$user_id  = isset( $_POST['user_id'] ) ? $_POST['user_id'] : false;
	$departamento_data  = isset( $_POST['departamento_data'] ) ? $_POST['departamento_data'] : false;
	$provincia_data  = isset( $_POST['provincia_data'] ) ? $_POST['provincia_data'] : false;
	$distrito_data  = isset( $_POST['distrito_data'] ) ? $_POST['distrito_data'] : false;
	$direccion_data  = isset( $_POST['direccion_data'] ) ? $_POST['direccion_data'] : false;
	$numero_data  = isset( $_POST['numero_data'] ) ? $_POST['numero_data'] : false;
	$piso_data  = isset( $_POST['piso_data'] ) ? $_POST['piso_data'] : false;
	$interior_data  = isset( $_POST['interior_data'] ) ? $_POST['interior_data'] : false;
	$referencia_data  = isset( $_POST['referencia_data'] ) ? $_POST['referencia_data'] : false;
	$directions = get_field( 'direcciones', 'user_'. $user_id );
	
	$field_key = "field_61e4fc32db516";
	$value = array(
		array( 
			"departamento" => $departamento_data, 
			"provincia" => $provincia_data, 
			"distrito" => $distrito_data,			 
			"direccion" => $direccion_data,			 
			"numero" => $numero_data, 			 
			"piso" => $piso_data,			 
			"interior" => $interior_data,			 
			"referencia" => $referencia_data,
		)
	);
	if ($directions) {
		foreach ($directions as $dir) {
			array_push($value, 
				array( 
					"departamento" => $dir['departamento'], 
					"provincia" => $dir['provincia'], 
					"distrito" => $dir['distrito'],			 
					"direccion" => $dir['direccion'],			 
					"numero" => $dir['numero'], 			 
					"piso" => $dir['piso'],			 
					"interior" => $dir['interior'],			 
					"referencia" => $dir['referencia'],
				)
			);
		}
	}
								
	update_field( $field_key, $value, 'user_'. $user_id );
		
	//return $link;	
	wp_send_json($value);
}

//hook updatefields
add_action('wp_ajax_nopriv_update_this_field', 'update_this_field');

// Hook para usuarios logueados
add_action('wp_ajax_update_this_field', 'update_this_field');
function update_this_field() {	
	$user_id  = isset( $_POST['user_id'] ) ? $_POST['user_id'] : false;
	$departamento_data  = isset( $_POST['departamento_data'] ) ? $_POST['departamento_data'] : false;
	$provincia_data  = isset( $_POST['provincia_data'] ) ? $_POST['provincia_data'] : false;
	$distrito_data  = isset( $_POST['distrito_data'] ) ? $_POST['distrito_data'] : false;
	$direccion_data  = isset( $_POST['direccion_data'] ) ? $_POST['direccion_data'] : false;
	$numero_data  = isset( $_POST['numero_data'] ) ? $_POST['numero_data'] : false;
	$piso_data  = isset( $_POST['piso_data'] ) ? $_POST['piso_data'] : false;
	$interior_data  = isset( $_POST['interior_data'] ) ? $_POST['interior_data'] : false;
	$referencia_data  = isset( $_POST['referencia_data'] ) ? $_POST['referencia_data'] : false;
	$directions = get_field( 'direcciones', 'user_'. $user_id );
	$idlist = isset( $_POST['idlist'] ) ? $_POST['idlist'] : false; 
	
	unset($directions[$idlist]);

	$field_key = "field_61e4fc32db516";
	$value = array(
		array( 
			"departamento" => $departamento_data, 
			"provincia" => $provincia_data, 
			"distrito" => $distrito_data,			 
			"direccion" => $direccion_data,			 
			"numero" => $numero_data, 			 
			"piso" => $piso_data,			 
			"interior" => $interior_data,			 
			"referencia" => $referencia_data,
		)
	);
	if ($directions) {
		foreach ($directions as $dir) {
			array_push($value, 
				array( 
					"departamento" => $dir['departamento'], 
					"provincia" => $dir['provincia'], 
					"distrito" => $dir['distrito'],			 
					"direccion" => $dir['direccion'],			 
					"numero" => $dir['numero'], 			 
					"piso" => $dir['piso'],			 
					"interior" => $dir['interior'],			 
					"referencia" => $dir['referencia'],
				)
			);
		}
	}
								
	update_field( $field_key, $value, 'user_'. $user_id );
		
	//return $link;	
	wp_send_json($value);
}

add_action('wp_ajax_nopriv_get_directions_user', 'get_directions_user');

// Hook para usuarios logueados
add_action('wp_ajax_get_directions_user', 'get_directions_user');
function get_directions_user() {
	$user_id  = isset( $_POST['user_id'] ) ? $_POST['user_id'] : false;
	$directions = get_field( 'direcciones', 'user_'. $user_id );
	$value = array();
	if ($directions) {
		foreach ($directions as $dir) {
			array_push($value, 
				array( 
					"departamento" => $dir['departamento'], 
					"provincia" => $dir['provincia'], 
					"distrito" => $dir['distrito'],			 
					"direccion" => $dir['direccion'],			 
					"numero" => $dir['numero'], 			 
					"piso" => $dir['piso'],			 
					"interior" => $dir['interior'],			 
					"referencia" => $dir['referencia'],
				)
			);
		}
	}
		
	//return $link;	
	wp_send_json($value);
}


add_action('wp_ajax_nopriv_get_locales', 'get_locales');

// Hook para usuarios logueados
add_action('wp_ajax_get_locales', 'get_locales');
function get_locales() {
	$locales = get_field( 'locales', 'options' );
	$value = array();
	if ($locales) {
		foreach ($locales as $dir) {
			array_push($value, 
				array( 
					"label" => $dir['label'], 
					"direccion" => $dir['direccion']
				)
			);
		}
	}
		
	//return $link;	
	wp_send_json($value);
}

add_action('wp_ajax_nopriv_update_delete_user', 'update_delete_user');

// Hook para usuarios logueados
add_action('wp_ajax_update_delete_user', 'update_delete_user');
function update_delete_user() {	
	$user_id  = isset( $_POST['user_id'] ) ? $_POST['user_id'] : false;
	$list_id  = isset( $_POST['list_id'] ) ? $_POST['list_id'] : false;

	$directions = get_field( 'direcciones', 'user_'. $user_id );
	unset($directions[$list_id]);
	
	$field_key = "field_61e4fc32db516";
	$value = array();
	if ($directions) {
		foreach ($directions as $dir) {
			array_push($value, 
				array( 
					"departamento" => $dir['departamento'], 
					"provincia" => $dir['provincia'], 
					"distrito" => $dir['distrito'],			 
					"direccion" => $dir['direccion'],			 
					"numero" => $dir['numero'], 			 
					"piso" => $dir['piso'],			 
					"interior" => $dir['interior'],			 
					"referencia" => $dir['referencia'],
				)
			);
		}
	}								
	update_field( $field_key, $value, 'user_'. $user_id );
		
	//return $link;	
	wp_send_json($value);
}

/**
 * add data updateUser
 */

add_action( 'woocommerce_save_account_details', 'updatevalueUser', 12, 1 );
function updatevalueUser($user_id) {
	$account_razon_social = $_POST['account_razon_social'];
	$account_telefono = $_POST['account_telefono'];
	$account_dni = $_POST['account_dni'];
	update_field( 'telefono', $account_telefono, 'user_'.$user_id );
	update_field( 'razon_social', $account_razon_social, 'user_'.$user_id );
	update_field( 'dni', $account_dni, 'user_'.$user_id);
}



/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
	$tabs['description']['title'] = __( 'Descripción' );		// Rename the description tab	
	$tabs['additional_information']['title'] = __( 'Especificaciones' );	// Rename the additional information tab
	return $tabs;
}

/**
 * Add a custom product data tab
 */
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {	
	// Adds the new tab
	
	$tabs['test_tab'] = array(
		'title' 	=> __( 'Productos de reemplazo', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_new_product_tab_content'
	);

	return $tabs;

}
function woo_new_product_tab_content() {
	global $product;
	$NewTabproductid = $product->get_id();
	$productInsideTab = wc_get_product( $NewTabproductid );
	// The new tab content
	if ( $productInsideTab->is_in_stock() ) {
		echo '<style>.additionalInfo .test_tab_tab { display:none; } .woocommerce-Tabs-panel--test_tab { display:none; } </style>';
	}
	echo '<div class="tabReemplazo">';
	echo '<h4>Productos compatibles </h4>';
	echo '<div class="tabReemplazoList">';
	$paquetes = get_field('products_reemplazo',$NewTabproductid);
	if ($paquetes) {
		foreach ($paquetes as $prod) {
			$productid = $prod['id'];
			$productInside = wc_get_product( $productid );
			$price_html_m2y = $productInside->get_price_html();
			echo '<div class="myProduct"><a href="'.get_permalink($productid).'"><div class="myProduct__image"><img src="'.get_the_post_thumbnail_url($productid).'" title="'.get_the_title($productid).'">';
			$discont = get_field('discount', $productid);
			if ($discont) { echo '<span class="discount">'.$discont.'</span>';}
			echo '</div><div class="myProduct__content"><h3>'.get_the_title($productid).'</h3><div class="inPrice">'.$price_html_m2y.'</div></div></a></div>';		
		}
	}
	echo '</div></div>';
}