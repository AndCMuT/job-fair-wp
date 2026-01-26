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
    $experience = get_post_meta($post->ID, 'experience', true);
    $remote = get_post_meta($post->ID, 'remote_work', true);
    ?>
    <p>
        <label for="company_name">Компания:</label><br>
        <input type="text" name="company_name" id="company_name" value="<?php echo esc_attr($company); ?>" style="width:100%">
    </p>
    <p>
        <label for="salary">Зарплата:</label><br>
        <input type="text" name="salary" id="salary" value="<?php echo esc_attr($salary); ?>" style="width:100%">
    </p>
    <p>
        <label for="experience">Опыт работы:</label><br>
        <input type="text" name="experience" id="experience" value="<?php echo esc_attr($experience); ?>" style="width:100%">
    </p>
    <p>
        <label for="remote_work">Возможность удалённой работы
            <input type="checkbox" name="remote_work" value="1"
                <?php checked($remote, '1'); ?>>
        </label>        
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
    if (array_key_exists('experience', $_POST)) {
        update_post_meta($post_id, 'experience', sanitize_text_field($_POST['experience']));
    }
    if (isset($_POST['remote_work'])) {
        update_post_meta($post_id, 'remote_work', '1');
    } else {
        delete_post_meta($post_id, 'remote_work');
    }
}
add_action('save_post', 'jobfair_save_vacancy_fields');
