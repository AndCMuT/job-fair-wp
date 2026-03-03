<?php
/**
 * Plugin Name: JobFair Applications
 * Description: Отклики на вакансии
 * Version: 1.0
 */

if ( ! defined('ABSPATH') ) {
    exit;
}
register_activation_hook(__FILE__, 'jobfair_create_applications_table'); //хук активации

function jobfair_create_applications_table() { //функция создания БД
    global $wpdb;

    $table_name = $wpdb->prefix . 'jobfair_applications'; //имя таблицы с префиксом сайта
    $charset_collate = $wpdb->get_charset_collate(); //получаем настройки кодировки
    //запрос на создание таблицы
    $sql = "CREATE TABLE $table_name (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, 
        vacancy_id BIGINT UNSIGNED NOT NULL,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        about TEXT,
        resume VARCHAR(255),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
        ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php'; //подключаем файл с функцией dbDelta
    dbDelta($sql); // обновляет таблицу если она уже есть
}
//AJAX обработчики
add_action('wp_ajax_jobfair_submit_application', 'jobfair_submit_application');  //для авторизированных пользователей
add_action('wp_ajax_nopriv_jobfair_submit_application', 'jobfair_submit_application'); //для гостей

function jobfair_submit_application() { //функция обработки полученных данных
    global $wpdb;
    $table = $wpdb->prefix . 'jobfair_applications';

    $data = [
        'vacancy_id' => intval($_POST['vacancy_id']),
        'name' => sanitize_text_field($_POST['name']),
        'email' => sanitize_email($_POST['email']),
        'about' => sanitize_textarea_field($_POST['about']),
        'resume' => esc_url_raw($_POST['resume_link']),
    ];

    $result = $wpdb->insert($table, $data);

    if ($result) { //ответ будет отправлен в modal.js
        wp_send_json([
            'success' => true,
            'message' => 'Отклик успешно отправлен'
        ]);
    } else {
        wp_send_json([
            'success' => false,
            'message' => 'Ошибка при сохранении'
        ]);
    }

}

add_action('admin_menu', 'jobfair_add_application_page'); //добавление в меню в админ панели

function jobfair_add_application_page() {
    add_menu_page(
        'Отклики',
        'Отклики',
        'manage_options',
        'jobfair-applications',
        'jobfair_render_application_page',
        'dashicons-email',
        25
    );
}

function jobfair_render_application_page() { //функция вывода страницы

    global $wpdb;
    $table = $wpdb->prefix . 'jobfair_applications';
    $applications = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC"); //получаем отклики из БД

    if (isset($_GET['delete'])) { //удаление отклика
    $wpdb->delete(
        $table,
        ['id' => intval($_GET['delete'])],
        ['%d']
    );
    echo '<div class="updated"><p>Удален</p></div>';
    }

    echo '<div class="wrap">';
    echo '<h1>Отклики на вакансии</h1>';

    if (empty($applications)) { //условие если откликов нет
        echo '<p>Откликов пока нет.</p>';
        return;
    }
    //таблица с откликами
    echo '<table class="widefat fixed striped">'; 
    echo '<thead>
            <tr>
                <th>ID</th>
                <th>Вакансия</th>
                <th>Имя</th>
                <th>Email</th>
                <th>О себе</th>
                <th>Резюме</th>
                <th>Дата</th>
            </tr>
        </thead><tbody>';

    foreach ($applications as $app) {
        $vacancy_id = (int) $app->vacancy_id;
        $title = get_the_title($vacancy_id);
        $edit_link = get_edit_post_link($vacancy_id);

        echo '<tr>';
        echo '<td>' . esc_html($app->id) . '</td>'; ?>
        <td>
            <?php if ($title && $edit_link): ?>
                <a href="<?php echo esc_url($edit_link); ?>">
                    <?php echo esc_html($title); ?>
                </a>
            <?php else: ?>
                <em>Вакансия удалена</em>
            <?php endif; ?>
        </td> <?php
        echo '<td>' . esc_html($app->name) . '</td>';
        echo '<td>' . esc_html($app->email) . '</td>';
        echo '<td>' . esc_html($app->about) . '</td>';
        echo '<td><a href="' . esc_url($app->resume) . '" target="_blank">Ссылка</a></td>';
        echo '<td>
                <a href="' . admin_url('admin.php?page=jobfair-applications&delete=' . $app->id) . '">Удалить</a>
            </td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';
}
?>
