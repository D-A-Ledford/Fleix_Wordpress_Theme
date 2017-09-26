<?php
/**
 * @package flexi
 */
?>
<div class="container">
<div class="row">
		<div class="col-1-1"><div class="wrap-col test postcontent">
            
      <h2 class="title"><?php the_title() ?></h2>
           
    <?php echo wp_get_attachment_image(get_post_meta(get_the_ID(), 'second_featured_image', true),'tumbnail'); ?>
        <div id="content"> <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<h1 class="postcontenttitle"><?php the_title() ?></h1>
<div class="authormeta">By:  <?php the_author_posts_link(); ?> </div>
        
<?php
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'flexi' ),
			'after'  => '</div>',
		) );
		
		edit_post_link( __( 'Edit', 'flexi' ), '<span class="edit-link">', '</span>' );
		?>
        <br>
</div></div>
</div>

</div>
</div>
</div><div>


