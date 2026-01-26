<?php get_header(); ?>

<main class="single-employee">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="employee-container">
            <h2 class="employee-name"><?php the_title(); ?></h2>
            <div class="info-employee">

            </div>
            <div class="about-employee">
                <?php the_content(); ?>
                <p><strong>Специализация:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'specialization', true)); ?></p>
                <p><strong>Опыт работы</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'work_exp', true)); ?></p>
                <p><strong>Услуги</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'services', true)); ?></p>
            </div>

        </article>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>