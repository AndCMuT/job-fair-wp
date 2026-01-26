<?php
/**
 * Plugin Name: JobFair employees CPT
 * Description: Плагин для работы с сотрудниками
 * Version: 1.0
 * Author: Smetanin Andrey
 */

if ( !defined('ABSPATH') ) {
    exit;
}

function jobfair_register_employee_cpt() {
    register_post_type('employee', [
        'labels' => [
            'name' => 'Сотрудники',
            'singular_name' => 'Сотрудник',
            'add_new' => 'Добавить сотрудника',
            'add_new_item' => 'Добавить нового сотрудника',
            'edit_item' => 'Отредактировать данные сотрудника',
            'new_item' => 'Новый сотрудник',
            'view_item' => 'Просмотр карточки сотрудника',
        ],
        'public' => true,
        'menu_icon' => 'dashicons-groups',
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'rewrite' => ['slug' => 'employees']
    ]);
}

add_action('init', 'jobfair_register_employee_cpt');

function jobfair_register_position_taxonomy() {
    $labels = array(
        'name' => 'Должности сотрудников',
        'singular_name' => 'Должность сотрудника',
        'search_items' => 'Поиск должности',
        'all_items' => 'Все должности',
        'edit_item' => 'Отредактировать должность',
        'update_item' => 'Обновить должность',
        'add_new_item' => 'Добавить должность',
        'new_item_name' => 'Новая должность сотрудника',
        'menu_name' => 'Должности',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'position'),
    );

    register_taxonomy('position', array('employee'), $args);
}
add_action('init', 'jobfair_register_position_taxonomy');

function jobfair_add_employees_metabox() {
    add_meta_box(
        'employees', 
        'Дополнительная информация', 
        'jobfair_employee_fields', 
        'employee'
        );
}

add_action('add_meta_boxes', 'jobfair_add_employees_metabox');

function jobfair_employee_fields($post) {
    $specialization = get_post_meta($post->ID, 'specialization', true);
    $work_exp = get_post_meta($post->ID, 'work_exp', true);
    $services = get_post_meta($post->ID, 'services', true);
    ?>

    <p>
        <label for="specialization">Специализация</label>
        <input type="text" name="specialization" id="specialization" value="<?php echo esc_attr($specialization); ?>" style="width:100%">
    </p>
    <p>
        <label for="work_exp">Опыт работы</label>
        <input type="text" name="work_exp" id="work_exp" value="<?php echo esc_attr($work_exp); ?>" style="width:100%">
    </p>
        <p>
        <label for="services">Предоставляемые услуги</label>
        <input type="text" name="services" id="services" value="<?php echo esc_attr($services); ?>" style="width:100%">
    </p>
    <?php
}

function jobfair_save_employee_fields($post_id) {
    if (array_key_exists('specialization', $_POST)) {
        update_post_meta(
            $post_id, 
            'specialization', 
            sanitize_text_field($_POST['specialization'])
        );
    }
    if (array_key_exists('work_exp', $_POST)) {
        update_post_meta(
            $post_id, 
            'work_exp', 
            sanitize_text_field($_POST['work_exp'])
        );
    }
    if (array_key_exists('services', $_POST)) {
        update_post_meta(
            $post_id, 
            'services', 
            sanitize_text_field($_POST['services'])
        );
    }
}
add_action('save_post_employee', 'jobfair_save_employee_fields');