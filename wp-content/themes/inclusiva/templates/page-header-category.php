<?php use Roots\Sage\Titles; ?>

<div class="page-header">
	<?php if (function_exists('custom_breadcrumbs')) { custom_breadcrumbs(); } ?>
	<h1><?= Titles\title(); ?></h1>
</div>