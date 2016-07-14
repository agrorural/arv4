<?php 
	global $post;
	
	$post_slug=$post->post_name;
?>
<div class="sharing-list">
	<ul class="list-inline">
		<li id="fb">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<li id="tw">
			<a href="https://twitter.com/home?status=<?php the_permalink(); ?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<li id="gp">
			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
	</ul>
</div>