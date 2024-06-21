<?php

function motaphoto_assets() {
    
    // Déclarer jQuery
    wp_enqueue_script('jquery' );
    
    // Déclarer le JS
	wp_enqueue_script( 
        'motaphoto', 
        get_template_directory_uri() . '/js/script.js', 
        array( 'jquery' ), 
        '1.0', 
        true
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


function motaphoto_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'motaphoto' ) );
    register_nav_menu( 'footer-menu', __( 'Menu Pied de Page', 'motaphoto' ) );
}

add_action( 'after_setup_theme', 'motaphoto_menu');
