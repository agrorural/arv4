<?php // ACF Format Link 
	$lnk__medio = get_field('lnk__medio'); 
	$lnk__url = get_field('lnk__url');
?>
<time class="updated" datetime="<?= get_post_time('c', true); ?>">Publicado en   <a href="<?php if ($lnk__url) { echo $lnk__url; } else { echo bloginfo( 'url' ); } ?>" rel="nofollow" class="" target="_blank"><?php if ($lnk__medio) { echo $lnk__medio; } else { echo 'AGRO RURAL'; } ?></a>, el <?= get_the_date(); ?></time>