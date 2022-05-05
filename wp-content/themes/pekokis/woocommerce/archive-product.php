<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

set_query_var('ENTRY', 'multimedia');
get_header( 'shop' );
$category = get_queried_object();

if (!property_exists($category, "term_id")) {
	/*$shop_id = woocommerce_get_page_id('shop');
	echo $shop_id;*/
	?>
	<section class="headerInside" style="background-image:url('<?php echo get_field('background_shop', 'options');?>');">
		<h1><?php echo get_field('title_shop', 'options');?></h1>
	</section>
	<section class="contentCategories">
		<div class="x-container">
			<div class="x-title">
				<h2><?php echo get_field('categories_title', 'options');?></h2>
				<p><?php echo get_field('categories_subtitle', 'options');?></p>
			</div>
			<div class="packsInside">
				<?php
					$terms = get_terms( array(                         
						'taxonomy' => 'product_tag',
						'hide_empty' => false,
					) 
					);
					if ($terms) {
						foreach($terms as $term) {							
							$id = $term->term_id;
							$name = $term->name; 
							$slug = $term->slug;
							$description = $term->description;
							//$thumbnail_id = get_woocommerce_term_meta( $id, 'thumbnail_id', true );
							//$image = wp_get_attachment_url( $thumbnail_id );
							$image = get_field('imagen','product_tag_'.$id);
							?>
					<div class="pack">
						<div class="pack__content">
							<div class="pack__image">
								<img src="<?php echo $image; ?>" title="<?php echo $name;?>">
							</div>
							<div class="pack__description">
								<h3><?php echo $name;?></h3>
								<p><?php echo $description; ?></p>
								<a class="btn btn-radius" href="<?php echo get_term_link($slug, 'product_tag'); ?>">
									VER TODOS
									<i>
										<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
											<circle cx="7" cy="7" r="7" fill="white"/>
											<path d="M4 7L10 7" stroke="#C41A2C" stroke-linecap="round"/>
											<path d="M8 4L10 7L8 10" stroke="#C41A2C" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</i>
								</a>
							</div>
						</div>
					</div>
							<?php
						}
					}
				?>
			</div>
		</div>
	</section>
	<?php
} else {	
	$idCategory = $category->term_id;
	$nameCategory = $category->name;
	$slugCategory = $category->slug;
	$thumbnail_id = get_woocommerce_term_meta( $idCategory, 'thumbnail_id', true );
	$imageTumb = wp_get_attachment_url( $thumbnail_id );
	$taxonomy = $category->taxonomy;
	$parent = $category->parent;
	?>
	<section class="headerInside" style="background-image:url('<?php echo get_field('background_shop', 'options');?>');">
		<div>
			<?php
				if ($taxonomy == 'product_cat') {
					if ($parent != 0) {
						$father = get_term( $parent )->name;
						?>
					<h1 class="modelTitle">
						<span><?php echo $father; ?></span>						
						<span class="separator"></span>						
						<span><?php echo $nameCategory; ?></span>
					</h1>					
					<a class="btn" href="<?php echo site_url();?>/tienda">
					CAMBIAR MODELO
						<i>
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<circle cx="7" cy="7" r="7" fill="white"/>
								<path d="M4 7L10 7" stroke="#C41A2C" stroke-linecap="round"/>
								<path d="M8 4L10 7L8 10" stroke="#C41A2C" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</i>
					</a>
						<?php
					} else {
						?>
					<h1>
						<img src="<?php echo $imageTumb?>">
					</h1>					
					<a class="btn" href="<?php echo site_url();?>/tienda">
					CAMBIAR MARCA
						<i>
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<circle cx="7" cy="7" r="7" fill="white"/>
								<path d="M4 7L10 7" stroke="#C41A2C" stroke-linecap="round"/>
								<path d="M8 4L10 7L8 10" stroke="#C41A2C" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</i>
					</a>
						<?php
					}
				} else {
					?>
					<h1 data="<?php echo site_url().'/product-tag/'.$slugCategory; ?>"><?php echo $nameCategory; ?></h1>
					<a class="btn" href="<?php echo site_url();?>/tienda">
					CAMBIAR CATEGORÍA
						<i>
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<circle cx="7" cy="7" r="7" fill="white"/>
								<path d="M4 7L10 7" stroke="#C41A2C" stroke-linecap="round"/>
								<path d="M8 4L10 7L8 10" stroke="#C41A2C" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</i>
					</a>
					<?php
				}
			?>
		</div>
	</section>
	<section class="contentCategories contentWhite">
		<div class="x-container">
			<div class="contentCategories_inside_flex">
				<aside>
					<div class="mobileTitle" style="display:none">
						Filtros
						<a href="javascript:void(0)" class="absButtn closeFilter">
							<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10.244 10.243L2.48582 2.48488" stroke="#808080" stroke-width="3" stroke-linecap="round"/>
								<path d="M10.2427 2.48488L2.48454 10.243" stroke="#808080" stroke-width="3" stroke-linecap="round"/>
							</svg>
						</a>
					</div>
					<div class="mobileAsig">
						<?php dynamic_sidebar('sidebar'); ?>
					</div>
				</aside>
				<div class="allProducts">
					<?php
					if ( woocommerce_product_loop() ) {

					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );
					woocommerce_product_loop_start();
					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );
						}
					}
					woocommerce_product_loop_end();
					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
					} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
					}

					/**
					* Hook: woocommerce_after_main_content.
					*
					* @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					*/
					do_action( 'woocommerce_after_main_content' );
					?>
				</div>
			</div>
		</div>
	</section>

	<script>
		const hrefData = '<?php echo site_url().'/product-tag/'.$slugCategory.'/'; ?>';
		const cloudValue = jQuery('.contentCategories_inside_flex .tag-cloud-link');
		for (let i=0;i<cloudValue.length;i++){
			const href = cloudValue.eq(i).attr('href');
			if (hrefData == href) {
				cloudValue.eq(i).addClass('active');
			}
		}
	</script>	
<?php
}

get_footer( 'shop' );
