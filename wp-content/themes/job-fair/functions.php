<?php
    add_action('wp_enqueue_scripts', 'add_styles');
    add_action('after_setup_theme', 'add_logo');
    function add_styles() {
        wp_enqueue_style('style', get_stylesheet_uri());
    }
    function add_logo() {
        add_theme_support( 'custom-logo', [
            'height' => 70,
            'width' => 70,
            'flex-width' => false,
            'flex-height' => false,
            'header-text' => '',
            'unlink-homepage-logo' => false
        ]);
    }
?>