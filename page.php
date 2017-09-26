<?php
/**
 * <?php
/**
 * Template name: Full Width Page
 *
 * @package Framer
 */

get_header('inside');
?>
<div class="insideposts">

<div class="wrapper">
<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'inc/partials/content', 'page' );
				endwhile;
			?>


</div>
<?php get_footer();
 *
 * @package flexi
 */

get_header();
?>
<div class="insideposts">

<div class="wrapper">
<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'inc/partials/content', 'page' );
				endwhile;
			?>


</div>
<?php get_footer();