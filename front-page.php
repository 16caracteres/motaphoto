<?php get_header(); ?>

<main class="homepage">
    <section class="photos__hero">
        <?php get_template_part( 'parts/photos_hero' ); ?>
        <h1 class="hero__title">Photographe Event</h1>
    </section>
    <section class="photos">
        <div class="photos__filters">
            <form action="">
                <select name="" id=""> 
                    <option value="Catégories">Catégories</option>
                    <option value=""></option> 
                </select>
                <select name="" id="">
                    <option value="Formats">Formats</option>
                    <option value=""></option> 
                </select>
                <select name="" id="">
                    <option value="Trier par">Trier par</option>
                    <option value=""></option> 
                </select>
            </form>
        </div>

        <div class="photo__list">
            <?php 
                $args = array(
                    'post_type' => 'photos',
                    'posts_per_page' => 8,
                    'order' => 'date'
                );

                $homepage_query = new WP_Query( $args );

                if( $homepage_query->have_posts() ) : while( $homepage_query->have_posts() ) : $homepage_query->the_post();
                    
                    get_template_part( 'parts/photos_list' ); 

                    endwhile;
                    endif;

                wp_reset_postdata();
            ?>
        
        </div>

    </section>
</main>

<?php get_footer(); ?>