<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Manufacturer
 */
$theme_options = man_theme_options();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> >
<?php do_action('manufacturer_before_header'); ?>

<?php 
	if (isset($theme_options['preloader-sw'])) {
		if ($theme_options['preloader-sw'] == '1') {
			echo '<div class="preloader"><div class="preloader_content"><div class="spinner"></div></div></div>';
		}
	}
?>

<div id="page" class="man_page <?php if ( !class_exists( 'ReduxFramework' ) ) { echo 'man_page_default';} ?>" data-title="
	<?php 
		if ( class_exists( 'ReduxFramework' ) ) {
			if (isset($theme_options['typosettings-h2-icon']['media']['width'])) {
				echo esc_attr($theme_options['typosettings-h2-icon']['media']['width']); 
			}
		}
	?>
">
	

	<?php 
		if ( class_exists( 'ReduxFramework' ) && function_exists( 'hfe_render_header' ) ) {
			if ($theme_options['default_header'] == 0) {
				hfe_render_header();
			}else{ ?>

				<header id="masthead" class="site-header">
					<div class="man_preheader">
						<div class="container">
							<div class="row">
									<div class="col-8">
										<?php 
											$manufacturer_description = get_bloginfo( 'description', 'display' );
											if ( $manufacturer_description || is_customize_preview() ) :
										?>
												<p class="site-description"><?php echo esc_attr($manufacturer_description); /* WPCS: xss ok. */ ?></p>
											<?php endif; ?>

									</div>
									<div class="col-4 text-right">
										<div class="man_search_block">
											<i class="ti ti-search"></i>
										</div>
										<div class="man_search_block_bg">
											<div class="man_search_block_bg_close"></div>
											<div class="search-form">
												<form action="<?php echo esc_url(get_home_url()); ?>" method="get">
														<input type="text" name="s" id="search" class="search-form-text" placeholder="<?php echo esc_attr__( 'Search...', 'manufacturer' ) ?>" value="<?php the_search_query(); ?>" />
														<button type="submit" class="search-form-submit">
														  <i class='ti ti-search'></i>
														</button>
												</form>
											</div>
										</div>

									</div>
							</div>
						</div>
					</div>

					<div class="container">
						<div class="row">
								<div class="col-md-12">
									<div class="site-branding">
										<?php
											the_custom_logo();
											if ( is_front_page() && is_home() ) : ?>
												<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></p>
												<?php else :?>
												<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></p>
										<?php endif; ?>
									</div><!-- .site-branding -->

									<div id="elementor-header-primary" class="elementor-header">
										<button class="sm_menu_toggle"><i class="ti ti-menu"></i></button>
										<a class="sm_menu_toggle_close" href="<?php echo esc_url('#'); ?>"><i class="ti ti-close"></i></a>
										<div id="sm_menu" class="sm_menu">
											<nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" id="elementor-navigation" class="elementor-navigation" role="navigation">
												<?php
												wp_nav_menu( array(
													'container'      => false,
													'menu_id'        => 'sm_nav_menu',
													'menu_class'     => 'sm_nav_menu',
													'echo'           => true,
												) );
												?>
											</nav><!-- #site-navigation -->
										</div>
									</div>
								</div>

						</div>
					</div>
					

					
				</header><!-- #masthead -->
				
			<?php }
		}else{
	?>
	<header id="masthead" class="site-header">
		<div class="man_preheader">
			<div class="container">
				<div class="row">
						<div class="col-xs-8 col-sm-8">
							<?php 
								$manufacturer_description = get_bloginfo( 'description', 'display' );
								if ( $manufacturer_description || is_customize_preview() ) :
							?>
									<p class="site-description"><?php echo esc_attr($manufacturer_description); /* WPCS: xss ok. */ ?></p>
								<?php endif; ?>

						</div>
						<div class="col-xs-4 col-sm-4 text-right">
							<div class="man_search_block">
								<i class="ti ti-search"></i>
							</div>
							<div class="man_search_block_bg">
								<div class="man_search_block_bg_close"></div>
								<div class="search-form">
									<form action="<?php echo esc_url(get_home_url()); ?>" method="get">
											<input type="text" name="s" id="search" class="search-form-text" placeholder="<?php echo esc_attr__( 'Search...', 'manufacturer' ) ?>" value="<?php the_search_query(); ?>" />
											<button type="submit" class="search-form-submit">
											  <i class='ti ti-search'></i>
											</button>
									</form>
								</div>
							</div>

						</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
					<div class="col-md-12">
						<div class="site-branding">
							<?php
								the_custom_logo();
								if ( is_front_page() && is_home() ) : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></p>
									<?php else :?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></p>
							<?php endif; ?>
						</div><!-- .site-branding -->

						<div id="elementor-header-primary" class="elementor-header">
							<button class="sm_menu_toggle"><i class="ti ti-menu"></i></button>
							<a class="sm_menu_toggle_close" href="<?php echo esc_url('#'); ?>"><i class="ti ti-close"></i></a>
							<div id="sm_menu" class="sm_menu">
								<nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" id="elementor-navigation" class="elementor-navigation" role="navigation">
									<?php
									wp_nav_menu( array(
										'container'      => false,
										'menu_id'        => 'sm_nav_menu',
										'menu_class'     => 'sm_nav_menu',
										'echo'           => true,
									) );
									?>
								</nav><!-- #site-navigation -->
							</div>
						</div>
					</div>

			</div>
		</div>
		

		
	</header><!-- #masthead -->
	<?php } ?>



	<?php 
	
	if ( class_exists( 'ReduxFramework' ) ) {

		if (isset($theme_options['header-background'])) {
			$background_image = $theme_options['header-background']['background-image'];
			$background_color = $theme_options['header-background']['background-color'];
			$background_repeat = $theme_options['header-background']['background-repeat'];
			$background_position = $theme_options['header-background']['background-position'];
			$background_attachment = $theme_options['header-background']['background-attachment'];
			$background_size = $theme_options['header-background']['background-size'];
		}else{
			$background_color = '#fff';
			$background_image = '';
			$background_repeat = '';
			$background_position = '';
			$background_attachment = '';
			$background_size = '';
		}
		
	}else{
		$background_color = '#fff';
		$background_image = '';
		$background_repeat = '';
		$background_position = '';
		$background_attachment = '';
		$background_size = '';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		if (!is_search() && !is_product_category() && !is_shop() && !is_404()) {
			if (isset($theme_options['header-featured'])) {
				if ($theme_options['header-featured'] == 1 && get_the_post_thumbnail_url( $post->ID)) {
					$background_image = get_the_post_thumbnail_url( $post->ID);
				}
			}
		}
	}else{
		if (!is_search() && !is_404()) {
			if ($theme_options['header-featured'] == 1 && get_the_post_thumbnail_url( $post->ID)) {
				$background_image = get_the_post_thumbnail_url( $post->ID);
			}
		}
	}
	

	?>


	
	
	<?php if (is_404()) { 
	?>
	
	<div class="man_intro man_404_section <?php if ( !class_exists( 'ReduxFramework' ) ) { echo 'man_intro_default';} ?> man_image_bck">
		
		
		<div class="man_intro_cont text-left">
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-6">
							<div class="man_404"><?php echo esc_html_e( '404', 'manufacturer' ); ?>
							</div>
							<h2><?php echo esc_html_e( "SOMETHING'S GONE WRONG", 'manufacturer' ); ?>
							</h2>
							<p><?php echo esc_html_e( 'We are very sorry but the page you are looking for cannot be found.', 'manufacturer' ); ?></p>
							<a href="javascript:history.back()" class="btn"><i class="ti ti-arrow-left"></i> <?php echo esc_html_e( 'Back', 'manufacturer' ); ?></a>

						</div>
						<div class="col-md-7 col-sm-6 hidden-xs text-right">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/robo.png" alt="<?php echo esc_attr_e( '404', 'manufacturer' ); ?>">
						</div>
					</div>
					
				
				</div>
		</div>
		

	</div>

	<?php } else {?>
	
	<div class="man_intro <?php if ( !class_exists( 'ReduxFramework' ) ) { echo 'man_intro_default';} ?> man_image_bck" data-image="<?php echo esc_attr($background_image); ?>" data-color="<?php echo esc_attr($background_color); ?>" data-repeat="<?php echo esc_attr($background_repeat); ?>" data-position="<?php echo esc_attr($background_position); ?>" data-attachment="<?php echo esc_attr($background_attachment); ?>" data-size="<?php echo esc_attr($background_size); ?>">
		
		<div class="man_over"></div>
		
		<div class="man_intro_cont">
			<h1>
				<?php

						if ( class_exists( 'WooCommerce' ) ) {
							if( is_search() ) {
	                printf( esc_html__( 'Search: %s', 'manufacturer' ), '<span>' . get_search_query() . '</span>' );
	            }elseif( is_shop() ){
	                woocommerce_page_title();
	            }elseif( is_category() || is_archive() ){
	                the_archive_title();
	            }elseif( is_front_page() || is_home() ){
	                bloginfo( 'name' ); 
	            }elseif( class_exists( 'WooCommerce' ) && is_product()  ){
									$terms = get_the_terms( $post->ID, 'product_cat' );
									$nterms = get_the_terms( $post->ID, 'product_tag'  );
									foreach ($terms  as $term  ) {
									    $product_cat_id = $term->term_id;
									    $product_cat_name = $term->name;
									    break;
									}
									echo esc_attr($product_cat_name);
	            }else { 
	                the_title(); 
	            }
						}else{
							if( is_search() ) {
                printf( esc_html__( 'Search: %s', 'manufacturer' ), '<span>' . get_search_query() . '</span>' );
	            }elseif( is_category() || is_archive() ){
	                the_archive_title();
	            }elseif( is_front_page() || is_home() ){
	                bloginfo( 'name' ); 
	            }elseif( class_exists( 'WooCommerce' ) && is_product()  ){
									$terms = get_the_terms( $post->ID, 'product_cat' );
									$nterms = get_the_terms( $post->ID, 'product_tag'  );
									foreach ($terms  as $term  ) {
									    $product_cat_id = $term->term_id;
									    $product_cat_name = $term->name;
									    break;
									}
									echo esc_attr($product_cat_name);
	            }else { 
	                the_title(); 
	            }
						}
            
        ?>


			</h1>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
			    <?php if(function_exists('bcn_display_list'))
			    {
			        bcn_display_list();
			    }?>
			</div>
		</div>

	</div>

	<?php } ?>


	<div id="content" class="site-content">



