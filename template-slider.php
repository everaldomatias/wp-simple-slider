<?php
	$args = array(
		'posts_per_page' => 5,
		'orderby' => 'date',
		'order' => 'DESC',
		'post_type' => 'sliders',
	);
	$sliders_home = new WP_Query( $args );
?>

<div class="slider">
 
	<ul class="slider-default">

	<?php while ( $sliders_home->have_posts() ) : $sliders_home->the_post(); ?>

	<li class="item item-slider">
		<a href="<?php echo 'http://' . slider_get_field( 'slider_link' ); ?>">
		<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('large');
			} else {
				echo '<img src="' . get_template_directory() . '/images/thumb-default.jpg" alt="<?php the_permalink(); ?>">';
			}
		?>
		</a>
	</li>

	<?php endwhile; ?> 

	</ul><!-- slider-default -->
	
	<div class="prev" id="prev-default"></div>
	<div class="next" id="next-default"></div>

</div><!-- slider -->

	