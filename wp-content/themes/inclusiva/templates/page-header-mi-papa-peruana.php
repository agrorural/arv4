<?php use Roots\Sage\Titles; ?>
<?php 
    $logo = get_field('pry__logo');
?>
<div class="page-header">
	<?php if (function_exists('custom_breadcrumbs')) { custom_breadcrumbs(); } ?>
    <img src="<?php echo $logo; ?>" alt="" width="185">
    <div class="share">
        <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fwww.agrorural.gob.pe%2Fmi-papa-peruana%2F&layout=button&size=large&mobile_iframe=true&appId=485149758350535&width=99&height=28" width="99" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
    </div>
    <?php 
        $page = get_page_by_path( 'mi-papa-peruana' );
    ?>
    <p class="lead"><?php echo $page->post_content; ?></p>
</div>