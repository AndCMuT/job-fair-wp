<?php
get_header();


$args = [
    'post_type' => 'vacancy',
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC'
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

$vacancies = new WP_Query($args);
?>

<main class="vacancies-page">
    <h1>Результаты поиска</h1>
    <?php
        if ($vacancies->have_posts()) :
            while ($vacancies->have_posts()) : $vacancies->the_post();
                $company = get_post_meta(get_the_ID(), 'company_name', true);
                $salary = get_post_meta(get_the_ID(), 'salary', true);
                $experience = get_post_meta(get_the_ID(), 'experience', true);
                $terms = get_the_terms( get_the_ID( ), 'location' );
                $remote = get_post_meta(get_the_ID(), 'remote_work', true);
                ?>
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
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Пока нет опубликованных вакансий.</p>';
        endif;
        ?>
</main>

<?php get_footer(); ?>