<?php get_header(); ?>
    <main>
        <section class="section-search">
            <h1>Найди работу мечты</h1>
            <form class="form-search" action="">
                <input class="input-search" type="text" placeholder="Профессия">
                <input class="input-search" type="text" placeholder="Локация">
                <input class="input-search" type="text" placeholder="Специализация">
                <button class="find-btn" type="button">Найти</button>
            </form>
        </section>
        <section class="section__hot-vacancies">
            <h2 class="section-header">Горячие вакансии</h2>
            <div class="container__carousel">
                <!-- Vacancy 1 -->
                <div class="hot-vacancy">
                    <h3>Название вакансии</h3>
                    <div class="container__info-hot-company-fork">
                        <h4>Mann, Renner and Bergnaum</h4>
                        <p>170 000 руб.</p>
                    </div>
                    <p class="about-work">Lorem ipsum dolor sit amet consectetur adipisicing met consectetur adipisicing elit. Accusantium iste maxime incidunt recusandae error, ullam dolores ipsam odit pariatur tenetur unde nobis.</p>
                    <button class="apply" type="button">Откликнуться</button>
                </div>
                <!-- Vacancy 2 -->
                    <div class="hot-vacancy">
                    <h3>Название вакансии</h3>
                    <div class="container__info-hot-company-fork">
                        <h4>Swaniawski - Gleason</h4>
                        <p>170 000 руб.</p>
                    </div>
                    <p class="about-work">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium  maxime quae  exercitationem error, ullam dolores ipsam odit pariatur tenetur unde nobis.</p>
                    <button class="apply" type="button">Откликнуться</button>
                </div>
            </div>
        </section>
        <section class="vacancies">
            <h2 class="section-header">Подобрали для вас</h2>

            <?php
            // Создаём запрос на вакансии
            $vacancies = new WP_Query([
                'post_type'      => 'vacancy', // тип записи
                'posts_per_page' => 6,         // сколько выводить
                'orderby'        => 'date',    // сортировка
                'order'          => 'DESC'     // сначала новые
            ]);

            if ($vacancies->have_posts()) :
                while ($vacancies->have_posts()) : $vacancies->the_post();
                    $company = get_post_meta(get_the_ID(), 'company_name', true);
                    $salary = get_post_meta(get_the_ID(), 'salary', true);
                    ?>
                    
                    <div class="vacancy">
                        <h3 class="vacancy-name">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="container__vacancy-info">
                            <div class="container__info-company-fork">
                                <h4 class="company-name"><?php echo esc_html($company); ?></h4>
                                <p><?php echo esc_html($salary); ?> ₽</p>
                            </div>
                            <div class="container-info__about-work">
                                <?php the_excerpt(); ?>
                            </div>
                            <div class="container-btn">
                                <button type="button" class="apply">Откликнуться</button>
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
        </section>
<?php get_footer(); ?>