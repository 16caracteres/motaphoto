<?php get_header(); ?>

<main class="photo__list">
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
            <div class="photo__preview"></div>
            <div class="pagination__arrows">
                <img src="" alt="" class="arrow_left">
                <img src="" alt="" class="arrow_right">
            </div>
        </div>
        
    </section>
	


    <!-- Template part Vous aimerez aussi -->
</main> 

<?php get_footer(); ?>