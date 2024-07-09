<?php get_header(); ?>

<main class="homepage">
    <section class="photos__hero">
        <?php get_template_part( 'parts/photos_hero' ); ?>
        <h1 class="hero__title">Photographe Event</h1>
    </section>
    <section class="photo__list">
        <div class="photos__filters">

        </div>
        
        <?php 
        // Définir les arguments personnalisés
            $args = array(
                'post_type' => 'photos',
                'posts_per_page' => 8, // Modifier le nombre de photos à afficher
                'orderby' => 'date' // Par exemple, trier par date au lieu de aléatoire
                
            );

            // Inclure le template-part avec les arguments
            get_template_part('template-photo-list', null, array('args' => $args));
        ?>

    </section>
</main>

<?php get_footer(); ?>