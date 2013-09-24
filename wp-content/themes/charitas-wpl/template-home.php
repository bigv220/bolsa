<?php
/**
 * Template Name: Temp Home Page
 *
 * @package WordPress
 * @subpackage Charitas
 * @since Charitas 1.0
 */
?>

<?php get_header('home'); ?>
	<div id="main" class="site-main container_16">
	<div class="inner">
		<div id="primary" class="<?php if ( $page_width == 'display' ) { echo 'grid_11 suffix_1'; } else { echo 'grid_16'; } ?>">
			<?php get_template_part('content', 'page' ); ?>
		</div><!-- #content -->
	

		<div class="clear"></div>
	</div><!-- #primary -->
</div>	
<?php get_footer('home'); ?>