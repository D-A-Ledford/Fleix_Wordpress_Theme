<?php
/**
 * The page template file.
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