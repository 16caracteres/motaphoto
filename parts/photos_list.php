<div class="photo__list-item">
    <div class="photo__link-hover">
        <div class="photo__link-fullscreen">
            <button class="fullscreen__icon"></button>
        </div>
        <div class="photo__link-details">
            <a href="<?php echo get_the_permalink(); ?>" class="details__icon"></a>
        </div>
        <div class="photo__link-infos">
            <span class="photo__title"><?php the_title(); ?></span>
            <span class="photo__cat">
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
        <?php 
            $thumbnail_id = get_post_thumbnail_id();
            $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full')[0];
            echo '<img src="' . esc_url($thumbnail_url) . '" data-src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
        ?>
    </a>
</div>
