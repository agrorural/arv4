<?php 
	global $post;
	
	$post_slug=$post->post_name;
	$count = json_decode(file_get_contents("https://api.facebook.com/method/fql.query?format=json&query=SELECT+url,normalized_url,total_count,share_count,comment_count,like_count,click_count,commentsbox_count+FROM+link_stat+WHERE+url+%3D+%27http://www.agrorural.gob.pe/".$post_slug."/%27"),true);
	$share_count = $count[0]['share_count'];
	//echo $post_slug;
	//var_dump($count);
?>
<div class="sharing-list">
	<ul class="list-inline">
		<li id="fb">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
				  <?php if ($share_count > 0) {?>
				  	<span class="badge"><?php echo $count[0]['share_count']; ?></span>
				  <?php } ?>
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