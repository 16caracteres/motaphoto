<?php 
$args = array(
    'post_type' => 'photos',
    'posts_per_page' => 1,
    'orderby' => 'rand'
);

$hero_query = new WP_Query( $args );

if( $hero_query->have_posts() ) : while( $hero_query->have_posts() ) : $hero_query->the_post();

    the_post_thumbnail();

endwhile;
endif;

wp_reset_postdata();