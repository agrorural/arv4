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

	  <div class="sharing-list">
    	<ul class="list-inline">
    		<?php if($pry__fb){ ?>
				<li id="fb">
					<a href="<?php echo 'http://www.facebook.com/' . $pry__fb; ?>" class="tip" target="_blank" rel="follow" title="Síguenos en Facebook">
						<span class="fa-stack fa-lg">
			              <i class="fa fa-circle fa-stack-2x"></i>
			              <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
			            </span>
					</a>
				</li>
			<?php } ?>
			<?php if($pry__tw){ ?>
				<li id="tw">
					<a href="<?php echo 'http://twitter.com/' . $pry__tw; ?>" class="tip" target="_blank" rel="follow" title="Síguenos en Twitter">
						<span class="fa-stack fa-lg">
			              <i class="fa fa-circle fa-stack-2x"></i>
			              <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
			            </span>
					</a>
				</li>
			<?php } ?>
	    	<?php if($pry__web){ ?>
				<li>
					<a href="<?php echo $pry__web; ?>" class="tip" target="_blank" rel="follow" title="Visita nuestra Web">
						<span class="fa-stack fa-lg">
			              <i class="fa fa-circle fa-stack-2x"></i>
			              <i class="fa fa-globe fa-stack-1x fa-inverse"></i>
			            </span>
					</a>
				</li>
			<?php } ?>
   		</ul>
    </div>
</div>