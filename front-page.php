<?php get_header(); ?>

<main class="homepage">
    <section class="photos__hero">
        <?php get_template_part( 'parts/photos_hero' ); ?>
        <h1 class="hero__title">Photographe Event</h1>
    </section>
    <section class="photos">
        <div class="photos__filters">
            <form id="filters__form" action="">
                <div class="filters__left">
                    <?php
                        $taxonomy = 'categorie-photos';
                        $terms = get_terms(array(
                            'taxonomy' => $taxonomy,
                            'hide_empty' => false,
                        ));

                        $output = '';

                        if (!empty($terms) && !is_wp_error($terms)) {
                            $output .= '<select name="filter__categories" id="filter__categories">';
                            $output .= '<option value="">Catégories</option>';
                            foreach ($terms as $term) {
                                $output .= '<option class="categories__value-item" value="' . esc_attr($term->slug) . '" data-slug="' . esc_attr($term->slug) . '" data-type="photos">' . esc_html($term->name) . '</option>';
                            }
                            $output .= '</select>';
                        }

                        echo $output;
                    ?>
                    
                    <?php
                        $taxonomy = 'format-photos';
                        $terms = get_terms(array(
                            'taxonomy' => $taxonomy,
                            'hide_empty' => false,
                        ));
                        
                        $output = '';

                        if (!empty($terms) && !is_wp_error($terms)) {
                            $output .= '<select name="filter__formats" id="filter__formats">';
                            $output .= '<option value="">Formats</option>';
                            foreach ($terms as $term) {
                                $output .= '<option class="formats__value-item" value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                            }
                            $output .= '</select>';
                        }

                        echo $output;
                    ?>

                </div>
                <div class="filters__right">
                    <select name="filters__trier-par" id="filters__trier-par">
                        <option value="trier-par">Trier par</option>
                        <option value="plus-recentes">À partir des plus récentes</option>
                        <option value="plus-anciennes">À partir des plus anciennes</option> 
                    </select>
                </div>
                
            </form>
        </div>

        <div class="photo__list">
            <?php 
                $args = array(
                    'post_type' => 'photos',
                    'posts_per_page' => 8,
                    'post_status' => 'publish',
                    'order' => 'date',
                    'order_by' => 'desc',
                    'paged' => 1
                );

                $homepage_query = new WP_Query( $args );

                if( $homepage_query->have_posts() ) : while( $homepage_query->have_posts() ) : $homepage_query->the_post();
                    
                    get_template_part( 'parts/photos_list' ); 

                    endwhile;
                    endif;

                wp_reset_postdata();
            ?>
        
        </div>

        <div class="button__loadmore">
            <button class="js__loadmore" data-nonce="<?php echo wp_create_nonce('motaphoto_loadmore_nonce'); ?>">Charger plus</button>
        </div>

    </section>
</main>

<?php get_footer(); ?>