<?php
/**
 * Template Name: Listado de sub-páginas
 */

 //Listado de sub-páginas
 $pages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
?>

<?php foreach( $pages as $page ) :
  $post_name = $page->post_name;
  $content = $page->post_content;
  $image = get_the_post_thumbnail_url($page->ID, 'full');

  if ( ! $content ) // Check for empty page
    continue;

  if ( ! $image ) // Check for empty images
    continue;

  $content = apply_filters( 'the_content', $content );
?>
  <div class="inner">
    <article class="<?php echo $post_name; ?>" style="background: url(<?php echo $image; ?>) no-repeat top center;  -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <?php //var_dump($image); ?>
     <div class="caption">
        <a href="<?php echo get_page_link( $page->ID ); ?>">
          <i class="icon fa fa-check-square-o" aria-hidden="true"></i>
        </a>
        <h2>
          <a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a>
        </h2>
        <div class="entry">
          <?php echo $content; ?>
        </div>
     </div>
    </article>
  </div>

<?php endforeach; ?>
