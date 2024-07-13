<?php
// Appel des styles et scripts
function motaphoto_assets() {
    
    // Déclarer jQuery
    wp_enqueue_script('jquery');
    
    // Déclarer le JS
	wp_enqueue_script( 
        'motaphoto', 
        get_template_directory_uri() . '/js/script.js', 
        array( 'jquery' ), 
        '1.0', 
        array( 
            'strategy'  => 'defer',
        )
    );
    
    // Déclarer le fichier style.css à la racine du thème
    wp_enqueue_style( 
        'motaphoto',
        get_stylesheet_uri(), 
        array(), 
        '1.0'
    );

}
add_action( 'wp_enqueue_scripts', 'motaphoto_assets' );


// Création des menus
function motaphoto_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'motaphoto' ) );
    register_nav_menu( 'footer-menu', __( 'Menu Bas de Page', 'motaphoto' ) );
}
add_action( 'after_setup_theme', 'motaphoto_menu');


// Création CPT et Taxonomies
function motaphoto_post_types() {
	// CPT Photos
    $labels = array(
        'name' => 'Photos',
        'all_items' => 'Toutes les photos',
        'singular_name' => 'Photo',
        'add_new' => 'Ajouter',
        'add_new_item' => 'Ajouter une photo',
        'edit_item' => 'Modifier la photo',
        'update_item' => 'Éditer le Like',
        'menu_name' => 'Photos'
    );

	$args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail'),
        'menu_position' => 10, 
        'menu_icon' => 'dashicons-format-image',
	);
	register_post_type( 'photos', $args );

    // Taxonomie Catégorie de Photos
    $labels = array(
        'name' => 'Catégorie',
        'new_item_name' => 'Nom de la nouvelle catégorie',
        'add_new_item' => 'Ajouter une nouvelle catégorie',
        'edit_item' => 'Modifier la catégorie'
    );
    
    $args = array( 
        'labels' => $labels,
        'public' => true, 
        'show_in_rest' => true,
        'hierarchical' => true, 
    );
    register_taxonomy( 'categorie-photos', 'photos', $args );

    // Taxonomie Format de Photos
    $labels = array(
        'name' => 'Format',
        'new_item_name' => 'Nom du nouveau format',
        'add_new_item' => 'Ajouter un nouveau format',
        'edit_item' => 'Modifier le format'
    );
    
    $args = array( 
        'labels' => $labels,
        'public' => true, 
        'show_in_rest' => true,
        'hierarchical' => true, 
    );
    register_taxonomy( 'format-photos', 'photos', $args );
}
add_action( 'init', 'motaphoto_post_types' );


// ----------


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
    
    if ($categorie) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie-photos',
            'field' => 'slug',
            'terms' => $categorie,
        ];
    }

    if ($format) {
        $args['tax_query'][] = [
            'taxonomy' => 'format-photos',
            'field' => 'slug',
            'terms' => $format,
        ];
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

