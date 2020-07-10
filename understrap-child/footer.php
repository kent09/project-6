<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
$size = 'full';
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>
<a class="to-top mobile" href="#wrapper-navbar" title="">
	<div>To Top</div>
</a>
<div class="signup-wrapper wrapper bg-primary">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<?php if(get_field('sign_up_title', 'option')):?>
					<div class="title"><strong><?php the_field('sign_up_title', 'option'); ?></strong></div>
				<?php endif; ?>
				<?php if(get_field('sign_up_text', 'option')):?>
					<p class="mb-0"><?php the_field('sign_up_text', 'option'); ?></p>
				<?php endif ?>
			</div>
			<div class="col-md-7">
				<?php if(get_field('sign_up_form', 'option')): ?>
					<div class="form-wrapper">
						<?php the_field('sign_up_form', 'option'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if( have_rows('sign_up_media', 'option') ): ?>
			<ul class="media-holder mobile">
				<?php while ( have_rows('sign_up_media', 'option') ) : the_row(); ?>
					<?php if(get_sub_field('icon')): ?>
				    	<li>
				    		<a href="<?php the_sub_field('link'); ?>">
				    			<?php echo wp_get_attachment_image( get_sub_field('icon'), $size ); ?>
				    		</a>
				    	</li>
			    	<?php endif; ?>
			      
			    <?php endwhile; ?>
			</ul>
		<?php endif; ?>
	</div>
</div>
<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">
		<div class="holder-wrapper">
			<?php dynamic_sidebar( 'footer-sidebar' ); ?>
		</div>
	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

