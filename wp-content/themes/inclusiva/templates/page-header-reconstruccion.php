<?php use Roots\Sage\Titles; ?>

<div class="page-header">
	<?php if (function_exists('custom_breadcrumbs')) { custom_breadcrumbs(); } ?>
    <h1><?= Titles\title(); ?></h1>
    <div class="share">
        <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fwww.agrorural.gob.pe%2Freconstruccion-con-cambios%2F&layout=button&size=large&mobile_iframe=true&appId=485149758350535&width=99&height=28" width="99" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
    </div>
    <p class="lead">Todo sobre los esfuerzos que se realizan desde el Ministerio de Agricultura y Riego y AGRO RURAL para una Reconstrucción con cambios.</p>
</div>