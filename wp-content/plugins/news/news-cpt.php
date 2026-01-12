<?php
/**
 * Plugin Name: JobFair News CPT
 * Description: Плагин для публикации новостей
 * Version: 1.0
 * Author: Smetanin Andrey
 */

// Защита — если файл вызван напрямую
if ( !defined('ABSPATH') ) {
    exit;
}

// Новости
function jobfair_register_news_cpt() {
    register_post_type('news', [
        'labels' => [
            'name' => 'Новости',
            'singular_name' => 'Новость',
            'add_new' => 'Добавить новость',
            'add_new_item' => 'Добавить новую новость',
            'edit_item' => 'Редактировать новость',
            'new_item' => 'Новая новость',
            'view_item' => 'Просмотр новости',
        ],
        'public' => true,
        'menu_icon' => 'dashicons-text-page',
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'author'],
        'rewrite' => ['slug' => 'news'],
        'show_in_rest' => 'true',
    ]);
}
add_action('init', 'jobfair_register_news_cpt');

function jobfair_register_news_taxonomy() {
    register_taxonomy( 'news_category', 'news', [
        'labels' => [
            'name' => 'Рубрики новостей',
            'singular_name' => 'Рубрика',
        ],
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
    ]);
}

add_action('init', 'jobfair_register_news_taxonomy');

function jobfair_add_news_metabox()  {
    add_meta_box(
        'news_details',
        'Дополнительная информация',
        'jobfair_news_fields',
        'news'
    );
}

add_action('add_meta_boxes', 'jobfair_add_news_metabox');

function jobfair_news_fields($post) {
    $source = get_post_meta($post->ID, 'news_source', true);
    $event_date = get_post_meta($post->ID, 'event_date', true);
    ?>

    <p>
        <label for="news_source">Источник новости:</label><br>
        <input type="text" name="news_source" value="<?php echo esc_attr( $source ); ?>" style="width:100%" >
    </p>
    <p>
        <label for="event_date">Дата публикации</label>
        <input type="text" name="event_date" value="<?php echo esc_attr($event_date); ?>" style="width:100%" >
    </p>
    <?php
}

function jobfair_save_news_fields($post_id) {
    if (isset($_POST['news_source'])) {
        update_post_meta(
            $post_id,
            'news_source',
            sanitize_text_field($_POST['news_source'])
        );
    }

    if (isset($_POST['event_date'])) {
        update_post_meta(
            $post_id,
            'event_date',
            sanitize_text_field($_POST['event_date'])
        );
    }
}
add_action('save_post_news', 'jobfair_save_news_fields');

//Шорткод для вывода новостей

function jobfair_news_shortcode($atts) {

    $atts = shortcode_atts([
        'count' => 5,
    ], $atts);

    $query = new WP_Query([
        'post_type' => 'news',
        'post_per_page' => (int)$atts['count'],
    ]);

    ob_start();

    if ($query->have_posts(  )) :
        while ($query->have_posts(  )) : $query->the_post(  );
            ?>
            <div class="news-item">
                <?php if (has_post_thumbnail( )) : ?>
                    <div class="news-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                <div class="container-title-excerpt">
                    <h3>
                        <a href="<?php the_permalink(  ); ?>"><?php the_title( ); ?> </a>
                    </h3>
                    <?php the_excerpt(  ); ?>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;

    return ob_get_clean();
}

add_shortcode('news_list', 'jobfair_news_shortcode');