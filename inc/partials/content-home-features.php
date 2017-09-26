<?php
/**
 * The template part for displaying sub features section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package flexi
 */

?>
<div id="featurewidgets">
<div class="wrapper">
<div class="row">

		<?php
		if ( !get_theme_mod( 'flexi_content_set', false ) ) {
			echo '<div class="col-1-4"><div class="wrap-col"><div class="featurewidget"><div class="featurewidgeticon">
                <a href="'.home_url().'"><i class="fa-desktop fa"></i></a>
              </div><div class="featurewidgettext"><h2 class="featurewidgettitle">'.__('Modern Design', 'flexi').'</h2><p>'.__('flexi has a nice homepage with a hero header area so you can write some into text with call to action buttons and links to your social media profiles.', 'flexi').'</p></div></div></div></div><div class="col-1-4"><div class="wrap-col"><div class="featurewidget"><div class="featurewidgeticon">
                <a href="'.home_url().'"><i class="fa-shopping-basket fa"></i></a>
              </div><div class="featurewidgettext"><h2 class="featurewidgettitle">'.__('eCommerce Ready', 'flexi').'</h2><p>'.__('Use flexi with the <a href="http://www.woothemes.com/woocommerce/">WooCommerce plugin</a> and you can create your own online store to sell digital or tangible products with no fuss.', 'flexi').'</p></div></div></div></div><div class="col-1-4"><div class="wrap-col"><div class="featurewidget"><div class="featurewidgeticon">
                <a href="'.home_url().'"><i class="fa-gears fa"></i></a>
              </div><div class="featurewidgettext"><h2 class="featurewidgettitle">'.__('Live Customizer', 'flexi').'</h2><p>'.__('Using the built-in WordPress Customizer you can change colors, fonts, text, buttons and upload your own logo for the footer and the header area.', 'flexi').'</p></div></div></div></div><div class="col-1-4"><div class="wrap-col"><div class="featurewidget"><div class="featurewidgeticon">
                <a href="'.home_url().'"><i class="fa-file-code-o fa"></i></a>
              </div><div class="featurewidgettext"><h2 class="featurewidgettitle">'.__('Coded With Care', 'flexi').'</h2><p>'.__('We have coded the flexi theme to be fast loading, with no bloated extras and it complies with all the latest WordPress theme requirements.', 'flexi').'</p></div></div></div></div>';
		}

		if ( is_active_sidebar( 'flexi-features' ) ) {
			dynamic_sidebar( 'flexi-features' );
		}
		?>
 </div><!-- End row -->
</div><!-- End  wrapper -->
</div><!-- End featurewidgets -->
