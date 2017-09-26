<?php
/**
 * The template part for displaying social links on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package flexi
 */

$flexi_display_social_links = get_theme_mod( 'flexi_header_social_show', 'yes' );

if ( $flexi_display_social_links === 'yes' ) :
	$flexi_facebook_url = get_theme_mod( 'flexi_header_social_facebook' );
	$flexi_twitter_url = get_theme_mod( 'flexi_header_social_twitter' );
	$flexi_pinterest_url = get_theme_mod( 'flexi_header_social_pinterest' );
	$flexi_linkedin_url = get_theme_mod( 'flexi_header_social_linkedin' );
	$flexi_gplus_url = get_theme_mod( 'flexi_header_social_gplus' );
	$flexi_behance_url = get_theme_mod( 'flexi_header_social_behance' );
	$flexi_dribbble_url = get_theme_mod( 'flexi_header_social_dribbble' );
	$flexi_flickr_url = get_theme_mod( 'flexi_header_social_flickr' );
	$flexi_500px_url = get_theme_mod( 'flexi_header_social_500px' );
	$flexi_reddit_url = get_theme_mod( 'flexi_header_social_reddit' );
	$flexi_wordpress_url = get_theme_mod( 'flexi_header_social_wordpress' );
	$flexi_youtube_url = get_theme_mod( 'flexi_header_social_youtube' );
	$flexi_soundcloud_url = get_theme_mod( 'flexi_header_social_soundcloud' );
	$flexi_medium_url = get_theme_mod( 'flexi_header_social_medium' );

	?>

		<ul class="socialmediamenu">
		<?php
		if ( !empty( $flexi_facebook_url ) ) {
			echo '<li class="facebook"><a href="' . esc_url( $flexi_facebook_url ) . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( !empty( $flexi_twitter_url ) ) {
			echo '<li class="twitter"><a href="' . esc_url( $flexi_twitter_url ) . '"><i class="fa fa-twitter"></i></a></li>';
		}
		if ( !empty( $flexi_pinterest_url ) ) {
			echo '<li class="pinterest"><a href="' . esc_url( $flexi_pinterest_url ) . '"><i class="fa fa-pinterest"></i></a></li>';
		}
		if ( !empty( $flexi_linkedin_url ) ) {
			echo '<li class="linkedin"><a href="' . esc_url( $flexi_linkedin_url ) . '"><i class="fa fa-linkedin"></i></a></li>';
		}
		if ( !empty( $flexi_gplus_url ) ) {
			echo '<li class="gplus"><a href="' . esc_url( $flexi_gplus_url ) . '"><i class="fa fa-google-plus"></i></a></li>';
		}
		if ( !empty( $flexi_behance_url ) ) {
			echo '<li class="behance"><a href="' . esc_url( $flexi_behance_url ) . '"><i class="fa fa-behance"></i></a></li>';
		}
		if ( !empty( $flexi_dribbble_url ) ) {
			echo '<li class="dribbble"><a href="' . esc_url( $flexi_dribbble_url ) . '"><i class="fa fa-dribbble"></i></a></li>';
		}
		if ( !empty( $flexi_flickr_url ) ) {
			echo '<li class="flickr"><a href="' . esc_url( $flexi_flickr_url ) . '"><i class="fa fa-flickr"></i></a></li>';
		}
		if ( !empty( $flexi_500px_url ) ) {
			echo '<li class="social500px"><a href="' . esc_url( $flexi_500px_url ) . '"><i class="fa fa-500px"></i></a></li>';
		}
		if ( !empty( $flexi_reddit_url ) ) {
			echo '<li class="reddit"><a href="' . esc_url( $flexi_reddit_url ) . '"><i class="fa fa-reddit"></i></a></li>';
		}
		if ( !empty( $flexi_wordpress_url ) ) {
			echo '<li class="wordpress"><a href="' . esc_url( $flexi_wordpress_url ) . '"><i class="fa fa-wordpress"></i></a></li>';
		}
		if ( !empty( $flexi_youtube_url ) ) {
			echo '<li class="youtube"><a href="' . esc_url( $flexi_youtube_url ) . '"><i class="fa fa-youtube"></i></a></li>';
		}
		if ( !empty( $flexi_soundcloud_url ) ) {
			echo '<li class="soundcloud"><a href="' . esc_url( $flexi_soundcloud_url ) . '"><i class="fa fa-soundcloud"></i></a></li>';
		}
		if ( !empty( $flexi_medium_url ) ) {
			echo '<li class="medium"><a href="' . esc_url( $flexi_medium_url ) . '"><i class="fa fa-medium"></i></a></li>';
		}
		?>
	</ul>

<?php endif;