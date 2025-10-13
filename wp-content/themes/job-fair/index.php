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
            <!-- Vacancy 1 -->
            <div class="vacancy">
                <h3 class="vacancy-name">Системный администратор</h3>
                <div class="container__vacancy-info">
                    <div class="container__info-company-fork">
                        <h4 class="company-name">Kirlin LLC</h4>
                        <p>170 000 руб.</p>
                    </div>
                    <div class="container-info__about-work">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem blanditiis, accusantium iste maxime quae incidunt exercitationem recusandae repellat error, ullam dolores tempora quas sunt ipsam odit pariatur tenetur unde nobis</p>
                    </div>
                    <div class="container-btn">
                        <button type="button" class="apply">Откликнуться</button>
                    </div>
                </div>
            </div>
            <!-- Vacancy 2 --> 
            <div class="vacancy">
                <h3 class="vacancy-name">DevOps инженер</h3>
                <div class="container__vacancy-info">
                    <div class="container__info-company-fork">
                        <h4 class="company-name">Crooks, Deckow and Lubowitz</h4>
                        <p>170 000 руб.</p>
                    </div>
                    <div class="container-info__about-work">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem blanditiis, accusantium iste maxime quae incidunt exercitationem recusandae repellat error, ullam dolores tempora quas sunt ipsam odit pariatur tenetur unde nobis</p>
                    </div>
                    <div class="container-btn">
                        <button type="button" class="apply">Откликнуться</button>
                    </div>
                </div>
            </div>
            <!-- Vacancy 3 --> 
            <div class="vacancy">
                <h3 class="vacancy-name">UX/UI дизайнер</h3>
                <div class="container__vacancy-info">
                    <div class="container__info-company-fork">
                        <h4 class="company-name">Swift - Miller</h4>
                        <p>170 000 руб.</p>
                    </div>
                    <div class="container-info__about-work">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem blanditiis, accusantium iste maxime quae incidunt exercitationem recusandae repellat error, ullam dolores tempora quas sunt ipsam odit pariatur tenetur unde nobis</p>
                    </div>
                    <div class="container-btn">
                        <button type="button" class="apply">Откликнуться</button>
                    </div>
                </div>
            </div>
            <!-- Vacancy 3 --> 
            <div class="vacancy">
                <h3 class="vacancy-name">UX/UI дизайнер</h3>
                <div class="container__vacancy-info">
                    <div class="container__info-company-fork">
                        <h4 class="company-name">Swift - Miller</h4>
                        <p>170 000 руб.</p>
                    </div>
                    <div class="container-info__about-work">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem blanditiis, accusantium iste maxime quae incidunt exercitationem recusandae repellat error, ullam dolores tempora quas sunt ipsam odit pariatur tenetur unde nobis</p>
                    </div>
                    <div class="container-btn">
                        <button type="button" class="apply">Откликнуться</button>
                    </div>
                </div>
            </div>
        </section>
<?php get_footer(); ?>