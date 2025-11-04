<?php get_header(); ?>

<main class="single-vacancy">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <article class="vacancy-info">
            <h2 class="vacancy-title"><?php the_title(); ?></h2>

            <div class="vacancy-meta">
                <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'company_name', true)); ?></h3> 
                <p><strong>Зарплата:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'salary', true)); ?> ₽</p>
            </div>

            <div class="vacancy-content">
                <?php the_content(); ?>
            </div>

            <div class="vacancy-actions">
                <button class="apply">Откликнуться</button>
            </div>
        </article>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
