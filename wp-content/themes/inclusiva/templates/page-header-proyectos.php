<?php use Roots\Sage\Titles; ?>
<?php // ACF Format Link 
	$pry__logo = get_field('pry__logo');
	$pry__web = get_field('pry__web'); 
?>

<div class="media">
	<div class="container">
	  <div class="media-left">
	    <a href="<?php echo the_permalink(); ?>">
	    <?php if($pry__logo){ ?>
	      <img class="" src="<?php echo $pry__logo; ?>" alt="<?= Titles\title(); ?>">
	     <?php } ?>
	    </a>
	  </div>
	  <div class="media-body">
	    <h1><?= Titles\title(); ?></h1>
	    	<?php if($pry__web){ ?>
				<p><a href="<?php echo $pry__web; ?>" target="_blank" rel="follow"><?php echo $pry__web; ?></a></p>
			<?php } ?>
	  </div>
	</div>
</div>