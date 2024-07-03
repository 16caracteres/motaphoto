<?php get_header(); ?>

<main class="photos__list">
	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
    	<div class="photo">
        	<h2 class="photo__title">
                <a href="<?php the_permalink(); ?>">
                	<?php the_title(); ?>
                </a>
            </h2>
         	<?php the_post_thumbnail(); ?>
    	</div>
    <?php endwhile; endif; ?>
</main> 

<?php get_footer(); ?>