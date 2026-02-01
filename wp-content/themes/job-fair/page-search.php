<?php
get_header();


$args = [
    'post_type' => 'vacancy',
    'posts_per_page' => 10,
];

if (!empty($_GET['profession'])) {
    $args['s'] = sanitize_text_field($_GET['profession']);
}

if (!empty($_GET['location'])) {
    $args['tax_query'] = [
        [
        'taxonomy' => 'location',
        'field' => 'slug',
        'terms' => sanitize_text_field($_GET['location']),
        ]
    ];
}

$query = new WP_Query($args);
?>

<main class="vacancies-page">
    <h1>Результаты поиска</h1>
    <?php if ($query->have_posts()) : ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>

        <article class="vacancy">
            <h2><?php the_title(); ?></h2>
            <a href="<?php the_permalink(); ?>">Подробнее</a>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <p>Вакансии не найдены</p>
        <?php endif; ?>
</main>

<?php get_footer(); ?>