<?php use Roots\Sage\Titles; ?>
<?php // ACF Format Link 
	$pry__logo = get_field('pry__logo');
	$pry__web = get_field('pry__web'); 
	$pry__logo__txt = get_field('pry__logo__txt');
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
		    <h1><?= Titles\title(); ?></h1>
		    	<?php if($pry__web){ ?>
					<p><a href="<?php echo $pry__web; ?>" target="_blank" rel="follow"><?php echo $pry__web; ?></a></p>
				<?php } ?>
		  </div>
	  <?php } ?>
	</div>
</div>