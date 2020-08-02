<?php 
get_header();
$args = [
    'post_type' => 'kk_department',
    'posts_per_page' =>8,
    'post_status' => 'publish'
];


$loop = new WP_Query( $args ); 

?>
<div class="services p-2">
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <div class="service-card flex">
        <div class="card-img p2">
            <?php the_post_thumbnail();?>
        </div>
        <div class="card-title text-white text-bold ptb-1">
            <?php the_title(); ?>
        </div>
        <div class="text-small text-left text-white pb-1">
            <?php the_excerpt(); ?>
        </div>
        <a href="<?php the_permalink() ?>" class="btn-cust">Learn More</a>
    </div>
    <?php  ?>
   
    
<?php endwhile; ?>
</div> 
<!-- .services -->
<?php get_footer(); ?>