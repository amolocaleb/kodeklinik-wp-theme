<?php


get_header();
?>

	<main id="primary" class="site-main centralize">

		<?php
		
		$args = [
			'post_type' => 'dev',
			'posts_per_page' =>8,
			'post_status' => 'publish'
		];
		
		
		$loop = new WP_Query( $args ); 
			
		while ( $loop->have_posts() ) : $loop->the_post(); 
			the_title(); 
			the_excerpt(); 
		endwhile;
		
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
