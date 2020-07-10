<?php
/**
 * Template Name: Home Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$size = "full";
?>



<div class="hero-banner">
	<?php if( have_rows('hero_banner') ): ?>
		<div class="desktop owl-carousel">
			<?php while ( have_rows('hero_banner') ) : the_row(); ?>
				<div><?php echo wp_get_attachment_image( get_sub_field('image'), $size ); ?></div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
	<?php if( have_rows('mobile_hero_banner') ): ?>
		<div class="mobile owl-carousel">
			<?php while ( have_rows('mobile_hero_banner') ) : the_row(); ?>
				<div><?php echo wp_get_attachment_image( get_sub_field('image'), $size ); ?></div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</div>


<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="shop-now">
			<?php if(get_field('shop_now_title')): ?>
				<h3><?php the_field('shop_now_title'); ?></h3>
			<?php endif; ?>
			<?php if(get_field('shop_now_btn')): ?>
				<div class="btn-holder">
					<a href="<?php the_field('shop_now_link'); ?>" class="shop-now-btn"><?php the_field('shop_now_btn'); ?></a>
				</div>
			<?php endif; ?>
		</div>

		<div class="mansory">

			<?php if( have_rows('mansory_image') ): ?>

			    <?php while ( have_rows('mansory_image') ) : the_row(); ?>

			    	<?php get_template_part( 'loop-templates/content', 'mansory' ); ?>

			    <?php endwhile; ?>

			<?php endif; ?>

		</div>

		<div class="shop-now">
			<?php if(get_field('shop_now_title_2')): ?>
				<h3><?php the_field('shop_now_title_2'); ?></h3>
			<?php endif; ?>
			<?php if(get_field('shop_now_btn_2')): ?>
				<div class="btn-holder">
					<a href="<?php the_field('shop_now_link_2'); ?>" class="shop-now-btn"><?php the_field('shop_now_btn_2'); ?></a>
				</div>
			<?php endif; ?>
		</div>


	</div><!-- #content -->

	<div class="mansory container-fluid">

		<?php if( have_rows('second_mansory_image') ): ?>

		    <?php while ( have_rows('second_mansory_image') ) : the_row(); ?>

		    	<?php get_template_part( 'loop-templates/content', 'mansory' ); ?>

		    <?php endwhile; ?>

		<?php endif; ?>

	</div>

	<div class="<?php echo esc_attr( $container ); ?> product-section">
		<header class="shop-now">
			<?php if(get_field('product_title')): ?>
				<h3><?php the_field('product_title'); ?></h3>
			<?php endif; ?>
			<?php if(get_field('product_shop_now_text')): ?>
				<a href="<?php the_field('product_shop_now_link'); ?>"><?php the_field('product_shop_now_text'); ?></a>
			<?php endif; ?>
		</header>

		<div class="product-list">

			<?php
				$posts = get_field('product_list');
				if( $posts ): ?>	
				<ul class="feature-product owl-carousel owl-theme">
					<?php foreach( $posts as $id ): ?>
					    <li class="item">
				    		<div class="item-image">
				    			<a href="<?php echo get_permalink( $id ); ?>">
				    				<?php echo get_the_post_thumbnail($id, 'medium', array( 'class' => 'img-responsive' )); ?>
				    			</a>
				    		</div>
				    		<div class="content-wrapper">
				    			<?php $getProductCat = get_the_terms( $id, 'brand' ); ?>
				    			<?php if($getProductCat): ?>
				    			<?php $i = 0; ?>

					    		<div class="brand-name">
					    			<ul>
					    				<?php foreach ($getProductCat as $term): ?>
											<li>
												<?php echo $i > 0 ? ", ": "" ;  ?>
												<a href="<?php echo get_term_link($term->term_id); ?>">
													<?php echo $term->name; ?>
												</a>

											</li>
											<?php $i++; ?>
					    				<?php endforeach; ?>
					    			</ul>
					    		</div>

					    		<?php endif; ?>

					    		<div class="product-name">
					    			<a href="<?php echo get_permalink( $id ); ?>">
						    			<?php echo get_the_title($id); ?>
						    		</a>
					    		</div>
					    	</div>
				    		<div class="product-price">
				    			<?php $product = wc_get_product( $id ); ?>
				    			<?php $price = empty($product->get_price()) ? $product->get_regular_price() : $product->get_price();  ?>
				    			<span class="price">$<?php echo $price; ?></span>
				    			<?php if($product->get_sale_price()): ?>
				    			<span class="sale-price">was $<?php echo $product->get_sale_price(); ?></span>
				    			<?php endif; ?>
				    		</div>				
					    </li>
					<?php endforeach; ?>
				</ul>

			<?php endif; ?>

		</div>
	

		<div class="instagram-section">

			<?php if(get_field('instagram_title')): ?>
				<h3><?php the_field('instagram_title'); ?></h3>
			<?php endif; ?>

			<?php if(get_field('instagram_content')): ?>
				<div class="content">
					<?php the_field('instagram_content'); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="detail-content">
			<?php if(get_field('detail_title')): ?>
				<h3><?php the_field('detail_title'); ?></h3>
			<?php endif; ?>
			<?php if(get_field('detail_content')): ?>
				<div class="content">
					<?php the_field('detail_content'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

</div><!-- #full-width-page-wrapper -->

<?php get_footer();
