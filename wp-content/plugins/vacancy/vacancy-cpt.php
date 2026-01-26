<?php
/**
 * Plugin Name: JobFair Vacancy CPT
 * Description: Плагин для работы с вакансиями на сайте
 * Version: 1.0
 * Author: Smetanin Andrey
 */

// Защита — если файл вызван напрямую
if ( !defined('ABSPATH') ) {
    exit;
}

// Вакансии
function jobfair_register_vacancy_cpt() {
    register_post_type('vacancy', [
        'labels' => [
            'name' => 'Вакансии',
            'singular_name' => 'Вакансия',
            'add_new' => 'Добавить вакансию',
            'add_new_item' => 'Добавить новую вакансию',
            'edit_item' => 'Редактировать вакансию',
            'new_item' => 'Новая вакансия',
            'view_item' => 'Просмотр вакансии',
        ],
        'public' => true,
        'menu_icon' => 'dashicons-businessman',
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'rewrite' => ['slug' => 'vacancies'],
    ]);
}
add_action('init', 'jobfair_register_vacancy_cpt');

function jobfair_register_location_taxonomy() {
    $labels = array(
        'name'                       => 'Локации',
        'singular_name'              => 'Локация',
        'search_items'               => 'Поиск локаций',
        'all_items'                  => 'Все локации',
        'edit_item'                  => 'Редактировать локацию',
        'update_item'                => 'Обновить локацию',
        'add_new_item'               => 'Добавить локацию',
        'new_item_name'              => 'Новая локация',
        'menu_name'                  => 'Локации',
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => false,   // false = как теги, true = как категории
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,    
        'rewrite'           => array('slug' => 'location'),
    );

    register_taxonomy('location', array('vacancy'), $args);
}
add_action('init', 'jobfair_register_location_taxonomy');
