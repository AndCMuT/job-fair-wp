<?php
    add_action('wp_enqueue_scripts', 'add_styles');
    add_action('after_setup_theme', 'add_logo');

    function add_styles() {
        wp_enqueue_style('style', get_stylesheet_uri());
    }
    function add_logo() {
        add_theme_support( 'custom-logo', [
            'height' => 50,
            'width' => 50,
            'flex-width' => false,
            'flex-height' => false,
            'header-text' => '',
            'unlink-homepage-logo' => false
        ]);
    }
// Меню
    add_action('after_setup_theme', 'add_menus');
    function add_menus() {
        register_nav_menus( [
            'header-menu' => 'Верхняя область',
            'footer-menu' => 'Нижняя область'
        ]);
    }
// Добавляем классы для тега <li>
    function job_add_menu_classes($classes) {
        $classes[] = 'nav-item';
        // if (in_array('current-menu-item', $classes)) {
        //     $classes[] = 'active';
        // }

        return $classes;
    }
    add_filter( 'nav_menu_css_class', 'job_add_menu_classes', 10, 1);
// Добавляем классы для тега <li>
    function add_link_classes($atts) {
        $atts['class'] = 'nav-link';
        return $atts;
    };
    add_filter( 'nav_menu_link_attributes', 'add_link_classes', 10, 1 );
?>