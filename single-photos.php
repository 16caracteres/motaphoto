<?php get_header(); ?>

<main class="photo__single">
    <section class="photo__container">
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
            <div class="photo__data">
                <h2 class="photo__title">
                    <?php the_title(); ?>
                </h2>
                <ul class="photo__dataList">
                    <li>Référence : 
                        <span class="photo__reference"><?php the_field( 'reference' ); ?></span>
                    </li>
                    <li>Catégorie : <?php the_terms( get_the_ID() , 'categorie-photos' ); ?></li>
                    <li>Format : <?php the_terms( get_the_ID() , 'format-photos' ); ?></li>
                    <li>Type : <?php the_field( 'type_de_photo' ); ?></li>
                    <li>Année : <?php the_time('Y'); ?></li>
                </ul>                 
            </div>
            <div class="photo__thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php endwhile; endif; ?>

        <div class="photo__contact">
            <p>Cette photo vous intéresse ?</p>
            <button class="btn__contact">Contact</button>
        </div>
        <div class="photo__pagination">
            <div class="photo__preview">
                <?php
                    $previous_post = get_previous_post();
                    $next_post = get_next_post();
                    $previous_post_thumbnail = $previous_post ? get_the_post_thumbnail_url($previous_post->ID, 'thumbnail') : '';
                    $next_post_thumbnail = $next_post ? get_the_post_thumbnail_url($next_post->ID, 'thumbnail') : ''; 
                ?>
                <img src="<?php echo $previous_post_thumbnail ?>" alt="Photo Précédente" class="photo__preview-previous">
                <img src="<?php echo $next_post_thumbnail ?>" alt="Photo Suivante" class="photo__preview-next">
            </div>
            <div class="pagination__arrows">
                <div class="pagination__arrow_left">
                    <?php previous_post_link('%link', '<img src="/wp-content/themes/nathalie-mota/assets/images/arrow_left.png" alt="Fléche voir photo précédente" class="arrow_left">'); ?>
                </div>
                <div class="pagination__arrow_right">
                    <?php next_post_link('%link', '<img src="/wp-content/themes/nathalie-mota/assets/images/arrow_right.png" alt="Fléche voir photo suivante" class="arrow_right">'); ?>
                    
                </div>
            </div>
        </div>
        
    </section>
	


    <!-- Template part Vous aimerez aussi -->
    <section class="photos__suggestion">
        <h4>Vous aimerez aussi</h4>
        <?php get_template_part( 'parts/photos_list' ); ?>
    </section>
    

</main> 

<?php get_footer(); ?>