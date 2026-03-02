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
            'name' => 'Вакансии', //Основное название, множественное число
            'singular_name' => 'Вакансия', // Название в единственном числе
            'add_new' => 'Добавить вакансию', // Для добавления новой записи
            'add_new_item' => 'Добавить новую вакансию', // Заголовок для создаваемой записи
            'edit_item' => 'Редактировать вакансию', // Для редактирования записи
            'new_item' => 'Новая вакансия', // Текст новой записи
            'view_item' => 'Просмотр вакансии', //Для просмотра записи этого типа
        ],
        'public' => true,
        'menu_icon' => 'dashicons-businessman', // Иконка в меню
        'has_archive' => true, // архив
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'rewrite' => ['slug' => 'vacancies'],
    ]);
}
add_action('init', 'jobfair_register_vacancy_cpt');

function jobfair_register_location_taxonomy() {
    $labels = array(
        'name' => 'Локации',
        'singular_name' => 'Локация',
        'search_items' => 'Поиск локаций',
        'all_items' => 'Все локации',
        'edit_item' => 'Редактировать локацию',
        'update_item' => 'Обновить локацию',
        'add_new_item' => 'Добавить локацию',
        'new_item_name' => 'Новая локация',
        'menu_name' => 'Локации',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => false,   // false = как теги, true = как категории
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,    
        'rewrite' => array('slug' => 'location'),
    );

    register_taxonomy('location', array('vacancy'), $args);
}
add_action('init', 'jobfair_register_location_taxonomy');

// Добавляем метабоксы
function jobfair_add_vacancy_metaboxes() {
    add_meta_box(
        'vacancy_details', // Уникальный идентификатор блока
        'Детали вакансии', // Заголовок блока
        'jobfair_vacancy_fields', // Функция которая выводит HTML
        'vacancy', // Для какого типа записи
        'normal', // Основная колонка
        'default' // Позиция
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

function jobfair_vacancy_shortcode($atts) {
    $atts = shortcode_atts( [
        'count' => 10, // количество постов по умолчанию
    ], $atts );
    $paged = max(1, get_query_var('paged'), get_query_var('page')); //текущая страница для пагинации, не меньше 1
    $vacancies = new WP_Query([ //новый запрос к базе данных
        'post_type' => 'vacancy', //ищем записи типа вакансии
        'posts_per_page' => (int) $atts['count'], //количество постов на странице
        'paged' => $paged, // номер текущей страницы
        'orderby' => 'date', //сортировать по дате
        'order' => 'DESC' //сначала новые
    ]);

    ob_start(); //буферизация вывода

    if ($vacancies->have_posts()) : //проверка есть ли вакансии
        while ($vacancies->have_posts()) : $vacancies->the_post(); //запуск цикла
            $company = get_post_meta(get_the_ID(), 'company_name', true); //получаем дополнительные поля
            $salary = get_post_meta(get_the_ID(), 'salary', true);
            $experience = get_post_meta(get_the_ID(), 'experience', true);
            $terms = get_the_terms( get_the_ID( ), 'location' ); //получаем термины таксономии
            $remote = get_post_meta(get_the_ID(), 'remote_work', true);
        ?>
        <!-- HTML разметка одной вакансии -->
        <div class="vacancy"> 
            <h3 class="vacancy-name">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="container__vacancy-info">
                <div class="container__info-company-fork">
                    <p class="salary"><?php echo esc_html($salary); ?> </p> 
                    <p class="company-name"><?php echo esc_html($company); ?></p>
                </div>
                <div class="container-info__about-work">
                    <?php if ($terms && !is_wp_error($terms)) : ?>
                        <p><?php echo esc_html($terms[0]->name) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($experience)) : ?>
                        <p><?php echo esc_html($experience) ?></p>
                    <?php endif; ?>
                    <?php if ($remote === '1') : ?>
                        <p>Можно удалённо</p>
                    <?php endif; ?>
                </div>
                <div class="container-btn">
                    <button class="apply-btn" data-vacancy-id="<?php echo get_the_ID(); ?>">Откликнуться</button>
                </div>
            </div>
        </div>
        <?php
        endwhile; //конец цикла
        wp_reset_postdata(); //возвращаем глобальные переменные в исходное состояние
    else :
        echo '<p>Пока нет опубликованных вакансий.</p>'; //если нет вакансий
    endif;
    if ($vacancies->max_num_pages > 1) { //вывод пагинации если страниц больше одной
        ?>
        <div class="paginate-links">
            <?php echo paginate_links([
                'total' => $vacancies->max_num_pages,
                'current' => $paged,
            ]); ?>
        </div>
    <?php
    }
    return ob_get_clean(); //возвращаем весь накопленный HTML функции 
}

add_shortcode( 'vacancies_list', 'jobfair_vacancy_shortcode' );