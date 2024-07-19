<?php
// Appel des styles et scripts
function motaphoto_assets() {
    
    // Déclarer jQuery et autres bibliothèques
    wp_enqueue_script('jquery');

    wp_enqueue_script( 
        'nice-select-js', 
        get_template_directory_uri() . '/js/libraries/nice-select/js/jquery.nice-select.min.js', 
        array( 'jquery' ), 
        '1.1.0', 
        array( 
            'strategy'  => 'defer',
        )
    );
    
    wp_enqueue_script( 
        'block-scroll-lock-js', 
        get_template_directory_uri() . '/js/libraries/body-scroll-lock.js', 
        array( 'jquery' ), 
        '4.0.0', 
        array( 
            'strategy'  => 'defer',
        )
    );

    // Déclarer les fichiers JS
	wp_enqueue_script( 
        'motaphoto', 
        get_template_directory_uri() . '/js/script.js', 
        array( 'jquery' ), 
        '1.0', 
        array( 
            'strategy'  => 'defer',
        )
    );

    wp_enqueue_script( 
        'motaphoto_filters', 
        get_template_directory_uri() . '/js/filters.js', 
        array( 'jquery' ), 
        '1.0', 
        array( 
            'strategy'  => 'defer',
        )
    );

    wp_enqueue_script( 
        'motaphoto_lightbox', 
        get_template_directory_uri() . '/js/lightbox.js', 
        array( 'jquery' ), 
        '1.0', 
        array( 
            'strategy'  => 'defer',
        )
    );
    
    // Déclarer les fichiers de style
    wp_enqueue_style( 
        'motaphoto',
        get_stylesheet_uri(), 
        array(), 
        '1.0'
    );

    wp_enqueue_style(
        'nice-select-css', 
        get_template_directory_uri() . '/js/libraries/nice-select/css/nice-select.css', 
        array(),
        '1.1.0'
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

// Ajout mention Tous droits réservés dans le menu du footer
function footer_menu($items, $args) {
    if ($args->theme_location == 'footer-menu') {
            $items .= '<li>Tous droits réservés</li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'footer_menu', 10, 2);

// ----------


include get_template_directory() . '/includes/ajax.php';