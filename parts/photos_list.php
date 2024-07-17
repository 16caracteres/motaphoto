<div class="photo__list-item">
    <div class="photo__link-hover">
        <div class="photo__link-fullscreen">
            <button class="fullscreen__icon"></button>
        </div>
        <div class="photo__link-details">
            <a href="<?php echo get_the_permalink(); ?>" class="details__icon"></a>
        </div>
        <div class="photo__link-infos">
            <span><?php the_field( 'reference' ); ?></span>
            <span>
                <?php 
                $terms = wp_get_post_terms( get_the_ID(), 'categorie-photos' );

                if ( !empty($terms) && !is_wp_error($terms) ) {
                    $term_names = array();
                    
                    foreach ( $terms as $term ) {
                        $term_names[] = $term->name;
                    }
                    
                    echo implode( ', ', $term_names );
                }
                ?>
            </span>
        </div>
    </div>
    <a href="<?php echo get_the_permalink(); ?>" class="photo__link">
        <?php the_post_thumbnail(); ?>
    </a>
</div>
