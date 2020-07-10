<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$size = "full";
$i = 0;
?>


<div class="row">

	<?php ?>

	<?php if( get_sub_field('image_row_type', $post->ID) == 'one' ): ?>
		<?php while ( have_rows('first_pair', $post->ID) ) : the_row(); ?>
			<?php $class = $i > 0 ? "col-md-8" : "col-md-4"; ?>
			<div class="<?php echo $class; ?>">
				<a href="<?php echo get_sub_field('link'); ?>">
    				<?php echo wp_get_attachment_image( get_sub_field('image'), $size ); ?>
    			</a>
			</div>
			<?php $i++; ?> 
		<?php endwhile; ?>
	<?php endif; ?>
	
	<?php if(get_sub_field('image_row_type') == 'two' ): ?>
		<?php while ( have_rows('second_pair') ) : the_row(); ?>
			<?php $class = $i > 0 ? "col-md-4" : "col-md-8"; ?>
			<div class="<?php echo $class; ?>">
				<a href="<?php echo get_sub_field('link'); ?>">
    				<?php echo wp_get_attachment_image( get_sub_field('image'), $size ); ?>
    			</a>
			</div>
			<?php $i++; ?> 
		<?php endwhile; ?>
	<?php endif; ?>

	<?php if(get_sub_field('image_row_type') == 'three' ): ?>
		<?php while ( have_rows('third_pair') ) : the_row(); ?>
			<div class="col-md-12">
				<a href="<?php echo get_sub_field('link'); ?>">
    				<?php echo wp_get_attachment_image( get_sub_field('image'), $size ); ?>
    			</a>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>

	<?php if(get_sub_field('image_row_type') == 'four' ): ?>
		<?php while ( have_rows('forth_pair') ) : the_row(); ?>
			<div class="col-md-6">
				<a href="<?php echo get_sub_field('link'); ?>">
    				<?php echo wp_get_attachment_image( get_sub_field('image'), $size ); ?>
    			</a>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>

	<?php if(get_sub_field('image_row_type') == 'fifth' ): ?>
		<?php while ( have_rows('fifth_pair') ) : the_row(); ?>
			<div class="col-md-4">
				<a href="<?php echo get_sub_field('link'); ?>">
    				<?php echo wp_get_attachment_image( get_sub_field('image'), $size ); ?>
    			</a>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>

</div>