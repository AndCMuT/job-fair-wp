<?php get_header(); 
/*
Template Name: Главная
*/
?>
    <main>
        <section class="section-search">
            <h1>Найди работу мечты</h1>
            <form class="form-search" action="/search/" method="GET">
                <input class="input-search" type="text" name="profession" placeholder="Профессия">
                <select class="input-search" name="location">
                    <option value="">Локация</option>

                    <?php
                    $locations = get_terms([
                        'taxonomy' => 'location',
                        'hide_empty' => false,
                    ]);

                    if (!is_wp_error( $locations )) :
                        foreach ($locations as $location) :
                            $selected = (
                                isset($_GET['location']) &&
                                $_GET['location'] === $locations->slug 
                            ) ? 'selected' : '';
                            ?>
                            <option value="<?php echo esc_attr($location->slug); ?>" <?php echo $selected; ?>>
                                <?php echo esc_html($location->name); ?>
                            </option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                    
                    <!-- <option value="архангельская-область">Архангельская область</option>
                    <option value="krasnodar-krai">Краснодарский край</option> -->
                </select>
                <!-- <input class="input-search" type="text" placeholder="Специализация"> -->
                <button class="find-btn" type="submit">Найти</button>
            </form>
        </section>
        <section class="section__our-employees">
            <h2 class="section-header">Наши сотрудники готовые Вам помочь</h2>
            <div class="employees-container">
                <?php 
                    $employees = new WP_Query([
                        'post_type' => 'employee',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ]);

                    if ($employees->have_posts()) :
                        while ($employees->have_posts()) : $employees->the_post();
                            $specialization = get_post_meta(get_the_ID(), 'specialization', true);
                            $work_exp = get_post_meta(get_the_ID(), 'work_exp', true);
                            $services = get_post_meta(get_the_ID(), 'services', true);
                            $position = get_the_terms(get_the_ID(), 'position', true);
                    ?>
                    
                        <div class="employee-card">
                            
                            <div class="employee-header">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'thumbnail', ['class' => 'img-employee']); ?>
                                </a>
                                <h3 class="employees-name">
                                    <a class="employee-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="position"><?php echo esc_html($position[0]->name); ?></p>
                            </div>
                            <div class="employees-info">
                                <p class="specialization"><strong>Специализация: </strong><?php echo esc_html($specialization) ?></p>
                                <p class="work_exp"><strong>Опыт: </strong><?php echo esc_html($work_exp) ?></p>
                                <!-- <p class="services"><?php echo esc_html($services) ?></p> -->
                            </div>
                            <div class="service-btn-container">
                                <button class="service-btn">Выбрать услугу</button>
                            </div>
                        </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>Пока нет сотрудников</p>';
                    endif;
                    ?>
            </div>
        </section>
        <section class="vacancies">
            <h2 class="section-header">Подобрали для вас</h2>

            <?php
            // Создаём запрос на вакансии
            $vacancies = new WP_Query([
                'post_type'      => 'vacancy', // тип записи
                'posts_per_page' => 8,         // сколько выводить
                'orderby'        => 'date',    // сортировка
                'order'          => 'DESC'     // сначала новые
            ]);

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
        </section>
    </main>
<?php get_footer(); ?>