<div class="photo__list">
    <?php 

    //Récupérer la catégorie de photo en cours
    $categories = get_the_terms(get_the_ID(), 'categorie-photos');
    $current_category_slugs = array();

    if ($categories) {
        foreach ($categories as $category) {
            $current_category_slugs[] = $category->slug;
        }
    }
    

    // On définit les arguments pour définir ce que l'on souhaite récupérer
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie-photos',
                'field' => 'slug',
                'terms' => $current_category_slugs
            ),
            ),
        'post__not_in' => [get_the_ID()]
    );

    // On exécute la WP Query
    $suggestion_query = new WP_Query( $args );

    // On lance la boucle !
    if( $suggestion_query->have_posts() ) : while( $suggestion_query->have_posts() ) : $suggestion_query->the_post();
        ?>
        
        <a href="<?php echo get_the_permalink(); ?>" class="photo__link"><?php the_post_thumbnail(); ?></a> 

        <?php
    endwhile;
    endif;

    // 4. On réinitialise à la requête principale (important)
    wp_reset_postdata();
    ?>
</div>