<?php
/**
 * The single post template file.
 *
 * @package flexi
 */

get_header('inside');
?>
<div class="insideposts">

<div class="wrapper"> 
    
<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'inc/partials/content', 'single' );
				endwhile;
			?>

</div>
</div>
<?php get_footer();