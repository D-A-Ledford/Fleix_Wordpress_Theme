<?php
/**
 * The template part for displaying sub features section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package flexi
 */

?>
<?php 
//Title
$flexi_latest_title_l = get_theme_mod( 'flexi_latest_title_l' );
//Sub Texts
$flexi_latest_text_l = get_theme_mod( 'flexi_latest_text_l' );
?>
<div id="introarea">
<div class="wrapper">
<div class="row">

	<h2 class="introtitle"><?php echo $flexi_latest_title_l; ?></h2>
    <p class="introtext"><?php echo $flexi_latest_text_l; ?></p>
    <div id="arrow2">
</div>


 </div><!-- End row -->
</div><!-- End  wrapper -->
</div><!-- End introarea -->