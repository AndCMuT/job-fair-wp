<?php
    add_action('wp_enqueue_scripts', 'add_styles');
    add_action('after_setup_theme', 'add_logo');
    add_theme_support('post-thumbnails');

    function add_styles() {
        wp_enqueue_style('jobfair-style', get_stylesheet_uri(), [], time());

        if (is_page_template('news.php')) {
        wp_enqueue_style(
            'jobfair-news-page',
            get_template_directory_uri() . '/assets/css/news.css',
            array('jobfair-style'),
            filemtime(get_template_directory() . '/assets/css/news.css')
        );
        } elseif (is_singular('vacancy')) {
            wp_enqueue_style(
                'jobfair-single-vacancy',
                get_template_directory_uri() . '/assets/css/single-vacancy.css',
                array('jobfair-style'), // зависимости
                filemtime(get_template_directory() . '/assets/css/single-vacancy.css') // автообновление при изменениях
            );
        } elseif (is_singular('news')) {
            wp_enqueue_style( 
                'jobfair-single-news',
                get_template_directory_uri( ) . '/assets/css/single-news.css',
                array('jobfair-style'),
                filemtime(get_template_directory() . '/assets/css/single-news.css')
            );
        }
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


// Настройки для вывода анонса вакансии на главной странице 
    function jobfair_excerpt_length($length) {
        return 40; // количество слов
    }
    add_filter('excerpt_length', 'jobfair_excerpt_length');

    function jobfair_excerpt_more($more) {
        return '...'; // замена символов в конце анонса с [...] на ...
    }
    add_filter('excerpt_more', 'jobfair_excerpt_more');

?>