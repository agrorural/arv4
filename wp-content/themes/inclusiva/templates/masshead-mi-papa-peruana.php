<?php use Roots\Sage\Titles; ?>

<?php
	global $post;
	$upload_dir = wp_upload_dir();
?>
  <!-- Swiper -->
<div class="masshead-slider swiper-container">
    <div class="swiper-wrapper">
        <?php
            $gallery = get_attached_media( 'image/jpeg', $post->ID );

            if( $gallery ){
                foreach($gallery as $clave =>$valor){
                    echo '<div class="masshead swiper-slide" style="background:url(';
                        echo $valor->guid;
                    echo ') no-repeat top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">';
                        echo '<div class="container">';
                            get_template_part('templates/page','header-mi-papa-peruana');
                        echo '</div>';                        
                    echo '</div>';
                    
                }
            }
        ?>
    </div>
    <!-- Add Arrows -->
    <!-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div> -->
     <!-- Add Pagination -->
     <!-- <div class="swiper-pagination"></div> -->
</div>