<?php use Roots\Sage\Titles; ?>
<?php // ACF Format Link 
	$pry__logo = get_field('pry__logo');
	$pry__fb = get_field('pry__fb'); 
	$pry__tw = get_field('pry__tw'); 
	$pry__yt = get_field('pry__yt'); 
	$pry__web = get_field('pry__web'); 
	$pry__logo__txt = get_field('pry__logo__txt');
?>

<div class="proyecto">
	<?php if($pry__logo){ ?>
		<div class="proyecto__logo">
			<a href="<?php echo the_permalink(); ?>">
				<img class="img-responsive" src="<?php echo $pry__logo; ?>" alt="<?= Titles\title(); ?>" width="72" height="72">
			</a>
		</div>
	<?php } ?>
  <?php if($pry__logo__txt){ ?>
	  <div class="proyecto__descripcion">
	    <h1><?= Titles\title(); ?></h1>
	  </div>
  <?php } ?>
	<?php if( $pry__fb || $pry__tw || $pry__yt || $pry__web ) { ?>
		  <div class="sharing-list">
	    	<ul>
	    		<?php if($pry__fb){ ?>
					<li id="fb"  class="share-social">
						<a href="<?php echo 'http://www.facebook.com/' . $pry__fb; ?>" class="tip btn btn-default" target="_blank" rel="follow" title="Síguenos en Facebook">
				              <i class="fa fa-facebook"></i>
						</a>
					</li>
				<?php } ?>
				<?php if($pry__tw){ ?>
					<li id="tw"  class="share-social">
						<a href="<?php echo 'http://twitter.com/' . $pry__tw; ?>" class="tip btn btn-default" target="_blank" rel="follow" title="Síguenos en Twitter">
				              <i class="fa fa-twitter"></i>
				    
						</a>
					</li>
				<?php } ?>
		    	<?php if($pry__web){ ?>
					<li id="wb" class="share-social">
						<a href="<?php echo $pry__web; ?>" class="tip btn btn-default" target="_blank" rel="follow" title="Visita nuestra Web">
				              <i class="fa fa-globe"></i>
						</a>
					</li>
				<?php } ?>
	   		</ul>
	    </div>
	<?php } ?>
</div>