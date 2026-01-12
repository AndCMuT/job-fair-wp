<?php get_header(); ?>

<main class="single-news">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="news-container">
            <h2 class="news-title"><?php the_title(); ?></h2>

            <div class="news-content">
                <?php the_content(); ?>
            </div>
            <div class="about-news">
                <p><strong>Дата:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'event_date', true)); ?></p>
                <p><strong>Автор:</strong> <?php echo esc_html(get_the_author()); ?></p>
                <p><strong>Источник:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'news_source', true)); ?></p>
            </div>
        </article>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>