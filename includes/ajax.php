<?php 
// Requête Ajax pour le bouton Charger plus
add_action( 'wp_ajax_motaphoto_loadmore', 'motaphoto_loadmore' );
add_action( 'wp_ajax_nopriv_motaphoto_loadmore', 'motaphoto_loadmore' );

function motaphoto_loadmore () {
    check_ajax_referer('motaphoto_loadmore_nonce', 'nonce');

    $categorie = isset($_POST['categorie']) ? sanitize_text_field($_POST['categorie']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'DESC';
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    error_log('Categorie: ' . $categorie); // Pour journaliser les données
    error_log('Format: ' . $format);
    error_log('Order: ' . $order);
    error_log('Paged: ' . $paged);

    $args = [
        'post_type' => 'photos',
        'posts_per_page' => 8,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => $order,
        'paged' => $paged,
    ];
    
    $tax_query = [];
    if ($categorie) {
        $tax_query[] = [
            'taxonomy' => 'categorie-photos',
            'field' => 'slug',
            'terms' => $categorie,
        ];
    }

    if ($format) {
        $tax_query[] = [
            'taxonomy' => 'format-photos',
            'field' => 'slug',
            'terms' => $format,
        ];
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $ajaxposts = new WP_Query($args);

    $response = '';
    $max_pages = $ajaxposts->max_num_pages;
    
    if($ajaxposts->have_posts()) {
        ob_start();
        while($ajaxposts->have_posts()) : $ajaxposts->the_post();
            get_template_part( 'parts/photos_list' );
        endwhile;
        $response = ob_get_contents();
        ob_end_clean();
    } else {
        $response = '<p class="photo__no-results">Aucune image ne correspond à vos critères.</p>';
    }


    $result = [
        'max' => $max_pages,
        'html' => $response
    ];

    echo json_encode($result);
    wp_die();
}


// ----------


// Requête Ajax pour filtrer les photos
/*add_action('wp_ajax_motaphoto_filter_categories', 'motaphoto_filter_categories');
add_action('wp_ajax_nopriv_motaphoto_filter_categories', 'motaphoto_filter_categories');

function motaphoto_filter_categories() {
    $categorieSlug = sanitize_text_field($_POST['category']) ;
    $term = get_term_by('slug', $categorieSlug, 'categorie-photos');
    $termIds = [$term->term_id];

    if(!$term) {
        echo 'empty';
        exit;
    }

    $ajaxposts = new WP_Query([
      'post_type' => 'photos',
      'posts_per_page' => -1,
      'order' => 'desc',
      'tax_query' => [
            [
                'taxonomy' => 'categorie-photos',
                'field'    => 'term_id',
                'terms'    => $termIds,
                'operator' => 'IN'
            ],
        ]
      
    ]);
    $response = '';
  
    if($ajaxposts->have_posts()) {
      while($ajaxposts->have_posts()) : $ajaxposts->the_post();
        $response .= get_template_part('parts/photos_list');
      endwhile;
    } else {
      $response = 'empty';
    }
  
    echo $response;
    exit;
  }*/

