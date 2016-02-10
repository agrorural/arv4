<?php use Roots\Sage\Titles; ?>
<?php // ACF Format Link 
	global $post;
	$parent = array_reverse(get_post_ancestors($post->ID));
	$first_parent = get_page($parent[1]);
	$parent_page_ID = $first_parent->ID;
	$pry__logo = get_field('pry__logo', $parent_page_ID);
	$pry__logo__txt = get_field('pry__logo__txt', $parent_page_ID);
	$pry__web = get_field('pry__web', $parent_page_ID); 
	$pry__tag = get_field('pry__tag', $parent_page_ID); 
	$tag_by_ID = get_term_by('id', $pry__tag, 'post_tag');
	$tag__slug = $tag_by_ID->slug;
?>
<div class="media">
	<div class="container">
	  <div class="media-left">
	    <a href="<?php echo the_permalink(); ?>">
	    <?php if($pry__logo){ ?>
	      <img class="" src="<?php echo $pry__logo; ?>" alt="<?= Titles\title(); ?>">
	      <?php if($pry__web && !$pry__logo__txt){ ?>
				<p><a href="<?php echo $pry__web; ?>" target="_blank" rel="follow"><?php echo $pry__web; ?></a></p>
			<?php } ?>
	     <?php } ?>
	    </a>
	  </div>
	  <?php if($pry__logo__txt){ ?>
		  <div class="media-body">
		  <h1><?php echo get_the_title( $parent_page_ID );  ?></h1>
		    	<?php if($pry__web){ ?>
					<p><a href="<?php echo $pry__web; ?>" target="_blank" rel="follow"><?php echo $pry__web; ?></a></p>
				<?php } ?>
		  </div>
	<?php } ?>
	</div>
</div>