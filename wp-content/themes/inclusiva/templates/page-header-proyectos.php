<?php use Roots\Sage\Titles; ?>
<?php // ACF Format Link 
	$pry__logo = get_field('pry__logo');
	$pry__web = get_field('pry__web'); 
?>

<div class="page-header">
	<?php if($pry__logo){ ?>
	<figure>
	  <img class="media-object" src="<?php echo $pry__logo; ?>" alt="<?= Titles\title(); ?>">
	</figure>
	<?php } ?>
	<h1><?= Titles\title(); ?></h1>
	<?php if($pry__web){ ?>
	<p><a href="<?php echo $pry__web; ?>" target="_blank" rel="follow"><?php echo $pry__web; ?></a></p>
	<?php } ?>

</div>