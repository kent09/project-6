<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
$page = get_page_by_path( 'wishlist' , OBJECT );
$myaccount_page_id = get_option('woocommerce_myaccount_page_id');
$myaccount_page_url ="";
if ($myaccount_page_id) {
    $myaccount_page_url = get_permalink($myaccount_page_id);
}

$count = isset($woocommerce->cart->cart_contents_count) ?: 0 ;

$cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar">
		<div class="top-nav desktop">
			<div class="container">
				<?php wp_nav_menu(
					array(
						'menu'			  => 'Top Menu',
						'menu_id'         => 'top-menu',
						'menu_class'         => 'p-0 m-0 d-flex list-style-none justify-content-end',
						'depth'           => 1,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>
			</div>
		</div>
		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav id="main-nav" class="navbar navbar-expand-md navbar-dark bg-primary" aria-labelledby="main-nav-label">

			<h2 id="main-nav-label" class="sr-only">
				<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
			</h2>

		<?php if ( 'container' === $container ) : ?>
			<div class="container">
		<?php endif; ?>
				<div class="hamburger-wrapper">
					<button class="navbar-toggler hamburger" type="button" data-toggle="collapse" data-target="#navbarMobileNavDropdown" aria-controls="navbarMobileNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
						<span class="line"></span>
						<span class="line"></span>
						<span class="line"></span>
					</button>
					<div class="seach-btn mobile">
						<i class="white-search-icon"></i>
					</div>
				</div>
					<?php wp_nav_menu(
						array(
							'menu'  => 'Mobile Menu',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'navbarMobileNavDropdown',
							'menu_class'      => 'navbar-nav mr-auto',
							'fallback_cb'     => '',
							'menu_id'         => 'mobile-menu',
							'depth'           => 4,
							'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
						)
					); ?>
					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>

					<?php } else {
						the_custom_logo();
					} ?><!-- end custom logo -->

				

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav mr-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 4,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>

				<div class="top-search-wrapper">
					<?php echo do_shortcode('[aws_search_form id="1"]'); ?>
				</div>
				<ul class="icon-list d-flex list-style-none p-0 m-0">
					<li>
						<a href="<?php echo $cart_url; ?>" class="cart">
							<i class="cart-icon"></i>
							<?php
		                    	if($count > 0) {
                                	echo "<span>".shortNumber($count)."</span>";
		                    	}
                           	?>
						</a>
					</li>
					<?php if(isset($page)): ?>
						<li>
							<a href="/wishlist">
								<i class="wishlist-icon"></i>
							</a>
						</li>
					<?php endif; ?>
					<?php if (is_user_logged_in()) : ?>
						<li>
							<a href="<?php $myaccount_page_url; ?>">
								<i class="user-icon"></i>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			<?php if ( 'container' === $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->
	<?php if( have_rows('top_guarante', 'option') ): ?>
		<div class="top-guarante desktop">
			<ul>
				<?php while ( have_rows('top_guarante', 'option') ) : the_row(); ?>
					<li><?php the_sub_field('text'); ?></li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>
