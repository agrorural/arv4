<?php
/**
 * Template Name: Listado de sub-páginas
 */

 //Listado de sub-páginas
 $pages = get_pages( array(
   'child_of' => $post->ID,
   'parent' => $post->ID,
   'hierarchical' => 0,
   'sort_column' => 'post_date',
   'sort_order' => 'desc',
   'post_type' => 'page',
	 'post_status' => 'publish'
) );
?>

<div class="page-container">
  <?php
    foreach( $pages as $page ) :
      $post_name = $page->post_name;
      $content = $page->post_content;
      $image = get_the_post_thumbnail_url($page->ID, 'full');

      if ( ! $content ) // Check for empty page
        continue;

        if ( ! $image ) // Check for empty images
        continue;

        $content = apply_filters( 'the_content', $content );
  ?>

      <article <?php post_class($post_name); ?>>
      <?php //var_dump($image); ?>
      <div class="article-container" style="background: url(<?php echo $image; ?>) no-repeat top center;  -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
        <a href="<?php echo get_page_link( $page->ID ); ?>">
         <div class="caption">
            <i class="icon" aria-hidden="true"></i>
            <h2>
              <?php echo $page->post_title; ?>
            </h2>
            <div class="entry">
              <?php echo $content; ?>
            </div>
         </div>
        </a>
       </div>
      </article>

  <?php endforeach; ?>
</div>
