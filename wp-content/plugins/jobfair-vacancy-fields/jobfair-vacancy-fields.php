<?php
/**
 * Plugin Name: JobFair Vacancy Fields
 * Description: Добавляет дополнительные поля (зарплата, компания) для кастомного типа записи "Вакансии".
 * Version: 1.0
 * Author: Smetanin Andrey
 */

// Защита — если файл вызван напрямую
if ( !defined('ABSPATH') ) {
    exit;
}

// Добавляем метабоксы
function jobfair_add_vacancy_metaboxes() {
    add_meta_box(
        'vacancy_details',
        'Детали вакансии',
        'jobfair_vacancy_fields',
        'vacancy',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'jobfair_add_vacancy_metaboxes');

// Форма полей
function jobfair_vacancy_fields($post) {
    $company = get_post_meta($post->ID, 'company_name', true);
    $salary = get_post_meta($post->ID, 'salary', true);
    ?>
    <p>
        <label for="company_name">Компания:</label><br>
        <input type="text" name="company_name" id="company_name" value="<?php echo esc_attr($company); ?>" style="width:100%">
    </p>
    <p>
        <label for="salary">Зарплата:</label><br>
        <input type="text" name="salary" id="salary" value="<?php echo esc_attr($salary); ?>" style="width:100%">
    </p>
    <?php
}

// Сохранение данных
function jobfair_save_vacancy_fields($post_id) {
    if (array_key_exists('company_name', $_POST)) {
        update_post_meta($post_id, 'company_name', sanitize_text_field($_POST['company_name']));
    }
    if (array_key_exists('salary', $_POST)) {
        update_post_meta($post_id, 'salary', sanitize_text_field($_POST['salary']));
    }
}
add_action('save_post', 'jobfair_save_vacancy_fields');
